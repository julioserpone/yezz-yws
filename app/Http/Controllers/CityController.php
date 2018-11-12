<?php

namespace App\Http\Controllers;

use Language;
use App\Country;
use App\Province;
use App\City;
use Illuminate\Http\Request;
use App\Http\Requests;

class CityController extends Controller
{
private $rules = [
        'province_id' => 'required',
        'description' => array('Regex:/^[A-Za-z ]+$/'),
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
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
        $cities = City::withTrashed()->with(['province'])->get();
        return view('cities.grid', compact('cities'));
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
        $timezones = trans('globals.time_zones');
        //$this->dropDownLists($timezones);
        return view('cities.create', compact('countries','provinces','timezones','edit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = \Validator::make($request->all(), $this->rules);

        if ($v->fails()) {
            \Utility::setMessage(['message' => $v->errors()->all()]);

            return redirect()->back()->withInput($request->all());
        }

        $city = City::where('description', 'like', '%' . $request->get('description') . '%')->where('province_id', $request->get('province_id'))->first();

        if ($city) {
            \Utility::setMessage(['message' => trans('messages.errors.cities.city_already_exist')]);
            
            return redirect()->back()->withInput();
        }

        City::create($request->all());
        \Utility::setMessageSuccess();

        return redirect()->route('city.index');
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
        $edit = true;
        $city = City::withTrashed()->where('id', $id)->first();
        if (!$city) {

            \Utility::setMessage(['message' => trans('messages.errors.cities.city_not_exist')]);
            return redirect()->to('city');
        }
        $provinces = Province::orderBy('description')->pluck('description', 'id');
        $this->dropDownLists($timezones);
        return view('cities.create', compact('edit','provinces','city','timezones'));
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
        $v = \Validator::make($request->all(), $this->rules);

        if ($v->fails()) {
            \Utility::setMessage(['message' => $v->errors()->all()]);

            return redirect()->back()->withInput();
        }

        $city = City::withTrashed()->where('id', $id)->first();
        $city->update($request->all());

        \Utility::setMessageSuccess();
        return redirect()->route('city.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $city = City::find($id);
        $city->delete();
        \Utility::setMessageSuccess();
        return redirect()->route('city.index');

    }

    public function search(Request $request) {
        $q = trim($request->get('q'));
        $data = [];

        $query = City::select(['id', 'description']);

        if ($q != '') {
            $query->whereRaw("description like '%" . $q . "%'");
        }

        $city = $query->orderBy('description', 'asc')->get();

        $city->each(function ($item, $key) use (&$data) {
            $data[] = ['id' => $item->id, 'text' => $item->description];
        });

        return json_encode($data);
    }

    public function searchByProvince(Request $request, $province_id) {
        $q = trim($request->get('q'));
        $data = [];

        $query = City::select(['id', 'description'])->where('province_id', $province_id);

        if ($q != '') {
            $query->whereRaw("description like '%" . $q . "%'");
        }

        $city = $query->orderBy('description', 'asc')->get();

        $city->each(function ($item, $key) use (&$data) {
            $data[] = ['id' => $item->id, 'text' => $item->description];
        });

        return json_encode($data);
    }

    /**
     * Change status to city
     */
    public function changeStatus($id,$status) {

        $city = City::withTrashed()->where('id', $id)->first();
        if ($city) {

            switch ($status) {
                case 'active':
                    //Inactivas
                    $deleted_at = \Carbon\Carbon::now();
                    $city->status = 'inactive';

                    $city->deleted_at = $deleted_at->toDateTimeString();
                    $city->save();
                    break;
                case 'inactive':
                case 'delete':
                    //Activa
                    $city->deleted_at = null;
                    $city->status = 'active';
                    $city->save();  
                    break;
                default:
                    //opciones cargadas a mano desde el explorador (denegadas)
                    \Utility::setMessage(['message' => trans('messages.errors.globals.request_invalid')]);
                    break;
            }

            \Utility::setMessageSuccess();
        } else {
            \Utility::setMessage(['message' => trans('messages.errors.cities.city_not_exist')]);
        }
        return redirect()->route('city.index');
    }

    private function dropDownLists(&$timezones) {

        foreach (array_keys(trans('globals.time_zones')) as $value) {
            $timezones[$value] = ucfirst($value);
        }
    }
}
