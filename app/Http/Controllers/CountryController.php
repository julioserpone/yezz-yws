<?php

namespace App\Http\Controllers;

use Language;
use App\Country;
use App\Attribute;
use App\CountryAttribute;
use Illuminate\Http\Request;
use App\Http\Requests;

class CountryController extends Controller
{
    private $rules = [
        'description' => 'required|max:255',
        'iso_code' => 'required|alpha|min:2|max:2',
        'calling_code' => 'required|min:2|max:4',
        'coin_code' => 'required|min:1|max:4',
        'coin_name' => 'required|alpha|max:20',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
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
        $countries = Country::withTrashed()->get();
        return view('countries.grid', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edit = false;
        return view('countries.create', compact('edit'));
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

        $country = Country::where('description', 'like', '%' . $request->get('description') . '%')->first();

        if ($country) {
            \Utility::setMessage(['message' => trans('messages.errors.countries.country_already_exist')]);
            
            return redirect()->back()->withInput();
        }

        //Create attribute initials to country
        $country = Country::create($request->all());
        if ($country) {
            $attributes = Attribute::all();
            foreach ($attributes as $attribute) {
                switch ($attribute->code) {
                    case 'OS_SECUENCE':
                        $attribute_value = 1;
                        break;
                    case 'TAX':
                        $attribute_value = 10;
                        break;
                    case 'CONVERSION_RATE':
                        $attribute_value = 10;
                        break;
                    case 'NIVEL_REPAIR_I':
                        $attribute_value = 200;
                        break;
                    case 'NIVEL_REPAIR_II':
                        $attribute_value = 300;
                        break;
                }
                CountryAttribute::create([
                    'country_id' => $country->id,
                    'attribute_id' => $attribute->id,
                    'attribute_value' => $attribute_value
                ]);                        
            }
        }
        \Utility::setMessageSuccess();

        return redirect()->route('country.index');
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
        $country = Country::withTrashed()->where('id', $id)->first();
        if (!$country) {

            \Utility::setMessage(['message' => trans('messages.errors.countries.country_not_exist')]);
            return redirect()->to('country');
        }
        return view('countries.create', compact('edit', 'country'));
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

        $country = Country::withTrashed()->where('id', $id)->first();
        $country->description = $request->get('description');
        $country->iso_code = $request->get('iso_code');
        $country->calling_code = $request->get('calling_code');
        $country->save();

        \Utility::setMessageSuccess();
        return redirect()->route('country.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $country = Country::find($id);
        $country->delete();
        \Utility::setMessageSuccess();
        return redirect()->route('country.index');

    }

    public function search(Request $request) {
        $q = trim($request->get('q'));
        $data = [];

        $query = Country::select(['id', 'description']);

        if ($q != '') {
            $query->whereRaw("description like '%" . $q . "%'");
        }

        $country = $query->orderBy('description', 'asc')->get();

        $country->each(function ($item, $key) use (&$data) {
            $data[] = ['id' => $item->id, 'text' => $item->description];
        });

        return json_encode($data);
    }

    /**
     * Change status to country
     */
    public function changeStatus($id,$status) {

        $country = Country::withTrashed()->where('id', $id)->first();
        if ($country) {

            switch ($status) {
                case 'active':
                    //Inactivas
                    $deleted_at = \Carbon\Carbon::now();
                    $country->status = 'inactive';

                    $country->deleted_at = $deleted_at->toDateTimeString();
                    $country->save();
                    break;
                case 'inactive':
                case 'delete':
                    //Activa
                    $country->deleted_at = null;
                    $country->status = 'active';
                    $country->save();  
                    break;
                default:
                    //opciones cargadas a mano desde el explorador (denegadas)
                    \Utility::setMessage(['message' => trans('messages.errors.globals.request_invalid')]);
                    break;
            }

            \Utility::setMessageSuccess();
        } else {
            \Utility::setMessage(['message' => trans('messages.errors.countries.country_not_exist')]);
        }
        return redirect()->route('country.index');
    }
}
