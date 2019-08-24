<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePersonRequest;
use App\Person;
use App\Related;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
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
     * Update a person.
     *
     */
    public function update(UpdatePersonRequest $request)
    {
        dd($request->all());
    }

    /**
     * Edit a person.
     *
     */
    public function edit($ssn)
    {
        $data = DB::select('SELECT * FROM people WHERE ssn = ' . $ssn);
        $childrenssn = null;
        if ($data[0]->gender == "male" && $data[0]->socialState != "single"){
            $spousessn = DB::select('SELECT memberssn FROM related WHERE husbandssn ='.$data[0]->ssn.' AND memberType = "wife"');
            $childrenssn = DB::select('SELECT memberssn FROM related WHERE husbandssn ='.$data[0]->ssn.' AND memberType = "child"');
            $data[1]= $spousessn[0];
            $data[2] = $childrenssn;
        }
        elseif($data[0]->gender == "female" && $data[0]->socialState != "single"){
            $spousessn = DB::select('SELECT husbandssn FROM related WHERE memberssn ='.$data[0]->ssn.' AND memberType = "wife"');
            $data[1]= $spousessn[0];
        }
        return view('persons.edit')->with('data', $data);
    }

    /**
     * Delete the selected person.
     *
     */
    public function destroy($ssn){
        $query = Input::get('query');
        @unlink (DB::table('people')->where('ssn', $ssn)->value('img_url'));
        $wifessn = DB::table('related')->where('husbandssn', $ssn)->where('memberType','wife')->value('memberssn');
        $husbandssn = DB::table('related')->where('memberssn', $ssn)->where('memberType', 'wife')->value('husbandssn');
        if(DB::table('people')->where('ssn', $wifessn)->value('ssn') == null){
            DB::table('related')->where('husbandssn', $ssn)->delete();
        }
        else{
            DB::table('related')->where('husbandssn', $ssn)->where('memberType', 'child')->delete();
        }
        if (DB::table('people')->where('ssn', $husbandssn)->value('ssn') == null){
            DB::table('related')->where('memberssn', $ssn)->where('memberType', 'wife')->delete();
        }
        DB::table('people')->where('ssn', $ssn)->delete();
        $result = DB::select($query);
        return redirect()->route('search.result', ['result' => $result, 'query' => $query]);
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

    /**
     * Show the person data.
     *
     */
    public function show($ssn)
    {
        $person = DB::select('SELECT * FROM people WHERE ssn = ' . $ssn);
        $data['person'] = $person[0];
        $data['children'] = [];
        if ($data['person']->socialState != "single" && $data['person']->gender == "male") {
            $wifessn = DB::table('related')->where('husbandssn', $ssn)->where('memberType', 'wife')->value('memberssn');
            $data['spousessn'] = $wifessn;
            $wife = DB::select('SELECT * FROM people WHERE ssn = ' . $wifessn);
            $data['spouse'] = $wife;
            $childrenssn = DB::select('SELECT memberssn FROM related WHERE husbandssn = ' . $ssn . ' And memberType = "child"');
            $data['childrenssn'] = $childrenssn;
            if ($childrenssn != null) {
                $index = 0;
                $children = null;
                foreach ($childrenssn as $childssn) {
                    $child = DB::select('SELECT * FROM people WHERE ssn = ' . $childssn->memberssn);
                    if ($child != null){
                        $children[$index++] = $child[0];
                    }
                }
                if ($children != null){
                    $data['children'] = $children;
                }
            }
        }
        else if ($data['person']->socialState != "single" && $data['person']->gender == "female"){
            $husbandssn = DB::table('related')->where('memberssn', $ssn)->where('memberType', 'wife')->value('husbandssn');
            $data['spousessn'] = $husbandssn;
            $husband = DB::select('SELECT * FROM people WHERE ssn = ' . $husbandssn);
            $data['spouse'] = $husband;
            $childrenssn = DB::select('SELECT memberssn FROM related WHERE husbandssn = ' . $husbandssn . ' And memberType = "child"');
            $data['childrenssn'] = $childrenssn;
            if ($childrenssn != null) {
                $index = 0;
                $children = null;
                foreach ($childrenssn as $childssn) {
                    $child = DB::select('SELECT * FROM people WHERE ssn = ' . $childssn->memberssn);
                    if ($child != null){
                        $children[$index++] = $child[0];
                    }
                }
                if ($children != null){
                    $data['children'] = $children;
                }
            }
        }
        return view('persons.show')->with('data', $data);
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
                    $relatedChild->memberType = "child";
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
