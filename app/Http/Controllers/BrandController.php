<?php

namespace App\Http\Controllers;

use Language;
use App\Brand;
use Illuminate\Http\Request;
use App\Http\Requests;

class BrandController extends Controller
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
        $brands = Brand::withTrashed()->get();
        return view('brands.grid', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edit = false;
        return view('brands.create', compact('edit'));
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

        $brand = Brand::where('description', 'like', '%' . $request->get('description') . '%')->first();

        if ($brand) {
            \Utility::setMessage(['message' => trans('messages.errors.brands.brand_already_exist')]);
            
            return redirect()->back()->withInput();
        }

        Brand::create($request->all());
        \Utility::setMessageSuccess();

        return redirect()->route('brand.index');
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
        $brand = Brand::withTrashed()->where('id', $id)->first();
        if (!$brand) {

            \Utility::setMessage(['message' => trans('messages.errors.brands.brand_not_exist')]);

            return redirect()->to('brand');
        }
        return view('brands.create', compact('edit', 'brand'));
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

        $brand = Brand::withTrashed()->where('id', $id)->first();
        $brand->description = $request->get('description');
        $brand->save();

        \Utility::setMessageSuccess();
        return redirect()->route('brand.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $brand = Brand::find($id);
        $brand->delete();
        \Utility::setMessageSuccess();
        return redirect()->route('brand.index');

    }

    public function search(Request $request) {
        $q = trim($request->get('q'));
        $data = [];

        $query = Brand::select(['id', 'description']);

        if ($q != '') {
            $query->whereRaw("description like '%" . $q . "%'");
        }

        $brand = $query->orderBy('description', 'asc')->get();

        $brand->each(function ($item, $key) use (&$data) {
            $data[] = ['id' => $item->id, 'text' => $item->description];
        });

        return json_encode($data);
    }

    /**
     * Change status to brand
     */
    public function changeStatus($id,$status) {

        $brand = Brand::withTrashed()->where('id', $id)->first();
        if ($brand) {

            switch ($status) {
                case 'active':
                    //Inactivas
                    $deleted_at = \Carbon\Carbon::now();
                    $brand->status = 'inactive';

                    $brand->deleted_at = $deleted_at->toDateTimeString();
                    $brand->save();
                    break;
                case 'inactive':
                case 'delete':
                    //Activa
                    $brand->deleted_at = null;
                    $brand->status = 'active';
                    $brand->save();  
                    break;
                default:
                    //opciones cargadas a mano desde el explorador (denegadas)
                    \Utility::setMessage(['message' => trans('messages.errors.globals.request_invalid')]);
                    break;
            }

            \Utility::setMessageSuccess();
        } else {
            \Utility::setMessage(['message' => trans('messages.errors.brands.brand_not_exist')]);
        }
        return redirect()->route('brand.index');
    }
}
