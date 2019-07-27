@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-md-right">بحث</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row text">
                            <div class="col-md-6 offset-md-2">
                                <div class="col-md-4 offset-md-4 d-inline">
                                    <label class="col-form-label text-md-left">انثي</label>
                                    <input type="checkbox" id="gender_femaleSearch" class="genderSearch @error('genderSearch') is-invalid @enderror" name="genderSearch" value="gender_femaleSearch" required autocomplete="genderSearch" autofocus>
                                </div>
                                <div class="col-md-4 d-inline">
                                    <label class="col-form-label text-md-left">ذكر</label>
                                    <input type="checkbox" checked id="gender_maleSearch" class="genderSearch @error('genderSearch') is-invalid @enderror" name="genderSearch" value="gender_maleSearch" required autocomplete="genderSearch" autofocus>                                    
                                </div>
                                @error('genderSearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="genderSearch" class="col-md-4 col-form-label text-md-left">النوع</label>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <div class="col-md-3 offset-md-2  d-inline">
                                    <label class="col-form-label text-md-left">أرمل</label>
                                    <input type="checkbox" id="socialStateSearch_widow" class="socialStateSearch @error('socialStateSearch') is-invalid @enderror" name="socialStateSearch" value="socialStateSearch_widow" required autocomplete="socialStateSearch" autofocus>
                                </div>
                                <div class="col-md-3 d-inline">
                                    <label class="col-form-label text-md-left">متزوج</label>
                                    <input type="checkbox" id="socialStateSearch_married" class="socialStateSearch @error('socialStateSearch') is-invalid @enderror" name="socialStateSearch" value="socialStateSearch_married" required autocomplete="socialStateSearch" autofocus>
                                </div>
                                <div class="col-md-3 d-inline">
                                    <label class="col-form-label text-md-left">أعزب</label>
                                    <input type="checkbox" checked id="socialStateSearch_single" class="socialStateSearch @error('socialStateSearch') is-invalid @enderror" name="socialStateSearch" value="socialStateSearch_single" required autocomplete="socialStateSearch" autofocus>                                    
                                </div>
                                @error('socialStateSearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="socialStateSearch" class="col-md-4 col-form-label text-md-left">الحالة الاجتماعية</label>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <div class="col-md-4 offset-md-4 d-inline">
                                    <label class="col-form-label text-md-left">نعم</label>
                                    <input type="radio" id="nameSearchYes" class="nameSearchOption @error('nameSearchOption') is-invalid @enderror" name="nameSearchOption" value="nameSearchYes" required autocomplete="nameSearchOption" autofocus>
                                </div>
                                <div class="col-md-4 d-inline">
                                    <label class="col-form-label text-md-left">لا</label>
                                    <input type="radio" checked id="nameSearchNo" class="nameSearchOption @error('nameSearchOption') is-invalid @enderror" name="nameSearchOption" value="nameSearchNo" required autocomplete="nameSearchOption" autofocus>                                    
                                </div>
                                @error('nameSearchOption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="nameSearchOption" class="col-md-4 col-form-label text-md-left">البحث بالاسم</label>
                        </div>

                        <div class="searchNameDiv form-group row jumbotron" hidden="true">
                            <div class="col-md-6 offset-md-2">
                                <input id="nameSearch" onkeypress="return arabicOnly(event,this);" type="text" class="text-md-right form-control @error('nameSearch') is-invalid @enderror" name="nameSearch" value="{{ old('nameSearch') }}" required autocomplete="nameSearch" autofocus>

                                @error('nameSearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="nameSearch" class="col-md-4 col-form-label text-md-left">الاسم كامل</label>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <div class="col-md-4 offset-md-4 d-inline">
                                    <label class="col-form-label text-md-left">نعم</label>
                                    <input type="radio" id="ssnSearchYes" class="ssnSearchOption @error('ssnSearchOption') is-invalid @enderror" name="ssnSearchOption" value="ssnSearchYes" required autocomplete="ssnSearchOption" autofocus>
                                </div>
                                <div class="col-md-4 d-inline">
                                    <label class="col-form-label text-md-left">لا</label>
                                    <input type="radio" checked id="ssnSearchNo" class="ssnSearchOption @error('ssnSearchOption') is-invalid @enderror" name="ssnSearchOption" value="ssnSearchNo" required autocomplete="ssnSearchOption" autofocus>                                    
                                </div>
                                @error('ssnSearchOption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="ssnSearchOption" class="col-md-4 col-form-label text-md-left">البحث بالرقم القومي</label>
                        </div>

                        <div class="searchssnDiv form-group row jumbotron" hidden>
                            <div class="col-md-6 offset-md-2">
                                <input id="ssnSearch" type="number" min="0" oninput="validity.valid||(value='');" class="form-control @error('ssnSearch') is-invalid @enderror" name="ssnSearch" value="{{ old('ssnSearch') }}" required autocomplete="ssnSearch" autofocus>

                                @error('ssnSearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="ssnSearch" class="col-md-4 col-form-label text-md-left">الرقم القومي</label>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <div class="col-md-4 offset-md-4 d-inline">
                                    <label class="col-form-label text-md-left">نعم</label>
                                    <input type="radio" id="mobileSearchYes" class="mobileSearchOption @error('mobileSearchOption') is-invalid @enderror" name="mobileSearchOption" value="mobileSearchYes" required autocomplete="mobileSearchOption" autofocus>
                                </div>
                                <div class="col-md-4 d-inline">
                                    <label class="col-form-label text-md-left">لا</label>
                                    <input type="radio" checked id="mobileSearchNo" class="mobileSearchOption @error('mobileSearchOption') is-invalid @enderror" name="mobileSearchOption" value="mobileSearchNo" required autocomplete="mobileSearchOption" autofocus>                                    
                                </div>
                                @error('mobileSearchOption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="mobileSearchOption" class="col-md-4 col-form-label text-md-left">البحث برقم المحمول</label>
                        </div>

                        <div class="searchMobileDiv form-group row jumbotron" hidden>
                            <div class="col-md-6 offset-md-2">
                                <input id="mobileSearch" type="number" min="0" oninput="validity.valid||(value='');" class="form-control @error('mobileSearch') is-invalid @enderror" name="mobileSearch" value="{{ old('mobileSearch') }}" required autocomplete="mobileSearch" autofocus>

                                @error('mobileSearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="mobileSearch" class="col-md-4 col-form-label text-md-left">رقم المحمول</label>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <div class="col-md-4 offset-md-4 d-inline">
                                    <label class="col-form-label text-md-left">نعم</label>
                                    <input type="radio" id="emailSearchYes" class="emailSearchOption @error('emailSearchOption') is-invalid @enderror" name="emailSearchOption" value="emailSearchYes" required autocomplete="emailSearchOption" autofocus>
                                </div>
                                <div class="col-md-4 d-inline">
                                    <label class="col-form-label text-md-left">لا</label>
                                    <input type="radio" checked id="emailSearchNo" class="emailSearchOption @error('emailSearchOption') is-invalid @enderror" name="emailSearchOption" value="emailSearchNo" required autocomplete="emailSearchOption" autofocus>                                    
                                </div>
                                @error('emailSearchOption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="emailSearchOption" class="col-md-4 col-form-label text-md-left">البحث بالبريد الالكتروني</label>
                        </div>

                        <div class="searchEmailDiv form-group row jumbotron" hidden>
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
                                <div class="col-md-4 offset-md-4 d-inline">
                                    <label class="col-form-label text-md-left">نعم</label>
                                    <input type="radio" id="motherSearchYes" class="motherSearchOption @error('motherSearchOption') is-invalid @enderror" name="motherSearchOption" value="motherSearchYes" required autocomplete="motherSearchOption" autofocus>
                                </div>
                                <div class="col-md-4 d-inline">
                                    <label class="col-form-label text-md-left">لا</label>
                                    <input type="radio" checked id="motherSearchNo" class="motherSearchOption @error('motherSearchOption') is-invalid @enderror" name="motherSearchOption" value="motherSearchNo" required autocomplete="motherSearchOption" autofocus>                                    
                                </div>
                                @error('motherSearchOption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="motherSearchOption" class="col-md-4 col-form-label text-md-left">البحث باسم الام</label>
                        </div>

                        <div class="searchMotherDiv form-group row jumbotron" hidden>
                            <div class="col-md-6 offset-md-2">
                                <input id="motherSearch" onkeypress="return arabicOnly(event,this);" type="text" class="text-md-right form-control @error('motherSearch') is-invalid @enderror" name="motherSearch" value="{{ old('motherSearch') }}" required autocomplete="motherSearch" autofocus>

                                @error('motherSearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="motherSearch" class="col-md-4 col-form-label text-md-left">اسم الأم</label>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <div class="col-md-4 offset-md-4 d-inline">
                                    <label class="col-form-label text-md-left">نعم</label>
                                    <input type="radio" id="birthDateSearchYes" class="birthDateSearchOption @error('birthDateSearchOption') is-invalid @enderror" name="birthDateSearchOption" value="birthDateSearchYes" required autocomplete="birthDateSearchOption" autofocus>
                                </div>
                                <div class="col-md-4 d-inline">
                                    <label class="col-form-label text-md-left">لا</label>
                                    <input type="radio" checked id="birthDateSearchNo" class="birthDateSearchOption @error('birthDateSearchOption') is-invalid @enderror" name="birthDateSearchOption" value="birthDateSearchNo" required autocomplete="birthDateSearchOption" autofocus>                                    
                                </div>
                                @error('birthDateSearchOption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="birthDateSearchOption" class="col-md-4 col-form-label text-md-left">البحث بتاريخ الميلاد</label>
                        </div>

                        <div class="searchBirthDateDiv form-group row jumbotron" hidden>
                            <div class="col-md-6 offset-md-2">
                                <input id="birthDateSearch" type="date" class="date form-control @error('birthDateSearch') is-invalid @enderror" name="birthDateSearch" value="{{ old('birthDateSearch') }}" required autocomplete="birthDateSearch" autofocus>

                                @error('birthDateSearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="birthDateSearch" class="col-md-4 col-form-label text-md-left">تاريخ الميلاد</label>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <div class="col-md-4 offset-md-4 d-inline">
                                    <label class="col-form-label text-md-left">نعم</label>
                                    <input type="radio" id="edcQualSearchYes" class="edcQualSearchOption @error('edcQualSearchOption') is-invalid @enderror" name="edcQualSearchOption" value="edcQualSearchYes" required autocomplete="edcQualSearchOption" autofocus>
                                </div>
                                <div class="col-md-4 d-inline">
                                    <label class="col-form-label text-md-left">لا</label>
                                    <input type="radio" checked id="edcQualSearchNo" class="edcQualSearchOption @error('edcQualSearchOption') is-invalid @enderror" name="edcQualSearchOption" value="edcQualSearchNo" required autocomplete="edcQualSearchOption" autofocus>                                    
                                </div>
                                @error('edcQualSearchOption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="edcQualSearchOption" class="col-md-4 col-form-label text-md-left">البحث بالمؤهل الدراسي</label>
                        </div>

                        <div class="searchEdcQualDiv form-group row text-md-right jumbotron" hidden>
                            <div class="col-md-6 offset-md-2">
                                <div class="row">
                                    <div class="col-md-4 d-inline">
                                        <label class="col-form-label text-md-left">متوسط</label>
                                        <input type="checkbox" id="edcQualSearch_average" class="@error('edcQualSearch') is-invalid @enderror" name="edcQualSearch" value="edcQualSearch_average" required autocomplete="edcQualSearch" autofocus>
                                    </div>
                                    <div class="col-md-4 d-inline">
                                        <label class="col-form-label text-md-left">فوق المتوسط</label>
                                        <input type="checkbox" id="edcQualSearch_aboveAverage" class="@error('edcQualSearch') is-invalid @enderror" name="edcQualSearch" value="edcQualSearch_aboveAverage" required autocomplete="edcQualSearch" autofocus>
                                    </div>
                                    <div class="col-md-4 d-inline">
                                        <label class="col-form-label text-md-left">عالي</label>
                                        <input type="checkbox" id="edcQualSearch_high" class="@error('edcQualSearch') is-invalid @enderror" name="edcQualSearch" value="edcQualSearch_high" required autocomplete="edcQualSearch" autofocus>                                    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 d-inline">
                                        <label class="col-form-label text-md-left">ابتدائي</label>
                                        <input type="checkbox" id="edcQualSearch_primary" class="@error('edcQualSearch') is-invalid @enderror" name="edcQualSearch" value="edcQualSearch_primary" required autocomplete="edcQualSearch" autofocus>
                                    </div>
                                    <div class="col-md-4 d-inline">
                                        <label class="col-form-label text-md-left">اعدادي</label>
                                        <input type="checkbox" id="edcQualSearch_preparatory" class="@error('edcQualSearch') is-invalid @enderror" name="edcQualSearch" value="edcQualSearch_preparatory" required autocomplete="edcQualSearch" autofocus>
                                    </div>
                                    <div class="col-md-4 d-inline">
                                        <label class="col-form-label text-md-left">ثانوي</label>
                                        <input type="checkbox" id="edcQualSearch_secondary" class="@error('edcQualSearch') is-invalid @enderror" name="edcQualSearch" value="edcQualSearch_secondary" required autocomplete="edcQualSearch" autofocus>                                    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 offset-md-8 d-inline">
                                    <label class="col-form-label text-md-left">بدون مؤهل</label>
                                    <input type="checkbox" id="edcQualSearch_non" class="@error('edcQualSearch') is-invalid @enderror" name="edcQualSearch" value="edcQualSearch_non" required autocomplete="edcQualSearch" autofocus>                                    
                                    </div>
                                </div>
                                @error('edcQualSearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="edcQualSearch" class="col-md-4 col-form-label text-md-left">المؤهل الدراسي</label>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <div class="col-md-4 offset-md-4 d-inline">
                                    <label class="col-form-label text-md-left">نعم</label>
                                    <input type="radio" id="addressSearchYes" class="addressSearchOption @error('addressSearchOption') is-invalid @enderror" name="addressSearchOption" value="addressSearchYes" required autocomplete="addressSearchOption" autofocus>
                                </div>
                                <div class="col-md-4 d-inline">
                                    <label class="col-form-label text-md-left">لا</label>
                                    <input type="radio" checked id="addressSearchNo" class="addressSearchOption @error('addressSearchOption') is-invalid @enderror" name="addressSearchOption" value="addressSearchNo" required autocomplete="addressSearchOption" autofocus>                                    
                                </div>
                                @error('addressSearchOption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="addressSearchOption" class="col-md-4 col-form-label text-md-left">البحث بالعنوان</label>
                        </div>

                        <div class="form-group row searchAddressDiv jumbotron" hidden>
                            <div class="col-md-6 offset-md-2">
                                <input id="citySearch" placeholder="مدينة/حي/قرية" type="text" class="text-md-right col-md-6 form-control d-inline @error('citySearch') is-invalid @enderror" name="citySearch" value="{{ old('citySearch') }}" required autocomplete="citySearch" autofocus>
                                @error('citySearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input id="governorateSearch" placeholder="محافظة" type="text" class="text-md-right col-md-6 float-right form-control d-inline @error('governorateSearch') is-invalid @enderror" name="governorateSearch" value="{{ old('governorateSearch') }}" required autocomplete="governorateSearch" autofocus>
                                @error('governorateSearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input id="streetSearch" placeholder="شارع" type="text" class="text-md-right col-md-6 float-right form-control d-inline @error('streetSearch') is-invalid @enderror" name="streetSearch" value="{{ old('streetSearch') }}" required autocomplete="streetSearch" autofocus>
                                @error('streetSearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input id="buildingSearch" placeholder="عقار" type="text" class="text-md-right col-md-6 form-control d-inline @error('buildingSearch') is-invalid @enderror" name="buildingSearch" value="{{ old('buildingSearch') }}" required autocomplete="buildingSearch" autofocus>
                                @error('buildingSearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <label class="col-md-4 col-form-label text-md-left pt-4">العنوان</label>
                        </div>

                        <div class="form-group row socialStateCheck" hidden>
                            <div class="col-md-6 offset-md-2">
                                <div class="col-md-4 offset-md-4 d-inline">
                                    <label class="col-form-label text-md-left">نعم</label>
                                    <input type="radio" id="husband_wifeNameSearchYes" class="husband_wifeNameSearchOption @error('husband_wifeNameSearchOption') is-invalid @enderror" name="husband_wifeNameSearchOption" value="husband_wifeNameSearchYes" required autocomplete="husband_wifeNameSearchOption" autofocus>
                                </div>
                                <div class="col-md-4 d-inline">
                                    <label class="col-form-label text-md-left">لا</label>
                                    <input type="radio" checked id="husband_wifeNameSearchNo" class="husband_wifeNameSearchOption @error('husband_wifeNameSearchOption') is-invalid @enderror" name="husband_wifeNameSearchOption" value="husband_wifeNameSearchNo" required autocomplete="husband_wifeNameSearchOption" autofocus>                                    
                                </div>
                                @error('husband_wifeNameSearchOption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="husband_wifeNameSearchOption" class="col-md-4 col-form-label text-md-left">البحث باسم الزوج/الزوجة</label>
                        </div>

                        <div class="searchHusband_wifeDiv form-group row jumbotron" hidden>
                            <div class="col-md-6 offset-md-2">
                                <input id="husband_wifeName" onkeypress="return arabicOnly(event,this);" type="text" class="text-md-right form-control @error('husband_wifeName') is-invalid @enderror" name="husband_wifeName" value="{{ old('husband_wifeName') }}" required autocomplete="husband_wifeName" autofocus>

                                @error('husband_wifeName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="husband_wifeName" class="col-md-4 col-form-label text-md-left"> اسم الزوج/الزوجة</label>
                        </div>

                        <div class="form-group row socialStateCheck" hidden>
                            <div class="col-md-6 offset-md-2">
                                <div class="col-md-4 offset-md-4 d-inline">
                                    <label class="col-form-label text-md-left">نعم</label>
                                    <input type="radio" id="marriageDateSearchYes" class="marriageDateSearchOption @error('marriageDateSearchOption') is-invalid @enderror" name="marriageDateSearchOption" value="marriageDateSearchYes" required autocomplete="marriageDateSearchOption" autofocus>
                                </div>
                                <div class="col-md-4 d-inline">
                                    <label class="col-form-label text-md-left">لا</label>
                                    <input type="radio" checked id="marriageDateSearchNo" class="marriageDateSearchOption @error('marriageDateSearchOption') is-invalid @enderror" name="marriageDateSearchOption" value="marriageDateSearchNo" required autocomplete="marriageDateSearchOption" autofocus>                                    
                                </div>
                                @error('marriageDateSearchOption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="marriageDateSearchOption" class="col-md-4 col-form-label text-md-left">البحث بتاريخ الزواج</label>
                        </div>

                        <div class="form-group row jumbotron searchMarriageDateDiv" hidden>
                            <div class="col-md-6 offset-md-2">
                                <input id="marriageDateSearch" type="date" class="date form-control @error('marriageDateSearch') is-invalid @enderror" name="marriageDateSearch" value="{{ old('marriageDateSearch') }}" required autocomplete="marriageDateSearch" autofocus>

                                @error('marriageDateSearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="marriageDateSearch" class="col-md-4 col-form-label text-md-left">تاريخ الزواج</label>
                        </div>

                        <div class="form-group row socialStateCheck" hidden>
                            <div class="col-md-6 offset-md-2">
                                <div class="col-md-4 offset-md-4 d-inline">
                                    <label class="col-form-label text-md-left">نعم</label>
                                    <input type="radio" id="numberofChildrenSearchYes" class="numberofChildrenSearchOption @error('numberofChildrenSearchOption') is-invalid @enderror" name="numberofChildrenSearchOption" value="numberofChildrenSearchYes" required autocomplete="numberofChildrenSearchOption" autofocus>
                                </div>
                                <div class="col-md-4 d-inline">
                                    <label class="col-form-label text-md-left">لا</label>
                                    <input type="radio" checked id="numberofChildrenSearchNo" class="numberofChildrenSearchOption @error('numberofChildrenSearchOption') is-invalid @enderror" name="numberofChildrenSearchOption" value="numberofChildrenSearchNo" required autocomplete="numberofChildrenSearchOption" autofocus>                                    
                                </div>
                                @error('numberofChildrenSearchOption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="numberofChildrenSearchOption" class="col-md-4 col-form-label text-md-left">البحث بعدد الابناء</label>
                        </div>

                        <div class="form-group row jumbotron searchNumberofChildrenDiv" hidden>
                            <div class="col-md-6 offset-md-2">
                                <input id="numberofChildrenSearch" type="number" value="0" max="15"  min="0" oninput="validity.valid||(value='');" class="form-control @error('numberofChildrenSearch') is-invalid @enderror" name="numberofChildrenSearch" value="{{ old('numberofChildrenSearch') }}" required autocomplete="numberofChildrenSearch" autofocus>

                                @error('numberofChildrenSearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="numberofChildrenSearch" class="col-md-4 col-form-label text-md-left">عدد الابناء</label>
                        </div>
                        
                        <div class="generatessnDiv"></div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <div class="col-md-4 offset-md-4 d-inline">
                                    <label class="col-form-label text-md-left">نعم</label>
                                    <input type="radio" id="servingTypeSearchYes" class="servingTypeSearchOption @error('servingTypeSearchOption') is-invalid @enderror" name="servingTypeSearchOption" value="servingTypeSearchYes" required autocomplete="servingTypeSearchOption" autofocus>
                                </div>
                                <div class="col-md-4 d-inline">
                                    <label class="col-form-label text-md-left">لا</label>
                                    <input type="radio" checked id="servingTypeSearchNo" class="servingTypeSearchOption @error('servingTypeSearchOption') is-invalid @enderror" name="servingTypeSearchOption" value="servingTypeSearchNo" required autocomplete="servingTypeSearchOption" autofocus>                                    
                                </div>
                                @error('servingTypeSearchOption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="husband_wifeNameSearchOption" class="col-md-4 col-form-label text-md-left">البحث بنوع الخدمة</label>
                        </div>

                        <div class="form-group row text-md-right jumbotron searchServingTypeDiv" hidden>
                            <div class="col-md-6 offset-md-2">
                                <div class="row">
                                    <div class="col-md-4 d-inline">
                                        <label class="col-form-label text-md-left">اعدادي</label>
                                        <input type="checkbox" id="servingTypeSearch_preparatory" class="@error('servingTypeSearch') is-invalid @enderror" name="servingTypeSearch" value="servingTypeSearch_preparatory" required autocomplete="servingTypeSearch" autofocus>
                                    </div>
                                    <div class="col-md-4 d-inline">
                                        <label class="col-form-label text-md-left">ثانوي</label>
                                        <input type="checkbox" id="servingTypeSearch_secondary" class="@error('servingTypeSearch') is-invalid @enderror" name="servingTypeSearch" value="servingTypeSearch_secondary" required autocomplete="servingTypeSearch" autofocus>
                                    </div>
                                    <div class="col-md-4 d-inline">
                                        <label class="col-form-label text-md-left">شباب</label>
                                        <input type="checkbox" id="servingTypeSearch_youth" class="@error('servingTypeSearch') is-invalid @enderror" name="servingTypeSearch" value="servingTypeSearch_youth" required autocomplete="servingTypeSearch" autofocus>                                    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 d-inline">
                                        <label class="col-form-label text-md-left">اخوة الرب</label>
                                        <input type="checkbox" id="servingTypeSearch_poor" class="@error('servingTypeSearch') is-invalid @enderror" name="servingTypeSearch" value="servingTypeSearch_poor" required autocomplete="servingTypeSearch" autofocus>
                                    </div>
                                    <div class="col-md-4 d-inline">
                                        <label class="col-form-label text-md-left">ايتام</label>
                                        <input type="checkbox" id="servingTypeSearch_orphans" class="@error('servingTypeSearch') is-invalid @enderror" name="servingTypeSearch" value="servingTypeSearch_orphans" required autocomplete="servingTypeSearch" autofocus>
                                    </div>
                                    <div class="col-md-4 d-inline">
                                        <label class="col-form-label text-md-left">ابتدائي</label>
                                        <input type="checkbox" id="servingTypeSearch_primary" class="@error('servingTypeSearch') is-invalid @enderror" name="servingTypeSearch" value="servingTypeSearch_primary" required autocomplete="servingTypeSearch" autofocus>                                    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 offset-md-8 d-inline">
                                    <label class="col-form-label text-md-left">مسنين</label>
                                    <input type="checkbox" id="servingTypeSearch_old" class="@error('servingTypeSearch') is-invalid @enderror" name="servingTypeSearch" value="servingTypeSearch_old" required autocomplete="servingTypeSearch" autofocus>                                    
                                    </div>
                                </div>
                                @error('servingTypeSearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="servingTypeSearch" class="col-md-4 col-form-label text-md-left">نوع الخدمة</label>
                        </div>

                        <div class="form-group row deaconLevelOptionDiv">
                            <div class="col-md-6 offset-md-2">
                                <div class="col-md-4 offset-md-4 d-inline">
                                    <label class="col-form-label text-md-left">نعم</label>
                                    <input type="radio" id="deaconLevelSearchYes" class="deaconLevelSearchOption @error('deaconLevelSearchOption') is-invalid @enderror" name="deaconLevelSearchOption" value="deaconLevelSearchYes" required autocomplete="deaconLevelSearchOption" autofocus>
                                </div>
                                <div class="col-md-4 d-inline">
                                    <label class="col-form-label text-md-left">لا</label>
                                    <input type="radio" checked id="deaconLevelSearchNo" class="deaconLevelSearchOption @error('deaconLevelSearchOption') is-invalid @enderror" name="deaconLevelSearchOption" value="deaconLevelSearchNo" required autocomplete="deaconLevelSearchOption" autofocus>                                    
                                </div>
                                @error('deaconLevelSearchOption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="deaconLevelSearchOption" class="col-md-4 col-form-label text-md-left">البحث بدرجة الشموسية</label>
                        </div>

                        <div class="form-group row text-md-right jumbotron searchDeaconLevelDiv" hidden>
                            <div class="col-md-6 offset-md-2">
                                <div class="row">
                                    <div class="col-md-4 d-inline">
                                        <label class="col-form-label text-md-left">ايبودياكون</label>
                                        <input type="checkbox" id="deaconLevelSearch_epideacon" class="@error('servingTypeSearch') is-invalid @enderror" name="servingTypeSearch" value="deaconLevelSearch_epideacon" required autocomplete="servingTypeSearch" autofocus>                                    
                                    </div>
                                    <div class="col-md-4 d-inline">
                                        <label class="col-form-label text-md-left">اناغنوستيس</label>
                                        <input type="checkbox" id="deaconLevelSearch_anaghnostos" class="@error('servingTypeSearch') is-invalid @enderror" name="servingTypeSearch" value="deaconLevelSearch_anaghnostos" required autocomplete="servingTypeSearch" autofocus>
                                    </div>
                                    <div class="col-md-4 d-inline">
                                        <label class="col-form-label text-md-left">ابصالتس</label>
                                        <input type="checkbox" id="deaconLevelSearch_epsaltos" class="@error('servingTypeSearch') is-invalid @enderror" name="servingTypeSearch" value="deaconLevelSearch_epsaltos" required autocomplete="servingTypeSearch" autofocus>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 offset-md-4 d-inline">
                                        <label class="col-form-label text-md-left">أرشيدياكون</label>
                                        <input type="checkbox" id="deaconLevelSearch_archdeacon" class="@error('servingTypeSearch') is-invalid @enderror" name="servingTypeSearch" value="deaconLevelSearch_archdeacon" required autocomplete="servingTypeSearch" autofocus>
                                    </div>
                                    <div class="col-md-4 d-inline">
                                        <label class="col-form-label text-md-left">دياكون</label>
                                        <input type="checkbox" id="deaconLevelSearch_deacon" class="@error('servingTypeSearch') is-invalid @enderror" name="servingTypeSearch" value="deaconLevelSearch_deacon" required autocomplete="servingTypeSearch" autofocus>
                                    </div>
                                </div>
                                @error('deaconLevelSearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="deaconLevelSearch" class="col-md-4 col-form-label text-md-left">درجة الشموسية</label>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <div class="col-md-4 offset-md-4 d-inline">
                                    <label class="col-form-label text-md-left">نعم</label>
                                    <input type="radio" id="churchNameSearchYes" class="churchNameSearchOption @error('churchNameSearchOption') is-invalid @enderror" name="churchNameSearchOption" value="churchNameSearchYes" required autocomplete="churchNameSearchOption" autofocus>
                                </div>
                                <div class="col-md-4 d-inline">
                                    <label class="col-form-label text-md-left">لا</label>
                                    <input type="radio" checked id="churchNameSearchNo" class="churchNameSearchOption @error('churchNameSearchOption') is-invalid @enderror" name="churchNameSearchOption" value="churchNameSearchNo" required autocomplete="churchNameSearchOption" autofocus>                                    
                                </div>
                                @error('churchNameSearchOption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="churchNameSearchOption" class="col-md-4 col-form-label text-md-left">البحث باسم الكنيسة التابع لها</label>
                        </div>

                        <div class="form-group row jumbotron searchChurchNameDiv" hidden>
                            <div class="col-md-6 offset-md-2">
                                <input id="churchNameSearch" onkeypress="return arabicOnly(event,this);" type="text" class="text-md-right form-control @error('churchNameSearch') is-invalid @enderror" name="churchNameSearch" value="{{ old('churchNameSearch') }}" required autocomplete="churchNameSearch" autofocus>

                                @error('churchNameSearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="churchNameSearch" class="col-md-4 col-form-label text-md-left">الكنيسة التابع لها</label>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <div class="col-md-4 offset-md-4 d-inline">
                                    <label class="col-form-label text-md-left">نعم</label>
                                    <input type="radio" id="confessFatherSearchYes" class="confessFatherSearchOption @error('confessFatherSearchOption') is-invalid @enderror" name="confessFatherSearchOption" value="confessFatherSearchYes" required autocomplete="confessFatherSearchOption" autofocus>
                                </div>
                                <div class="col-md-4 d-inline">
                                    <label class="col-form-label text-md-left">لا</label>
                                    <input type="radio" checked id="confessFatherSearchNo" class="confessFatherSearchOption @error('confessFatherSearchOption') is-invalid @enderror" name="confessFatherSearchOption" value="confessFatherSearchNo" required autocomplete="confessFatherSearchOption" autofocus>                                    
                                </div>
                                @error('confessFatherSearchOption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="confessFatherSearchOption" class="col-md-4 col-form-label text-md-left">البحث باسم اب الاعتراف</label>
                        </div>

                        <div class="form-group row jumbotron searchConfessFatherDiv" hidden>
                            <div class="col-md-6 offset-md-2">
                                <input id="confessFatherSearch" onkeypress="return arabicOnly(event,this);" type="text" class="text-md-right form-control @error('confessFatherSearch') is-invalid @enderror" name="confessFatherSearch" value="{{ old('confessFatherSearch') }}" required autocomplete="confessFatherSearch" autofocus>

                                @error('confessFatherSearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="confessFatherSearch" class="col-md-4 col-form-label text-md-left">اسم اب الاعتراف</label>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-2">
                                <button type="submit" class="w-100 btn btn-primary">
                                    بحث
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