@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center printable">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">عرض البيانات</div>

                    <div class="card-body text-md-right">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>

                    <div class="ml-5 mb-4">
                        <img class="img-responsive float-md-left" src="{{URL::to($data['person']->img_url)}}" alt="personal image" width="150" height="200">
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">الاسم كامل:</label>
                        <label for="name" class="col-md-8 col-form-label text-md-left">{{$data['person']->fullName}}</label>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">الرقم القومي:</label>
                        <label for="name" class="col-md-8 col-form-label text-md-left">{{$data['person']->ssn}}</label>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">رقم المحمول:</label>
                        <label for="name" class="col-md-8 col-form-label text-md-left">{{$data['person']->mobile}}</label>
                    </div>

                    @php
                        if ($data['person']->email == null){
                            $data['person']->email = 'لا يوجد';
                        }
                        if ($data['person']->gender == "male"){
                            $gender = "ذكر";
                            $deaconLevel = $data['person']->deaconLevel;
                            if ($deaconLevel == null){
                                $deaconLevel = "ليس شماس";
                            }
                        }
                        else{
                            $gender = "انثي";
                        }
                        if ($data['person']->socialState == "single"){
                            $socialState = "اعزب";
                        }
                        else if($data['person']->socialState == "married"){
                            $socialState = "متزوج";
                        }
                        else{
                            $socialState = "ارمل";
                        }
                        if ($socialState != "اعزب"){
                            $spouseName = "";
                            $childNumber = ["الاول", "الثاني", "الثالث", "الرابع", "الخامس", "السادس", "السابع", "الثامن", "التاسع", "العاشر", "الحادي عشر", "الثاني عشر", "الثالث عشر", "الرابع عشر", "الخامس عشر"];
                            $childNumberIndex = 0;
                            if ($data['spouse'] != null){
                                $spouseName = $data['spouse'][0]->fullName;
                            }
                        }
                        $servingType = $data['person']->servingType;
                        if ($servingType == null){
                            $servingType = "ليس خادم";
                        }
                    @endphp

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">البريد الالكتروني:</label>
                        <label for="name" class="col-md-8 col-form-label text-md-left">{{$data['person']->email}}</label>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">اسم الأم:</label>
                        <label for="name" class="col-md-8 col-form-label text-md-left">{{$data['person']->motherName}}</label>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">النوع:</label>
                        <label for="name" class="col-md-8 col-form-label text-md-left">{{$gender}}</label>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">تاريخ الميلاد:</label>
                        <label for="name" class="col-md-8 col-form-label text-md-left">{{$data['person']->birthDate}}</label>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">المؤهل الدراسي:</label>
                        <label for="name" class="col-md-8 col-form-label text-md-left">{{$data['person']->eduQual}}</label>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">العنوان:</label>
                        <label for="name" class="col-md-2 col-form-label text-md-left">{{$data['person']->city}}</label>
                        <label for="name" class="col-md-2 col-form-label text-md-left">{{$data['person']->governorate}}</label>
                        <span class="col-md-6"></span>
                        <label class="col-md-2 col-form-label text-md-right"></label>
                        <label for="name" class="col-md-2 col-form-label text-md-left">{{$data['person']->building}}</label>
                        <label for="name" class="col-md-2 col-form-label text-md-left">{{$data['person']->street}}</label>
                        <span class="col-md-6"></span>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">الحالة الاجتماعية:</label>
                        <label for="name" class="col-md-8 col-form-label text-md-left">{{$socialState}}</label>
                    </div>

                    @if($socialState != "اعزب")
                        @if($gender == "ذكر")
                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">الرقم القومي للزوجة:</label>
                                <label for="name" class="col-md-8 col-form-label text-md-left">{{$data['spousessn']}}</label>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">اسم الزوجة:</label>
                                @if($spouseName != null)
                                    <label for="name" class="col-md-4 col-form-label text-md-left"><a class="text-decoration-none text-dark" href="{{route('person.show', ['ssn' => $data['spousessn']])}}">{{$spouseName}}</a></label>
                                @else
                                    <label for="name" class="col-md-4 col-form-label text-md-left">لم يتم تسجيل بيانات الزوجة بعد.</label>
                                @endif
                            </div>
                        @elseif($gender == "انثي")
                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">الرقم القومي للزوج:</label>
                                <label for="name" class="col-md-8 col-form-label text-md-left">{{$data['spousessn']}}</label>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">اسم الزوج:</label>
                                @if($spouseName != null)
                                    <label for="name" class="col-md-4 col-form-label text-md-left"><a class="text-decoration-none text-dark" href="{{route('person.show', ['ssn' => $data['spousessn']])}}">{{$spouseName}}</a></label>
                                @else
                                    <label for="name" class="col-md-4 col-form-label text-md-left">لم يتم تسجيل بيانات الزوج بعد.</label>
                                @endif
                            </div>
                        @endif
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">تاريخ الزواج:</label>
                            <label for="name" class="col-md-4 col-form-label text-md-left">{{$data['person']->marriageDate}}</label>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">عدد الابناء:</label>
                            <label for="name" class="col-md-4 col-form-label text-md-left">{{$data['person']->numOfChildren}}</label>
                        </div>

                        @foreach($data['childrenssn'] as $childssn)
                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">الرقم القومي للابن {{$childNumber[$childNumberIndex++]}}:</label>
                                <label for="name" class="col-md-4 col-form-label text-md-left">{{$childssn->memberssn}}</label>
                            </div>
                        @endforeach

                        @for($i=0; $i < count($data['childrenssn']); $i++)
                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">اسم الابن {{$childNumber[$i]}}:</label>
                                @if($data['children'] == null || !(array_key_exists($i, $data['children'])))
                                    <label for="name" class="col-md-4 col-form-label text-md-left">لم يتم تسجيل بيانات الابن بعد.</label>
                                @else
                                    <label for="name" class="col-md-4 col-form-label text-md-left"><a class="text-decoration-none text-dark" href="{{route('person.show', ['ssn' => $data['children'][$i]->ssn])}}">{{$data['children'][$i]->fullName}}</a></label>
                                @endif
                            </div>
                        @endfor
                    @endif
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">نوع الخدمة:</label>
                        <label for="name" class="col-md-8 col-form-label text-md-left">{{$servingType}}</label>
                    </div>

                    @if($gender == "ذكر")
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">درجة الشموسية:</label>
                            <label for="name" class="col-md-8 col-form-label text-md-left">{{$deaconLevel}}</label>
                        </div>

                    @endif

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">الكنيسة التابع لها:</label>
                        <label for="name" class="col-md-8 col-form-label text-md-left">{{$data['person']->church}}</label>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">اسم اب الاعتراف:</label>
                        <label for="name" class="col-md-8 col-form-label text-md-left">{{$data['person']->confessFather}}</label>
                    </div>
                    <div class="align-self-center mb-2 w-25 non-printable">
                        <a class="btn btn-success d-block" onclick="window.print()" href="#">طباعة</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
