<?php
namespace App\Http\Controllers;

use Language;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Since laravel version 5.3, session variables or values are not accessible from the controllers__construct methods
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            
            Language::setLanguage();
            return $next($request);
        });
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        return view('home.index');
    }

    public function dashboard()
    {
        return view('home.index');
    }

    public function ViewEmail($status, $id) {

        switch ($status) {
            case 'issued_case':
                $order = \App\Order::with(['country'])->where('id', $id)->first();
                $config_email = \App\EmailTemplate::where('code','issued_case')->byCountry($order->country_id)->first();
                $data['order'] = $order;
                $data['img_header'] = $config_email->img_header;
                $data['img_ext_link'] = $config_email->img_ext_link;
                $data['url_ext_link'] = $config_email->url_ext_link;
                $data['body_message'] = $config_email->body_message;

                //$country = $order->country->language;
                //dd($order);
                return view('emails.issued_case',compact('data'));
                break;
            case 'order_created':
                $order = \App\Order::with(['country','workshop','product'])->where('id', $id)->first();
                Language::setLanguage($order->country->language);
                $data['order'] = $order;
                $pdf = \PDF::loadView('pdf.order_created', $data);
                $order_pdf_url = storage_path().'/files/documents/'.$order->order_number.'/'.trans('email.orders.order_created.filename', ['order_number' => $order->order_number]);
                $pdf->save($order_pdf_url);
                return $pdf->stream(trans('email.orders.order_created.filename', ['order_number' => $order->order_number]));
                //return view('pdf.order_created',compact('order'));
                break;
            default:
                # code...
                break;
        }
        return;
    }
}