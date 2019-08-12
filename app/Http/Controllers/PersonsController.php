<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePersonRequest;
use App\Person;
use App\Related;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

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
     * Delete the selected person.
     *
     */
    public function delete($ssn){
        DB::table('people')->where('ssn', $ssn)->delete();
        return redirect()->back();
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
        $successRelated = true;
        $successPerson = true;
        $img_path = 'storage/' . request('personalPic')->store('uploads','public');
        $data = $request->all();
        $person = new Person();
        $related = new Related();
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
        $person->img_url = $img_path;
        $person->servingType = $data['servingType'];
        $person->deaconLevel = $data['deaconLevel'];
        if ($data['gender'] == "male"){
            $person->gender = "male";
        }
        else{
            $person->gender = "female";
        }
        if ($data['socialState'] == "socialState_single"){
            $person->socialState = "single";
            $person->marriageDate = null;
            $person->numOfChildren = null;
        }
        else{
            $person->marriageDate = $data['marriageDate'];
            $person->numOfChildren = $data['numberofChildren'];
            if ($data['socialState'] == "socialState_married"){
                $person->socialState = "married";
            }
            else{
                $person->socialState = "widow";
            }
            if ($data['gender'] == "male"){
                for ($i = 1; $i <=$data['numberofChildren']; $i++){
                    $relatedChild = new Related();
                    $relatedChild->memberssn = $data['childssn'.$i];
                    $relatedChild->memberType = "Child";
                    $relatedChild->husbandssn = $data['ssn'];
                    $relatedChild->save();
                }
                $check = DB::table('related')->where('memberssn', $data['wifessn'])->value('memberssn');
                if ($check == null){
                    $related->memberssn=$data['wifessn'];
                    $related->memberType="wife";
                    $related->husbandssn=$data['ssn'];
                    $successRelated = $related->save();
                }
            }
            else{
                $check = DB::table('related')->where('husbandssn', $data['husbandssn'])->value('memberssn');
                if ($check == null){
                    $related->memberssn=$data['ssn'];
                    $related->memberType="wife";
                    $related->husbandssn=$data['husbandssn'];
                    $successRelated = $related->save();
                }
            }
        }
        try{
            $successPerson = $person->save();
        }
        catch (Exception $e){
            if(file_exists($img_path)) {
                @unlink($img_path);
            }
            return redirect()->back()->with('failure','حدث خطأ في تسجيل البيانات, برجاء مراجعة البيانات و اعادة ادخالها في وقت اخر .');
        }
        if ($successPerson && $successRelated){
            return redirect()->back()->with('success', 'تم تسجيل البيانات بنجاح .');
        }else{
            if(file_exists($img_path)) {
                @unlink($img_path);
            }
            return redirect()->back()->with('failure','حدث خطأ في تسجيل البيانات, برجاء مراجعة البيانات و اعادة ادخالها في وقت اخر .');
        }
    }
}
