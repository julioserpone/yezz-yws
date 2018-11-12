<?php

namespace App\Http\Controllers;

use Language;
use App\Route;
use Illuminate\Http\Request;
use App\Http\Requests;

class RouteController extends Controller
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
        $routes = Route::withTrashed()->get();
        return view('routes.grid', compact('routes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edit = false;
        return view('routes.create', compact('edit'));
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

        $route = Route::where('description', 'like', '%' . $request->get('description') . '%')->first();

        if ($route) {
            \Utility::setMessage(['message' => trans('messages.errors.routes.route_already_exist')]);
            
            return redirect()->back()->withInput();
        }

        Route::create($request->all());
        \Utility::setMessageSuccess();

        return redirect()->route('route.index');
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
        $route = Route::withTrashed()->where('id', $id)->first();
        if (!$route) {
            \Utility::setMessage(['message' => trans('messages.errors.routes.route_not_exist')]);
            return redirect()->to('route');
        }
        return view('routes.create', compact('edit', 'route'));
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

        $route = Route::withTrashed()->where('id', $id)->first();
        $route->description = $request->get('description');
        $route->save();

        \Utility::setMessageSuccess();
        return redirect()->route('route.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $route = Route::find($id);
        $route->delete();
        \Utility::setMessageSuccess();
        return redirect()->route('route.index');

    }

    public function search(Request $request) {
        $q = trim($request->get('q'));
        $data = [];

        $query = Route::select(['id', 'description']);

        if ($q != '') {
            $query->whereRaw("description like '%" . $q . "%'");
        }

        $route = $query->orderBy('description', 'asc')->get();

        $route->each(function ($item, $key) use (&$data) {
            $data[] = ['id' => $item->id, 'text' => $item->description];
        });

        return json_encode($data);
    }

    /**
     * Change status to route
     */
    public function changeStatus($id,$status) {

        $route = Route::withTrashed()->where('id', $id)->first();
        if ($route) {

            switch ($status) {
                case 'active':
                    //Inactivas
                    $deleted_at = \Carbon\Carbon::now();
                    $route->status = 'inactive';

                    $route->deleted_at = $deleted_at->toDateTimeString();
                    $route->save();
                    break;
                case 'inactive':
                case 'delete':
                    //Activa
                    $route->deleted_at = null;
                    $route->status = 'active';
                    $route->save();  
                    break;
                default:
                    //opciones cargadas a mano desde el explorador (denegadas)
                    \Utility::setMessage(['message' => trans('messages.errors.globals.request_invalid')]);
                    break;
            }

            \Utility::setMessageSuccess();
        } else {
            \Utility::setMessage(['message' => trans('messages.errors.routes.route_not_exist')]);
        }
        return redirect()->route('route.index');
    }
}
