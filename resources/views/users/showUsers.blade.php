@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    @if($type == 'normal')
                        <div class="card-header">المستخدمين</div>
                    @else
                        <div class="card-header">المشرفين</div>
                    @endif

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
                            <th class="text-md-center" scope="col">الأسم كامل</th>
                            <th class="text-md-center" scope="col">اسم المستخدم</th>
                            <th class="text-md-center" scope="col">البريد الالكتروني</th>
                            <th class="non-printable"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($users != null)
                            @foreach ($users as $user)
                                <tr>
                                    <td class="text-md-center"> {{$user->name}}</td>
                                    <td class="text-md-center"> {{$user->username}} </td>
                                    <td class="text-md-center"> {{$user->email}} </td>
                                    <td class="non-printable">
                                        <form class="d-inline" action="{{route('users.destroy', $user->username)}}" method="POST">
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
