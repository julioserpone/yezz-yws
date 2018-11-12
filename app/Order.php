<?php

namespace App;

use Carbon\Carbon;
use App\Jobs\SendEmail;
use App\Notifications\AbandonedOrder;
use App\Mail\OrderCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Mail;
use Language;

class Order extends Model
{
    use DispatchesJobs, Notifiable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $dates = ['order_date','client_invoice_date','created_at','updated_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'client_id',
        'user_id',
    	'country_id',
        'province_id',
        'city_id',
    	'workshop_id',
    	'state_id',
    	'courier_id',
        'product_id',
    	'order_number',
        'client_invoice_number',
        'client_invoice_date',
        'client_invoice_doc',
        'order_date',
        'personal_retreat',
        'type_management',
        'gp_imei',
        'gp_num_doc',
        'gp_item_code',
        'gp_item_description',
        'gp_brand',
        'gp_part_number',
        'gp_model',
        'gp_invoice_date',
        'gp_purchase_date',
        'gp_customer_code',
        'gp_customer_name',
        'gp_country_name',
        'tracking',
        'failure_description',
        'accesories_received',
        'devolution_address',
        'devolution_zip_code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

	public function client()
    {
        return $this->belongsTo(Client::class)->withTrashed();
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function workshop()
    {
        return $this->belongsTo(Workshop::class)->withTrashed();
    }

    public function state()
    {
        return $this->belongsTo(State::class)->withTrashed();
    }

    public function courier()
    {
        return $this->belongsTo(Courier::class)->withTrashed();
    }

    public function product()
    {
        return $this->belongsTo(Product::class)->withTrashed();
    }

    public function failures()
    {
        return $this->hasMany(OrderFailure::class);
    }

    public function attachments()
    {
        return $this->hasMany(OrderAttachment::class);
    }

    public function histories()
    {
        return $this->hasMany(OrderHistory::class)->withTrashed()->orderBy('log_date', 'desc');
    }

    public function actions()
    {
        return $this->hasMany(OrderHistoryAction::class)->withTrashed()->orderBy('log_date', 'desc');
    }

    public function diagnostics()
    {
        return $this->hasMany(OrderHistoryDiagnostic::class)->withTrashed()->orderBy('log_date', 'desc');
    }

    public static function scopeWithRelations($query, $order_id = null) {

        $query->with(['country','workshop','client','state','courier','product','failures','histories']);
        if ($order_id) $query->where('id', $order_id);
    }

    public static function scopeOnlyCaseForWorkshop($query, $imei = null)
    {
        $query->with(['country','workshop','client','state','courier','product','failures'])->byStatus('issued_case');

        if ($imei) $query->where('gp_imei', $imei);
              
        if (\Auth::user()->role == 'workshop') { 
            $query->where('workshop_id', \Auth::user()->workshop_id);
        }
    }

    public static function scopeIsImeiInUse($query, $imei, $status = 'issued_case')
    {
        $query->where('gp_imei', $imei);
        if ($status) $query->ByStatus($status);
    }

    public function scopeOfDates($query, $from, $to = '')
    {
        if (trim($from) == '' && trim($to) == '') {
            return;
        }

        if (trim($from) != '' && trim($to) != '') {
            return $query->whereBetween(\DB::raw('DATE(order_date)'), [$from, $to]);
        } elseif (trim($from) != '' && trim($to) == '') {
            return $query->where(\DB::raw('DATE(order_date)'), $from);
        } elseif (trim($from) == '' && trim($to) != '') {
            return $query->where(\DB::raw('DATE(order_date)'), $to);
        }
    }

    public function scopeByOlder($query, $days) {
        return $query->where('order_date', '<', Carbon::now()->subDays($days));
    }

    public function scopeByStatus($query, $status_code) {

        return $query->whereHas('state', function ($query) use ($status_code) {
            $query->where('code', '=', $status_code);
        });
    }

    public function getDateForTimezoneAttribute()
    {
        $countryParameter = CountryAttribute::with(['country','attribute'])->GetAttribute($this->attributes['country_id'], '%OS_SECUENCE%')->first();
        $date = Carbon::now(City::where('id', $this->attributes['city_id'])->first()->timezone);
        return $date;
    }

    public function allowChangeState() {

        return (!in_array($this->state->code, ['issued_case','delivered','voided','abandoned','out_of_time','credit_note']));
    }

    public function createLog($option = null, $exception = null)
    {
        $actions = [];
        foreach (trans('globals.action_types') as $value) {
            if ($value['source_type'] == 'order') {
                $actions[$value['action']] = [
                    "id" => $value['id'],
                    "action" => $value['action'],
                ];
            }
        }

        //get state (estado - estatus)
        $state =  State::where('id', $this->state_id)->first();

        //If an action is defined as a parameter, assigning action is ignored by order status
        $action = ($option) ? $actions[$option] : $actions[$state->code];
        $details = trans('notices.templates.order:'.$action['action'], ['order_number' => $this->order_number]);

        Log::create([
            'action_type_id' => $action["id"],
            'source_id'      => $this->id,
            'user_id'        => $this->user_id,
            'details'        => $details,
            'error_dump'     => $exception,
        ]);

        return;
    }

    public function sendNotice()
    {   
        if (!empty($this->user_id) && !empty($this->workshop_id)) {
            $state =  State::where('id', $this->state_id)->first();
            $action = ActionType::where('action', $state->code)->first();
            switch ($state->code) {
                case 'issued_case':
                    Notice::create([
                        'action_type_id' => $action->id,
                        'source_id'      => $this->id,
                        'user_id'        => $this->workshop_id,
                        'sender_id'      => $this->user_id,
                    ]);
                    break;

                case 'received':
                    Notice::create([
                        'action_type_id' => $action->id,
                        'source_id'      => $this->id,
                        'user_id'        => $this->user_id,
                        'sender_id'      => $this->workshop_id,
                    ]);
                    break;
                
                case 'out_of_time':
                    $user = User::where('username', 'admin')->first();
                    Notice::create([
                        'action_type_id' => $action->id,
                        'source_id'      => $this->id,
                        'user_id'        => $this->user_id,
                        'sender_id'      => $user->id,
                    ]);
                    break;
                /*case 'cancelled':
                    Notice::create([
                        'action_type_id' => 9,
                        'source_id'      => $this->id,
                        'users'          => [$this->seller_id, $this->user_id],
                    ]);
                break;*/
            }
        }
        return;
    }

    public function sendMail($options = [])
    {
        $data = [];
        $attachments = [];
        $client = Client::with(['person','business'])->where('id', $this->client_id)->first();
        Language::setLanguage($this->country->language);
        if (!$options) {
            switch ($this->state->code) {
                case 'issued_case':
                    //Sends the user a mail to notify that the
                    $config_email = EmailTemplate::with(['country'])->where('code','issued_case')->byCountry($this->country_id)->first();
                    $email = $this->client->email;
                    
                    $template = 'emails.issued_case';
                    $subject = trans('email.orders.issued_case.subject', ['order_number' => $this->order_number]);
                    
                    $data['action'] = 'created_mail';
                    $data['img_header'] = env('MAIN_SERVER').$config_email->img_header;
                    $data['img_ext_link'] = env('MAIN_SERVER').$config_email->img_ext_link;
                    $data['url_ext_link'] = $config_email->url_ext_link;
                    $data['body_message'] = $config_email->body_message;

                    //Generate Order in PDF. Save in Storage folder
                    $data_pdf['order'] = $this->with(['client','workshop','product'])->where('id', $this->id)->first();
                    $pdf = \PDF::loadView('pdf.order_created', $data_pdf);
                    
                    $url_attachments = storage_path().'/documents/'.$this->order_number.'/';
                    $order_pdf_url = $url_attachments.trans('email.orders.order_created.filename', ['order_number' => $this->order_number]);
                    $data['order_pdf_url'] = $order_pdf_url;

                    //folder validation - if there is not folder, it will be created
                    if (!is_dir($url_attachments)) {
                        mkdir($url_attachments, 0777, true);
                    }
                    $pdf->save($order_pdf_url);
                    
                    //To save in Amazon S3
                    $path_cloud = '/documents/'.$this->order_number.'/'.trans('email.orders.order_created.filename', ['order_number' => $this->order_number]);
                    Storage::disk('s3')->put($path_cloud, $pdf->output(), 'public');
                    
                    //attach files
                    $attachments = [
                        'order_case' => $order_pdf_url,
                    ];
                break;
            }
        } else {
            if (isset($options['command'])) {
                $command = $options['command'];
                switch ($command) {
                    case 'out_of_time':
                        $config_email = EmailTemplate::with(['country'])->where('code','out_of_time')->byCountry($this->country_id)->first();
                        $data['order'] = $this;
                        $data['message_email'] = $config_email->body_message;
                        $this->notify(new AbandonedOrder($data));
                        return;
                        break;
                    
                    default:
                        # code...
                        break;
                }
            }
        }

        //Asign parameter to $data variable
        $data['order_id'] = $this->id;
        $data['order_object'] = $this;
        $data['email'] = $email;
        $data['subject'] = $subject;
        $data['template'] = $template;
        
        if ($attachments) {
            $data['attachments'] = $attachments;
        }

        if (isset($template)) {
            //For Laravel 5.3
            /*$job = (new SendEmail($data))->onQueue('emails');
            $this->dispatch($job);*/

            //For Laravel 5.4 >=
            try {
                Mail::to($email)->send(new OrderCreated($data));
                $this->createLog($data['action']);
            }
            catch(\Exception $e) {
                $this->createLog('not_send_mail', $e->getMessage());
            }
        }

        //Remove the generated pdf file from the web server
        if (file_exists($order_pdf_url)) {
            unlink($order_pdf_url);
        }
    }


    public function routeNotificationForMail()
    {
        return $this->client->email;
    }
}
