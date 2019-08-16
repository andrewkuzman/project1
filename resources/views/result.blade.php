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

                    <table class="table table-striped printable printable-result">
                        <thead>
                        <tr>
                            <th class="non-printable"></th>
                            <th class="text-md-center" scope="col">رقم المحمول</th>
                            <th class="text-md-center" scope="col">الرقم القومي</th>
                            <th class="text-md-center" scope="col">البريد الالكتروني</th>
                            <th class="text-md-center" scope="col">الأسم كامل</th>
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
                                <td class="non-printable">
                                <form class="d-inline" action="{{route('person.destroy', ['ssn' => $person['ssn'], 'query' => $query])}}" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    {{ csrf_field() }}
                                    <input type="submit" onclick="return confirm('هل انت متأكد انك تريد ان تحذف هذا الشخص ؟')" class="btn btn-danger m-lg-1" value="حذف">
                                </form>
                                <a class="btn btn-primary" href="#">تعديل</a>
                                </td>
                                <td class="text-md-center"> {{$person['mobile']}} </td>
                                <td class="text-md-center"> {{$person['ssn']}} </td>
                                <td class="text-md-center"> {{$person['email']}} </td>
                                <td class="text-md-center"> <a class="text-decoration-none text-dark" href="{{route('person.show', ['ssn' => $person['ssn']])}}">{{$person['fullName']}}</a> </td>
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
