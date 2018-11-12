<?php

namespace App\Http\Controllers;

use Language;
use App\Workshop;
use App\Country;
use App\Route;
use Illuminate\Http\Request;
use App\Http\Requests;

class WorkshopController extends Controller
{
    private $rules = [
        'country_id' => 'required',
        'route_id' => 'required',
        'description' => 'required|max:255',
        'contact_name' => 'required',
        'address' => 'required|max:255',
        'comment' => 'max:255',
        'type' => 'required',
    ];

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
        $workshops = Workshop::withTrashed()->with(['country','route'])->get();
        return view('workshops.grid', compact('workshops'));
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
        $routes = Route::orderBy('description')->pluck('description', 'id');
        $this->dropDownLists($type_workshop);

        return view('workshops.create', compact('edit','countries','routes','type_workshop'));
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

        $workshop = Workshop::where('description', 'like', '%' . $request->get('description') . '%')->first();

        if ($workshop) {
            \Utility::setMessage(['message' => trans('messages.errors.workshops.workshop_already_exist')]);
            return redirect()->back()->withInput($request->all());
        }

        Workshop::create($request->all());
        \Utility::setMessageSuccess();

        return redirect()->route('workshop.index');
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
        $countries = Country::orderBy('description')->pluck('description', 'id');
        $routes = Route::orderBy('description')->pluck('description', 'id');
        $workshop = Workshop::withTrashed()->where('id', $id)->first();
        $this->dropDownLists($type_workshop);

        if (!$workshop) {

            \Utility::setMessage(['message' => trans('messages.errors.workshops.workshop_not_exist')]);
            return redirect()->to('workshop');
        }
        return view('workshops.create', compact('edit', 'workshop', 'countries', 'routes', 'type_workshop'));
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

        $workshop = Workshop::withTrashed()->where('id', $id)->first();
        $workshop->update($request->all());

        \Utility::setMessageSuccess();
        return redirect()->route('workshop.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $workshop = Workshop::find($id);
        $workshop->delete();
        \Utility::setMessageSuccess();
        return redirect()->route('workshop.index');

    }

    public function search(Request $request) {
        $q = trim($request->get('q'));
        $data = [];

        $query = Workshop::select(['id', 'description']);

        if ($q != '') {
            $query->whereRaw("description like '%" . $q . "%'");
        }

        $workshops = $query->orderBy('description', 'asc')->get();

        $workshops->each(function ($item, $key) use (&$data) {
            $data[] = ['id' => $item->id, 'text' => $item->description];
        });

        return json_encode($data);
    }

    public function searchByCountry(Request $request, $country_id) {
        $q = trim($request->get('q'));
        $data = [];

        $query = Workshop::select(['id', 'description'])->where('country_id', $country_id);

        if ($q != '') {
            $query->whereRaw("description like '%" . $q . "%'");
        }

        $workshops = $query->orderBy('description', 'asc')->get();

        $workshops->each(function ($item, $key) use (&$data) {
            $data[] = ['id' => $item->id, 'text' => $item->description];
        });

        return json_encode($data);
    }

    /**
     * Metodo para filtrar tiendas por paises (utilizado para filtros de reportes con campos select2 multiple)
     * @param  Request $request Parametros recibidos en formato json
     * @return Array           Array contentivo de tiendas
     */
    public function searchByCountries(Request $request) {
        $q = trim($request->get('q'));  //Texto escrito en el recuadro
        $country_ids = $request->get('countries');    //Paises seleccionados en campo tipo select2 multiple (countries)
        $data = [];

        $query = Workshop::select(['id', 'description']);

        if ($country_ids) {
            $query->whereIn('country_id', $country_ids);
        }

        if ($q != '') {
            $query->whereRaw("description like '%" . $q . "%'");
        }

        $workshops = $query->orderBy('description', 'asc')->get();

        $workshops->each(function ($item, $key) use (&$data) {
            $data[] = ['id' => $item->id, 'text' => $item->description];
        });

        return json_encode($data);
    }

    /**
     * Change status to workshop
     */
    public function changeStatus($id,$status) {

        $workshop = Workshop::withTrashed()->where('id', $id)->first();
        if ($workshop) {

            switch ($status) {
                case 'active':
                    //Inactivas
                    $deleted_at = \Carbon\Carbon::now();
                    $workshop->status = 'inactive';

                    $workshop->deleted_at = $deleted_at->toDateTimeString();
                    $workshop->save();
                    break;
                case 'inactive':
                case 'delete':
                    //Activa
                    $workshop->deleted_at = null;
                    $workshop->status = 'active';
                    $workshop->save();  
                    break;
                default:
                    //opciones cargadas a mano desde el explorador (denegadas)
                    \Utility::setMessage(['message' => trans('messages.errors.globals.request_invalid')]);
                    break;
            }

            \Utility::setMessageSuccess();
        } else {
            \Utility::setMessage(['message' => trans('messages.errors.workshops.workshop_not_exist')]);
        }
        return redirect()->route('workshop.index');
    }

    private function dropDownLists(&$type_workshop) {
        foreach (array_keys(trans('globals.type_workshop')) as $value) {
            $type_workshop[$value] = ucfirst($value);
        }
    }
}
