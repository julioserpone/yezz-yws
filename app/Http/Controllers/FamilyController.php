<?php

namespace App\Http\Controllers;

use Language;
use App\Family;
use Illuminate\Http\Request;
use App\Http\Requests;

class FamilyController extends Controller
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
        $families = Family::withTrashed()->get();
        return view('families.grid', compact('families'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edit = false;
        return view('families.create', compact('edit'));
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

        $family = Family::where('description', trim($request->get('description')))->first();

        if ($family) {
            \Utility::setMessage(['message' => trans('messages.errors.families.family_already_exist')]);
            
            return redirect()->back()->withInput();
        }

        Family::create($request->all());
        \Utility::setMessageSuccess();

        return redirect()->route('family.index');
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
        $family = Family::withTrashed()->where('id', $id)->first();
        if (!$family) {

            \Utility::setMessage(['message' => trans('messages.errors.families.family_not_exist')]);

            return redirect()->to('family');
        }
        return view('families.create', compact('edit', 'family'));
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

        $family_exist = Family::withTrashed()->where('description', trim($request->get('description')))->where('id', '<>', $id)->first();
        if ($family_exist) {
            \Utility::setMessage(['message' => trans('messages.errors.families.family_already_exist')]);
            return redirect()->back()->withInput();
        }
        $family = Family::withTrashed()->where('id', $id)->first();
        $family->description = $request->get('description');
        $family->save();

        \Utility::setMessageSuccess();
        return redirect()->route('family.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $family = Family::find($id);
        $family->delete();
        \Utility::setMessageSuccess();
        return redirect()->route('family.index');

    }

    public function search(Request $request) {
        $q = trim($request->get('q'));
        $data = [];

        $query = Family::select(['id', 'description']);

        if ($q != '') {
            $query->whereRaw("description like '%" . $q . "%'");
        }

        $family = $query->orderBy('description', 'asc')->get();

        $family->each(function ($item, $key) use (&$data) {
            $data[] = ['id' => $item->id, 'text' => $item->description];
        });

        return json_encode($data);
    }

    /**
     * Change status to family
     */
    public function changeStatus($id,$status) {

        $family = Family::withTrashed()->where('id', $id)->first();
        if ($family) {

            switch ($status) {
                case 'active':
                    //Inactivas
                    $deleted_at = \Carbon\Carbon::now();
                    $family->status = 'inactive';

                    $family->deleted_at = $deleted_at->toDateTimeString();
                    $family->save();
                    break;
                case 'inactive':
                case 'delete':
                    //Activa
                    $family->deleted_at = null;
                    $family->status = 'active';
                    $family->save();  
                    break;
                default:
                    //opciones cargadas a mano desde el explorador (denegadas)
                    \Utility::setMessage(['message' => trans('messages.errors.globals.request_invalid')]);
                    break;
            }

            \Utility::setMessageSuccess();
        } else {
            \Utility::setMessage(['message' => trans('messages.errors.families.family_not_exist')]);
        }
        return redirect()->route('family.index');
    }
}
