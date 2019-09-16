@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('تغيير كلمة السر') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.change') }}">
                        @csrf

                        @if(session()->has('error'))
                            <ul dir="rtl" class="text-left alert alert-danger">
                                <li>{{ session()->get('error') }}</li>
                            </ul>
                        @endif
                        @if(session()->has('success'))
                            <ul dir="rtl" class="text-left alert alert-success">
                                <li>{{ session()->get('success') }}</li>
                            </ul>
                        @endif
                        @if(session()->has('failure'))
                            <ul dir="rtl" class="text-left alert alert-danger">
                                <li>{{ session()->get('failure') }}</li>
                            </ul>
                        @endif
                        @if(session()->has('info'))
                            <ul dir="rtl" class="text-left alert alert-info">
                                <li>{{ session()->get('info') }}</li>
                            </ul>
                        @endif

                        <input type="hidden" name="id" value="{{ $user_id }}">

                        <div class="form-group row">
                            <label for="currentPassword" class="col-md-4 col-form-label text-md-right">{{ __('كلمة السر الحالية') }}</label>

                            <div class="col-md-6">
                                <input id="currentPassword" type="password" class="form-control @error('currentPassword') is-invalid @enderror" name="currentPassword" value="{{ $currentPassword ?? old('currentPassword') }}" required autocomplete="currentPassword" autofocus>

                                @error('currentPassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('كلمة السر الجديدة') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('تأكيد كلمة السر') }}</label>

                            <div class="col-md-6">
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('تغيير كلمة السر') }}
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
