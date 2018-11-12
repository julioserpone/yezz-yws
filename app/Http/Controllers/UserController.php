<?php

namespace App\Http\Controllers;

use Language;
use App\User;
use App\Country;
use App\Workshop;
use App\Helpers\File;
use App\Helpers\FileUpload;
use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    private function rules($id = '', $key = '') {
        $rules = [
            'identification' => 'required|unique:users,identification,'.$id,
            'username' => 'required|alpha|unique:users,username,'.$id,
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'birth_date' => 'required|date',
            'cellphone_number' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'photo' => 'mimes:jpeg,bmp,png',
            'country_id' => 'required',
            'workshop_id' => 'required_if:role,workshop',
        ];
        //Si no hay clave, es nuevo registro
        if (empty($key)) $rules['password'] = 'required';
        return $rules;
    }

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
        $users = User::withTrashed()->with(['country'])->orderBy('first_name')->get();
        return view('users.grid', compact('users'));
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
        $workshops = Workshop::orderBy('description')->pluck('description', 'id');
        $this->dropDownLists($gender, $language, $status, $roles);

        return view('users.create', compact('countries', 'workshops', 'gender', 'language', 'status', 'roles', 'edit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = \Validator::make($request->all(), $this->rules());

        if ($v->fails()) {
            \Utility::setMessage(['message' => $v->errors()->all()]);
            return redirect()->back()->withInput($request->all());
        }

        $data = $request->except([
            'language',
            'remember_token',
            'disabled_at',
            'deleted_at',
        ]);

        $user = User::create($data);

        if ($user) {

            $data['birth_date'] = Carbon::parse($request->get('birth_date'))->format('Y-m-d');
            if ($request->get('password')) $data['password'] = \Hash::make($request->get('password'));

            //Upload image
            if ($request->file('photo')) {
                $fileuploaded = File::section('profile_img')
                    ->setting([
                        'code' => false,
                        'subpath' => $user->id,
                    ])->upload($request->file('photo'));
                $data['pic_url'] = $fileuploaded;
                
                //delete old file
                File::deleteFile($user->pic_url, env('FILESYSTEM'));
            } else {
                $data['pic_url'] = '/profile_img/avatar.png';
            }

            //update workshop (only for users type 'workshop')
            if ($data['role'] != 'workshop') {
                $data['workshop_id'] = null;
            }
            $user->update($data);

            \Utility::setMessageSuccess();
        }

        return redirect()->to('user');
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
        $user = User::where('id', $id)->first();

        if (!$user) {
            \Utility::setMessage(['message' => trans('messages.errors.globals.not_section_allow')]);
            return redirect()->to('user');
        }

        $edit = true;
        $countries = Country::orderBy('description')->pluck('description', 'id')->all();
        $workshops = Workshop::orderBy('description')->pluck('description', 'id');
        $this->dropDownLists($gender, $language, $status, $roles);

        return view('users.create', compact('user', 'countries', 'workshops', 'gender', 'language', 'status', 'roles', 'edit'));
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
        $v = \Validator::make($request->all(), $this->rules($id, $request->get('key')));

        if ($v->fails()) {
            \Utility::setMessage(['message' => $v->errors()->all()]);
            return redirect()->back()->withInput($request->all());
        }
        $data = $request->except([
            'remember_token',
            'disabled_at',
            'deleted_at',
        ]);

        $user = User::where('id', $id)->first();

        if ($user) {
            
            $data['birth_date'] = Carbon::parse($request->get('birth_date'))->format('Y-m-d');
            
            //if the same password, change in database. But it is left
            $data['password'] = ($request->get('password')) ? \Hash::make($request->get('password')) : $data['key'];
            
            //Upload image
            if ($request->file('photo')) {
                //Storage Amazon S3
                $fileuploaded = File::section('profile_img')
                    ->setting([
                        'code' => false,
                        'subpath' => $user->id,
                    ])->upload($request->file('photo'));
                $data['pic_url'] = $fileuploaded;
                
                //delete old file
                File::deleteFile($user->pic_url, env('FILESYSTEM'));
            } else {
                $data['pic_url'] = '/profile_img/avatar.png';
            }
            
            //update workshop (only for users type 'workshop')
            if (isset($data['role']) && $data['role'] != 'workshop') {
                $data['workshop_id'] = null;
            }

            $user->update($data);
            \Utility::setMessageSuccess();
        } else {
            \Utility::setMessage(['message' => trans('messages.errors.globals.not_section_allow')]);
        }

        return redirect()->to(($request->get('isprofile')) ? 'home':'user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $user = User::find($id);
        $user->delete();
        \Utility::setMessageSuccess();
        return redirect()->route('user.index');

    }

    public function search(Request $request) {
        $q = trim($request->get('q'));
        $data = [];

        $users = User::select(['id', 'first_name', 'last_name'])
        ->where('verified', 'yes')
        ->where('status', 'active')
        ->where('role', '!=', 'admin');

        if ($q != '') {
            $users->whereRaw("CONCAT (first_name, ' ', last_name) like '%" . $q . "%'");
        }

        $users = $users->get();

        $users->each(function ($item, $key) use (&$data) {
            $data[] = ['id' => $item->id, 'text' => $item->first_name . ' ' . $item->last_name];
        });

        return json_encode($data);
    }

    /**
     * Change status to user
     */
    public function changeStatus($id,$status) {

        $user = User::withTrashed()->where('id', $id)->first();
        if ($user) {

            switch ($status) {
                case 'active':
                    //Inactivas
                    $deleted_at = \Carbon\Carbon::now();
                    $user->status = 'inactive';

                    $user->deleted_at = $deleted_at->toDateTimeString();
                    $user->save();
                    break;
                case 'inactive':
                case 'delete':
                    //Activa
                    $user->deleted_at = null;
                    $user->status = 'active';
                    $user->save();  
                    break;
                default:
                    //opciones cargadas a mano desde el explorador (denegadas)
                    \Utility::setMessage(['message' => trans('messages.errors.globals.request_invalid')]);
                    break;
            }

            \Utility::setMessageSuccess();
        } else {
            \Utility::setMessage(['message' => trans('messages.errors.users.user_not_exist')]);
        }
        return redirect()->route('user.index');
    }

    /**
     * Get information for edit profile
     */
    public function profile() {

        $user = User::where('id', \Auth::user()->id)->first();

        if (!$user) {

            \Utility::setMessage(['message' => trans('messages.errors.globals.not_section_allow')]);
            return redirect()->to('home');
        }
        
        $edit = true;
        $profile = true;
        $countries = Country::orderBy('description')->pluck('description', 'id');
        $this->dropDownLists($gender, $verified, $status, $roles);
        return view('users.create', compact('user', 'countries', 'gender', 'verified', 'status', 'roles', 'edit', 'profile'));
    }

    private function dropDownLists(&$gender, &$languages, &$status, &$roles) {
        foreach (array_keys(trans('globals.gender')) as $value) {
            $gender[$value] = ucfirst($value);
        }

        foreach (array_keys(trans('globals.language')) as $value) {
            $languages[$value] = ucfirst($value);
        }

        foreach (array_keys(trans('globals.type_status')) as $value) {
            $status[$value] = ucfirst($value);
        }

        foreach (array_keys(trans('globals.roles')) as $value) {
            $roles[$value] = ucfirst($value);
        }
    }
}
