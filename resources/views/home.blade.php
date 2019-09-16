@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">لوحة التحكم</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul class="list-unstyled list-group">
                        <li class="list-group-item">
                            <a class="nav-link" href="{{ route('person.create') }}">تسجيل اشخاص</a>
                        </li>
                        @if (Auth::User()->isSuper == true || Auth::User()->isAdmin == true)
                            <li class="list-group-item">
                                <a class="nav-link" href="{{ route('search') }}">بحث</a>
                            </li>
                            <li class="list-group-item">
                                <a class="nav-link" href="{{ route('register') }}">انشاء حساب</a>
                            </li>
                            <li class="list-group-item">
                                <a class="nav-link" href="{{ route('users.show', 'normal') }}">عرض المستخدمين</a>
                            </li>
                        @endif
                        @if (Auth::User()->isSuper == true)
                            <li class="list-group-item">
                                <a class="nav-link" href="{{ route('users.show', 'admins') }}">عرض المشرفين</a>
                            </li>
                        @else
                            <li class="list-group-item">
                                <a class="nav-link" href="{{ route('password.show') }}">تغيير كلمة السر</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
