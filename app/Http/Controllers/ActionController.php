<?php

namespace App\Http\Controllers;

use Language;
use App\Action;
use Illuminate\Http\Request;

class ActionController extends Controller
{

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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request) {
        $q = trim($request->get('q'));
        $data = [];

        $query = Action::listsTranslations('name');

        if ($q != '') {
            $query->whereRaw("name like '%" . $q . "%'");
        }

        $state = $query->orderBy('name', 'asc')->get();

        $state->each(function ($item, $key) use (&$data) {
            $data[] = ['id' => $item->id, 'text' => $item->name];
        });

        return json_encode($data);
    }

    public function searchByState(Request $request, $state_id) {
        $q = trim($request->get('q'));
        $data = [];

        $query = Action::whereHas('states', function ($query) use ($state_id) {
                                    $query->where('state_id', $state_id);
                                })->listsTranslations('name');

        if ($q != '') {
            $query->whereRaw("name like '%" . $q . "%'");
        }

        $state = $query->orderBy('name', 'asc')->get();

        $state->each(function ($item, $key) use (&$data) {
            $data[] = ['id' => $item->id, 'text' => $item->name];
        });

        return json_encode($data);
    }
}
