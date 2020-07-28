@extends('master.master')

@section('title')
    <title>Login - {{ config('app.name') }}</title>
@endsection

@section('style')
    <style>
        .content {display: flex;flex-direction: column;justify-content: center;}
        .card {max-width: 300px;margin: 0px auto;background: transparent !important;border: 1px solid #38C172;}
        .card-body {background-color: rgba(255,255,255,0.25);}
    </style>
@endsection

@section('content')
    <section class="container-fluid">
        <div class="card">
            <div class="card-header bg-success">
                <h3 class="text-light fw-900">Login Area</h3>
            </div>
            <div class="card-body">
                @include('components.error')
                <form action="{{ route('login.loginAttempt') }}" method="post">
                    @csrf
                    <div class="form-group mb-1">
                        <label for="phone-number" class="text-success">Phone Number <span class="required">*</span>:</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-phone"></i></span></div>
                            <input type="text" name="phone_number" id="phone-number" placeholder="e.g XXXX XXXXXXX" data-mask="0000 0000000" value="{{ old('phone_number') }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="text-success">Password <span class="required">*</span>:</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-lock"></i></span></div>
                            <input type="password" name="password" id="password" placeholder="********" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-7 pt-2"><a href="{{ route('resetpassword.index') }}" class="text-success">Forgot Password?</a></div>
                        <div class="col-5">
                            <button type="submit" class="btn btn-success float-right"><i class="fas fa-sign-in-alt"></i> Login</button>
                            <br class="clear">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
