<?php

namespace App\Http\Controllers;

use Language;
use App\State;
use Illuminate\Http\Request;
use App\Http\Requests;

class StateController extends Controller
{
    private $rules = [
        'code' => 'required|max:255',
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
        $states = State::withTrashed()->get();
        return view('states.grid', compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edit = false;
        return view('states.create', compact('edit'));
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

        $state = State::where('code', 'like', '%' . $request->get('code') . '%')->first();

        if ($state) {
            \Utility::setMessage(['message' => trans('messages.errors.states.state_already_exist')]);
            
            return redirect()->back()->withInput();
        }

        State::create($request->all());
        \Utility::setMessageSuccess();

        return redirect()->route('state.index');
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
        $state = State::withTrashed()->where('id', $id)->first();
        if (!$state) {

            \Utility::setMessage(['message' => trans('messages.errors.states.state_not_exist')]);

            return redirect()->to('state');
        }
        return view('states.create', compact('edit', 'state'));
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

        $state = State::withTrashed()->where('id', $id)->first();
        $state->code = $request->get('code');
        $state->save();

        \Utility::setMessageSuccess();
        return redirect()->route('state.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $state = State::find($id);
        $state->delete();
        \Utility::setMessageSuccess();
        return redirect()->route('state.index');

    }

    public function search(Request $request) {
        $q = trim($request->get('q'));
        $data = [];

        $query = State::listsTranslations('name');

        if ($q != '') {
            $query->whereRaw("name like '%" . $q . "%'");
        }

        $state = $query->orderBy('name', 'asc')->get();

        $state->each(function ($item, $key) use (&$data) {
            $data[] = ['id' => $item->id, 'text' => $item->name];
        });

        return json_encode($data);
    }

    /**
     * Change status to state
     */
    public function changeStatus($id,$status) {

        $state = State::withTrashed()->where('id', $id)->first();
        if ($state) {

            switch ($status) {
                case 'active':
                    //Inactivas
                    $deleted_at = \Carbon\Carbon::now();
                    $state->status = 'inactive';

                    $state->deleted_at = $deleted_at->toDateTimeString();
                    $state->save();
                    break;
                case 'inactive':
                case 'delete':
                    //Activa
                    $state->deleted_at = null;
                    $state->status = 'active';
                    $state->save();  
                    break;
                default:
                    //opciones cargadas a mano desde el explorador (denegadas)
                    \Utility::setMessage(['message' => trans('messages.errors.globals.request_invalid')]);
                    break;
            }

            \Utility::setMessageSuccess();
        } else {
            \Utility::setMessage(['message' => trans('messages.errors.states.state_not_exist')]);
        }
        return redirect()->route('state.index');
    }
}
