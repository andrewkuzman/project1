@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">نتائج البحث</div>

                    <div class="card-body text-md-left">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>

                    <table class="table table-striped printable printable-result">
                        <thead>
                        <tr>
                            <th class="text-md-center" scope="col">الأسم كامل</th>
                            <th class="text-md-center" scope="col">البريد الالكتروني</th>
                            <th class="text-md-center" scope="col">الرقم القومي</th>
                            <th class="text-md-center" scope="col">رقم المحمول</th>
                            <th class="non-printable"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            use Illuminate\Support\Facades\Input;
                            $query = Input::get('query');
                        @endphp
                        @if($result != null)
                            @foreach ($result as $person)
                                <tr>
                                    <td class="text-md-center"> <a class="text-decoration-none text-dark" href="{{route('person.show', ['ssn' => $person['ssn']])}}">{{$person['fullName']}}</a> </td>
                                    <td class="text-md-center"> {{$person['email']}} </td>
                                    <td class="text-md-center"> {{$person['ssn']}} </td>
                                    <td class="text-md-center"> {{$person['mobile']}} </td>
                                    <td class="non-printable">
                                        <a class="btn btn-primary" href="{{route('person.edit', ['ssn' => $person['ssn']])}}">تعديل</a>
                                        <form class="d-inline" action="{{route('person.destroy', ['ssn' => $person['ssn'], 'query' => $query])}}" method="POST">
                                            <input type="hidden" name="_method" value="DELETE">
                                            {{ csrf_field() }}
                                            <input type="submit" onclick="return confirm('هل انت متأكد انك تريد ان تحذف هذا الشخص ؟')" class="btn btn-danger m-lg-1" value="حذف">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <div class="align-self-center mb-2 w-25">
                        <a class="btn btn-success d-block" onclick="window.print()" href="#">طباعة</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
