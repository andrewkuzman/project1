<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function search(){
        return view('search');
    }

    public function searchByGender(){
        if(request()->has('genderSearchMale') && request()->has('genderSearchFemale')){
            return (true);
        }
        else if(request()->has('genderSearchMale')){
            return('male');
        }
        else{
            return('female');
        }
    }

    public function prepare(Request $request){
        $data = request()->all();

        $d = DB::table('people')->where('gender',$this->searchByGender());
        dd($d);
    }
}
