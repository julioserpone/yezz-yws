<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductType;
use App\Brand;
use App\Family;
use App\Technology;
use App\Scale;
use App\Color;
use Language;
use DinamicsGP;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests;

class ProductController extends Controller
{
    private $rules = [
        'producttype_id' => 'required',
        'brand_id' => 'required',
        'family_id' => 'required',
        'technology_id' => 'required',
        'scale_id' => 'required',
        'color_id' => 'required',
        'code' => 'required|max:20',
        'part_number' => 'required|max:20',
        'model' => 'required|max:100',
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
        $products = Product::withTrashed()->with(['producttype','brand','family','technology','scale', 'color'])->get();
        return view('products.grid', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edit = false;
        $producttypes = ProductType::orderBy('description')->pluck('description', 'id');
        $brands = Brand::orderBy('description')->pluck('description', 'id');
        $families = Family::orderBy('description')->pluck('description', 'id');
        $technologies = Technology::orderBy('description')->pluck('description', 'id');
        $scales = Scale::orderBy('description')->pluck('description', 'id');
        $colors = Color::orderBy('description')->pluck('description', 'id');
        $this->dropDownLists($type_states);

        return view('products.create', compact('edit','producttypes','brands','families','technologies','scales','colors','type_states'));
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

        $product = Product::where('code', 'like', '%' . $request->get('code') . '%')->first();

        if ($product) {
            \Utility::setMessage(['message' => trans('messages.errors.products.product_already_exist')]);
            return redirect()->back()->withInput();
        }

        Product::create($request->all());
        \Utility::setMessageSuccess();

        return redirect()->route('product.index');
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
        $product = Product::withTrashed()->where('id', $id)->first();

        if (!$product) {
            \Utility::setMessage(['message' => trans('messages.errors.products.product_not_exist')]);
            return redirect()->to('product');
        }

        $producttypes = ProductType::orderBy('description')->pluck('description', 'id');
        $brands = Brand::orderBy('description')->pluck('description', 'id');
        $families = Family::orderBy('description')->pluck('description', 'id');
        $technologies = Technology::orderBy('description')->pluck('description', 'id');
        $scales = Scale::orderBy('description')->pluck('description', 'id');
        $colors = Color::orderBy('description')->pluck('description', 'id');
        $this->dropDownLists($type_states);

        return view('products.create', compact('edit','product','producttypes','brands','families','technologies','scales','colors','type_states'));
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

        $product = Product::withTrashed()->where('id', $id)->first();
        //dd($product, $request->all());
        $product->update($request->all());

        \Utility::setMessageSuccess();
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $product = Product::find($id);
        $product->delete();
        \Utility::setMessageSuccess();
        return redirect()->route('product.index');

    }

    /**
     * Change states to product
     */
    public function changeStates($id,$state) {

        $product = Product::withTrashed()->where('id', $id)->first();
        if ($product) {

            switch ($state) {
                case 'active':
                    //Pasive
                    $deleted_at = \Carbon\Carbon::now();
                    $product->state = 'pasive';

                    $product->deleted_at = $deleted_at->toDateTimeString();
                    $product->save();
                    break;
                case 'pasive':
                    //Active
                    $product->deleted_at = null;
                    $product->state = 'active';
                    $product->save();  
                    break;
                default:
                    //opciones cargadas a mano desde el explorador (denegadas)
                    \Utility::setMessage(['message' => trans('messages.errors.globals.request_invalid')]);
                    break;
            }

            \Utility::setMessageSuccess();
        } else {
            \Utility::setMessage(['message' => trans('messages.errors.products.product_not_exist')]);
        }
        return redirect()->route('product.index');
    }

    public function search(Request $request) {
        $q = trim($request->get('q'));
        $data = [];

        $query = Product::with(['color']);

        if ($q != '') {
            $query->whereRaw("description like '%" . $q . "%'");
        }

        $courier = $query->orderBy('description', 'asc')->get();

        $courier->each(function ($item, $key) use (&$data) {
            //$data[] = ['id' => $item->id, 'text' => $item->model." (".$item->color->description.")"];
            $data[] = ['id' => $item->id, 'text' => $item->description];
        });

        return json_encode($data);
    }

    /**
     * Sincronize data with Dinamics GP
     * @return json response
     */
    public function sincronize() {

        try
        {
            $data = DinamicsGP::getListProducts(false);
            $products = Product::all();

            $colors = Color::all();
            $regex = trans('products.regex_colors');

            foreach ($data as $product) {
                $color = '';  
                //Busqueda de color, segun lo suministrado por GP                
                foreach ($regex as $key => $value) {
                      $find = stripos($product['Descripcion'], $key);
                      if ($find !== false) {
                            $color = $value;
                            break;
                      }
                }
                $found = $products->where('code', $product['Codigo'])->first();
                if ($found) {
                    $found->update([
                        'producttype_id' => ProductType::where('description',$product['Clase'])->first()->id,
                        'brand_id' => Brand::where('description',$product['Marca'])->first()->id,
                        'color_id' => Color::where('description',($color)?:'BLACK')->first()->id,
                        'code' => $product['Codigo'],
                        'model' => $product['Modelo'],
                        'part_number' => $product['NumerodeParte'],
                        'description' => $product['Descripcion'],
                    ]);
                } else {
                    Product::create([
                        'producttype_id' => ProductType::where('description',$product['Clase'])->first()->id,
                        'family_id' => Family::where('description','')->first()->id,
                        'brand_id' => Brand::where('description',$product['Marca'])->first()->id,
                        'technology_id' => Technology::where('description','')->first()->id,
                        'scale_id' => Scale::where('description','MEDIUM')->first()->id,
                        'color_id' => Color::where('description',($color)?:'BLACK')->first()->id,
                        'code' => $product['Codigo'],
                        'model' => $product['Modelo'],
                        'part_number' => $product['NumerodeParte'],
                        'description' => $product['Descripcion'],
                    ]);
                }

            } //foreach
            
            return new JsonResponse('OK', 200);

        }
        catch (Exception $e)
        {
            report($e);
            return false;
        }
    }

    public function getDataByImei(Request $request)
    {
        $data = DinamicsGP::getDataByImei($request->get('imei'));
        return ($data) ? $data : null;
    }

    public function getListProductsDinamicsGP()
    {
        $data = DinamicsGP::getListProducts();
        return ($data) ? $data : null;
    }

    private function dropDownLists(&$type_states) {

        foreach (array_keys(trans('globals.type_state')) as $value) {
            $type_states[$value] = ucfirst($value);
        }
    }
}
