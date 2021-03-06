@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">تعديل بيانات</div>

                <div class="card-body">
                    <form action="{{route('person.update', $data[0]->ssn)}}" enctype="multipart/form-data" method="POST">
                        <input type="hidden" name="_method" value="put" />
                        <input type="hidden" name="originalssn" value="{{$data[0]->ssn}}" />
                        @csrf
                        @if($errors->any())
                            <ul dir="rtl" class="text-left alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        @if(session()->has('success'))
                            <ul dir="rtl" class="text-left alert alert-success">
                                <li>{{ session()->get('success') }}</li>
                            </ul>
                        @endif
                        @if(session()->has('failure'))
                            <ul dir="rtl" class="text-left alert alert-danger">
                                <li>{{ session()->get('failure') }}</li>
                            </ul>
                        @endif
                        @php
                            $childNumber = ["الاول", "الثاني", "الثالث", "الرابع", "الخامس", "السادس", "السابع", "الثامن", "التاسع", "العاشر", "الحادي عشر", "الثاني عشر", "الثالث عشر", "الرابع عشر", "الخامس عشر"];
                        @endphp
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">الاسم كامل</label>

                            <div class="col-md-6">
                                <input id="name" onkeypress="return arabicOnly(event,this);" type="text" class="text-md-right form-control @error('name') is-invalid @enderror" name="name" value="{{ $data[0]->fullName }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ssn" class="col-md-4 col-form-label text-md-right">الرقم القومي</label>

                            <div class="col-md-6">
                                <input id="ssn" type="number" min="0" oninput="validity.valid||(value='');" class="form-control @error('ssn') is-invalid @enderror" name="ssn" value="{{ $data[0]->ssn }}" required autocomplete="ssn" autofocus>

                                @error('ssn')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ssn" class="col-md-4 col-form-label text-md-right">رقم المحمول</label>

                            <div class="col-md-6">
                                <input id="mobile" type="number" min="0" oninput="validity.valid||(value='');" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ $data[0]->mobile }}" required autocomplete="mobile" autofocus>

                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">البريد الالكتروني</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $data[0]->email }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="motherName" class="col-md-4 col-form-label text-md-right">اسم الأم</label>

                            <div class="col-md-6">
                                <input id="motherName" onkeypress="return arabicOnly(event,this);" type="text" class="text-md-right form-control @error('motherName') is-invalid @enderror" name="motherName" value="{{ $data[0]->motherName }}" required autocomplete="motherName" autofocus>

                                @error('mothername')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">النوع</label>

                            <div class="col-md-6">
                                @if($data[0]->gender == "male")
                                    <div class="col-md-4 d-inline">
                                        <input type="radio" checked id="male" class="gender @error('gender') is-invalid @enderror" name="gender" value="male" @if(old('gender')) @endif required autocomplete="gender" autofocus>
                                        <label class="col-form-label text-md-left">ذكر</label>
                                    </div>
                                    <div class="col-md-4 d-inline">
                                        <input type="radio" id="female" class="gender @error('gender') is-invalid @enderror" name="gender" value="female" @if(old('gender')) @endif required autocomplete="gender" autofocus>
                                        <label class="col-form-label text-md-left">انثي</label>
                                    </div>
                                @else
                                    <div class="col-md-4 d-inline">
                                        <input type="radio" id="male" class="gender @error('gender') is-invalid @enderror" name="gender" value="male" @if(old('gender')) @endif required autocomplete="gender" autofocus>
                                        <label class="col-form-label text-md-left">ذكر</label>
                                    </div>
                                    <div class="col-md-4 d-inline">
                                        <input type="radio" checked id="female" class="gender @error('gender') is-invalid @enderror" name="gender" value="female" @if(old('gender')) @endif required autocomplete="gender" autofocus>
                                        <label class="col-form-label text-md-left">انثي</label>
                                    </div>
                                @endif
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="birthDate" class="col-md-4 col-form-label text-md-right">تاريخ الميلاد</label>

                            <div class="col-md-6">
                                <input id="birthDate" type="date" onchange="preventPast()" class="date form-control @error('birthDate') is-invalid @enderror" name="birthDate" value="{{ $data[0]->birthDate }}" required autocomplete="birthDate" autofocus>

                                @error('birthDate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="edcQual" class="col-md-4 col-form-label text-md-right">المؤهل الدراسي</label>

                            <div class="col-md-6">
                                <select id="edcQual" class="form-control @error('edcQual') is-invalid @enderror" name="edcQual" required autocomplete="edcQual" autofocus>
                                    <option value="اختار">اختار</option>
                                    <option value="عالي" {{ $data[0]->eduQual =="عالي"? 'selected' : '' }}>عالي</option>
                                    <option value="فوق المتوسط" {{ $data[0]->eduQual =="فوق المتوسط"? 'selected' : '' }}>فوق المتوسط</option>
                                    <option value="متوسط" {{ $data[0]->eduQual =="متوسط"? 'selected' : '' }}>متوسط</option>
                                    <option value="ثانوي" {{ $data[0]->eduQual =="ثانوي"? 'selected' : '' }}>ثانوي</option>
                                    <option value="اعدادي" {{ $data[0]->eduQual =="اعدادي"? 'selected' : '' }}>اعدادي</option>
                                    <option value="ابتدائي" {{ $data[0]->eduQual =="ابتدائي"? 'selected' : '' }}>ابتدائي</option>
                                    <option value="بدون مؤهل" {{ $data[0]->eduQual =="بدون مؤهل"? 'selected' : '' }}>بدون مؤهل</option>
                                </select>
                                @error('edcQual')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right pt-4">العنوان</label>

                            <div class="col-md-6">
                                <input id="city" placeholder="مدينة/حي/قرية" type="text" class="text-md-right col-md-6 form-control d-inline @error('city') is-invalid @enderror" name="city" value="{{ $data[0]->city }}" required autocomplete="city" autofocus>
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input id="governorate" placeholder="محافظة" type="text" class="text-md-right col-md-6 float-right form-control d-inline @error('governorate') is-invalid @enderror" name="governorate" value="{{ $data[0]->governorate }}" required autocomplete="governorate" autofocus>
                                @error('governorate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input id="street" placeholder="شارع" type="text" class="text-md-right col-md-6 float-right form-control d-inline @error('street') is-invalid @enderror" name="street" value="{{ $data[0]->street }}" required autocomplete="street" autofocus>
                                @error('street')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input id="building" placeholder="عقار" type="text" class="text-md-right col-md-6 form-control d-inline @error('building') is-invalid @enderror" name="building" value="{{ $data[0]->building }}" required autocomplete="building" autofocus>
                                @error('building')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="socialState" class="col-md-4 col-form-label text-md-right">الحالة الاجتماعية</label>

                            <div class="col-md-6">
                                @if($data[0]->socialState == "single")
                                    <div class="col-md-3 d-inline">
                                        <label class="col-form-label text-md-left">متزوج</label>
                                        <input type="radio" id="socialState_married" class="socialState @error('socialState') is-invalid @enderror" name="socialState" value="socialState_married" @if(old('socialState')) checked @endif required autocomplete="socialState" autofocus>
                                    </div>
                                    <div class="col-md-3 d-inline">
                                        <label class="col-form-label text-md-left">أرمل</label>
                                        <input type="radio" id="socialState_widow" class="socialState @error('socialState') is-invalid @enderror" name="socialState" value="socialState_widow" @if(old('socialState')) checked @endif required autocomplete="socialState" autofocus>
                                    </div>
                                    <div class="col-md-3 d-inline">
                                        <label class="col-form-label text-md-left">أعزب</label>
                                        <input type="radio" checked id="socialState_single" class="socialState @error('socialState') is-invalid @enderror" name="socialState" value="socialState_single" @if(old('socialState')) checked @endif required autocomplete="socialState" autofocus>
                                    </div>
                                @elseif($data[0]->socialState == "married")
                                    <div class="col-md-3 d-inline">
                                        <label class="col-form-label text-md-left">متزوج</label>
                                        <input type="radio" checked id="socialState_married" class="socialState @error('socialState') is-invalid @enderror" name="socialState" value="socialState_married" @if(old('socialState')) checked @endif required autocomplete="socialState" autofocus>
                                    </div>
                                    <div class="col-md-3 d-inline">
                                        <label class="col-form-label text-md-left">أرمل</label>
                                        <input type="radio" id="socialState_widow" class="socialState @error('socialState') is-invalid @enderror" name="socialState" value="socialState_widow" @if(old('socialState')) checked @endif required autocomplete="socialState" autofocus>
                                    </div>
                                    <div class="col-md-3 d-inline">
                                        <label class="col-form-label text-md-left">أعزب</label>
                                        <input type="radio" id="socialState_single" class="socialState @error('socialState') is-invalid @enderror" name="socialState" value="socialState_single" @if(old('socialState')) checked @endif required autocomplete="socialState" autofocus>
                                    </div>
                                @else
                                    <div class="col-md-3 offset-md-2 d-inline">
                                        <label class="col-form-label text-md-left">أعزب</label>
                                        <input type="radio" id="socialState_single" class="socialState @error('socialState') is-invalid @enderror" name="socialState" value="socialState_single" @if(old('socialState')) checked @endif required autocomplete="socialState" autofocus>
                                    </div>
                                    <div class="col-md-3 d-inline">
                                        <label class="col-form-label text-md-left">أرمل</label>
                                        <input type="radio" checked id="socialState_widow" class="socialState @error('socialState') is-invalid @enderror" name="socialState" value="socialState_widow" @if(old('socialState')) checked @endif required autocomplete="socialState" autofocus>
                                    </div>
                                    <div class="col-md-3 d-inline">
                                        <label class="col-form-label text-md-left">متزوج</label>
                                        <input type="radio" id="socialState_married" class="socialState @error('socialState') is-invalid @enderror" name="socialState" value="socialState_married" @if(old('socialState')) checked @endif required autocomplete="socialState" autofocus>
                                    </div>
                                @endif
                                @error('socialState')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group generateHusbandWifeData"></div>
                        @if($data[0]->socialState != "single")
                            @if($data[0]->gender == "male")
                                <div class="socialStateDiv genderssn form-group row" >
                                    <label for="wifessn" class="col-md-4 col-form-label text-md-right"> الرقم القومي للزوجة</label>

                                    <div class="col-md-6">
                                        <input id="wifessn" type="number" min="0" oninput="validity.valid||(value='');" class="form-control @error('wifessn') is-invalid @enderror" name="wifessn" value="{{ $data[1]->memberssn }}" required autocomplete="wifessn" autofocus>

                                        @error('wifessn')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            @else
                                <div class="socialStateDiv genderssn form-group row" >
                                    <label for="hsubandssn" class="col-md-4 col-form-label text-md-right"> الرقم القومي للزوج</label>

                                    <div class="col-md-6">
                                        <input id="husbandssn" type="number" min="0" oninput="validity.valid||(value='');" class="form-control @error('husbandssn') is-invalid @enderror" name="husbandssn" value="{{ $data[1]->husbandssn }}" required autocomplete="husbandssn" autofocus>

                                        @error('husbandssn')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            <div class="socialStateDiv form-group row" >
                                <label for="marriageDate" class="col-md-4 col-form-label text-md-right">تاريخ الزواج</label>

                                <div class="col-md-6">
                                    <input id="marriageDate" type="date" class="date form-control @error('marriageDate') is-invalid @enderror" value="{{ $data[0]->marriageDate }}" name="marriageDate" required autocomplete="marriageDate" autofocus>
                                    @error('marriageDate')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="socialStateDiv form-group row" >
                                <label for="numberofChildren" class="col-md-4 col-form-label text-md-right">عدد الابناء</label>

                                <div class="col-md-6">
                                    <input id="numberofChildren" type="number" value="{{ $data[0]->numOfChildren }}" max="15"  min="0" oninput="validity.valid||(value='');" class="form-control" name="numberofChildren" value="{{ old('numberofChildren') }}" required autocomplete="numberofChildren" autofocus>
                                    @error('numberofChildren')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            @if($data[0]->gender == "male")
                                @for ($i = 1; $i <= $data[0]->numOfChildren; $i++)
                                    <div class="generatessn socialStateDiv form-group row">
                                        <label for="{{"childssn".($i)}}" class="col-md-4 col-form-label text-md-right"> الرقم القومي للابن/الابنة {{$childNumber[$i-1]}}</label>

                                        <div class="col-md-6">
                                            <input id="{{"childssn".($i)}}" type="number" min="0" oninput="validity.valid||(value='');" class="form-control" name="{{"childssn".($i)}}" value="{{ $data[2][$i-1]->memberssn }}" required autocomplete="{{"childssn".($i)}}" autofocus>
                                        </div>
                                    </div>
                                @endfor
                            @endif
                        @endif
                        <div class="form-group generateChildrenssnDiv"></div>

                        <div class="form-group row">
                            <label for="servingType" class="col-md-4 col-form-label text-md-right">اذا كان خادم) نوع الخدمة)</label>

                            <div class="col-md-6">
                                <select id="servingType" class="form-control @error('servingType') is-invalid @enderror" name="servingType" required autocomplete="servingType" autofocus>
                                    <option value="اختار" {{ $data[0]->servingType =="اختار"? 'selected' : '' }}>اختار</option>
                                    <option value="شباب" {{ $data[0]->servingType =="شباب"? 'selected' : '' }}>شباب</option>
                                    <option value="ثانوي" {{ $data[0]->servingType =="ثانوي"? 'selected' : '' }}>ثانوي</option>
                                    <option value="اعدادي" {{ $data[0]->servingType =="اعدادي"? 'selected' : '' }}>اعدادي</option>
                                    <option value="ابتدائي" {{ $data[0]->servingType =="ابتدائي"? 'selected' : '' }}>ابتدائي</option>
                                    <option value="ايتام" {{ $data[0]->servingType =="ايتام"? 'selected' : '' }}>ايتام</option>
                                    <option value="اخوة الرب" {{ $data[0]->servingType =="اخوة الرب"? 'selected' : '' }}>اخوة الرب</option>
                                    <option value="مسنين" {{ $data[0]->servingType =="مسنين"? 'selected' : '' }}>مسنين</option>
                                </select>
                                @error('servingType')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @if($data[0]->gender == "male")
                            <div class="deaconLevelDiv form-group row">
                        @else
                            <div class="deaconLevelDiv form-group row" hidden>
                        @endif
                                <label for="deaconLevel" class="col-md-4 col-form-label text-md-right">اذا كان شماس) درجة الشموسية)</label>

                                <div class="col-md-6">
                                    <select id="deaconLevel" class="form-control @error('deaconLevel') is-invalid @enderror" name="deaconLevel" required autocomplete="deaconLevel" autofocus>
                                        <option value="اختار" {{ $data[0]->deaconLevel =="اختار"? 'selected' : '' }}>اختار</option>
                                        <option value="ابصالتس" {{ $data[0]->deaconLevel =="ابصالتس"? 'selected' : '' }}>ابصالتس</option>
                                        <option value="اناغنوستيس" {{ $data[0]->deaconLevel =="اناغنوستيس"? 'selected' : '' }}>اناغنوستيس</option>
                                        <option value="ايبودياكون" {{ $data[0]->deaconLevel =="ايبودياكون"? 'selected' : '' }}>ايبودياكون</option>
                                        <option value="دياكون" {{ $data[0]->deaconLevel =="دياكون"? 'selected' : '' }}>دياكون</option>
                                        <option value="أرشيدياكون" {{ $data[0]->deaconLevel =="أرشيدياكون"? 'selected' : '' }}>أرشيدياكون</option>
                                    </select>
                                    @error('deaconLevel')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                            <label for="church" class="col-md-4 col-form-label text-md-right">الكنيسة التابع لها</label>

                            <div class="col-md-6">
                                <input id="church" onkeypress="return arabicOnly(event,this);" type="text" class="text-md-right form-control @error('church') is-invalid @enderror" name="church" value="{{ $data[0]->church }}" required autocomplete="church" autofocus>

                                @error('church')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="confessFather" class="col-md-4 col-form-label text-md-right">اسم اب الاعتراف</label>

                            <div class="col-md-6">
                                <input id="confessFather" onkeypress="return arabicOnly(event,this);" type="text" class="text-md-right form-control @error('confessFather') is-invalid @enderror" name="confessFather" value="{{ $data[0]->confessFather }}" required autocomplete="confessFather" autofocus>

                                @error('confessFather')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="personalPic" class="col-md-4 col-form-label text-md-right"> الصورة الشخصية</label>

                            <div class="col-md-6">
                                <img src="{{URL::to($data[0]->img_url)}}" alt="profile image" id="previewPersonalPic" class="m-auto w-100 mb-2">
                                <input id="personalPic" type="file" accept="image/*" onchange="changeImg(this)" class="w-100 form-control @error('personalPic') is-invalid @enderror" name="personalPic" autocomplete="personalPic" autofocus>

                                @error('personalPic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" name="submit" class="w-100 btn btn-primary">
                                    تعديل
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
