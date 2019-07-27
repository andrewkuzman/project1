@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-md-right">تسجيل دخول</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="username" class="col-md-4 col-form-label text-md-left">اسم المستخدم</label>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <label for="password" class="col-md-4 col-form-label text-md-left">كلمة السر</label>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4 offset-md-4 text-md-right">
                                <div class="form-check">
                                    <label class="form-check-label pr-4" for="remember">
                                        تذكرني
                                    </label>

                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 text-md-right">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link text-md-right" href="{{ route('password.request') }}">
                                        نسيت كلمة السر ؟
                                    </a>
                                @endif
                                <button type="submit" class="btn btn-primary">
                                    تسجيل دخول
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
