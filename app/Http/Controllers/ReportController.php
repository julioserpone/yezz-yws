<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Brand;
use App\Country;
use App\Order;
use App\Report;
use App\ReportItem;
use App\ReportGroup;
use App\ReportGroupItem;
use App\Workshop;
use Carbon\Carbon;
use App;
use DB;
use Excel;
use Language;

class ReportController extends Controller
{
	public function __construct() {

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
		$user = \Auth::user();
		$brands = Brand::select('id','description as text')->get()->pluck('text','id');
		$countries = ($user->role == 'workshop') ? Country::where('id', $user->country_id)->pluck('description','id') : Country::get()->pluck('description','id');
		$workshops = ($user->role == 'workshop') ? Workshop::where('id', $user->workshop_id)->pluck('description','id') : Workshop::get()->pluck('description','id');
		$fields = ReportGroupItem::select('report_group_items.id')->join('report_groups','report_group_id','=','report_groups.id')
					->where('report_groups.name','Orders')
					->orderBy('order')
					->get()->pluck('name','id');

		return view('reports.reports',compact('countries','brands','workshops','fields','user'));
	}

	public function templateItems() 
	{

		$items = ReportGroupItem::select('report_group_items.id')->join('report_groups','report_group_id','=','report_groups.id')
		->where('report_groups.name','Order')
		->get();

		$items = $this->formatSelect2($items);
		return $items;
	}

	public function generate(Request $request) 
	{

		try {
			$params['fields'] = $request->get('fields');
			$params['countries'] = $request->get('countries');
			$params['workshops'] = $request->get('workshops');
			$params['order_date'] = $request->get('order_date');
			$params['type'] = $request->get('type');

			$result = $this->process($params);

			return response()->json($result);

		} catch (Exception $e) {
			return response()->json(['error'=> $e]);
		}
	}


	public function export(Request $request) 
	{

		$params['fields']     = $request->get('fields');
		$params['countries']  = $request->get('countries');
		$params['workshops']  = $request->get('workshops');
		$params['order_date'] = $request->get('order_date');
		$params['type'] = $request->get('type');

		$result  = $this->process($params);

		$data = json_decode( json_encode($result['data']), true);
		$filename = Carbon::now()->format('Y-m-d').' YWS-Orders';

		$file_excel = Excel::create($filename, function($excel) use ($data) {
			$excel->sheet('orders', function($sheet) use ($data) {
				$sheet->fromArray($data);
			});
		});

		$file_excel = $file_excel->string('xlsx'); //change xlsx for the format you want, default is xls
		$response =  array(
			'name' => $filename, //no extention needed
			'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($file_excel) //mime type of used format
		);

		return response()->json($response);
	}


	private function process($params) 
	{

		$locale = \Auth::user()->language;

		$fields     = $params['fields'];
		$countries  = $params['countries'];
		$workshops  = $params['workshops'];
		$order_date = $params['order_date'];
		$type       = $params['type'];

		//Se obtienen los campos del reporte
		if($fields == 0){
			$fields = ReportGroupItem::orderBy('order')->get();   
		}else{
			$fields = ReportGroupItem::whereIn('id',$fields)->orderBy('order')->get();
		}
		$field_names = $this->getFieldName($fields, 'name', false);
		
		//Obtiene una lista de nombre de campos ej: order.imei, order.model
		$fields = $this->getFieldName($fields, 'code', true);

		$allCountries = 0;
		if($countries != 0)
		{
			$countries =  implode(' , ',$countries);
			$allCountries = 1;
		}

		$allWorkshops = 0;
		if($workshops != 0)
		{
			$workshops = implode(' , ',$workshops);
			$allWorkshops = 1;
		}

		$order_date = explode(' - ',$order_date);
		$order_date[0] = $this->defaultDateFormat($order_date[0]);
		$order_date[1] = $this->defaultDateFormat($order_date[1]);

		$rows = DB::table('orders')
				->join('countries','country_id','=','countries.id')
				->join('workshops','workshop_id','=','workshops.id')
				->join('states','state_id','=','states.id')
				->join('state_translations','state_translations.state_id','=','states.id')
				->join('clients','orders.client_id','=','clients.id')
				->join('products','orders.product_id','=','products.id')
				->leftjoin('persons','persons.client_id','=','clients.id')
				->leftjoin('businesses','businesses.client_id','=','clients.id')
				->leftJoin(DB::raw('(SELECT a.order_id, group_concat(t.name) actions 
						from order_history_actions a
						inner join action_translations t on a.action_id = t.action_id
						where t.locale = \''.$locale.'\' and a.deleted_at is null group by a.order_id) actions'),
						function($join) {
							$join->on('orders.id', '=', 'actions.order_id');
						})
				->leftJoin(DB::raw('(select h.order_id, group_concat(c.comment) comments 
						from order_histories h
						inner join order_history_comments c on h.id = c.order_history_id
						where h.deleted_at is null 
						group by h.order_id) comments'),
						function($join) {
							$join->on('orders.id', '=', 'comments.order_id');
						})
				->leftJoin(DB::raw('(select d.order_id, group_concat(t.name) diagnostics
						from order_history_diagnostics d
						inner join diagnostic_translations t on d.diagnostic_id = t.diagnostic_id
						where t.locale = \''.$locale.'\' and d.deleted_at is null group by d.order_id) diagnostics'),
						function($join) {
							$join->on('orders.id', '=', 'diagnostics.order_id');
						})
				->leftJoin(DB::raw('(select f.order_id , group_concat(t.name) failures 
						from order_failures f
						inner join failure_translations t on f.failure_id = t.failure_id
						where t.locale = \''.$locale.'\' group by f.order_id) failures'),
						function($join) {
							$join->on('orders.id', '=', 'failures.order_id');
						})
				->where('state_translations.locale',$locale)
				->whereRaw('(countries.id in ('.$countries.') or (0 = '.$allCountries.'))')
				->whereRaw('(workshops.id in ('.$workshops.') or (0 = '.$allWorkshops.'))')
				->whereRaw('(DATE(orders.order_date) between \''.$order_date[0].'\' and \''.$order_date[1].'\')')
				->select(DB::raw($fields))->orderBy('orders.order_date')->get();

		//Por ahora, para poder colocar las traducciones correctas en la cabecera del archivo de excel, se insertara primera estas cabeceras traducidas en un array
		//Luego, se insertara en otro array cada valor de las columnas, sin el key asociativo. Esto se hace porque el paquete de exportacion de excel no toma un array de cabecera
		//personalizado. El asume que la primera fila de dicho array es la cabecera del sheet que se esta creando
		
		$data = [];
		//Header
		if ($type == "export") {
			$data[] = $field_names;
		}

		//Eliminacion de keys asociativo del array
		foreach ($rows as $key => $row) {
			$r = [];
			foreach ($row as $k => $value) {
				$r[] = $value;
			}
			$data[] = $r;
		}

		$object['data']  = $data; //Para el caso de la vista previa, debemos eliminar la primera fila en el frontend
		$object['fields'] = $field_names;

		return  $object;
	
	}

	public function getFieldName($unformated_list, $attribute, $result_string)
	{
		$list = [];
		if ($unformated_list) {
			foreach ($unformated_list as $key => $value) {
				$list[$key] =  $value[$attribute];
			}
		}

		if($result_string)
		{
			$list = implode(',',$list);
		} 
		return $list;   
	}
	
	public function defaultDateFormat($date) 
	{

		$date = explode('/', $date);
		return $date[2].'-'.$date[1].'-'.$date[0];
	}

	public function formatFields($unformated_list) 
	{

		$temporary_list = $unformated_list;
		$list = [];
		if ($temporary_list) {
			foreach ($temporary_list as $key => $value) {
				$list[$key] = ['name'=> $value['name'], 'field_name'=> $value['code'] ];
			}
		}
		return $list;
	}

	private function formatSelect2($unformated_list) 
	{

		$temporary_list = $unformated_list;
		$list = [];
		if ($temporary_list) {
			foreach ($temporary_list as $key => $value) {
				$list[$key] = ['id'=> $value['id'], 'text'=> ($value['name'] == null) ? $value['description'] : $value['name'] ];
			}
		}

		return $list;
	}


}
