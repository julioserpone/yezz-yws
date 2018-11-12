<?php

namespace App\Http\Controllers;

use Language;
use App\Chain;
use App\Country;
use Illuminate\Http\Request;
use App\Http\Requests;

class ChainController extends Controller
{
    private $rules = [
        'description' => 'required|max:255',
        'country_id' => 'required',
        'admin_imei' => 'required',
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
        $chains = Chain::withTrashed()->with('country')->get();
        return view('chains.grid', compact('chains'));
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

        return view('chains.create', compact('edit','countries'));
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

        $chain = Chain::where('description', 'like', '%' . $request->get('description') . '%')->first();

        if ($chain) {
            \Utility::setMessage(['message' => trans('messages.errors.chains.chain_already_exist')]);
            return redirect()->back()->withInput();
        }

        Chain::create($request->all());
        \Utility::setMessageSuccess();

        return redirect()->route('chain.index');
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
        $chain = Chain::withTrashed()->where('id', $id)->first();
        //dd($chain);
        if (!$chain) {

            \Utility::setMessage(['message' => trans('messages.errors.chains.chain_not_exist')]);
            return redirect()->to('chain');
        }
        return view('chains.create', compact('edit', 'chain', 'countries'));
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

        $chain = Chain::withTrashed()->where('id', $id)->first();
        $chain->description = $request->get('description');
        $chain->country_id = $request->get('country_id');
        $chain->admin_imei = $request->get('admin_imei');
        $chain->save();

        \Utility::setMessageSuccess();
        return redirect()->route('chain.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $chain = Chain::find($id);
        $chain->delete();
        \Utility::setMessageSuccess();
        return redirect()->route('chain.index');

    }

    public function search(Request $request) {
        $q = trim($request->get('q'));
        $data = [];

        $query = Chain::select(['id', 'description']);

        if ($q != '') {
            $query->whereRaw("description like '%" . $q . "%'");
        }

        $chain = $query->orderBy('description', 'asc')->get();

        $chain->each(function ($item, $key) use (&$data) {
            $data[] = ['id' => $item->id, 'text' => $item->description];
        });

        return json_encode($data);
    }

    /**
     * Change status to chain
     */
    public function changeStatus($id,$status) {

        $chain = Chain::withTrashed()->where('id', $id)->first();
        if ($chain) {

            switch ($status) {
                case 'active':
                    //Inactivas
                    $deleted_at = \Carbon\Carbon::now();
                    $chain->status = 'inactive';

                    $chain->deleted_at = $deleted_at->toDateTimeString();
                    $chain->save();
                    break;
                case 'inactive':
                case 'delete':
                    //Activa
                    $chain->deleted_at = null;
                    $chain->status = 'active';
                    $chain->save();  
                    break;
                default:
                    //opciones cargadas a mano desde el explorador (denegadas)
                    \Utility::setMessage(['message' => trans('messages.errors.globals.request_invalid')]);
                    break;
            }

            \Utility::setMessageSuccess();
        } else {
            \Utility::setMessage(['message' => trans('messages.errors.chains.chain_not_exist')]);
        }
        return redirect()->route('chain.index');
    }
}
