@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center printable">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header text-md-right">عرض البيانات</div>

                    <div class="card-body text-md-right">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>

                    <div class="mr-5 mb-4">
                        <img class="img-responsive float-md-right" src="{{URL::to($data['person']->img_url)}}" alt="personal image" width="150" height="200">
                    </div>

                    <div class="form-group row">
                        <label for="name" class="offset-7 col-md-3 col-form-label text-md-right">{{$data['person']->fullName}}</label>
                        <label for="name" class="col-md-2 col-form-label text-md-left">:الاسم كامل</label>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="offset-7 col-md-3 col-form-label text-md-right">{{$data['person']->ssn}}</label>
                        <label for="name" class="col-md-2 col-form-label text-md-left">:الرقم القومي</label>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="offset-7 col-md-3 col-form-label text-md-right">{{$data['person']->mobile}}</label>
                        <label for="name" class="col-md-2 col-form-label text-md-left">:رقم المحمول</label>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="offset-7 col-md-3 col-form-label text-md-right">{{$data['person']->email}}</label>
                        <label for="name" class="col-md-2 col-form-label text-md-left">:البريد الالكتروني</label>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="offset-7 col-md-3 col-form-label text-md-right">{{$data['person']->motherName}}</label>
                        <label for="name" class="col-md-2 col-form-label text-md-left">:اسم الأم</label>
                    </div>

                    @php
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
                        <label for="name" class="offset-7 col-md-3 col-form-label text-md-right">{{$gender}}</label>
                        <label for="name" class="col-md-2 col-form-label text-md-left">:النوع</label>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="offset-7 col-md-3 col-form-label text-md-right">{{$data['person']->birthDate}}</label>
                        <label for="name" class="col-md-2 col-form-label text-md-left">:تاريخ الميلاد</label>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="offset-7 col-md-3 col-form-label text-md-right">{{$data['person']->eduQual}}</label>
                        <label for="name" class="col-md-2 col-form-label text-md-left">:المؤهل الدراسي</label>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="offset-6 col-md-2 col-form-label text-md-right">{{$data['person']->street}}</label>
                        <label for="name" class="col-md-2 col-form-label text-md-right">{{$data['person']->building}}</label>
                        <label for="name" class="col-md-2 col-form-label text-md-left">:العنوان</label>
                        <label for="name" class="offset-6 col-md-2 col-form-label text-md-right">{{$data['person']->governorate}}</label>
                        <label for="name" class="col-md-2 col-form-label text-md-right">{{$data['person']->city}}</label>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="offset-7 col-md-3 col-form-label text-md-right">{{$socialState}}</label>
                        <label for="name" class="col-md-2 col-form-label text-md-left">:الحالة الاجتماعية</label>
                    </div>

                    @if($socialState != "اعزب")
                        @if($gender == "ذكر")
                            <div class="form-group row">
                                <label for="name" class="offset-7 col-md-3 col-form-label text-md-right">{{$data['spousessn']}}</label>
                                <label for="name" class="col-md-2 col-form-label text-md-left">:الرقم القومي للزوجة</label>
                            </div>
                            <div class="form-group row">
                                @if($spouseName != null)
                                    <label for="name" class="offset-6 col-md-4 col-form-label text-md-right"><a class="text-decoration-none text-dark" href="{{route('person.show', ['ssn' => $data['spousessn']])}}">{{$spouseName}}</a></label>
                                @else
                                    <label for="name" class="offset-6 col-md-4 col-form-label text-md-right">.لم يتم تسجيل بيانات الزوجة بعد</label>
                                @endif
                                <label for="name" class="col-md-2 col-form-label text-md-left">:اسم الزوجة</label>
                            </div>
                        @elseif($gender == "انثي")
                            <div class="form-group row">
                                <label for="name" class="offset-7 col-md-3 col-form-label text-md-right">{{$data['spousessn']}}</label>
                                <label for="name" class="col-md-2 col-form-label text-md-left">:الرقم القومي للزوج</label>
                            </div>
                            <div class="form-group row">
                                @if($spouseName != null)
                                    <label for="name" class="offset-6 col-md-4 col-form-label text-md-right"><a class="text-decoration-none text-dark" href="{{route('person.show', ['ssn' => $data['spousessn']])}}">{{$spouseName}}</a></label>
                                @else
                                    <label for="name" class="offset-6 col-md-4 col-form-label text-md-right">.لم يتم تسجيل بيانات الزوج بعد</label>
                                @endif
                                <label for="name" class="col-md-2 col-form-label text-md-left">:اسم الزوج</label>
                            </div>
                        @endif
                        <div class="form-group row">
                            <label for="name" class="offset-6 col-md-4 col-form-label text-md-right">{{$data['person']->marriageDate}}</label>
                            <label for="name" class="col-md-2 col-form-label text-md-left">:تاريخ الزواج</label>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="offset-6 col-md-4 col-form-label text-md-right">{{$data['person']->numOfChildren}}</label>
                            <label for="name" class="col-md-2 col-form-label text-md-left">:عدد الابناء</label>
                        </div>

                        @foreach($data['childrenssn'] as $childssn)
                            <div class="form-group row">
                                <label for="name" class="offset-6 col-md-4 col-form-label text-md-right">{{$childssn->memberssn}}</label>
                                <label for="name" class="col-md-2 col-form-label text-md-left">:الرقم القومي للابن {{$childNumber[$childNumberIndex++]}}</label>
                            </div>
                        @endforeach

                        @for($i=0; $i < count($data['childrenssn']); $i++)
                            <div class="form-group row">
                                @if($data['children'] == null || !(array_key_exists($i, $data['children'])))
                                    <label for="name" class="offset-6 col-md-4 col-form-label text-md-right">.لم يتم تسجيل بيانات الابن بعد</label>
                                @else
                                    <label for="name" class="offset-6 col-md-4 col-form-label text-md-right"><a class="text-decoration-none text-dark" href="{{route('person.show', ['ssn' => $data['children'][$i]->ssn])}}">{{$data['children'][$i]->fullName}}</a></label>
                                @endif
                                <label for="name" class="col-md-2 col-form-label text-md-left">:اسم الابن {{$childNumber[$i]}}</label>
                            </div>
                        @endfor
                    @endif
                    <div class="form-group row">
                        <label for="name" class="offset-7 col-md-3 col-form-label text-md-right">{{$servingType}}</label>
                        <label for="name" class="col-md-2 col-form-label text-md-left">:نوع الخدمة</label>
                    </div>

                    @if($gender == "ذكر")
                        <div class="form-group row">
                            <label for="name" class="offset-7 col-md-3 col-form-label text-md-right">{{$deaconLevel}}</label>
                            <label for="name" class="col-md-2 col-form-label text-md-left">:درجة الشموسية</label>
                        </div>

                    @endif

                    <div class="form-group row">
                        <label for="name" class="offset-7 col-md-3 col-form-label text-md-right">{{$data['person']->church}}</label>
                        <label for="name" class="col-md-2 col-form-label text-md-left">:الكنيسة التابع لها</label>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="offset-7 col-md-3 col-form-label text-md-right">{{$data['person']->confessFather}}</label>
                        <label for="name" class="col-md-2 col-form-label text-md-left">:اسم اب الاعتراف</label>
                    </div>
                    <div class="align-self-center mb-2 w-25 non-printable">
                        <a class="btn btn-success d-block" onclick="window.print()" href="#">طباعة</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
