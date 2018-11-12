<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
    *   Rules Login
    **/
    private $rules = [
        'username' => 'required',
        'password' => 'required',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function login(Request $request)
    {
        $v = \Validator::make($request->all(), $this->rules);

        if ($v->fails()) {
            \Utility::setMessage(['message' => $v->errors()->all()]);
            return redirect()->back()->withInput($request->all());
        }

        $credentials = [
            'username' => $request->get('username'),
            'password' => $request->get('password'),
            'status'   => 'active'
        ];

        if (\Auth::attempt($credentials, $request->get('remember'))) {
            // Authentication passed...
            return redirect()->intended('home');
        } 
        else
        {
            \Utility::setMessage(['message' => trans('messages.credentials_invalid')]);
            return redirect()->back()->withInput($request->all());
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->to('login');
    }
}