@extends('master.master')

@section('title')
    <title>Register - {{ config('app.name') }}</title>
@endsection

@section('style')
    <style>
        .content {display: flex;flex-direction: column;justify-content: center;}
        .card {max-width: 300px;margin: 0px auto;background: transparent !important;border: 1px solid #38C172;}
        .card-body {background-color: rgba(255,255,255,0.25);}
    </style>
@endsection

@section('content')
    <section class="container-fluid py-3">
        <div class="card">
            <div class="card-header bg-success">
                <h3 class="text-light fw-900">Registration Area</h3>
            </div>
            <div class="card-body">
                @include('components.error')
                @include('components.success')
                <form action="{{ route('register.registration') }}" method="post">
                    @csrf
                    <div class="form-group mb-1">
                        <label for="name" class="text-success">Name <span class="required">*</span>:</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-address-card"></i></span></div>
                            <input type="text" name="name" id="name" placeholder="Name" class="form-control" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="form-group mb-1">
                        <label for="phone-number" class="text-success">Phone Number <span class="required">*</span>:</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-phone"></i></span></div>
                            <input type="text" name="phone_number" id="phone-number" placeholder="e.g XXXX XXXXXXX" data-mask="0000 0000000" value="{{ old('phone_number') }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group mb-1">
                        <label for="cnic" class="text-success">CNIC <span class="required">*</span>:</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-address-card"></i></span></div>
                            <input type="text" name="cnic" id="cnic" placeholder="e.g XXXXX-XXXXXXX-X" data-mask="00000-0000000-0" class="form-control" value="{{ old('cnic') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="text-success">Address <span class="required">*</span>:</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span></div>
                            <input type="text" name="address" id="address" placeholder="Address" class="form-control" value="{{ old('address') }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="offset-6 col-6">
                            <button type="submit" class="btn btn-success float-right"><i class="fas fa-user"></i> Register</button>
                            <br class="clear">
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer bg-success">
                <p class="mb-0 text-center"><a class="text-light" href="{{ route('login.index') }}">Login Here</a></p>
            </div>
        </div>
    </section>
@endsection
