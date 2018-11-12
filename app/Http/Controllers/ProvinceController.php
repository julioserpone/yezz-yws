<?php

namespace App\Http\Controllers;

use Language;
use App\Province;
use App\Country;
use Illuminate\Http\Request;
use App\Http\Requests;

class ProvinceController extends Controller
{
    private $rules = [
        'country_id' => 'required',
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
        $provinces = Province::withTrashed()->with(['country'])->get();
        return view('provinces.grid', compact('provinces'));
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
        return view('provinces.create', compact('countries','edit'));
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

        $province = Province::where('description', 'like', '%' . $request->get('description') . '%')
                        ->where('country_id', $request->get('country_id'))
                        ->first();

        if ($province) {
            \Utility::setMessage(['message' => trans('messages.errors.provinces.province_already_exist')]);
            
            return redirect()->back()->withInput($request->all());
        }

        Province::create($request->all());
        \Utility::setMessageSuccess();

        return redirect()->route('province.index');
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
        $province = Province::withTrashed()->where('id', $id)->first();
        if (!$province) {

            \Utility::setMessage(['message' => trans('messages.errors.provinces.province_not_exist')]);
            return redirect()->to('province');
        }
        $countries = Country::orderBy('description')->pluck('description', 'id');
        return view('provinces.create', compact('edit', 'province', 'countries'));
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

            return redirect()->back()->withInput($request->all());
        }

        $province_duplicate = Province::where('description', 'like', '%' . $request->get('description') . '%')
                        ->where('country_id', $request->get('country_id'))
                        ->where('id', '!=', $id)
                        ->first();

        if ($province_duplicate) {
            \Utility::setMessage(['message' => trans('messages.errors.provinces.province_already_exist')]);
            return redirect()->back()->withInput($request->all());
        }

        $province = Province::withTrashed()->where('id', $id)->first();
        $province->update($request->all());

        \Utility::setMessageSuccess();
        return redirect()->route('province.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $province = Province::find($id);
        $province->delete();
        \Utility::setMessageSuccess();
        return redirect()->route('province.index');

    }

    public function search(Request $request) {
        $q = trim($request->get('q'));
        $data = [];

        $query = Province::select(['id', 'description']);

        if ($q != '') {
            $query->whereRaw("description like '%" . $q . "%'");
        }

        $province = $query->orderBy('description', 'asc')->get();

        $province->each(function ($item, $key) use (&$data) {
            $data[] = ['id' => $item->id, 'text' => $item->description];
        });

        return json_encode($data);
    }

    public function searchByCountry(Request $request, $country_id) {
        $q = trim($request->get('q'));
        $data = [];

        $query = Province::select(['id', 'description'])->where('country_id', $country_id);

        if ($q != '') {
            $query->whereRaw("description like '%" . $q . "%'");
        }

        $province = $query->orderBy('description', 'asc')->get();

        $province->each(function ($item, $key) use (&$data) {
            $data[] = ['id' => $item->id, 'text' => $item->description];
        });

        return json_encode($data);
    }

    /**
     * Change status to province
     */
    public function changeStatus($id,$status) {

        $province = Province::withTrashed()->where('id', $id)->first();
        if ($province) {

            switch ($status) {
                case 'active':
                    //Inactivas
                    $deleted_at = \Carbon\Carbon::now();
                    $province->status = 'inactive';

                    $province->deleted_at = $deleted_at->toDateTimeString();
                    $province->save();
                    break;
                case 'inactive':
                case 'delete':
                    //Activa
                    $province->deleted_at = null;
                    $province->status = 'active';
                    $province->save();  
                    break;
                default:
                    //opciones cargadas a mano desde el explorador (denegadas)
                    \Utility::setMessage(['message' => trans('messages.errors.globals.request_invalid')]);
                    break;
            }

            \Utility::setMessageSuccess();
        } else {
            \Utility::setMessage(['message' => trans('messages.errors.provinces.province_not_exist')]);
        }
        return redirect()->route('province.index');
    }
}
