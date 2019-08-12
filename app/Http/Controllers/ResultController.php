<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;

class ResultController extends Controller
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

    /**
     * Show the search result.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $result = Input::get('result');
        return view('result')->with('result', $result);
    }
}
