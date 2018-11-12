<?php

namespace App\Http\Controllers;

use Language;
use App\Scale;
use Illuminate\Http\Request;
use App\Http\Requests;

class ScaleController extends Controller
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
        $scales = Scale::withTrashed()->get();
        return view('scales.grid', compact('scales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edit = false;
        return view('scales.create', compact('edit'));
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

        $scale = Scale::where('description', 'like', '%' . $request->get('description') . '%')->first();

        if ($scale) {
            \Utility::setMessage(['message' => trans('messages.errors.scales.scale_already_exist')]);
            
            return redirect()->back()->withInput();
        }

        Scale::create($request->all());
        \Utility::setMessageSuccess();

        return redirect()->route('scale.index');
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
        $scale = Scale::withTrashed()->where('id', $id)->first();
        if (!$scale) {

            \Utility::setMessage(['message' => trans('messages.errors.scales.scale_not_exist')]);

            return redirect()->to('scale');
        }
        return view('scales.create', compact('edit', 'scale'));
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

        $scale = Scale::withTrashed()->where('id', $id)->first();
        $scale->description = $request->get('description');
        $scale->save();

        \Utility::setMessageSuccess();
        return redirect()->route('scale.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $scale = Scale::find($id);
        $scale->delete();
        \Utility::setMessageSuccess();
        return redirect()->route('scale.index');

    }

    public function search(Request $request) {
        $q = trim($request->get('q'));
        $data = [];

        $query = Scale::select(['id', 'description']);

        if ($q != '') {
            $query->whereRaw("description like '%" . $q . "%'");
        }

        $scale = $query->orderBy('description', 'asc')->get();

        $scale->each(function ($item, $key) use (&$data) {
            $data[] = ['id' => $item->id, 'text' => $item->description];
        });

        return json_encode($data);
    }

    /**
     * Change status to scale
     */
    public function changeStatus($id,$status) {

        $scale = Scale::withTrashed()->where('id', $id)->first();
        if ($scale) {

            switch ($status) {
                case 'active':
                    //Inactivas
                    $deleted_at = \Carbon\Carbon::now();
                    $scale->status = 'inactive';

                    $scale->deleted_at = $deleted_at->toDateTimeString();
                    $scale->save();
                    break;
                case 'inactive':
                case 'delete':
                    //Activa
                    $scale->deleted_at = null;
                    $scale->status = 'active';
                    $scale->save();  
                    break;
                default:
                    //opciones cargadas a mano desde el explorador (denegadas)
                    \Utility::setMessage(['message' => trans('messages.errors.globals.request_invalid')]);
                    break;
            }

            \Utility::setMessageSuccess();
        } else {
            \Utility::setMessage(['message' => trans('messages.errors.scales.scale_not_exist')]);
        }
        return redirect()->route('scale.index');
    }
}
