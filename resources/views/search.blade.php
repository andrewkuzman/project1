@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">بحث</div>

                <div class="card-body">
                    <form method="GET" action="/search/prepare">
                        @csrf

                        @if(session()->has('success'))
                            <ul dir="rtl" class="text-left alert alert-success">
                                <li>{{ session()->get('success') }}</li>
                            </ul>
                        @endif

                        <div class="form-group row text">
                            <label for="genderSearch" class="col-md-4 col-form-label text-md-right">النوع</label>

                            <div class="col-md-6">
                                <div class="col-md-4 offset-md-4 d-inline">
                                    <input type="checkbox" checked id="gender_maleSearch" class="genderSearch @error('genderSearch') is-invalid @enderror" name="genderSearchMale" value="gender_maleSearch" autocomplete="genderSearch" autofocus>
                                    <label class="col-form-label text-md-left">ذكر</label>
                                </div>
                                <div class="col-md-4 d-inline">
                                    <input type="checkbox" id="gender_femaleSearch" class="genderSearch @error('genderSearch') is-invalid @enderror" name="genderSearchFemale" value="gender_femaleSearch" autocomplete="genderSearch" autofocus>
                                    <label class="col-form-label text-md-left">انثي</label>
                                </div>
                                @error('genderSearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="socialStateSearch" class="col-md-4 col-form-label text-md-right">الحالة الاجتماعية</label>

                            <div class="col-md-6">
                                <div class="col-md-3 offset-md-2 d-inline">
                                    <input type="checkbox" checked id="socialStateSearch_single" class="socialStateSearch @error('socialStateSearch') is-invalid @enderror" name="socialStateSearchSingle" value="socialStateSearch_single" autocomplete="socialStateSearch" autofocus>
                                    <label class="col-form-label text-md-left">أعزب</label>
                                </div>
                                <div class="col-md-3 d-inline">
                                    <input type="checkbox" id="socialStateSearch_married" class="socialStateSearch @error('socialStateSearch') is-invalid @enderror" name="socialStateSearchMarried" value="socialStateSearch_married" autocomplete="socialStateSearch" autofocus>
                                    <label class="col-form-label text-md-left">متزوج</label>
                                </div>
                                <div class="col-md-3  d-inline">
                                    <input type="checkbox" id="socialStateSearch_widow" class="socialStateSearch @error('socialStateSearch') is-invalid @enderror" name="socialStateSearchWidow" value="socialStateSearch_widow" autocomplete="socialStateSearch" autofocus>
                                    <label class="col-form-label text-md-left">أرمل</label>
                                </div>
                                @error('socialStateSearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nameSearchOption" class="col-md-4 col-form-label text-md-right">البحث بالاسم</label>

                            <div class="col-md-6">
                                <div class="col-md-4 offset-md-4 d-inline">
                                    <input type="radio" id="nameSearchYes" class="nameSearchOption @error('nameSearchOption') is-invalid @enderror" name="nameSearchOption" value="nameSearchYes" autocomplete="nameSearchOption" autofocus>
                                    <label class="col-form-label text-md-left">نعم</label>
                                </div>
                                <div class="col-md-4 d-inline">
                                    <input type="radio" checked id="nameSearchNo" class="nameSearchOption @error('nameSearchOption') is-invalid @enderror" name="nameSearchOption" value="nameSearchNo" autocomplete="nameSearchOption" autofocus>
                                    <label class="col-form-label text-md-left">لا</label>
                                </div>
                                @error('nameSearchOption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="searchNameDiv form-group row jumbotron" hidden="true">
                            <label for="nameSearch" class="col-md-4 col-form-label text-md-right">الاسم كامل</label>

                            <div class="col-md-6">
                                <input id="nameSearch" onkeypress="return arabicOnly(event,this);" type="text" class="text-md-right form-control @error('nameSearch') is-invalid @enderror" name="nameSearch" value="{{ old('nameSearch') }}" autocomplete="nameSearch" autofocus>

                                @error('nameSearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ssnSearchOption" class="col-md-4 col-form-label text-md-right">البحث بالرقم القومي</label>

                            <div class="col-md-6">
                                <div class="col-md-4 offset-md-4 d-inline">
                                    <input type="radio" id="ssnSearchYes" class="ssnSearchOption @error('ssnSearchOption') is-invalid @enderror" name="ssnSearchOption" value="ssnSearchYes" autocomplete="ssnSearchOption" autofocus>
                                    <label class="col-form-label text-md-left">نعم</label>
                                </div>
                                <div class="col-md-4 d-inline">
                                    <input type="radio" checked id="ssnSearchNo" class="ssnSearchOption @error('ssnSearchOption') is-invalid @enderror" name="ssnSearchOption" value="ssnSearchNo" autocomplete="ssnSearchOption" autofocus>
                                    <label class="col-form-label text-md-left">لا</label>
                                </div>
                                @error('ssnSearchOption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="searchssnDiv form-group row jumbotron" hidden>
                            <label for="ssnSearch" class="col-md-4 col-form-label text-md-right">الرقم القومي</label>

                            <div class="col-md-6">
                                <input id="ssnSearch" type="number" min="0" oninput="validity.valid||(value='');" class="form-control @error('ssnSearch') is-invalid @enderror" name="ssnSearch" value="{{ old('ssnSearch') }}" autocomplete="ssnSearch" autofocus>

                                @error('ssnSearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mobileSearchOption" class="col-md-4 col-form-label text-md-right">البحث برقم المحمول</label>

                            <div class="col-md-6">
                                <div class="col-md-4 offset-md-4 d-inline">
                                    <input type="radio" id="mobileSearchYes" class="mobileSearchOption @error('mobileSearchOption') is-invalid @enderror" name="mobileSearchOption" value="mobileSearchYes" autocomplete="mobileSearchOption" autofocus>
                                    <label class="col-form-label text-md-left">نعم</label>
                                </div>
                                <div class="col-md-4 d-inline">
                                    <input type="radio" checked id="mobileSearchNo" class="mobileSearchOption @error('mobileSearchOption') is-invalid @enderror" name="mobileSearchOption" value="mobileSearchNo" autocomplete="mobileSearchOption" autofocus>
                                    <label class="col-form-label text-md-left">لا</label>
                                </div>
                                @error('mobileSearchOption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="searchMobileDiv form-group row jumbotron" hidden>
                            <label for="mobileSearch" class="col-md-4 col-form-label text-md-right">رقم المحمول</label>

                            <div class="col-md-6">
                                <input id="mobileSearch" type="number" min="0" oninput="validity.valid||(value='');" class="form-control @error('mobileSearch') is-invalid @enderror" name="mobileSearch" value="{{ old('mobileSearch') }}" autocomplete="mobileSearch" autofocus>

                                @error('mobileSearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="emailSearchOption" class="col-md-4 col-form-label text-md-right">البحث بالبريد الالكتروني</label>

                            <div class="col-md-6">
                                <div class="col-md-4 offset-md-4 d-inline">
                                    <input type="radio" id="emailSearchYes" class="emailSearchOption @error('emailSearchOption') is-invalid @enderror" name="emailSearchOption" value="emailSearchYes" autocomplete="emailSearchOption" autofocus>
                                    <label class="col-form-label text-md-left">نعم</label>
                                </div>
                                <div class="col-md-4 d-inline">
                                    <input type="radio" checked id="emailSearchNo" class="emailSearchOption @error('emailSearchOption') is-invalid @enderror" name="emailSearchOption" value="emailSearchNo" autocomplete="emailSearchOption" autofocus>
                                    <label class="col-form-label text-md-left">لا</label>
                                </div>
                                @error('emailSearchOption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="searchEmailDiv form-group row jumbotron" hidden>
                            <label for="email" class="col-md-4 col-form-label text-md-right">البريد الالكتروني</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="motherSearchOption" class="col-md-4 col-form-label text-md-right">البحث باسم الام</label>

                            <div class="col-md-6">
                                <div class="col-md-4 offset-md-4 d-inline">
                                    <input type="radio" id="motherSearchYes" class="motherSearchOption @error('motherSearchOption') is-invalid @enderror" name="motherSearchOption" value="motherSearchYes" autocomplete="motherSearchOption" autofocus>
                                    <label class="col-form-label text-md-left">نعم</label>
                                </div>
                                <div class="col-md-4 d-inline">
                                    <input type="radio" checked id="motherSearchNo" class="motherSearchOption @error('motherSearchOption') is-invalid @enderror" name="motherSearchOption" value="motherSearchNo" autocomplete="motherSearchOption" autofocus>
                                    <label class="col-form-label text-md-left">لا</label>
                                </div>
                                @error('motherSearchOption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="searchMotherDiv form-group row jumbotron" hidden>
                            <label for="motherSearch" class="col-md-4 col-form-label text-md-right">اسم الأم</label>

                            <div class="col-md-6">
                                <input id="motherSearch" onkeypress="return arabicOnly(event,this);" type="text" class="text-md-right form-control @error('motherSearch') is-invalid @enderror" name="motherSearch" value="{{ old('motherSearch') }}" autocomplete="motherSearch" autofocus>

                                @error('motherSearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="birthDateSearchOption" class="col-md-4 col-form-label text-md-right">البحث بتاريخ الميلاد</label>

                            <div class="col-md-6">
                                <div class="col-md-4 offset-md-4 d-inline">
                                    <input type="radio" id="birthDateSearchYes" class="birthDateSearchOption @error('birthDateSearchOption') is-invalid @enderror" name="birthDateSearchOption" value="birthDateSearchYes" autocomplete="birthDateSearchOption" autofocus>
                                    <label class="col-form-label text-md-left">نعم</label>
                                </div>
                                <div class="col-md-4 d-inline">
                                    <input type="radio" checked id="birthDateSearchNo" class="birthDateSearchOption @error('birthDateSearchOption') is-invalid @enderror" name="birthDateSearchOption" value="birthDateSearchNo" autocomplete="birthDateSearchOption" autofocus>
                                    <label class="col-form-label text-md-left">لا</label>
                                </div>
                                @error('birthDateSearchOption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="searchBirthDateDiv form-group row jumbotron" hidden>
                            <label for="birthDateSearch" class="col-md-4 col-form-label text-md-right">تاريخ الميلاد</label>

                            <div class="col-md-6">
                                <input id="birthDateSearch" type="date" class="date form-control @error('birthDateSearch') is-invalid @enderror" name="birthDateSearch" value="{{ old('birthDateSearch') }}" autocomplete="birthDateSearch" autofocus>

                                @error('birthDateSearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="edcQualSearchOption" class="col-md-4 col-form-label text-md-right">البحث بالمؤهل الدراسي</label>

                            <div class="col-md-6">
                                <div class="col-md-4 offset-md-4 d-inline">
                                    <input type="radio" id="edcQualSearchYes" class="edcQualSearchOption @error('edcQualSearchOption') is-invalid @enderror" name="edcQualSearchOption" value="edcQualSearchYes" autocomplete="edcQualSearchOption" autofocus>
                                    <label class="col-form-label text-md-left">نعم</label>
                                </div>
                                <div class="col-md-4 d-inline">
                                    <input type="radio" checked id="edcQualSearchNo" class="edcQualSearchOption @error('edcQualSearchOption') is-invalid @enderror" name="edcQualSearchOption" value="edcQualSearchNo" autocomplete="edcQualSearchOption" autofocus>
                                    <label class="col-form-label text-md-left">لا</label>
                                </div>
                                @error('edcQualSearchOption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="searchEdcQualDiv form-group row text-md-right jumbotron" hidden>
                            <label for="edcQualSearch" class="col-md-4 col-form-label text-md-right">المؤهل الدراسي</label>

                            <div class="col-md-6 text-md-left">
                                <div>
                                    <input type="checkbox" id="edcQualSearch_high" class="@error('edcQualSearch') is-invalid @enderror" name="edcQualSearchHigh" value="edcQualSearch_high" autocomplete="edcQualSearchHigh" autofocus>
                                    <label class="col-form-label text-md-right">عالي</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="edcQualSearch_aboveAverage" class="@error('edcQualSearch') is-invalid @enderror" name="edcQualSearchAboveAverage" value="edcQualSearch_aboveAverage" autocomplete="edcQualSearchAboveAverage" autofocus>
                                    <label class="col-form-label text-md-right">فوق المتوسط</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="edcQualSearch_average" class="@error('edcQualSearch') is-invalid @enderror" name="edcQualSearchAverage" value="edcQualSearch_average" autocomplete="edcQualSearchAverage" autofocus>
                                    <label class="col-form-label text-md-right">متوسط</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="edcQualSearch_secondary" class="@error('edcQualSearch') is-invalid @enderror" name="edcQualSearchSecondary" value="edcQualSearch_secondary" autocomplete="edcQualSearchSecondary" autofocus>
                                    <label class="col-form-label text-md-right">ثانوي</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="edcQualSearch_preparatory" class="@error('edcQualSearch') is-invalid @enderror" name="edcQualSearchPreparatory" value="edcQualSearch_preparatory" autocomplete="edcQualSearchPreparatory" autofocus>
                                    <label class="col-form-label text-md-right">اعدادي</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="edcQualSearch_primary" class="@error('edcQualSearch') is-invalid @enderror" name="edcQualSearchPrimary" value="edcQualSearch_primary" autocomplete="edcQualSearchPrimary" autofocus>
                                    <label class="col-form-label text-md-right">ابتدائي</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="edcQualSearch_non" class="@error('edcQualSearch') is-invalid @enderror" name="edcQualSearchNon" value="edcQualSearch_non" autocomplete="edcQualSearchNon" autofocus>
                                    <label class="col-form-label text-md-right">بدون مؤهل</label>
                                </div>
                                @error('edcQualSearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="addressSearchOption" class="col-md-4 col-form-label text-md-right">البحث بالعنوان</label>

                            <div class="col-md-6">
                                <div class="col-md-4 offset-md-4 d-inline">
                                    <input type="radio" id="addressSearchYes" class="addressSearchOption @error('addressSearchOption') is-invalid @enderror" name="addressSearchOption" value="addressSearchYes" autocomplete="addressSearchOption" autofocus>
                                    <label class="col-form-label text-md-left">نعم</label>
                                </div>
                                <div class="col-md-4 d-inline">
                                    <input type="radio" checked id="addressSearchNo" class="addressSearchOption @error('addressSearchOption') is-invalid @enderror" name="addressSearchOption" value="addressSearchNo" autocomplete="addressSearchOption" autofocus>
                                    <label class="col-form-label text-md-left">لا</label>
                                </div>
                                @error('addressSearchOption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row searchAddressDiv jumbotron" hidden>
                            <label class="col-md-4 col-form-label text-md-right pt-4">العنوان</label>

                            <div class="col-md-6">
                                <input id="governorateSearch" placeholder="محافظة" type="text" class="text-md-right col-md-6 float-right form-control d-inline @error('governorateSearch') is-invalid @enderror" name="governorateSearch" value="{{ old('governorateSearch') }}" autocomplete="governorateSearch" autofocus>
                                @error('governorateSearch')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input id="citySearch" placeholder="مدينة/حي/قرية" type="text" class="text-md-right col-md-6 float-right form-control d-inline @error('citySearch') is-invalid @enderror" name="citySearch" value="{{ old('citySearch') }}" autocomplete="citySearch" autofocus>
                                @error('citySearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input id="streetSearch" placeholder="شارع" type="text" class="text-md-right col-md-6 float-right form-control d-inline @error('streetSearch') is-invalid @enderror" name="streetSearch" value="{{ old('streetSearch') }}" autocomplete="streetSearch" autofocus>
                                @error('streetSearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input id="buildingSearch" placeholder="عقار" type="text" class="text-md-right col-md-6 float-right form-control d-inline @error('buildingSearch') is-invalid @enderror" name="buildingSearch" value="{{ old('buildingSearch') }}" autocomplete="buildingSearch" autofocus>
                                @error('buildingSearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="searchHusband_wifeDiv form-group row jumbotron" hidden>
                            <label for="husband_wifeName" class="col-md-4 col-form-label text-md-right"> اسم الزوج/الزوجة</label>

                            <div class="col-md-6">
                                <input id="husband_wifeName" onkeypress="return arabicOnly(event,this);" type="text" class="text-md-right form-control @error('husband_wifeName') is-invalid @enderror" name="husband_wifeName" value="{{ old('husband_wifeName') }}" autocomplete="husband_wifeName" autofocus>

                                @error('husband_wifeName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row socialStateCheck" hidden>
                            <label for="marriageDateSearchOption" class="col-md-4 col-form-label text-md-right">البحث بتاريخ الزواج</label>

                            <div class="col-md-6">
                                <div class="col-md-4 offset-md-4 d-inline">
                                    <input type="radio" id="marriageDateSearchYes" class="marriageDateSearchOption @error('marriageDateSearchOption') is-invalid @enderror" name="marriageDateSearchOption" value="marriageDateSearchYes" autocomplete="marriageDateSearchOption" autofocus>
                                    <label class="col-form-label text-md-left">نعم</label>
                                </div>
                                <div class="col-md-4 d-inline">
                                    <input type="radio" checked id="marriageDateSearchNo" class="marriageDateSearchOption @error('marriageDateSearchOption') is-invalid @enderror" name="marriageDateSearchOption" value="marriageDateSearchNo" autocomplete="marriageDateSearchOption" autofocus>
                                    <label class="col-form-label text-md-left">لا</label>
                                </div>
                                @error('marriageDateSearchOption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row jumbotron searchMarriageDateDiv" hidden>
                            <label for="marriageDateSearch" class="col-md-4 col-form-label text-md-right">تاريخ الزواج</label>

                            <div class="col-md-6">
                                <input id="marriageDateSearch" type="date" class="date form-control @error('marriageDateSearch') is-invalid @enderror" name="marriageDateSearch" value="{{ old('marriageDateSearch') }}" autocomplete="marriageDateSearch" autofocus>

                                @error('marriageDateSearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row socialStateCheck" hidden>
                            <label for="numberofChildrenSearchOption" class="col-md-4 col-form-label text-md-right">البحث بعدد الابناء</label>

                            <div class="col-md-6">
                                <div class="col-md-4 offset-md-4 d-inline">
                                    <input type="radio" id="numberofChildrenSearchYes" class="numberofChildrenSearchOption @error('numberofChildrenSearchOption') is-invalid @enderror" name="numberofChildrenSearchOption" value="numberofChildrenSearchYes" autocomplete="numberofChildrenSearchOption" autofocus>
                                    <label class="col-form-label text-md-left">نعم</label>
                                </div>
                                <div class="col-md-4 d-inline">
                                    <input type="radio" checked id="numberofChildrenSearchNo" class="numberofChildrenSearchOption @error('numberofChildrenSearchOption') is-invalid @enderror" name="numberofChildrenSearchOption" value="numberofChildrenSearchNo" autocomplete="numberofChildrenSearchOption" autofocus>
                                    <label class="col-form-label text-md-left">لا</label>
                                </div>
                                @error('numberofChildrenSearchOption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row jumbotron searchNumberofChildrenDiv" hidden>
                            <label for="numberofChildrenSearch" class="col-md-4 col-form-label text-md-right">عدد الابناء</label>

                            <div class="col-md-6">
                                <input id="numberofChildrenSearch" type="number" value="0" max="15"  min="0" oninput="validity.valid||(value='');" class="form-control @error('numberofChildrenSearch') is-invalid @enderror" name="numberofChildrenSearch" value="{{ old('numberofChildrenSearch') }}" autocomplete="numberofChildrenSearch" autofocus>

                                @error('numberofChildrenSearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="generatessnDiv"></div>

                        <div class="form-group row">
                            <label for="husband_wifeNameSearchOption" class="col-md-4 col-form-label text-md-right">البحث بنوع الخدمة</label>

                            <div class="col-md-6">
                                <div class="col-md-4 offset-md-4 d-inline">
                                    <input type="radio" id="servingTypeSearchYes" class="servingTypeSearchOption @error('servingTypeSearchOption') is-invalid @enderror" name="servingTypeSearchOption" value="servingTypeSearchYes" autocomplete="servingTypeSearchOption" autofocus>
                                    <label class="col-form-label text-md-left">نعم</label>
                                </div>
                                <div class="col-md-4 d-inline">
                                    <input type="radio" checked id="servingTypeSearchNo" class="servingTypeSearchOption @error('servingTypeSearchOption') is-invalid @enderror" name="servingTypeSearchOption" value="servingTypeSearchNo" autocomplete="servingTypeSearchOption" autofocus>
                                    <label class="col-form-label text-md-left">لا</label>
                                </div>
                                @error('servingTypeSearchOption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row text-md-right jumbotron searchServingTypeDiv" hidden>
                            <label for="servingTypeSearch" class="col-md-4 col-form-label text-md-right">نوع الخدمة</label>

                            <div class="col-md-6 text-md-left">
                                <div>
                                    <input type="checkbox" id="servingTypeSearch_youth" class="@error('servingTypeSearch') is-invalid @enderror" name="servingTypeSearchYouth" value="servingTypeSearch_youth" autocomplete="servingTypeSearchYouth" autofocus>
                                    <label class="col-form-label text-md-left">شباب</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="servingTypeSearch_secondary" class="@error('servingTypeSearch') is-invalid @enderror" name="servingTypeSearchSecondary" value="servingTypeSearch_secondary" autocomplete="servingTypeSearchSecondary" autofocus>
                                    <label class="col-form-label text-md-left">ثانوي</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="servingTypeSearch_preparatory" class="@error('servingTypeSearch') is-invalid @enderror" name="servingTypeSearchPreparatory" value="servingTypeSearch_preparatory" autocomplete="servingTypeSearchPreparatory" autofocus>
                                    <label class="col-form-label text-md-left">اعدادي</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="servingTypeSearch_primary" class="@error('servingTypeSearch') is-invalid @enderror" name="servingTypeSearchPrimary" value="servingTypeSearch_primary" autocomplete="servingTypeSearchPrimary" autofocus>
                                    <label class="col-form-label text-md-left">ابتدائي</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="servingTypeSearch_poor" class="@error('servingTypeSearch') is-invalid @enderror" name="servingTypeSearchPoor" value="servingTypeSearch_poor" autocomplete="servingTypeSearchPoor" autofocus>
                                    <label class="col-form-label text-md-left">اخوة الرب</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="servingTypeSearch_orphans" class="@error('servingTypeSearch') is-invalid @enderror" name="servingTypeSearchOrphans" value="servingTypeSearch_orphans" autocomplete="servingTypeSearchOrphans" autofocus>
                                    <label class="col-form-label text-md-left">ايتام</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="servingTypeSearch_old" class="@error('servingTypeSearch') is-invalid @enderror" name="servingTypeSearchOld" value="servingTypeSearch_old" autocomplete="servingTypeSearchOld" autofocus>
                                    <label class="col-form-label text-md-left">مسنين</label>
                                </div>
                                @error('servingTypeSearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row deaconLevelOptionDiv">
                            <label for="deaconLevelSearchOption" class="col-md-4 col-form-label text-md-right">البحث بدرجة الشموسية</label>

                            <div class="col-md-6">
                                <div class="col-md-4 offset-md-4 d-inline">
                                    <input type="radio" id="deaconLevelSearchYes" class="deaconLevelSearchOption @error('deaconLevelSearchOption') is-invalid @enderror" name="deaconLevelSearchOption" value="deaconLevelSearchYes" autocomplete="deaconLevelSearchOption" autofocus>
                                    <label class="col-form-label text-md-left">نعم</label>
                                </div>
                                <div class="col-md-4 d-inline">
                                    <input type="radio" checked id="deaconLevelSearchNo" class="deaconLevelSearchOption @error('deaconLevelSearchOption') is-invalid @enderror" name="deaconLevelSearchOption" value="deaconLevelSearchNo" autocomplete="deaconLevelSearchOption" autofocus>
                                    <label class="col-form-label text-md-left">لا</label>
                                </div>
                                @error('deaconLevelSearchOption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row text-md-right jumbotron searchDeaconLevelDiv" hidden>
                            <label for="deaconLevelSearch" class="col-md-4 col-form-label text-md-right">درجة الشموسية</label>

                            <div class="col-md-6 text-md-left">
                                <div>
                                    <input type="checkbox" id="deaconLevelSearch_epideacon" class="@error('servingTypeSearch') is-invalid @enderror" name="servingTypeSearchEpideacon" value="deaconLevelSearch_epideacon" autocomplete="servingTypeSearchEpideacon" autofocus>
                                    <label class="col-form-label text-md-left">ايبودياكون</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="deaconLevelSearch_anaghnostos" class="@error('servingTypeSearch') is-invalid @enderror" name="servingTypeSearchAnaghnostos" value="deaconLevelSearch_anaghnostos" autocomplete="servingTypeSearchAnaghnostos" autofocus>
                                    <label class="col-form-label text-md-left">اناغنوستيس</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="deaconLevelSearch_epsaltos" class="@error('servingTypeSearch') is-invalid @enderror" name="servingTypeSearchEpsaltos" value="deaconLevelSearch_epsaltos" autocomplete="servingTypeSearchEpsaltos" autofocus>
                                    <label class="col-form-label text-md-left">ابصالتس</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="deaconLevelSearch_archdeacon" class="@error('servingTypeSearch') is-invalid @enderror" name="servingTypeSearchArchdeacon" value="deaconLevelSearch_archdeacon" autocomplete="servingTypeSearchArchdeacon" autofocus>
                                    <label class="col-form-label text-md-left">أرشيدياكون</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="deaconLevelSearch_deacon" class="@error('servingTypeSearch') is-invalid @enderror" name="servingTypeSearchDeacon" value="deaconLevelSearch_deacon" autocomplete="servingTypeSearchDeacon" autofocus>
                                    <label class="col-form-label text-md-left">دياكون</label>
                                </div>
                                @error('deaconLevelSearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="churchNameSearchOption" class="col-md-4 col-form-label text-md-right">البحث باسم الكنيسة التابع لها</label>

                            <div class="col-md-6">
                                <div class="col-md-4 offset-md-4 d-inline">
                                    <input type="radio" id="churchNameSearchYes" class="churchNameSearchOption @error('churchNameSearchOption') is-invalid @enderror" name="churchNameSearchOption" value="churchNameSearchYes" autocomplete="churchNameSearchOption" autofocus>
                                    <label class="col-form-label text-md-left">نعم</label>
                                </div>
                                <div class="col-md-4 d-inline">
                                    <input type="radio" checked id="churchNameSearchNo" class="churchNameSearchOption @error('churchNameSearchOption') is-invalid @enderror" name="churchNameSearchOption" value="churchNameSearchNo" autocomplete="churchNameSearchOption" autofocus>
                                    <label class="col-form-label text-md-left">لا</label>
                                </div>
                                @error('churchNameSearchOption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row jumbotron searchChurchNameDiv" hidden>
                            <label for="churchNameSearch" class="col-md-4 col-form-label text-md-right">الكنيسة التابع لها</label>

                            <div class="col-md-6">
                                <input id="churchNameSearch" onkeypress="return arabicOnly(event,this);" type="text" class="text-md-right form-control @error('churchNameSearch') is-invalid @enderror" name="churchNameSearch" value="{{ old('churchNameSearch') }}" autocomplete="churchNameSearch" autofocus>

                                @error('churchNameSearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="confessFatherSearchOption" class="col-md-4 col-form-label text-md-right">البحث باسم اب الاعتراف</label>

                            <div class="col-md-6">
                                <div class="col-md-4 offset-md-4 d-inline">
                                    <input type="radio" id="confessFatherSearchYes" class="confessFatherSearchOption @error('confessFatherSearchOption') is-invalid @enderror" name="confessFatherSearchOption" value="confessFatherSearchYes" autocomplete="confessFatherSearchOption" autofocus>
                                    <label class="col-form-label text-md-left">نعم</label>
                                </div>
                                <div class="col-md-4 d-inline">
                                    <input type="radio" checked id="confessFatherSearchNo" class="confessFatherSearchOption @error('confessFatherSearchOption') is-invalid @enderror" name="confessFatherSearchOption" value="confessFatherSearchNo" autocomplete="confessFatherSearchOption" autofocus>
                                    <label class="col-form-label text-md-left">لا</label>
                                </div>
                                @error('confessFatherSearchOption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row jumbotron searchConfessFatherDiv" hidden>
                            <label for="confessFatherSearch" class="col-md-4 col-form-label text-md-right">اسم اب الاعتراف</label>

                            <div class="col-md-6">
                                <input id="confessFatherSearch" onkeypress="return arabicOnly(event,this);" type="text" class="text-md-right form-control @error('confessFatherSearch') is-invalid @enderror" name="confessFatherSearch" value="{{ old('confessFatherSearch') }}" autocomplete="confessFatherSearch" autofocus>

                                @error('confessFatherSearch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
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
