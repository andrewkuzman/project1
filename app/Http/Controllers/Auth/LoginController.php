<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
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
    protected $redirectTo = '/home';

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
     * Check if user password is expired or not.
     *
     * @param Request $request
     * @param $user
     * @return void
     */
    public function authenticated(Request $request, $user)
    {
        $password_updated_at = $user->updated_at;
        $password_expiry_days = 30;
        $password_expiry_at = Carbon::parse($password_updated_at)->addDays($password_expiry_days);
        if($password_expiry_at->lessThan(Carbon::now()) && $user->isSuper == 0){
            $request->session()->put('user_id',$user->id);
            auth()->logout();
            return redirect(route('password.show'))->with('info', "كلمة السر الخاصة بك غير صالحة بعد الان برجاء تغيير كلمة السر.");
        }

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

}
