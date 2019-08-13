@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header text-md-right">نتائج البحث</div>

                    <div class="card-body text-md-right">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th></th>
                            <th class="text-md-center" scope="col">رقم المحمول</th>
                            <th class="text-md-center" scope="col">الرقم القومي</th>
                            <th class="text-md-center" scope="col">البريد الالكتروني</th>
                            <th class="text-md-center" scope="col">الأسم كامل</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if($result != null)
                            @php
                                $index = -1;
                            @endphp
                            @foreach ($result as $person)
                                @php
                                    $index++;
                                @endphp
                                <tr>
                                <td>
                                <a class="btn btn-primary" href="#">تعديل</a>
                                <a class="btn btn-danger m-lg-1" href="{{route('person.destroy', ['result' => $result, 'index' => $index])}}">حذف</a>
                                </td>
                                <td class="text-md-center"> {{$person['mobile']}} </td>
                                <td class="text-md-center"> {{$person['ssn']}} </td>
                                <td class="text-md-center"> {{$person['email']}} </td>
                                <td class="text-md-center"> {{$person['fullName']}} </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
