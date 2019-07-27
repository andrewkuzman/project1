@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-md-right">تسجيل بيانات</div>

                <div class="card-body">
                    <form action="/p" enctype="multipart/form-data" method="POST">
                        @csrf
                        @if($errors->any())
                            <ul dir="rtl" class="text-right alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <input id="name" onkeypress="return arabicOnly(event,this);" type="text" class="text-md-right form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="name" class="col-md-4 col-form-label text-md-left">الاسم كامل</label>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <input id="ssn" type="number" min="0" oninput="validity.valid||(value='');" class="form-control @error('ssn') is-invalid @enderror" name="ssn" value="{{ old('ssn') }}" required autocomplete="ssn" autofocus>

                                @error('ssn')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="ssn" class="col-md-4 col-form-label text-md-left">الرقم القومي</label>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <input id="mobile" type="number" min="0" oninput="validity.valid||(value='');" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile" autofocus>

                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="ssn" class="col-md-4 col-form-label text-md-left">رقم المحمول</label>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <label for="email" class="col-md-4 col-form-label text-md-left">البريد الالكتروني</label>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <input id="motherName" onkeypress="return arabicOnly(event,this);" type="text" class="text-md-right form-control @error('motherName') is-invalid @enderror" name="motherName" value="{{ old('motherName') }}" required autocomplete="motherName" autofocus>

                                @error('mothername')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="motherName" class="col-md-4 col-form-label text-md-left">اسم الأم</label>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <div class="col-md-4 offset-md-4 d-inline">
                                    <label class="col-form-label text-md-left">انثي</label>
                                    <input type="radio" id="gender_female" class="gender @error('gender') is-invalid @enderror" name="gender" value="gender_female" @if(old('gender')) checked @endif required autocomplete="gender" autofocus>
                                </div>
                                <div class="col-md-4 d-inline">
                                    <label class="col-form-label text-md-left">ذكر</label>
                                    <input type="radio" checked id="gender_male" class="gender @error('gender') is-invalid @enderror" name="gender" value="gender_male" @if(old('gender')) checked @endif required autocomplete="gender" autofocus>
                                </div>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="gender" class="col-md-4 col-form-label text-md-left">النوع</label>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <input id="birthDate" type="date" onchange="preventPast()" class="date form-control @error('birthDate') is-invalid @enderror" name="birthDate" value="{{ old('birthDate') }}" required autocomplete="birthDate" autofocus>

                                @error('birthDate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="birthDate" class="col-md-4 col-form-label text-md-left">تاريخ الميلاد</label>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <select id="edcQual" class="form-control @error('edcQual') is-invalid @enderror" name="edcQual" value="{{ old('edcQual') }}" required autocomplete="edcQual" autofocus>
                                    <option value="اختار">اختار</option>
                                    <option value="عالي" {{ old('edcQual') =="عالي"? 'selected' : '' }}>عالي</option>
                                    <option value="فوق المتوسط" {{ old('edcQual') =="فوق المتوسط"? 'selected' : '' }}>فوق المتوسط</option>
                                    <option value="متوسط" {{ old('edcQual') =="متوسط"? 'selected' : '' }}>متوسط</option>
                                    <option value="ثانوي" {{ old('edcQual') =="ثانوي"? 'selected' : '' }}>ثانوي</option>
                                    <option value="اعدادي" {{ old('edcQual') =="اعدادي"? 'selected' : '' }}>اعدادي</option>
                                    <option value="ابتدائي" {{ old('edcQual') =="ابتدائي"? 'selected' : '' }}>ابتدائي</option>
                                    <option value="بدون مؤهل" {{ old('edcQual') =="بدون مؤهل"? 'selected' : '' }}>بدون مؤهل</option>
                                </select>
                                @error('edcQual')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="edcQual" class="col-md-4 col-form-label text-md-left">المؤهل الدراسي</label>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <input id="city" placeholder="مدينة/حي/قرية" type="text" class="text-md-right col-md-6 form-control d-inline @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city" autofocus>
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input id="governorate" placeholder="محافظة" type="text" class="text-md-right col-md-6 float-right form-control d-inline @error('governorate') is-invalid @enderror" name="governorate" value="{{ old('governorate') }}" required autocomplete="governorate" autofocus>
                                @error('governorate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input id="street" placeholder="شارع" type="text" class="text-md-right col-md-6 float-right form-control d-inline @error('street') is-invalid @enderror" name="street" value="{{ old('street') }}" required autocomplete="street" autofocus>
                                @error('street')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input id="building" placeholder="عقار" type="text" class="text-md-right col-md-6 form-control d-inline @error('building') is-invalid @enderror" name="building" value="{{ old('building') }}" required autocomplete="building" autofocus>
                                @error('building')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <label class="col-md-4 col-form-label text-md-left pt-4">العنوان</label>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <div class="col-md-3 offset-md-2 d-inline">
                                    <label class="col-form-label text-md-left">أعزب</label>
                                    <input type="radio" id="socialState_single" class="socialState @error('socialState') is-invalid @enderror" name="socialState" value="socialState_single" @if(old('socialState')) checked @endif required autocomplete="socialState" autofocus>
                                </div>
                                <div class="col-md-3 d-inline">
                                    <label class="col-form-label text-md-left">أرمل</label>
                                    <input type="radio" id="socialState_widow" class="socialState @error('socialState') is-invalid @enderror" name="socialState" value="socialState_widow" @if(old('socialState')) checked @endif required autocomplete="socialState" autofocus>
                                </div>
                                <div class="col-md-3 d-inline">
                                    <label class="col-form-label text-md-left">متزوج</label>
                                    <input type="radio" checked id="socialState_married" class="socialState @error('socialState') is-invalid @enderror" name="socialState" value="socialState_married" @if(old('socialState')) checked @endif required autocomplete="socialState" autofocus>
                                </div>
                                @error('socialState')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="socialState" class="col-md-4 col-form-label text-md-left">الحالة الاجتماعية</label>
                        </div>

                        <div class="form-group generateHusbandWifeData"></div>
                        <div class="socialStateDiv genderssn form-group row" >
                            <div class="col-md-6 offset-md-2">
                                <input id="wifessn" type="number" min="0" oninput="validity.valid||(value='');" class="form-control @error('wifessn') is-invalid @enderror" name="wifessn" value="{{ old('wifessn') }}" required autocomplete="wifessn" autofocus>

                                @error('wifessn')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="wifessn" class="col-md-4 col-form-label text-md-left"> الرقم القومي للزوجة</label>
                        </div>

                        <div class="socialStateDiv form-group row" >
                            <div class="col-md-6 offset-md-2">
                                <input id="marriageDate" type="date" class="date form-control @error('marriageDate') is-invalid @enderror" value="{{ old('marriageDate') }}" name="marriageDate" required autocomplete="marriageDate" autofocus>
                                @error('marriageDate')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="marriageDate" class="col-md-4 col-form-label text-md-left">تاريخ الزواج</label>
                        </div>
                        <div class="socialStateDiv form-group row" >
                            <div class="col-md-6 offset-md-2">
                                <input id="numberofChildren" type="number" value="0" max="15"  min="0" oninput="validity.valid||(value='');" class="form-control" name="numberofChildren" value="{{ old('numberofChildren') }}" required autocomplete="numberofChildren" autofocus>
                                @error('numberofChildren')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="numberofChildren" class="col-md-4 col-form-label text-md-left">عدد الابناء</label>
                        </div>

                        <div class="form-group generateChildrenssnDiv"></div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <select id="servingType" class="form-control @error('servingType') is-invalid @enderror" name="servingType" required autocomplete="servingType" autofocus>
                                    <option value="اختار" {{ old('servingType') =="اختار"? 'selected' : '' }}>اختار</option>
                                    <option value="شباب" {{ old('servingType') =="شباب"? 'selected' : '' }}>شباب</option>
                                    <option value="ثانوي" {{ old('servingType') =="ثانوي"? 'selected' : '' }}>ثانوي</option>
                                    <option value="اعدادي" {{ old('servingType') =="اعدادي"? 'selected' : '' }}>اعدادي</option>
                                    <option value="ابتدائي" {{ old('servingType') =="ابتدائي"? 'selected' : '' }}>ابتدائي</option>
                                    <option value="ايتام" {{ old('servingType') =="ايتام"? 'selected' : '' }}>ايتام</option>
                                    <option value="اخوة الرب" {{ old('servingType') =="اخوة الرب"? 'selected' : '' }}>اخوة الرب</option>
                                    <option value="مسنين" {{ old('servingType') =="مسنين"? 'selected' : '' }}>مسنين</option>
                                </select>
                                @error('servingType')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="servingType" class="col-md-4 col-form-label text-md-left">اذا كان خادم) نوع الخدمة)</label>
                        </div>

                        <div class="deaconLevelDiv form-group row">
                            <div class="col-md-6 offset-md-2">
                                <select id="deaconLevel" class="form-control @error('deaconLevel') is-invalid @enderror" name="deaconLevel" required autocomplete="deaconLevel" autofocus>
                                    <option value="اختار" {{ old('deaconLevel') =="اختار"? 'selected' : '' }}>اختار</option>
                                    <option value="ابصالتس" {{ old('deaconLevel') =="ابصالتس"? 'selected' : '' }}>ابصالتس</option>
                                    <option value="اناغنوستيس" {{ old('deaconLevel') =="اناغنوستيس"? 'selected' : '' }}>اناغنوستيس</option>
                                    <option value="ايبودياكون" {{ old('deaconLevel') =="ايبودياكون"? 'selected' : '' }}>ايبودياكون</option>
                                    <option value="دياكون" {{ old('deaconLevel') =="دياكون"? 'selected' : '' }}>دياكون</option>
                                    <option value="أرشيدياكون" {{ old('deaconLevel') =="أرشيدياكون"? 'selected' : '' }}>أرشيدياكون</option>
                                </select>
                                @error('deaconLevel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="deaconLevel" class="col-md-4 col-form-label text-md-left">اذا كان شماس) درجة الشموسية)</label>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <input id="church" onkeypress="return arabicOnly(event,this);" type="text" class="text-md-right form-control @error('church') is-invalid @enderror" name="church" value="{{ old('church') }}" required autocomplete="church" autofocus>

                                @error('church')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="church" class="col-md-4 col-form-label text-md-left">الكنيسة التابع لها</label>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <input id="confessFather" onkeypress="return arabicOnly(event,this);" type="text" class="text-md-right form-control @error('confessFather') is-invalid @enderror" name="confessFather" value="{{ old('confessFather') }}" required autocomplete="confessFather" autofocus>

                                @error('confessFather')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="confessFather" class="col-md-4 col-form-label text-md-left">اسم اب الاعتراف</label>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3 offset-md-2">
                                <input id="personalPic" type="file" accept="image/*" class="w-auto form-control @error('personalPic') is-invalid @enderror" name="personalPic" required autocomplete="personalPic" autofocus>

                                @error('personalPic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <label for="personalPic" class="col-md-4 offset-md-3 col-form-label text-md-left"> الصورة الشخصية</label>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-2">
                                <button type="submit" name="submit" class="w-100 btn btn-primary">
                                    تسجيل
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
