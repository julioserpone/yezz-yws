<?php

namespace App\Http\Controllers;

use App\Color;
use Language;
use Illuminate\Http\Request;
use App\Http\Requests;

class ColorController extends Controller
{
    private $rules = [
        'description' => 'required|max:255',
        'hexadecimal' => 'required',
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
        $colors = Color::withTrashed()->get();
        return view('colors.grid', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edit = false;
        return view('colors.create', compact('edit'));
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

        $color = Color::where('description', 'like', '%' . $request->get('description') . '%')->first();

        if ($color) {
            \Utility::setMessage(['message' => trans('messages.errors.colors.color_already_exist')]);
            return redirect()->back()->withInput();
        }

        Color::create($request->all());
        \Utility::setMessageSuccess();

        return redirect()->route('color.index');
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
        $color = Color::withTrashed()->where('id', $id)->first();

        if (!$color) {

            \Utility::setMessage(['message' => trans('messages.errors.colors.color_not_exist')]);
            return redirect()->to('color');
        }
        return view('colors.create', compact('edit', 'color'));
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

        $color = Color::withTrashed()->where('id', $id)->first();
        $color->update($request->all());

        \Utility::setMessageSuccess();
        return redirect()->route('color.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $color = Color::find($id);
        $color->delete();
        \Utility::setMessageSuccess();
        return redirect()->route('color.index');

    }

    public function search(Request $request) {
        $q = trim($request->get('q'));
        $data = [];

        $query = Color::select(['id', 'description']);

        if ($q != '') {
            $query->whereRaw("description like '%" . $q . "%'");
        }

        $color = $query->orderBy('description', 'asc')->get();

        $color->each(function ($item, $key) use (&$data) {
            $data[] = ['id' => $item->id, 'text' => $item->description];
        });

        return json_encode($data);
    }

    public function searchToSelect2Format(Request $request) {
        $q = trim($request->get('q'));
        $data["items"] = [];

        $query = Color::select(['id', 'description', 'hexadecimal', 'secondary_hex']);

        if ($q != '') {
            $query->whereRaw("description like '%" . $q . "%'");
        }

        $color = $query->orderBy('description', 'asc')->get();

        $color->each(function ($item, $key) use (&$data) {
            $data["items"][] = ['id' => $item->id, 'text' => $item->description, 'primary_color' => $item->hexadecimal, 'secondary_color' => $item->secondary_hex];
        });

        return json_encode($data);
    }


    /**
     * Change status to color
     */
    public function changeStatus($id,$status) {

        $color = Color::withTrashed()->where('id', $id)->first();
        if ($color) {

            switch ($status) {
                case 'active':
                    //Inactivas
                    $deleted_at = \Carbon\Carbon::now();
                    $color->status = 'inactive';

                    $color->deleted_at = $deleted_at->toDateTimeString();
                    $color->save();
                    break;
                case 'inactive':
                case 'delete':
                    //Activa
                    $color->deleted_at = null;
                    $color->status = 'active';
                    $color->save();  
                    break;
                default:
                    //opciones cargadas a mano desde el explorador (denegadas)
                    \Utility::setMessage(['message' => trans('messages.errors.globals.request_invalid')]);
                    break;
            }

            \Utility::setMessageSuccess();
        } else {
            \Utility::setMessage(['message' => trans('messages.errors.colors.color_not_exist')]);
        }
        return redirect()->route('color.index');
    }
}
