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
                    <h3 class="text-center text-light mb-2">Reset Password</h3>
                    <form action="" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="new_pass" class="text-light">New Password:</label>
                            <input type="password" name="new_password" id="new_pass" placeholder="New Password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="re_new_pass" class="text-light">Retype New Password:</label>
                            <input type="password" name="retype_new_password" id="re_new_pass" placeholder="Retype New Password" class="form-control">
                        </div>
                        <div>
                            <a href="{{ route('login.index') }}" class="text-success">Click here to login?</a>
                            <button type="submit" class="btn btn-success float-right">Update Password</button>
                            <br class="clear">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
