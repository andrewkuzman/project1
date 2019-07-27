<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePersonRequest;
use App\Person;
use Illuminate\Http\Request;

class PersonsController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('persons.create');
    }

    public function store(CreatePersonRequest $request)
    {
        $data = $request->all();
        $person = new Person();
        $person->fullName = $data['name'];
        $person->ssn = $data['ssn'];
        $person->mobile = $data['mobile'];
        $person->email = $data['email'];
        $person->motherName = $data['motherName'];
        $person->birthDate = $data['birthDate'];
        $person->eduQual = $data['edcQual'];
        $person->governorate = $data['governorate'];
        $person->city = $data['city'];
        $person->street = $data['street'];
        $person->building = $data['building'];
        $person->church = $data['church'];
        $person->confessFather = $data['confessFather'];
        $person->img_url = "HELLO";
        $person->servingType = $data['servingType'];
        $person->deaconLevel = $data['deaconLevel'];
        if ($data['gender'] == "gender_male"){
            $person->gender = "male";
        }
        else{
            $person->gender = "female";
        }
        if ($data['socialState'] == "socialState_single"){
            $person->socialState = "single";
            $person->marriageDate = "";
            $person->numOfChildren = "";
        }
        else if($data['socialState'] == "socialState_married"){
            $person->socialState = "married";
            $person->marriageDate = $data['marriageDate'];
            $person->numOfChildren = $data['numberofChildren'];
        }
        else{
            $person->socialState = "widow";
            $person->marriageDate = $data['marriageDate'];
            $person->numOfChildren = $data['numberofChildren'];
        }
        $person->save();
        //dd($request->all());
    }
}
