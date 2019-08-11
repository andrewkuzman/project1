<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CreatePersonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function childValidation($number, $j)
    {
        $str = '';
        for ($i = 1; $i <= $number; $i++){
            if ($i != $j){
                if ($i != $number){
                    $str = $str . $this->request->all()['childssn'.$i].',';
                }
                else{
                    $str = $str . $this->request->all()['childssn'.$i];
                }
            }
        }
        return $str;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = ['name' => 'required|regex:/^[\pL\s\-]+$/u|max:40',
            'ssn' =>'required|unique:people|size:14',
            'mobile' => 'required|unique:people|size:11',
            'email' => 'required|unique:people|email|max:50',
            'motherName' => 'required|regex:/^[\pL\s\-]+$/u|max:40',
            'gender' => 'required|in:male,female',
            'birthDate' => 'required|date|before:today',
            'edcQual' => 'required|in:عالي,فوق المتوسط,متوسط,ثانوي,اعدادي,ابتدائي,بدون مؤهل',
            'city' => 'required|max:25',
            'governorate' => 'required|max:25',
            'street' => 'required|max:25',
            'building' => 'required|max:25',
            'socialState' => 'required|in:socialState_single,socialState_married,socialState_widow',
            'church' => 'required|max:35',
            'confessFather' => 'required|alpha|max:40',
            'personalPic' => 'required|image|max:2048',
            'servingType' => 'in:ايتام,ابتدائي,اعدادي,ثانوي,شباب,اختار,اخوة الرب,مسنين',
        ];
        if($this->request->all()['gender'] == "female"){
            $rules ['deaconLevel'] = 'in:اختار';
        }
        if($this->request->all()['gender'] == "male"){
            $rules ['deaconLevel'] = 'in:اختار,ابصالتس,اناغنوستيس,ايبودياكون,دياكون,أرشيدياكون';
        }
        if($this->request->all()['socialState'] != "socialState_single"){
            $rules ['numberofChildren'] = 'required|max:15';
            if ($this->request->all()['gender'] == "male"){
                $checkAlreadyExist = DB::table('related')->where('husbandssn', $this->request->all()['ssn'])->where('memberType','wife')->value('memberssn');
                $checkWifeGender = DB::table('people')->where('ssn', $this->request->all()['wifessn'])->value('gender');
                $checkIfSingle = DB::table('people')->where('ssn',$this->request->all()['wifessn'])->where('socialState','single')->value('ssn');
                $checkNumberOfChildren = DB::table('people')->where('ssn',$this->request->all()['wifessn'])->value('numOfChildren');
                if ($checkWifeGender != null){
                    $rules['gender'] = 'not_in:'.$checkWifeGender;
                }
                if ($checkAlreadyExist == null){
                    $rules ['wifessn'] = 'required|unique:related,memberssn|size:14|not_in:'.$this->request->all()['ssn'].','.$checkIfSingle;
                    $rules ['marriageDate'] = 'required|before:today|date|greater_year:birthDate';
                }
                else{
                    $rules ['wifessn'] = 'required|size:14|in:'.$checkAlreadyExist.'|not_in:'.$this->request->all()['ssn'].','.$checkIfSingle;
                    $rules ['marriageDate'] = 'required|before:today|date|greater_year:birthDate|in:'.DB::table('people')->where('ssn', $this->request->all()['wifessn'])->value('marriageDate');
                }
                if ($checkNumberOfChildren != null){
                    $rules['numberofChildren'] = $rules['numberofChildren'] . '|in:'.$checkNumberOfChildren;
                }
                for ($i = 1; $i <= $this->all()['numberofChildren']; $i++){
                    $rules ['childssn' . $i] = 'required|unique:related,memberssn|unique:people,ssn|size:14|not_in:'.$this->request->all()['ssn'].','.$this->request->all()['wifessn'].','.self::childValidation($this->request->all()['numberofChildren'],$i);
                }
            }
            else{
                $checkAlreadyExist = DB::table('related')->where('memberssn', $this->request->all()['ssn'])->where('memberType','wife')->value('husbandssn');
                $checkHusbandGender = DB::table('people')->where('ssn', $this->request->all()['husbandssn'])->value('gender');
                $checkIfSingle = DB::table('people')->where('ssn',$this->request->all()['husbandssn'])->where('socialState','single')->value('ssn');
                $checkNumberOfChildren = DB::table('people')->where('ssn',$this->request->all()['husbandssn'])->value('numOfChildren');
                if ($checkHusbandGender != null){
                    $rules['gender'] = 'not_in:'.$checkHusbandGender;
                }
                if ($checkAlreadyExist == null){
                    $rules ['marriageDate'] = 'required|before:today|date|greater_year:birthDate';
                    $rules ['husbandssn'] = 'unique:related,husbandssn,NULL,memberssn,memberType,wife|required|size:14|not_in:'.$this->request->all()['ssn'].','.$checkIfSingle;
                }
                else{
                    $rules ['marriageDate'] = 'required|before:today|date|greater_year:birthDate|in:'.DB::table('people')->where('ssn', $this->request->all()['husbandssn'])->value('marriageDate');
                    $rules['husbandssn'] = 'required|size:14|in:'.$checkAlreadyExist.'|not_in:'.$this->request->all()['ssn'].','.$checkIfSingle;
                }
                if ($checkNumberOfChildren != null){
                    $rules['numberofChildren'] = $rules['numberofChildren'] . '|in:'.$checkNumberOfChildren;
                }
            }
        }
        else{
            if ($this->request->all()['gender'] == "male") {
                $checkIfSingle = DB::table('related')->where('husbandssn', $this->request->all()['ssn'])->value('husbandssn');
                $rules['ssn'] = 'not_in:'.$checkIfSingle;
            }
            else{
                $checkIfSingle = DB::table('related')->where('memberssn', $this->request->all()['ssn'])->where('memberType','wife')->value('memberssn');
                $rules['ssn'] = 'not_in:'.$checkIfSingle;
            }
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => 'برجاء ادخال الاسم كامل.',
            'name.max' => 'يجب ان لا يتعدي الاسم ال40 حرف.',
            'ssn.required' => 'برجاء ادخال الرقم القومي.',
            'ssn.unique' => 'هذا الرقم القومي مسجل بالفعل برجاء اعادة ادخال الرقم القومي و التأكد منه.',
            'ssn.not_in' => 'الحالة الاجتماعية غير صحيحة, هذا الشخص متزوج بالفعل.',
            'ssn.size' => 'يجب ان يتكون الرقم القومي من 14 رقم.',
            'mobile.required' => 'برجاء ادخال رقم المحمول.',
            'mobile.unique' => 'رقم المحمول مسجل بالفعل برجاء اعادة ادخال رقم المحمول و التأكد منه.',
            'mobile.size' => 'يجب ان يتكون رقم المحمول من 14 رقم.',
            'email.required' => 'برجاء ادخال البريد الالكتروني.',
            'email.unique' => 'هذا البريد الالكتروني مسجل بالفعل برجاء اعادة ادخال البريد الالكتروني و التأكد منه.',
            'email.email' => 'هذا البريد الالكتروني غير صحيح برجاء اعادة ادخال البريد الالكتروني و التأكد منه.',
            'email.max' => 'يجب ان لا يتعدي البريد الالكتروني ال50 حرف.',
            'motherName.required' => 'برجاء ادخال اسم الام.',
            'motherName.max' => 'يجب ان لا يتعدي اسم الام ال40 حرف.',
            'gender.required' => 'برجاء اختيار النوع.',
            'gender.in' => 'النوع يجب ان يكون ذكر او انثي فقط.',
            'gender.not_in' => 'النوع غير صحيح برجاء التأكد منه و اعادة ادخاله مرة اخري.',
            'birthDate.required' => 'برجاء ادخال تاريخ الميلاد.',
            'birthDate.date' => 'يجب ان يكون تاريخ الميلاد علي هيئة تاريخ.',
            'birthDate.before' => 'يجب ان يكون تاريخ الميلاد قبل تاريخ اليوم.',
            'edcQual.required' => 'برجاء اختيار المؤهل الدراسي.',
            'edcQual.in' => 'المؤهل الدراسي يجب ان يكون احد الاختيارات المتاحة فقط.',
            'city.required' => 'برجاء ادخال اسم المدينة/الحي/القرية.',
            'city.max' => 'يجب ان لا يتعدي اسم المدينة/الحي/القرية ال25 حرف .',
            'governorate.required' => 'برجاء ادخال اسم المحافظة.',
            'governorate.max' => 'يجب ان لا يتعدي اسم المحافظة ال25 حرف .',
            'street.required' => 'برجاء ادخال اسم الشارع.',
            'street.max' => 'يجب ان لا يتعدي اسم الشارع ال25 حرف .',
            'building.required' => 'برجاء ادخال اسم/رقم العقار.',
            'building.max' => 'يجب ان لا يتعدي اسم/رقم العقار ال25 حرف .',
            'socialState.required' => 'برجاء اختيار الحالة الاجتماعية.',
            'socialState.in' => 'النوع يجب ان تكون الحالة الاجتماعية اعزب, متزوج, ارمل فقط.',
            'socialState.not_in' => 'الحالة الاجتماعية غير صحيحة, هذا الشخص متزوج بالفعل.',
            'wifessn.required' => 'برجاء ادخال الرقم القومي للزوجة.',
            'wifessn.unique' => 'الرقم القومي للزوجة مسجل بالفعل لشخص اخر برجاء اعادة ادخال الرقم القومي للزوجة و التأكد منه.',
            'wifessn.size' => 'يجب ان يتكون الرقم القومي للزوجة من 14 رقم.',
            'wifessn.not_in' => 'الرقم القومي للزوجة غير صحيح برجاء اعادة ادخال الرقم القومي للزوجة و التأكد منه, او التأكد من الحالة الأجتماعية للزوجة.',
            'wifessn.in' => 'الرقم القومي للزوجة غير صحيح برجاء اعادة ادخال الرقم القومي للزوجة و التأكد منه.',
            'husbandssn.required' => 'برجاء ادخال الرقم القومي للزوج.',
            'husbandssn.unique' => 'الرقم القومي للزوج مسجل بالفعل لشخص اخر برجاء اعادة ادخال الرقم القومي للزوج و التأكد منه.',
            'husbandssn.size' => 'يجب ان يتكون الرقم القومي للزوج من 14 رقم.',
            'husbandssn.not_in' => 'الرقم القومي للزوج غير صحيح برجاء اعادة ادخال الرقم القومي للزوج و التأكد منه, او التأكد من الحالة الأجتماعية للزوج.',
            'husbandssn.in' => 'الرقم القومي للزوج غير صحيح برجاء اعادة ادخال الرقم القومي للزوج و التأكد منه.',
            'childssn1.required' => 'برجاء ادخال الرقم القومي للابن الاول.',
            'childssn1.unique' => 'هذا الرقم القومي مسجل بالفعل برجاء اعادة ادخال الرقم القومي للابن الاول و التأكد منه.',
            'childssn1.size' => 'يجب ان يتكون الرقم القومي للابن الاول من 14 رقم.',
            'childssn1.not_in' => 'الرقم القومي للابن الاول غير صحيح برجاء اعادة ادخال الرقم القومي للابن الاول و التأكد منه.',
            'childssn2.required' => 'برجاء ادخال الرقم القومي للابن الثاني.',
            'childssn2.unique' => 'هذا الرقم القومي مسجل بالفعل برجاء اعادة ادخال الرقم القومي للابن الثاني و التأكد منه.',
            'childssn2.size' => 'يجب ان يتكون الرقم القومي للابن الثاني من 14 رقم.',
            'childssn2.not_in' => 'الرقم القومي للابن الثاني غير صحيح برجاء اعادة ادخال الرقم القومي للابن الثاني و التأكد منه.',
            'childssn3.required' => 'برجاء ادخال الرقم القومي للابن الثالث.',
            'childssn3.unique' => 'هذا الرقم القومي مسجل بالفعل برجاء اعادة ادخال الرقم القومي للابن الثالث و التأكد منه.',
            'childssn3.size' => 'يجب ان يتكون الرقم القومي للابن الثالث من 14 رقم.',
            'childssn3.not_in' => 'الرقم القومي للابن الثالث غير صحيح برجاء اعادة ادخال الرقم القومي للابن الثالث و التأكد منه.',
            'childssn4.required' => 'برجاء ادخال الرقم القومي للابن الرابع.',
            'childssn4.unique' => 'هذا الرقم القومي مسجل بالفعل برجاء اعادة ادخال الرقم القومي للابن الرابع و التأكد منه.',
            'childssn4.size' => 'يجب ان يتكون الرقم القومي للابن الرابع من 14 رقم.',
            'childssn4.not_in' => 'الرقم القومي للابن الرابع غير صحيح برجاء اعادة ادخال الرقم القومي للابن الرابع و التأكد منه.',
            'childssn5.required' => 'برجاء ادخال الرقم القومي للابن الخامس.',
            'childssn5.unique' => 'هذا الرقم القومي مسجل بالفعل برجاء اعادة ادخال الرقم القومي للابن الخامس و التأكد منه.',
            'childssn5.size' => 'يجب ان يتكون الرقم القومي للابن الخامس من 14 رقم.',
            'childssn5.not_in' => 'الرقم القومي للابن الخامس غير صحيح برجاء اعادة ادخال الرقم القومي للابن الخامس و التأكد منه.',
            'childssn6.required' => 'برجاء ادخال الرقم القومي للابن السادس.',
            'childssn6.unique' => 'هذا الرقم القومي مسجل بالفعل برجاء اعادة ادخال الرقم القومي للابن السادس و التأكد منه.',
            'childssn6.size' => 'يجب ان يتكون الرقم القومي للابن السادس من 14 رقم.',
            'childssn6.not_in' => 'الرقم القومي للابن السادس غير صحيح برجاء اعادة ادخال الرقم القومي للابن السادس و التأكد منه.',
            'childssn7.required' => 'برجاء ادخال الرقم القومي للابن السابع.',
            'childssn7.unique' => 'هذا الرقم القومي مسجل بالفعل برجاء اعادة ادخال الرقم القومي للابن السابع و التأكد منه.',
            'childssn7.size' => 'يجب ان يتكون الرقم القومي للابن السابع من 14 رقم.',
            'childssn7.not_in' => 'الرقم القومي للابن السابع غير صحيح برجاء اعادة ادخال الرقم القومي للابن السابع و التأكد منه.',
            'childssn8.required' => 'برجاء ادخال الرقم القومي للابن الثامن.',
            'childssn8.unique' => 'هذا الرقم القومي مسجل بالفعل برجاء اعادة ادخال الرقم القومي للابن الثامن و التأكد منه.',
            'childssn8.size' => 'يجب ان يتكون الرقم القومي للابن الثامن من 14 رقم.',
            'childssn8.not_in' => 'الرقم القومي للابن الثامن غير صحيح برجاء اعادة ادخال الرقم القومي للابن الثامن و التأكد منه.',
            'childssn9.required' => 'برجاء ادخال الرقم القومي للابن التاسع.',
            'childssn9.unique' => 'هذا الرقم القومي مسجل بالفعل برجاء اعادة ادخال الرقم القومي للابن التاسع و التأكد منه.',
            'childssn9.size' => 'يجب ان يتكون الرقم القومي للابن التاسع من 14 رقم.',
            'childssn9.not_in' => 'الرقم القومي للابن التاسع غير صحيح برجاء اعادة ادخال الرقم القومي للابن التاسع و التأكد منه.',
            'childssn10.required' => 'برجاء ادخال الرقم القومي للابن العاشر.',
            'childssn10.unique' => 'هذا الرقم القومي مسجل بالفعل برجاء اعادة ادخال الرقم القومي للابن العاشر و التأكد منه.',
            'childssn10.size' => 'يجب ان يتكون الرقم القومي للابن العاشر من 14 رقم.',
            'childssn10.not_in' => 'الرقم القومي للابن العاشر غير صحيح برجاء اعادة ادخال الرقم القومي للابن العاشر و التأكد منه.',
            'childssn11.required' => 'برجاء ادخال الرقم القومي للابن الحادي عشر.',
            'childssn11.unique' => 'هذا الرقم القومي مسجل بالفعل برجاء اعادة ادخال الرقم القومي للابن الحادي عشر و التأكد منه.',
            'childssn11.size' => 'يجب ان يتكون الرقم القومي للابن الحادي عشر من 14 رقم.',
            'childssn11.not_in' => 'الرقم القومي للابن الحادي عشر غير صحيح برجاء اعادة ادخال الرقم القومي للابن الحادي عشر و التأكد منه.',
            'childssn12.required' => 'برجاء ادخال الرقم القومي للابن الثاني عشر.',
            'childssn12.unique' => 'هذا الرقم القومي مسجل بالفعل برجاء اعادة ادخال الرقم القومي للابن الثاني عشر و التأكد منه.',
            'childssn12.size' => 'يجب ان يتكون الرقم القومي للابن الثاني عشر من 14 رقم.',
            'childssn12.not_in' => 'الرقم القومي للابن الثاني عشر غير صحيح برجاء اعادة ادخال الرقم القومي للابن الثاني عشر و التأكد منه.',
            'childssn13.required' => 'برجاء ادخال الرقم القومي للابن الثالث عشر.',
            'childssn13.unique' => 'هذا الرقم القومي مسجل بالفعل برجاء اعادة ادخال الرقم القومي للابن الثالث عشر و التأكد منه.',
            'childssn13.size' => 'يجب ان يتكون الرقم القومي للابن الثالث عشر من 14 رقم.',
            'childssn13.not_in' => 'الرقم القومي للابن الثالث عشر غير صحيح برجاء اعادة ادخال الرقم القومي للابن الثالث عشر و التأكد منه.',
            'childssn14.required' => 'برجاء ادخال الرقم القومي للابن الرابع عشر.',
            'childssn14.unique' => 'هذا الرقم القومي مسجل بالفعل برجاء اعادة ادخال الرقم القومي للابن الرابع عشر و التأكد منه.',
            'childssn14.size' => 'يجب ان يتكون الرقم القومي للابن الرابع عشر من 14 رقم.',
            'childssn14.not_in' => 'الرقم القومي للابن الرابع عشر غير صحيح برجاء اعادة ادخال الرقم القومي للابن الرابع عشر و التأكد منه.',
            'childssn15.required' => 'برجاء ادخال الرقم القومي للابن الخامس عشر.',
            'childssn15.unique' => 'هذا الرقم القومي مسجل بالفعل برجاء اعادة ادخال الرقم القومي للابن الخامس عشر و التأكد منه.',
            'childssn15.size' => 'يجب ان يتكون الرقم القومي للابن الخامس عشر من 14 رقم.',
            'childssn15.not_in' => 'الرقم القومي للابن الخامس عشر غير صحيح برجاء اعادة ادخال الرقم القومي للابن الخامس عشر و التأكد منه.',
            'servingType.in' => 'نوع الخدمة يجب ان يكون احد الاختيارات المتاحة فقط.',
            'deaconLevel.in' => 'نوع الخدمة يجب ان يكون احد الاختيارات المتاحة فقط.',
            'numberofChildren.required' => 'برجاء ادخال عدد الابناء.',
            'numberofChildren.max' => 'يجب ان لا يتعدي عدد الابناء ال15 ابن .',
            'numberofChildren.in' => 'عدد الابناء غير صحيح برجاء مراجعة عدد الابناء و اعادة ادخاله .',
            'marriageDate.required' => 'برجاء ادخال تاريخ الزواج.',
            'marriageDate.date' => 'يجب ان يكون تاريخ الزواج علي هيئة تاريخ.',
            'marriageDate.before' => 'يجب ان يكون تاريخ الزواج قبل تاريخ اليوم.',
            'marriageDate.greater_year' => 'تاريخ الزواج غير صحيح برجاء مراجعة تاريخ الميلاد و تاريخ الزواج.',
            'marriageDate.in' => 'تاريخ الزواج غير صحيح برجاء مراجعة تاريخ الزواج و اعادة ادخاله.',
            'church.required' => 'برجاء ادخال اسم الكنيسة.',
            'church.max' => 'يجب ان لا يتعدي اسم الكنيسة ال35 حرف .',
            'confessFather.required' => 'برجاء ادخال اسم الكنيسة.',
            'confessFather.max' => 'يجب ان لا يتعدي اسم اب الاعتراف ال40 حرف .',
            'personalPic.required' => 'برجاء اختيار الصورة الشخصية.',
            'personalPic.image' => 'يجب ان تكون الصورة من نوع jpeg, png, bmp, gif, svg.',
            'personalPic.max' => 'يجب ان تكون الصورة اصغر من 2 ميجابايت.',
        ];
    }
}
