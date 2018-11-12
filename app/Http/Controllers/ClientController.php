<?php

namespace App\Http\Controllers;

use App\Client;
use App\Country;
use App\Province;
use App\City;
use App\Business;
use App\Person;
use App\User;
use Language;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests;

class ClientController extends Controller
{
    private function rules($optional = []) {
        $rules = [
            'country_id' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'status' => 'required',
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
        $clients_grid = Client::withTrashed()->with(['person','business'])->get();
        $modal_view = false;
        return view('clients.grid', compact('clients_grid','modal_view'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edit = false;
        $countries = Country::orderBy('description')->pluck('description', 'id');
        $provinces = Province::orderBy('description')->pluck('description', 'id');
        $cities = City::orderBy('description')->pluck('description', 'id');
        $this->dropDownLists($types, $status);

        return view('clients.create', compact('types', 'status', 'countries', 'provinces', 'cities', 'edit'));
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
        $client = null;
        $rules_optional['type'] = 'required';
        switch ($request->get('type')) {
            //type business
            case 'business':        
                //$rules_optional["code_identification"] = "required";
                $rules_optional["description"] = "required";
                $client_exist = Business::where('code_identification', 'like', '%' . $request->get('code_identification') . '%')
                            ->where('description', 'like', '%' . $request->get('description') . '%')
                            ->first();
                break;
            //type person
            default:
                //$rules_optional["identification"] = "required";
                $rules_optional["first_name"] = "required";
                $rules_optional["last_name"] = "required";
                $rules_optional["cellphone_number"] = "required";
                $client_exist = Person::where('first_name', 'like', '%' . $request->get('first_name') . '%')
                            ->where('last_name', 'like', '%' . $request->get('last_name') . '%')
                            ->Where('identification', 'like', '%' . $request->get('identification') . '%')
                            ->first();
                break;
        }

        $v = \Validator::make($request->all(), $this->rules($rules_optional));
        
        //This response only occurs if the request this procedure is done by ajax
        if ($request->ajax() || $request->wantsJson())
        {
            if ($v->fails()) {
                return new JsonResponse($v->errors(), 422);
            }
            if ($client_exist) {
                return new JsonResponse([(($request->get('type') == 'business') ? 'description' : 'identification') => trans('messages.errors.clients.client_already_exist')], 422);   
            }
        }

        if ($v->fails()) {
            \Utility::setMessage(['message' => $v->errors()->all()]);
            return redirect()->back()->withInput($request->all());
        }

        if ($client_exist) {
            \Utility::setMessage(['message' => trans('messages.errors.clients.client_already_exist')]);
            return redirect()->back()->withInput($request->all());
        }

        //Save data for type
        $client = Client::create($request->all());

        if ($client->type == 'business') {
            Business::create([
                'client_id' => $client->id,
                'code_identification' => $request->code_identification,
                'description' => $request->description,
                'contact_name' => $request->contact_name,
                ]);
        } else {
            Person::create([
                'client_id' => $client->id,
                'identification' => $request->identification,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                ]);
        }

        if ($request->ajax() || $request->wantsJson()) {
            return new JsonResponse('OK', 200);
        } else {
            \Utility::setMessageSuccess();
            return redirect()->route('client.index');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->prepareDataClient($id);
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
        $type_client = !$request->get('type') ? $request->get('_type') : $request->get('type');
        switch ($type_client) {
            case 'business':
                //$rules_optional["code_identification"] = "required";
                $rules_optional["description"] = "required";
                break;
            //type person
            default:
                //$rules_optional["identification"] = "required";
                $rules_optional["first_name"] = "required";
                $rules_optional["last_name"] = "required";
                break;
        }

        $v = \Validator::make($request->all(), $this->rules($rules_optional));
        
        if ($v->fails()) {
            \Utility::setMessage(['message' => $v->errors()->all()]);
            return redirect()->back()->withInput($request->all());
        }

        $client = Client::find($id);

        //Si existen otros clientes con los mismos atributos, entonces no realizo el update
        if ($client->otherCustomersWithSameAttributes($request))
        {
            \Utility::setMessage([
                "message" => trans('messages.errors.clients.client_same_attribute'),
                "messageTimeShow" => 8000,
                ], 'error');
            return redirect()->back()->withInput($request->all());
        }

        if ($client) {
            $client->update($request->all());
            if ($client->type == 'person') {
                $client->person->update([
                    'identification' => $request->get('identification'),
                    'first_name' => $request->get('first_name'),
                    'last_name' => $request->get('last_name')
                ]);
            } else {
                //Type Business
                $client->business->update([
                    'code_identification' => $request->get('code_identification'),
                    'description' => $request->get('description'),
                    'contact_name' => $request->get('contact_name')
                ]);
            }
            \Utility::setMessageSuccess();
        } else {
            \Utility::setMessage(['message' => trans('messages.errors.globals.not_section_allow')]);
        }

        if ($request->get('is_customer')) return redirect()->to('home');
        else return redirect()->to('client');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();
        \Utility::setMessageSuccess();
        return redirect()->route('client.index');
    }

    public function profileClient() 
    {
        $client_id = \Auth::user()->client_id;
        return $this->prepareDataClient($client_id, true);
    }

    public function search(Request $request) {
        
        $data = [];
        
        //if there is a parameter ID, return client instance consulted
        if ($request->get('id')) {
            $clients = Client::with(['country','province','city','person','business'])
                ->where('id', $request->get('id'))->get();
            $clients->each(function ($item, $key) use (&$data) {
                $data[] = [
                    'id' => $item->id,
                    'type' => $item->type,
                    'identification' => ($item->type == 'person') ? $item->person->identification : null,
                    'first_name' => ($item->type == 'person') ? $item->person->first_name : null,
                    'last_name' => ($item->type == 'person') ? $item->person->last_name : null,
                    'code_identification' => ($item->type == 'business') ? $item->business->code_identification : null,
                    'description' => ($item->type == 'business') ? $item->business->description : null,
                    'contact_name' => ($item->type == 'business') ? $item->business->contact_name : null,
                    'cellphone_number' => $item->cellphone_number,
                    'homephone_number' => $item->homephone_number,
                    'email' => $item->email,
                    'country' => $item->country->id,
                    //Since the data must be dynamically parsed in a select2 control, we must pass the data into {id: 'value', text: 'value'}
                    'country_description' => json_decode(Country::where('id', $item->country->id)->get(['id', 'description as text'])),
                    'province' => $item->province->id,
                    'province_description' => json_decode(Province::where('id', $item->province->id)->get(['id', 'description as text'])),
                    'city' => $item->city->id,
                    'city_description' => json_decode(City::where('id', $item->city->id)->get(['id', 'description as text'])),
                    'shipping_address' => $item->shipping_address,
                    'zip_code' => $item->zip_code,
                    'status' => $item->status
                ];
            });
        } else {
            $q = trim($request->get('q'));

            $clients = Client::ListAll($q)->get();

            $clients->each(function ($item, $key) use (&$data) {
                $data[] = ['id' => $item->id, 'text' => $item->names];
            });
        }

        return json_encode($data);
    }

    public function prepareDataClient($id, $for_customer = false, $for_edit = true) 
    {
        $client = Client::withTrashed()->with(['person','business'])->where('id', $id)->first();

        if (!$client) {
            \Utility::setMessage(['message' => trans('messages.errors.clients.client_not_exist')]);
            return redirect()->to(($for_customer)?'home':'client');
        }
        
        $edit = $for_edit;
        $is_customer = $for_customer;
        $countries = Country::orderBy('description')->pluck('description', 'id');
        $provinces = Province::orderBy('description')->pluck('description', 'id');
        $cities = City::orderBy('description')->pluck('description', 'id');
        $this->dropDownLists($types, $status);

        return view('clients.create', compact('client', 'types', 'status', 'countries', 'provinces', 'cities', 'edit', 'is_customer'));
    }

    public function registerNewCustomer(Request $request) {

    	//Definicion de reglas para usuarios y clientes
    	$rules = [
            'country_id' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'first_name' => 'required|max:20|regex:/^[\pL\s]+$/u',
            'last_name' => 'required|alpha_dash|max:20',
            'gender' => 'required',
            'identification' => 'required|max:20',
            'email' => 'required|email|unique:users,email',
            'email_client' => 'required|email|unique:clients,email',
            'shipping_address' => 'required',
            'zip_code' => 'required|numeric',
            'cellphone_number_client' => 'required|numeric|max:9999999999',
            'g-recaptcha-response' => 'required|recaptcha',
        ];

        switch ($request->get('type')) {
            //type business
            case 'business':        
                $rules["description"] = "required";
                $client_exist = Business::where('code_identification', 'like', '%' . $request->get('code_identification') . '%')
                            ->where('description', 'like', '%' . $request->get('description') . '%')
                            ->first();
                break;
            //type person
            default:
                $rules["identification"] = "required";
                $rules["username"] = "required|alpha|between:8,15";
                $rules['cellphone_number'] = "required|numeric|max:9999999999";
                $client_exist = Person::where('first_name', 'like', '%' . $request->get('first_name') . '%')
                            ->where('last_name', 'like', '%' . $request->get('last_name') . '%')
                            ->where('identification', 'like', '%' . $request->get('identification') . '%')
                            ->first();
                break;
        }

        //Validacion de datos y de existencia del cliente
        $v = \Validator::make($request->all(), $rules);

        if ($v->fails()) {
            \Utility::setMessage(['message' => $v->errors()->all()]);
            return redirect()->back()->withInput($request->all());
        }

        if ($client_exist) {
            \Utility::setMessage(['message' => trans('messages.errors.clients.client_already_exist')]);
            return redirect()->back()->withInput($request->all());
        }

        //Registro del cliente segun sea el tipo
        $client = Client::create([
                'country_id' => $request->get('country_id'),
                'province_id' => $request->get('province_id'),
                'city_id' => $request->get('city_id'),
                'cellphone_number' => $request->get('cellphone_number_client'),
                'homephone_number' => $request->get('homephone_number_client'),
                'email' => $request->get('email_client'),
                'type' => $request->get('type'),
                'shipping_address' => strtoupper(trim($request->get('shipping_address'))),
                'zip_code' => $request->get('zip_code'),
            ]);

        if ($client->type == 'business') {
            Business::create([
                'client_id' => $client->id,
                'code_identification' => $request->get('code_identification'),
                'description' => strtoupper(trim($request->get('description'))),
                'contact_name' => strtoupper(trim($request->get('contact_name'))),
                ]);
        } else {
            Person::create([
                'client_id' => $client->id,
                'identification' => $request->get('identification'),
                'first_name' => strtoupper(trim($request->get('first_name'))),
                'last_name' => strtoupper(trim($request->get('last_name'))),
                ]);
        }
        
        //Registro del Usuario
        $password = $request->get('password');
        $user = User::create([
                'country_id' => $request->get('country_id'),
                'client_id' => $client->id,
                'role' => ($request->get('type') == 'business') ?'store':'client',
                'first_name' => strtoupper(trim($request->get('first_name'))),
                'last_name' => strtoupper(trim($request->get('last_name'))),
                'username' => strtolower(trim($request->get('username'))),
                'pic_url' => '/profile_img/avatar.png',
                'gender' => $request->get('gender'),
                'identification' => $request->get('identification'),
                'cellphone_number' => $request->get('cellphone_number'),
                'homephone_number' => $request->get('homephone_number'),
                'email' => trim($request->get('email')),
                'password' => \Hash::make($password),
                'verified' => 'yes',
                'language' => $request->get('language'),
            ]);

        if ($user) {
            
            Language::setLanguage($user->language);
            
            //Notificar via notification mail
            $user->sendWelcomeEmail($user->username, $password);

            //Autenticar y redirigir
            $credentials = [
                'username' => $user->username,
                'password' => $password,
                'status'   => 'active'
            ];

            if (\Auth::attempt($credentials, true)) {

                \Utility::setMessage([
                    "message" => trans('messages.client_registered'),
                    "messageTimeShow" => 10000,
                    ], 'success');
                
                // Authentication passed...
                return redirect()->intended('home');
            }
        }

    }

    /**
     * Change status to Client
     */
    public function changeStatus($id,$status) {

        $client = Client::withTrashed()->where('id', $id)->first();
        if ($client) {

            switch ($status) {
                case 'active':
                    //Inactivas
                    $deleted_at = \Carbon\Carbon::now();
                    $client->status = 'inactive';

                    $client->deleted_at = $deleted_at->toDateTimeString();
                    $client->save();
                    break;
                case 'inactive':
                case 'delete':
                    //Activa
                    $client->deleted_at = null;
                    $client->status = 'active';
                    $client->save();  
                    break;
                default:
                    //opciones cargadas a mano desde el explorador (denegadas)
                    \Utility::setMessage(['message' => trans('messages.errors.globals.request_invalid')]);
                    break;
            }

            \Utility::setMessageSuccess();
        } else {
            \Utility::setMessage(['message' => trans('messages.errors.users.client_not_exist')]);
        }
        return redirect()->route('client.index');
    }

    private function dropDownLists(&$types, &$status) {

        foreach (array_keys(trans('globals.type_client')) as $value) {
            $types[$value] = ucfirst($value);
        }

        foreach (array_keys(trans('globals.type_status')) as $value) {
            $status[$value] = ucfirst($value);
        }
    }

}
