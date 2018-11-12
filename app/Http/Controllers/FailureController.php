<?php

namespace App\Http\Controllers;

use Language;
use App\Failure;
use App\FailureTranslation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests;

class FailureController extends Controller
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
        //$failures = Failure::withTrashed()->with('translations')->translatedIn(\App::getLocale())->get();
        $failures = FailureTranslation::where('locale', \App::getLocale())->orderBy('name')->get();
        return view('failures.grid', compact('failures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edit = false;
        $this->dropDownLists($status);
        return view('failures.create', compact('edit', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Making rules for validation inputs
        $rules=[
            "code" => [
                'required',
                'max:150',
                Rule::unique('failures','code'),
            ],
        ];

        //translations
        foreach (trans('locale') as $key => $value) {
            $rules['name_'.$key] = [
                'required',
                'max:150',
                Rule::unique('failure_translations','name')
            ];
        }

        $v = \Validator::make($request->all(), $rules);

        if ($v->fails()) {
            \Utility::setMessage(['message' => $v->errors()->all()]);

            return redirect()->back()->withInput();
        }

        $failure = new Failure;
        $failure->code = strtoupper($request->code);
        $failure->status = $request->status;
        $failure->save();

        foreach (trans('locale') as $key => $value) {
            $translation = $failure->translateOrNew($key);
            $translation->failure_id = $failure->id;
            $translation->name = strtoupper($request->input('name_'.$key));
            $translation->save();
        }

        \Utility::setMessageSuccess();

        return redirect()->route('failure.index');
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
        $failure = Failure::withTrashed()->where('id', $id)->first();
        $this->dropDownLists($status);

        if (!$failure) {

            \Utility::setMessage(['message' => trans('messages.errors.failures.failure_not_exist')]);

            return redirect()->to('failure');
        }
        return view('failures.create', compact('edit', 'failure', 'status'));
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

        //Making rules for validation inputs
        $rules=[
            "code" => [
                'required',
                'max:150',
                Rule::unique('failures','code')->ignore($id),
            ],
        ];

        //translations
        foreach (trans('locale') as $key => $value) {
            $rules['name_'.$key] = [
                'required',
                'max:150',
                Rule::unique('failure_translations','name')->ignore($id, 'failure_id')
            ];
        }

        $v = \Validator::make($request->all(), $rules);

        if ($v->fails()) {
            \Utility::setMessage(['message' => $v->errors()->all()]);

            return redirect()->back()->withInput();
        }

        $failure = $id ?  Failure::find($id) : new Failure;
        $failure->code = strtoupper($request->code);
        $failure->status = $request->status;
        $failure->save();

        foreach (trans('locale') as $key => $value) {
            $translation = $failure->translateOrNew($key);
            $translation->name = strtoupper($request->input('name_'.$key));
            $translation->save();
        }

        \Utility::setMessageSuccess();

        return redirect()->route('failure.index');
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

        $query = Failure::listsTranslations('name');

        if ($q != '') {
            $query->whereRaw("name like '%" . $q . "%'");
        }

        $failures = $query->orderBy('name', 'asc')->get();

        $failures->each(function ($item, $key) use (&$data) {
            $data[] = ['id' => $item->id, 'text' => $item->name];
        });

        return json_encode($data);
    }

    /**
     * Change status to failure
     */
    public function changeStatus($id,$status) {

        $failure = Failure::withTrashed()->where('id', $id)->first();
        if ($failure) {

            switch ($status) {
                case 'active':
                    //Inactivas
                    $deleted_at = \Carbon\Carbon::now();
                    $failure->status = 'inactive';

                    $failure->deleted_at = $deleted_at->toDateTimeString();
                    $failure->save();
                    break;
                case 'inactive':
                case 'delete':
                    //Activa
                    $failure->deleted_at = null;
                    $failure->status = 'active';
                    $failure->save();  
                    break;
                default:
                    //opciones cargadas a mano desde el explorador (denegadas)
                    \Utility::setMessage(['message' => trans('messages.errors.globals.request_invalid')]);
                    break;
            }

            \Utility::setMessageSuccess();
        } else {
            \Utility::setMessage(['message' => trans('messages.errors.failures.failure_not_exist')]);
        }
        return redirect()->route('failure.index');
    }

    private function dropDownLists(&$status) {

        foreach (array_keys(trans('globals.type_status')) as $value) {
            $status[$value] = ucfirst($value);
        }
    }
}
