<?php

namespace App\Http\Controllers;

use Language;
use App\Technology;
use Illuminate\Http\Request;
use App\Http\Requests;

class TechnologyController extends Controller
{
    private $rules = [
        'description' => 'required|max:255',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
        $technologies = Technology::withTrashed()->get();
        return view('technologies.grid', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edit = false;
        return view('technologies.create', compact('edit'));
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
            return redirect()->back()->withInput();
        }

        $technology = Technology::where('description', 'like', '%' . $request->get('description') . '%')->first();

        if ($technology) {
            \Utility::setMessage(['message' => trans('messages.errors.technologies.technology_already_exist')]);
            
            return redirect()->back()->withInput();
        }

        Technology::create($request->all());
        \Utility::setMessageSuccess();

        return redirect()->route('technology.index');
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
        $technology = Technology::withTrashed()->where('id', $id)->first();
        if (!$technology) {
            \Utility::setMessage(['message' => trans('messages.errors.technologies.technology_not_exist')]);
            return redirect()->to('technology');
        }
        return view('technologies.create', compact('edit', 'technology'));
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

        $technology = Technology::withTrashed()->where('id', $id)->first();
        $technology->description = $request->get('description');
        $technology->save();

        \Utility::setMessageSuccess();
        return redirect()->route('technology.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $technology = Technology::find($id);
        $technology->delete();
        \Utility::setMessageSuccess();
        return redirect()->route('technology.index');

    }

    public function search(Request $request) {
        $q = trim($request->get('q'));
        $data = [];

        $query = Technology::select(['id', 'description']);

        if ($q != '') {
            $query->whereRaw("description like '%" . $q . "%'");
        }

        $technology = $query->orderBy('description', 'asc')->get();

        $technology->each(function ($item, $key) use (&$data) {
            $data[] = ['id' => $item->id, 'text' => $item->description];
        });

        return json_encode($data);
    }

    /**
     * Change status to technology
     */
    public function changeStatus($id,$status) {

        $technology = Technology::withTrashed()->where('id', $id)->first();
        if ($technology) {

            switch ($status) {
                case 'active':
                    //Inactivas
                    $deleted_at = \Carbon\Carbon::now();
                    $technology->status = 'inactive';

                    $technology->deleted_at = $deleted_at->toDateTimeString();
                    $technology->save();
                    break;
                case 'inactive':
                case 'delete':
                    //Activa
                    $technology->deleted_at = null;
                    $technology->status = 'active';
                    $technology->save();  
                    break;
                default:
                    //opciones cargadas a mano desde el explorador (denegadas)
                    \Utility::setMessage(['message' => trans('messages.errors.globals.request_invalid')]);
                    break;
            }

            \Utility::setMessageSuccess();
        } else {
            \Utility::setMessage(['message' => trans('messages.errors.technologies.technology_not_exist')]);
        }
        return redirect()->route('technology.index');
    }
}
