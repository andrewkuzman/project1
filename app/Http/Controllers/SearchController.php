<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

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
            return('gender = "male"');
        }
        else{
            return('gender = "female"');
        }
    }

    public function searchBySocialState(){
        if (request()->has('socialStateSearchWidow') && request()->has('socialStateSearchMarried') && request()->has('socialStateSearchSingle')){
            return (true);
        }
        else if (request()->has('socialStateSearchWidow') && request()->has('socialStateSearchMarried')){
            return ('socialState != "single"');
        }
        else if (request()->has('socialStateSearchMarried') && request()->has('socialStateSearchSingle')){
            return ('socialState != "widow"');
        }
        else if (request()->has('socialStateSearchWidow') && request()->has('socialStateSearchSingle')){
            return ('socialState != "married"');
        }
        else if (request()->has('socialStateSearchWidow')){
            return ('socialState = "widow"');
        }
        else if (request()->has('socialStateSearchMarried')){
            return ('socialState = "married"');
        }
        else{
            return ('socialState = "Single"');
        }
    }

    public function searchByName(){
        $data = request()->all();
        if ($data['nameSearchOption'] == "nameSearchYes"){
            return ('fullName like "'.$data['nameSearch'].'%"');
        }
        else{
            return (true);
        }
    }

    public function searchBySsn(){
        $data = request()->all();
        if ($data['ssnSearchOption'] == "ssnSearchYes"){
            return ('ssn = "'.$data['ssnSearch'].'"');
        }
        else{
            return (true);
        }
    }

    public function searchByMobileNumber(){
        $data = request()->all();
        if ($data['mobileSearchOption'] == "mobileSearchYes"){
            return ('mobile = "'.$data['mobileSearch'].'"');
        }
        else{
            return (true);
        }
    }

    public function searchByEmail(){
        $data = request()->all();
        if ($data['emailSearchOption'] == "emailSearchYes"){
            return ('email = "'.$data['email'].'"');
        }
        else{
            return (true);
        }
    }

    public function searchByMotherName(){
        $data = request()->all();
        if ($data['motherSearchOption'] == "motherSearchYes"){
            return ('motherName like "'.$data['motherSearch'].'%"');
        }
        else{
            return (true);
        }
    }

    public function searchByBirthdate(){
        $data = request()->all();
        if ($data['birthDateSearchOption'] == "birthDateSearchYes"){
            return ('birthDate = "'.$data['birthDateSearch'].'"');
        }
        else{
            return (true);
        }
    }

    public function searchByEduQual(){
        $data = request()->all();
        if ($data['edcQualSearchOption'] == "edcQualSearchYes"){
            $result = 'eduQual in (';
            if (request()->has('edcQualSearchHigh')){
                if ($result == 'eduQual in ('){
                    $result = $result . " N'عالي'";
                }
                else{
                    $result = $result . ",N'عالي'";
                }
            }
            if (request()->has('edcQualSearchAboveAverage')){
                if ($result == 'eduQual in (') {
                    $result = $result . " N'فوق المتوسط'";
                }
                else{
                    $result = $result . " ,N'فوق المتوسط'";
                }
            }
            if (request()->has('edcQualSearchAverage')){
                if ($result == 'eduQual in (') {
                    $result = $result . " N'متوسط'";
                }
                else{
                    $result = $result . " ,N'متوسط'";
                }
            }
            if (request()->has('edcQualSearchSecondary')){
                if ($result == 'eduQual in (') {
                    $result = $result . " N'ثانوي'";
                }
                else{
                    $result = $result . " ,N'ثانوي'";
                }
            }
            if (request()->has('edcQualSearchPreparatory')){
                if ($result == 'eduQual in (') {
                    $result = $result . " N'اعدادي'";
                }
                else{
                    $result = $result . " ,N'اعدادي'";
                }
            }
            if (request()->has('edcQualSearchPrimary')){
                if ($result == 'eduQual in (') {
                    $result = $result . " N'ابتدائي'";
                }
                else{
                    $result = $result . " ,N'ابتدائي'";
                }
            }
            if (request()->has('edcQualSearchNon')){
                if ($result == 'eduQual in (') {
                    $result = $result . " N'بدون مؤهل'";
                }
                else{
                    $result = $result . " ,N'بدون مؤهل'";
                }
            }
            return ($result.')');
        }
        else{
            return (true);
        }
    }

    public function searchByAddress(){
        $data = request()->all();
        if ($data['addressSearchOption'] == "addressSearchYes"){
            $result = true;
            if ($data['governorateSearch'] != null){
                $result = $result . " AND governorate = N'".$data['governorateSearch']."'";
            }
            if ($data['citySearch'] != null){
                $result = $result . " AND city = N'".$data['citySearch']."'";
            }
            if ($data['streetSearch'] != null){
                $result = $result . " AND street = N'".$data['streetSearch']."'";
            }
            if ($data['buildingSearch'] != null){
                $result = $result . " AND building = N'".$data['buildingSearch']."'";
            }
            return ($result);
        }
        else{
            return (true);
        }
    }

    public function searchByMarriageDate(){
        $data = request()->all();
        if (request()->has('marriageDateSearchOption') && $data['marriageDateSearchOption'] == "marriageDateSearchYes"){
            return ('marriageDate = "'.$data['marriageDateSearch'].'"');
        }
        else{
            return (true);
        }
    }

    public function searchByNumberOfChildren(){
        $data = request()->all();
        if (request()->has('numberofChildrenSearchOption') && $data['numberofChildrenSearchOption'] == "numberofChildrenSearchYes"){
            return ('numOfChildren = "'.$data['numberofChildrenSearch'].'"');
        }
        else{
            return (true);
        }
    }

    public function searchByServingType(){
        $data = request()->all();
        if ($data['servingTypeSearchOption'] == "servingTypeSearchYes"){
            $result = 'servingType in (';
            if (request()->has('servingTypeSearchYouth')){
                if ($result == 'servingType in (') {
                    $result = $result . " N'شباب'";
                }
                else{
                    $result = $result . " ,N'شباب'";
                }
            }
            if (request()->has('servingTypeSearchSecondary')){
                if ($result == 'servingType in (') {
                    $result = $result . " N'ثانوي'";
                }
                else{
                    $result = $result . " ,N'ثانوي'";
                }
            }
            if (request()->has('servingTypeSearchPreparatory')){
                if ($result == 'servingType in (') {
                    $result = $result . " N'اعدادي'";
                }
                else{
                    $result = $result . " ,N'اعدادي'";
                }
            }
            if (request()->has('servingTypeSearchPrimary')){
                if ($result == 'servingType in (') {
                    $result = $result . " N'ابتدائي'";
                }
                else{
                    $result = $result . " ,N'ابتدائي'";
                }
            }
            if (request()->has('servingTypeSearchOrphans')){
                if ($result == 'servingType in (') {
                    $result = $result . " N'ايتام'";
                }
                else{
                    $result = $result . " ,N'ايتام'";
                }
            }
            if (request()->has('servingTypeSearchPoor')){
                if ($result == 'servingType in (') {
                    $result = $result . " N'اخوة الرب'";
                }
                else{
                    $result = $result . " ,N'اخوة الرب'";
                }
            }
            if (request()->has('servingTypeSearchOld')){
                if ($result == 'servingType in (') {
                    $result = $result . " N'مسنين'";
                }
                else{
                    $result = $result . " ,N'مسنين'";
                }
            }
            return ($result.')');
        }
        else{
            return (true);
        }
    }

    public function searchByDeaconLevel(){
        $data = request()->all();
        if ($data['deaconLevelSearchOption'] == "deaconLevelSearchYes"){
            $result = 'deaconLevel in (';
            if (request()->has('servingTypeSearchEpideacon')){
                if ($result == 'deaconLevel in (') {
                    $result = $result . " N'ايبودياكون'";
                }
                else{
                    $result = $result . " ,N'ايبودياكون'";
                }
            }
            if (request()->has('servingTypeSearchAnaghnostos')){
                if ($result == 'deaconLevel in (') {
                    $result = $result . " N'اناغنوستيس'";
                }
                else{
                    $result = $result . " ,N'اناغنوستيس'";
                }
            }
            if (request()->has('servingTypeSearchEpsaltos')){
                if ($result == 'deaconLevel in (') {
                    $result = $result . " N'ابصالتس'";
                }
                else{
                    $result = $result . " ,N'ابصالتس'";
                }
            }
            if (request()->has('servingTypeSearchArchdeacon')){
                if ($result == 'deaconLevel in (') {
                    $result = $result . " N'أرشيدياكون'";
                }
                else{
                    $result = $result . " ,N'أرشيدياكون'";
                }
            }
            if (request()->has('servingTypeSearchDeacon')){
                if ($result == 'deaconLevel in (') {
                    $result = $result . " N'دياكون'";
                }
                else{
                    $result = $result . " ,N'دياكون'";
                }
            }
            return ($result.')');
        }
        else{
            return (true);
        }
    }

    public function searchByChurchName(){
        $data = request()->all();
        if ($data['churchNameSearchOption'] == "churchNameSearchYes"){
            return ('church like "'.$data['churchNameSearch'].'%"');
        }
        else{
            return (true);
        }
    }

    public function searchByConfessionFatherName(){
        $data = request()->all();
        if ($data['confessFatherSearchOption'] == "confessFatherSearchYes"){
            return ('confessFather like "'.$data['confessFatherSearch'].'%"');
        }
        else{
            return (true);
        }
    }

    public function prepare(){
        $result = DB::select('SELECT * FROM people WHERE '.$this->searchByGender().' AND '.$this->searchBySocialState().' AND '.$this->searchByName().' AND '.$this->searchBySsn().' AND '.$this->searchByMobileNumber().' AND '.$this->searchByEmail().' AND '.$this->searchByMotherName().' AND '.$this->searchByBirthDate().' AND '.$this->searchByEduQual().' AND '.$this->searchByAddress().' AND '.$this->searchByServingType().' AND '.$this->searchByDeaconLevel().' AND '.$this->searchByChurchName().' AND '.$this->searchByConfessionFatherName().' AND '.$this->searchByMarriageDate().' AND '.$this->searchByNumberOfChildren());
        return redirect()->route('search.result', ['result' => $result]);
    }
}
