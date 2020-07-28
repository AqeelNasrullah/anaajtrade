@extends('master.master')

@section('title')
    <title>Forgot Password - {{ config('app.name') }}</title>
@endsection

@section('style')
    <style>
        .content {display: flex;flex-direction: column;justify-content: center;}
    </style>
@endsection

@section('content')
    <section class="contianer-fluid py-3">
        <div class="mx-auto" style="max-width: 700px;">
            @include('components.error')
            @include('components.success')
            <div class="row">
                <div class="col-md-6 pt-3">
                    <h2 class="text-center text-uppercase fw-900 text-light mb-3">Keep your password secret</h2>
                    <h5 class="text-center text-light">Do not share your password with anyone.</h5>
                </div>
                <div class="col-md-6">
                    <h3 class="text-center text-light mb-2">Password Recorvery</h3>
                    <form action="{{ route('resetpassword.validateCode', $phone) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="code" class="text-light">Verification Code:</label>
                            <input type="text" name="code" id="code" data-mask="000000" placeholder="Verification Code" class="form-control">
                        </div>
                        <div>
                            <a href="{{ route('login.index') }}" class="text-success">Click here to login?</a>
                            <button type="submit" class="btn btn-success float-right">Verify Code</button>
                            <br class="clear">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
