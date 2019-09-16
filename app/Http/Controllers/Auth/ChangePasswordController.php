<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{

    public function showChangeForm(Request $request){
        try{
            $user_id = $user = auth()->user()->id;
        }
        catch(\Exception $e){
            $user_id = $request->session()->get('user_id');
        }
        if($user_id == null){
            return redirect('/login');
        }
        return view('auth.passwords.change')->with('user_id',$user_id);
    }

    public function changePassword(Request $request){
        $user_id = $request->session()->get('user_id');
        if ($user_id == null){
            $user_id = $request->input('id');
        }
        if($user_id == null){
            return redirect('/login');
        }

        $user = User::find($user_id);
        if (!(Hash::check($request->get('currentPassword'), $user->password))) {
            // The passwords doesn't match
            return redirect()->back()->with("error","كلمة السر الحالية لا تتماشي مع كلمة السر التي ادخلتها. برجاء المحاولة مرة اخري.");
        }

        if(strcmp($request->get('currentPassword'), $request->get('password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","كلمة السر الجديدة لا يمكن ان تكون مطابقة لكلمة السر الحالية, برجاء اختيار كلمة سر مختلفة.");
        }

        $validatedData = $request->validate([
            'currentPassword' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);


        //Change Password
        $user->password = bcrypt($request->get('password'));
        $user->save();

        //Update timestamp
        $user->updated_at = Carbon::now();
        $user->save();

        auth()->logout();
        return redirect('/login')->with("status","تم تغيير كلمة السر بنجاح يمكنك الان تسجيل الدخول!");
    }
}
