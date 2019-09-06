<?php


namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class UsersController extends Controller
{
    /**
     * Create a new user instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the users according to their account type.
     *
     * @param  string  $type
     * @return View
     */
    public function show($type)
    {
        if ($type == 'normal' && (Auth::User()->isSuper == true || Auth::User()->isAdmin == true)){
            $query = 'SELECT * FROM users WHERE isAdmin = 0 AND isSuper = 0';
            $users = DB::select($query);
            return view('users.showUsers')->with('users',$users)->with('type',$type);
        }
        else if($type == 'admins' && Auth::User()->isSuper == true){
            $query = 'SELECT * FROM users WHERE isAdmin = 1 AND isSuper = 0';
            $users = DB::select($query);
            return view('users.showUsers')->with('users',$users)->with('type',$type);
        }
        else{
                return redirect()->route('home');
        }
    }

    /**
     * Delete the selected user.
     *
     */
    public function destroy($username)
    {
        $type = DB::table('users')->where('username', $username)->value('isAdmin');
        if (Auth::User()->isSuper == true) {
            if ($type == 0) {
                $type = 'normal';
            } else {
                $type = 'admins';
            }
            DB::table('users')->where('username', $username)->delete();
            return redirect()->route('users.show', $type);
        }
        else if(Auth::User()->isAdmin == true){
            if ($type == 0) {
                DB::table('users')->where('username', $username)->delete();
                return redirect()->route('users.show', 'normal');
            } else {
                return redirect()->route('home');
            }
        }
        else{
            return redirect()->route('home');
        }
    }
}
