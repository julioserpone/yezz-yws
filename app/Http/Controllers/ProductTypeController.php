<?php

namespace App\Http\Controllers;

use Language;
use App\ProductType;
use Illuminate\Http\Request;
use App\Http\Requests;

class ProductTypeController extends Controller
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
        $producttypes = ProductType::withTrashed()->get();
        return view('producttypes.grid', compact('producttypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edit = false;
        return view('producttypes.create', compact('edit'));
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

        $producttype = ProductType::where('description', 'like', '%' . $request->get('description') . '%')->first();

        if ($producttype) {
            \Utility::setMessage(['message' => trans('messages.errors.producttypes.producttype_already_exist')]);
            
            return redirect()->back()->withInput();
        }

        ProductType::create($request->all());
        \Utility::setMessageSuccess();

        return redirect()->route('producttype.index');
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
        $producttype = ProductType::withTrashed()->where('id', $id)->first();
        if (!$producttype) {

            \Utility::setMessage(['message' => trans('messages.errors.producttypes.producttype_not_exist')]);

            return redirect()->to('producttype');
        }
        return view('producttypes.create', compact('edit', 'producttype'));
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

        $producttype = ProductType::withTrashed()->where('id', $id)->first();
        $producttype->description = $request->get('description');
        $producttype->save();

        \Utility::setMessageSuccess();
        return redirect()->route('producttype.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $producttype = ProductType::find($id);
        $producttype->delete();
        \Utility::setMessageSuccess();
        return redirect()->route('producttype.index');

    }

    public function search(Request $request) {
        $q = trim($request->get('q'));
        $data = [];

        $query = ProductType::select(['id', 'description']);

        if ($q != '') {
            $query->whereRaw("description like '%" . $q . "%'");
        }

        $producttype = $query->orderBy('description', 'asc')->get();

        $producttype->each(function ($item, $key) use (&$data) {
            $data[] = ['id' => $item->id, 'text' => $item->description];
        });

        return json_encode($data);
    }

    /**
     * Change status to producttype
     */
    public function changeStatus($id,$status) {

        $producttype = ProductType::withTrashed()->where('id', $id)->first();
        if ($producttype) {

            switch ($status) {
                case 'active':
                    //Inactivas
                    $deleted_at = \Carbon\Carbon::now();
                    $producttype->status = 'inactive';

                    $producttype->deleted_at = $deleted_at->toDateTimeString();
                    $producttype->save();
                    break;
                case 'inactive':
                case 'delete':
                    //Activa
                    $producttype->deleted_at = null;
                    $producttype->status = 'active';
                    $producttype->save();  
                    break;
                default:
                    //opciones cargadas a mano desde el explorador (denegadas)
                    \Utility::setMessage(['message' => trans('messages.errors.globals.request_invalid')]);
                    break;
            }

            \Utility::setMessageSuccess();
        } else {
            \Utility::setMessage(['message' => trans('messages.errors.producttypes.producttype_not_exist')]);
        }
        return redirect()->route('producttype.index');
    }
}
