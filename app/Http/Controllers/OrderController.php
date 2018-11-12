<?php

namespace App\Http\Controllers;

use Language;
use DinamicsGP;
use Mail;
use Image;
use App\Helpers\File;
use App\Attribute;
use App\Action;
use App\Client;
use App\City;
use App\Color;
use App\Country;
use App\CountryAttribute;
use App\Courier;
use App\Diagnostic;
use App\Failure;
use App\Order;
use App\OrderHistory;
use App\OrderHistoryAction;
use App\OrderHistoryDiagnostic;
use App\OrderHistoryComment;
use App\OrderFailure;
use App\OrderAttachment;
use App\Product;
use App\Province;
use App\State;
use App\Workshop;
use App\Jobs\SendOrderCreateEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests;

class OrderController extends Controller
{
    private function rules($optional = []) {
         $rules = [
            'client_id' => 'required',
            '_product_id' => 'required',
            'type_management' => 'required',
            'gp_imei' => 'required|numeric',
            'gp_brand' => 'required',
            'gp_model' => 'required',
            'gp_part_number' => 'required',
            //'gp_invoice_date' => 'required',
            //'gp_purchase_date' => 'required',
            'failure_description' => 'required',
            'failures_list' => 'required',
            'personal_retreat' => 'required',
            'order_country_id' => 'required',
            'order_province_id' => 'required',
            'order_city_id' => 'required',
            'workshop_id' => 'required',
        ];

        if ($optional) $rules = $rules + $optional;
        return $rules;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Since laravel version 5.3, session variables or values are not accessible from the controllers__construct methods
        $this->middleware(function ($request, $next) {
            
            Language::setLanguage();
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session()->forget('load_data');
        session()->forget('order_failures');
        
        //Si el usuario tiene role de workshop, se filtran solo las ordenes del taller asociado a ese usuario
        switch (\Auth::user()->role) {
            case 'workshop':
                $orders = Order::WithRelations()->where('workshop_id', \Auth::user()->workshop_id)->get();
                break;

            case 'client':
            case 'store':
                $orders = Order::WithRelations()->where('client_id', \Auth::user()->client->id)->get();
                break;
                
            default:
                //callcenter, analist, manager and admin
                $orders = Order::WithRelations()->get();
                break;
        }
        
        return view('orders.grid', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edit = false;
        $user = \Auth::user();
        $products = Product::orderBy('description')->pluck('description', 'id');
        $failures = Failure::listsTranslations('name')->orderBy('name')->pluck('name', 'id'); //List with translations
        session()->forget('failures_list');

        if ($user->role == 'client')
        {
            $client = Client::find($user->client_id);
            $workshops = Workshop::where('country_id', $user->country_id)->orderBy('description')->pluck('description', 'id');
            $colors = Color::orderBy('description')->pluck('description', 'id');
            return view('orders.external.create', compact('edit','client','products','failures','workshops','colors'));

        } else {
            $modal_json = true;
            $modal_view = true;
            $countries = Country::orderBy('description')->pluck('description', 'id');
            $provinces = [];
            $cities = [];
            $workshops = Workshop::orderBy('description')->pluck('description', 'id');
            $clients = Client::withTrashed()->with(['person','business'])->ListAll()->pluck('names', 'id');
            $clients_grid = Client::withTrashed()->with(['person','business'])->get();
            
            $this->dropDownLists($types, $status, $type_management);

            return view('orders.create', compact('countries', 'provinces', 'cities', 'workshops', 'products', 'clients', 'clients_grid', 'failures', 'status', 'types', 'type_management', 'modal_json', 'modal_view', 'edit'));
        }
    }

    public function store_external(Request $request) {

        dd($request->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules_optional = [];
        if ($request->hasFile('client_invoice_doc')) {
            $rules_optional["client_invoice_doc"] = "mimes:jpeg,bmp,png,pdf";
        }
        if ($request->get('personal_retreat')=='no') {
            $rules_optional["devolution_zip_code"] = "required";
            $rules_optional["devolution_address"] = "required";
        }
        if ($request->get('client_invoice_date')) {
            $rules_optional['client_invoice_date'] = 'date_format:d/m/Y';
        }
        $v = \Validator::make($request->all(), $this->rules($rules_optional));

        //Replace inputs 'failures_list' by $failures_temp
        $failures_list = $this->prepareListFailuresOrder($request);
        //I keep in session so you do not miss the temporary list in the frontend
        session()->forget('failures_list');
        session()->put('failures_list', $failures_list);
        $request->merge(['failures_list' => $failures_list ]);

        //Back to failures
        if ($v->fails()) {
            \Utility::setMessage(['message' => $v->errors()->all()]);
            $countries = Country::orderBy('description')->pluck('description', 'id');
            $provinces = ($request->get('order_country_id')) ? Province::where('country_id', $request->get('order_country_id'))->orderBy('description')->pluck('description', 'id') : [];
            return back()->with('provinces', [$provinces])->withInput($request->all());
        }

        if (Order::IsImeiInUse($request->get('gp_imei'))->count())
        {
            \Utility::setMessage(['message' => trans('messages.errors.orders.imei_in_use')]);
            return back()->withInput($request->all());
        }

        $user = \Auth::user();
        $state = State::where('code', 'issued_case')->first();
        $country_source = $request->get('order_country_id');

        //Get OS Secuence
        $countryParameter = CountryAttribute::with(['country','attribute'])->GetAttribute($country_source, '%OS_SECUENCE%')->first();
        $data = $this->prepareDataOrder($request, $user, $state, $countryParameter);
        $date = Carbon::now(City::where('id', $data['city_id'])->first()->timezone);

        //Register order
        $order = Order::create($data);

        if ($order) {
            //Log States
            OrderHistory::create([
                "order_id" => $order->id,
                "state_id" => $state->id,
                "user_id" => $user->id,
                'log_date' => $date,
            ]);

            //Failures
            foreach ($failures_list as $failure) {
                OrderFailure::create([
                    "order_id" => $order->id,
                    "failure_id" => $failure['id'],
                    'date_registered' => $date,
                ]);
            }

            //update correlative of country
            $countryParameter->UpdateCorrelative();
            
            //Log order created
            $order->createLog();
            $order->sendNotice();

            //Send email notification only if indicated on the form
            if ($request->get('email_notify')=='yes') {
                $order->sendMail();
            }

            session()->forget('failures_list');
            \Utility::setMessage([
                "message" => trans('orders.order_registered', ['order_number' => $order->order_number]),
                "messageTimeShow" => 8000,
                ], 'success');

            return redirect()->route('order.index'); 

        } else {

            \Utility::setMessage(['message' => trans('messages.errors.orders.not_process_order')]);
            return redirect()->back()->withInput($request->all());

        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::WithRelations($id)->first();
        if (!$order) 
        {
            \Utility::setMessage(['message' => trans('messages.errors.orders.not_process_order')]);
            return redirect()->to('order');
        }
         
        $histories_list   = $this->formatHistories($order->histories);
        
        $url_tracking = trans('couriers.tracking.'.strtolower($order->courier->description).'.url');
        $method = trans('couriers.tracking.'.strtolower($order->courier->description).'.method');
        $parameters = trans('couriers.tracking.'.strtolower($order->courier->description).'.parameters') ;
        if ($method == 'GET')
        {
            $url_tracking = $url_tracking.'?';
            foreach($parameters as $key => $value) {
                $url_tracking = $url_tracking.$key.'='.(($value==':number_tracking') ? $order->tracking : $value).'&';
            }
        }
        return view('orders.resume', compact('order','histories_list','actions_list','diagnostics_list','url_tracking','method','parameters'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::with(['state'])->where('id', $id)->first();

        if (!$order) {
            \Utility::setMessage(['message' => trans('messages.errors.orders.order_not_exist')]);
            return redirect()->to('order');
        }
        
        if ($order->state->code != 'issued_case') {
            \Utility::setMessage(['message' => trans('messages.errors.orders.order_not_can_modify')]);
            return redirect()->to('order');   
        }
        
        $edit = true;
        $modal_json = true;
        $modal_view = true;
        $countries = Country::orderBy('description')->pluck('description', 'id');
        $provinces = Province::where('country_id', $order->country_id)->orderBy('description')->pluck('description', 'id');
        $cities = City::where('province_id', $order->province_id)->orderBy('description')->pluck('description', 'id');
        $workshops = Workshop::orderBy('description')->pluck('description', 'id');
        $couriers = Courier::orderBy('description')->pluck('description', 'id');
        $products = Product::orderBy('description')->pluck('description', 'id');
        $clients = Client::ListAll()->pluck('names', 'id');
        $clients_grid = Client::withTrashed()->with(['person','business'])->get();
        $failures = Failure::listsTranslations('name')->orderBy('name')->pluck('name', 'id'); //List with translations
        $order_failures = OrderFailure::with(['failure'])->where('order_id', $order->id)->get();

        $failures_list = [];
        if ($order_failures) {
            foreach ($order_failures as $key => $value) {
                $failures_list[$key] = ['id' => $value->failure_id, 'description' => $value->failure->name];
            }
        }

        session()->put('failures_list', $failures_list);
        $this->dropDownLists($types, $status, $type_management);

        return view('orders.create', compact('order', 'countries', 'provinces', 'cities', 'workshops', 'couriers', 'products', 'clients', 'clients_grid', 'failures', 'status', 'types', 'type_management', 'modal_json', 'modal_view', 'edit'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules_optional = [];
        if ($request->get('personal_retreat')=='no') {
            $rules_optional["devolution_zip_code"] = "required";
            $rules_optional["devolution_address"] = "required";
        }
        $v = \Validator::make($request->all(), $this->rules($rules_optional));

        $failures_list = $this->prepareListFailuresOrder($request);

        //This is to manipulate the list of failures in the event that for any error return to the edit view (app/order/#/edit) => 
        session()->forget('failures_list');
        session()->put('failures_list', $failures_list);
        //Replace inputs 'failures_list' by $failures_temp
        $request->merge(['failures_list' => $failures_list ]);

        if ($v->fails()) {
            \Utility::setMessage(['message' => $v->errors()->all()]);
            return redirect()->back()->withInput($request->all());
        }

        $user = \Auth::user();
        $data = $this->prepareDataOrder($request, $user);
        
        $order = Order::with(['failures'])->where('id', $id)->first();
        if (!$order) {
            \Utility::setMessage(['message' => trans('messages.errors.orders.order_not_exist')]);
            return redirect()->to('order');
        } else {
            $order->update($data);
            $order->failures()->forceDelete();

            if ($failures_list) {
                foreach ($failures_list as $key => $failure) {
                    OrderFailure::create([
                        'order_id' => $order->id,
                        'failure_id' => $failure['id'],
                    ]);
                }
            }
        }

        session()->forget('failures_list');
        \Utility::setMessage([
            "message" => trans('orders.order_updated', ['order_number' => $order->order_number]),
            "messageTimeShow" => 8000,
        ], 'success');

        return redirect()->route('order.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showFormUploadAttachment($order_id) 
    {
        $order = Order::where('id', $order_id)->first();
        return view('orders.partials.upload_file',compact('order'));
    }

    public function showFormState($order_id)
    {
        $order = Order::where('id', $order_id)->first();

        $states = State::listsTranslations('name')->orderBy('name')->pluck('name', 'id');
        $diagnostics = Diagnostic::has('states')->listsTranslations('name')->orderBy('name')->pluck('name', 'id');
        $actions = Action::has('states')->listsTranslations('name')->orderBy('name')->pluck('name', 'id');
                

        return view('orders.partials.edit_state',compact('order','states','actions','diagnostics'));
    }

    public function showFormEquipmentReceive($order_id) 
    {
        $order = Order::where('id', $order_id)->first();
        return view('orders.partials.equipment_receive',compact('order'));
    }

    public function saveState(Request $request, $id) {

        $rules = [
            'state_id' => 'required',
        ];

        $actions_list     = $this->prepareDynamicListOrder($request, 'actions_list');
        $diagnostics_list = $this->prepareDynamicListOrder($request, 'diagnostics_list');
        session()->forget('actions_list');
        session()->forget('diagnostics_list');
        $order = Order::where('id', $id)->first();
        $history = OrderHistory::where('order_id', $order->id)->where('state_id', $request->get('state_id'))->first();
        
        if ((!$history)||($history==null)) {
            $history = OrderHistory::create([
                'order_id' => $order->id,
                'state_id' => $request->get('state_id'),
                'user_id' => \Auth::user()->id,
                'log_date' => $order->DateForTimezone,
            ]);

            //change state order
            $order->state_id = $request->get('state_id');
            $order->save();
        }
        if ($request->get('comment'))
        {
            OrderHistoryComment::create([
                'order_history_id' => $history->id,
                'user_id' => \Auth::user()->id,
                'comment' => $request->get('comment'),
                'log_date' => $order->DateForTimezone,
            ]);
        }
        if($actions_list){
          foreach ($actions_list as $action) {
                $history_action =  OrderHistoryAction::where('order_id','=', $order->id)
                                                     ->where('order_history_id','=', $history->id)
                                                     ->where('action_id','=', $action['id'])
                                                     ->get();
                if($history_action->count() == 0)
                {                                      
                    OrderHistoryAction::create([
                        'order_id'         => $order->id,
                        'order_history_id' => $history->id,
                        'action_id'        => $action['id'],
                        'user_id'          => \Auth::user()->id,
                        'log_date'         => $order->DateForTimezone,
                    ]);
                }
            }
        }
        if($diagnostics_list){
          foreach ($diagnostics_list as $diagnostic) {
               $history_diagnostic = OrderHistoryDiagnostic::where('order_id','=',$order->id)
                                                           ->where('order_history_id', '=',$history->id)
                                                           ->where('diagnostic_id', '=',$diagnostic['id'])
                                                           ->get();
               
                if($history_diagnostic->count() == 0)
                {
                    OrderHistoryDiagnostic::create([
                            'order_id'         => $order->id,
                            'order_history_id' => $history->id,
                            'diagnostic_id'    => $diagnostic['id'],
                            'user_id'          => \Auth::user()->id,
                            'log_date'         => $order->DateForTimezone,
                   ]);
                }
            }
        }

        
        \Utility::setMessage([
            "message" => trans('orders.order_updated', ['order_number' => $order->order_number]),
            "messageTimeShow" => 8000,
        ], 'success');

        return redirect()->route('order.show', [$id]);
    }

    public function orderReceived(Request $request) 
    {
        $rules = [
            'gp_imei' => 'required',
        ];
        $v = \Validator::make($request->all(), $rules);
        if ($v->fails()) {
            \Utility::setMessage(['message' => $v->errors()->all()]);
            return redirect()->back()->withInput($request->all());
        }

        $data = $request->except(['gp_imei']);
        $data['imei'] = explode(",", str_replace("\r\n", '', $request->get('gp_imei')) );
        
        foreach ($data['imei'] as $key => $imei) {
            
            $order = Order::OnlyCaseForWorkshop($imei)->first();

            if ($order)
            {
                //register history
                $state = State::where('code', 'received')->first();
                $history = OrderHistory::create([
                        'order_id' => $order->id,
                        'user_id' => \Auth::user()->id,
                        'state_id' => $state->id,
                        'log_date' => $order->DateForTimezone,
                    ]);
                
                if ($request->get('comment')) {
                    OrderHistoryComment::create([
                        'order_history_id' => $history->id,
                        'user_id' => \Auth::user()->id,
                        'comment' => $request->get('comment'),
                        'log_date' => $order->DateForTimezone,
                    ]);
                }

                $order->state_id = $state->id;
                $order->accesories_received = $this->setAccesoriesJson($data['accesories']);
                $order->save();

                //Log order created
                $order->createLog();
                $order->sendNotice();
            }
        }
        
        \Utility::setMessageSuccess();
        return redirect()->route('order.index');
    }


    public function uploadAttachment(Request $request, $id)
    {

        $rules = [
            'order_attachment' => 'required|mimes:jpeg,jpg,bmp,png,doc,docx,pdf,xls,avi,mp4,mpeg|max:30000000',
        ];
        $v = \Validator::make($request->all(), $rules);
        if ($v->fails()) {
            \Utility::setMessage(['message' => $v->errors()->all()]);
            return redirect()->back()->withInput($request->all());
        }

        $order = Order::where('id', $id)->first();

        $fileuploaded = File::section('default')->setting([
                'filesystem' => env('FILESYSTEM'),
                'subpath' => 'attachments',
                'code' => true, 
                'code_value' => $order->order_number
            ])->upload($request->file('order_attachment'));
        
        OrderAttachment::create([
            'order_id' => $id,
            'user_id' => \Auth::user()->id,
            'attachment_doc' => $fileuploaded,
            'comment_doc' => $request->get('comment_doc'),
        ]);

        \Utility::setMessage([
            "message" => trans('orders.order_updated', ['order_number' => $order->order_number]),
            "messageTimeShow" => 8000,
        ], 'success');

        return redirect()->route('order.show', $order->id); 
    }

    public function assignCourier($id) 
    {
        $order = Order::with(['state'])->where('id', $id)->first();
        if (!$order) 
        {
            \Utility::setMessage(['message' => trans('messages.errors.orders.order_not_exist')]);
            return redirect()->to('order');
        }
        $couriers = Courier::orderBy('description')->pluck('description', 'id');
        return view('orders.assign_courier', compact('couriers','order'));
    }

    public function saveCourier(Request $request, $id)
    {
        $order = Order::where('id', $id)->first();
        $order->courier_id = $request->get('courier_id');
        $order->tracking = $request->get('tracking');
        $order->save();

        \Utility::setMessage([
            "message" => trans('orders.order_updated', ['order_number' => $order->order_number]),
            "messageTimeShow" => 8000,
        ], 'success');

        return redirect()->route('order.show', $order->id); 
    }

    /**
     * Download documents or Invoice Order
     * @param  string   $type       'invoice|attachment'
     * @param  integer  $order      Id Order
     * @param  integer  $attachment   Id Attachment
     * @return binary   file
     */
    public function downloadDocument($order, $type, $attachment) {

        $order = Order::with(['attachments'])->where('id', $order)->first();
        $url = '';
        $filename = '';

        switch ($type) {
            case 'invoice':
                $url = getenv('FILES_STORAGE_SERVER').$order->client_invoice_doc;
                break;

            case 'attachment':
                $url = getenv('FILES_STORAGE_SERVER').$order->attachments->where('id', $attachment)->first()->attachment_doc;
                break;

            default:
                # code...
                break;
        }
        
        $filename = pathinfo($url, PATHINFO_FILENAME).'.'.pathinfo($url, PATHINFO_EXTENSION);
        header("Content-disposition:attachment; filename=$filename");
        return readfile($url);

    }

    private function dropDownLists(&$types, &$status, &$type_management) {

        foreach (array_keys(trans('globals.type_client')) as $value) {
            $types[$value] = ucfirst($value);
        }

        foreach (array_keys(trans('globals.type_status')) as $value) {
            $status[$value] = ucfirst($value);
        }

        foreach (array_keys(trans('globals.type_management')) as $value) {
            $type_management[$value] = ucfirst($value);
        }
    }

    private function prepareDataOrder($request, $user, $state = null, $countryParameter = null) {

        $data = $request->except([
            'failure',
            'failures_list',
            'failures_list_temp',
            '_order_province_id',
            '_order_city_id',
            '_workshop_id',
        ]);
        
        if ($countryParameter) {
            $data['order_number'] = $countryParameter->correlative();
        }
        //upload invoice to Amazon S3 Server
        if ($request->hasFile('client_invoice_doc')) {
            $fileuploaded = File::section('default')->setting([
                'filesystem' => env('FILESYSTEM'),
                'subpath' => 'invoice',
                'code' => true, 
                'code_value' => $data['order_number']
            ])->upload($request->file('client_invoice_doc'));
            $data['client_invoice_doc'] = $fileuploaded;

            //if the bill was already attached, it is removed which is registered in database to save the new invoice
            if ($request->get('_client_invoice_doc')) {
                File::deleteFile($request->get('_client_invoice_doc'), env('FILESYSTEM'));
            }
        }

        $data['client_invoice_date'] = ($data['client_invoice_date']) ? Carbon::createFromFormat('d/m/Y', $data['client_invoice_date']) : null;

        $data['user_id'] = $user->id;
        $data['product_id'] = $data['_product_id'];
        unset($data['_product_id']);
        //These fields are defined in the array manually because the model does not exist, and the method Order::create () 
        //executes an auto assignment of values if the field names that match
        $data['country_id'] = $data['order_country_id'];
        $data['province_id'] = $data['order_province_id'];
        $data['city_id'] = $data['order_city_id'];

        //Format date
        $data['gp_invoice_date'] = Carbon::parse($data['gp_invoice_date'])->format('Y-m-d');
        $data['gp_purchase_date'] = Carbon::parse($data['gp_purchase_date'])->format('Y-m-d');
        
        //Set date according to the time zone of the selected city 
        if ($countryParameter) {
            $date = Carbon::now(City::where('id', $data['city_id'])->first()->timezone);
            $data['order_date'] = $date;
        }

        //Get Id from States Orders (FIRST STATE FROM PROCESS)
        if ($state) { 
            $data['state_id'] = $state->id;
        }
        return $data;
    }

    private function prepareListFailuresOrder($request) {

        $failures_temp = $request->get('failures_list') ? : '';
        $failures = [];

        if ($failures_temp) {
            foreach ($failures_temp as $key => $value) {
                $items = explode(',', $value);
                $failures[$key] = ['id' => $items[0], 'description' => $items[1]];
            }
        }

        return $failures;
    }

    private function prepareDynamicListOrder($request, $listName) {

        $temporary_list = $request->get($listName) ? : '';
        $list = [];
        if ($temporary_list) {
            foreach ($temporary_list as $key => $value) {
                $items = explode(',', $value);
                $list[$key] = ['id' => $items[0], 'description' => $items[1]];
            }
        }

        return $list;
    }

    public function setAccesoriesJson($data)
    {
        $accesories = [];
        foreach (array_keys(trans('globals.accesories')) as $key) {
            $accesories[$key] = (in_array($key, $data)) ? 'yes' : 'no';
        }

        return json_encode($accesories);
    }

    private function getJson($data) 
    {
        if (is_string($data)){
            return $this->isJson($data)?json_decode($data):[];
        }
        return is_array($data) || is_object($data)?$data:[];
    }

    private function isJson($string) 
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    public function resendEmailOrderCreated(Request $request, $id) {

        $order = Order::find($id);
        $order->sendMail();

        if ($request->ajax() || $request->wantsJson()) {
            return new JsonResponse('OK', 200);
        } else {
            return  true;
        }
    }

    public function formatHistories($histories)
    {

        //group by log_date
        $data = [];
        $temp = [];
        $histories->each(function($history, $key) use (&$data, &$temp) {
            $index = $history->log_date->format('d/m/Y');
            if (!isset($data[$index])) {
                $data[$index] = [];
                $temp = [];
            }
            $temp[$key] = $history;
            $data[$index] = $temp;

        });
        
        return $data;
    }

    public function orderByStatus($status) 
    {
        
    }

    public function showTicket($order_id)
    {
        $order = Order::with(['client','workshop','product'])->where('id', $order_id)->first();
        
        $data_pdf['order'] = $order;

        $pdf = \PDF::loadView('pdf.order_delivered', $data_pdf);
        //To save in Amazon S3
        $path_cloud = '/documents/'.$order->order_number.'/'.trans('email.orders.order_delivered.filename', ['order_number' => $order->order_number]);
        Storage::disk('s3')->put($path_cloud, $pdf->output(), 'public');

        $url = getenv('FILES_STORAGE_SERVER').$path_cloud;

        $filename = pathinfo($url, PATHINFO_FILENAME).'.'.pathinfo($url, PATHINFO_EXTENSION);
        header("Content-disposition:attachment; filename=$filename");
        return readfile($url);
    }

    public function updateTypeManagement(Request $request, $id)
    {
        $order = Order::find($id);

        if ($order)
        {
            $order->type_management = ($order->type_management == 'warranty') ? 'out_of_warranty' : 'warranty';
            $order->update();
        }
        \Utility::setMessage([
            "message" => trans('orders.order_updated', ['order_number' => $order->order_number]),
            "messageTimeShow" => 8000,
        ], 'success');

        return redirect()->route('order.show', $order->id); 
    }

    public function deleteState(Request $request, $id) {
        
        $order_history_id = $request->get('id');
        $order = Order::find($id);
        $user= \Auth::user();
        $order_history = OrderHistory::find($order_history_id);
        if ($order_history) {
            $order_history->deleted_by = $user->id;
            $order_history->deleted_at = $order->DateForTimezone;
            $order_history->save();

            //update state to the order
            $new_state = OrderHistory::where('order_id', $id)->orderBy('log_date', 'desc')->first();
            $order->state_id = $new_state->state_id;
            $order->save();

            //delete actions and diagnostics asociated to order state
            $order_actions_by_history= OrderHistoryAction::where('order_history_id', $order_history_id)->get();
            $order_actions_by_history->each(function ($item, $key) use ($user, $order) {
                $item->deleted_by = $user->id;
                $item->deleted_at = $order->DateForTimezone;
                $item->save();
            });

            $order_diagnostics_by_history= OrderHistoryDiagnostic::where('order_history_id', $order_history_id)->get();
            $order_diagnostics_by_history->each(function ($item, $key) use ($user, $order) {
                $item->deleted_by = $user->id;
                $item->deleted_at = $order->DateForTimezone;
                $item->save();
            });
        }

        $route_redirect = route('order.show', [$id]);   //A donde voy a redireccionar

        if ($request->ajax() || $request->wantsJson()) {
            return new JsonResponse([
                'url' => $route_redirect
                ], 200);
        } else {
            return  true;
        }
    }

    public function deleteAction(Request $request, $order) {
        
    }

    public function deleteDiagnostic(Request $request, $order) {
        
    }
}
