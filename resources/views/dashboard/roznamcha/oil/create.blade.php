@extends('master.dashboard-master')

@section('title')
    <title>Generate Slip - {{ config('app.name') }}</title>
@endsection

@section('style')
    <style>
        .slip {max-width:600px;}
        .slip-logo {width: 100px; float: left; margin-right: 15px;}
        .slip-detail {width: calc(100% - 115px);float: left;}
    </style>
@endsection

@section('content')
    <section class="content-fluid py-3">
        @if ($station && $profile)
        <div class="slip mx-auto">
            <div class="slip-header">
                <div class="slip-logo"><img src="{{ asset('images/logos/'.$station->oilCompany->avatar) }}" width="100%" alt="Image not found"></div>
                <div class="slip-detail pt-2">
                    <h2 class="fw-900">{{ $station->name }}</h2>
                    <div>
                        <h5 class="float-left mr-5"><i class="fas fa-gas-pump"></i> {{ $station->oilCompany->name }}</h5>
                        <h5 class="float-left"><i class="fas fa-phone"></i> {{ $station->phone_number }}</h5>
                        <br class="clear">
                    </div>
                    <h5><i class="fas fa-map-marker-alt"></i> {{ $station->address }}</h5>
                </div>
                <br class="clear">
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <h3 class="fw-700 mb-2">Commission Agent</h3>
                    <p class="mb-1"><i class="fas fa-address-card"></i> {{ auth()->user()->profile->name }}</p>
                    <p class="mb-1"><i class="fas fa-address-card"></i> {{ auth()->user()->profile->cnic }}</p>
                    <p class="mb-1"><i class="fas fa-phone"></i> {{ auth()->user()->profile->phone_number }}</p>
                    <p class="mb-1"><i class="fas fa-map-marker-alt"></i> {{ auth()->user()->profile->address }}</p>
                </div>
                <div class="col-md-6">
                    <h3 class="fw-700 mb-2">Customer</h3>
                    <p class="mb-1"><i class="fas fa-address-card"></i> {{ $profile->name }}</p>
                    <p class="mb-1"><i class="fas fa-address-card"></i> {{ $profile->cnic }}</p>
                    <p class="mb-1"><i class="fas fa-phone"></i> {{ $profile->phone_number }}</p>
                    <p class="mb-1"><i class="fas fa-map-marker-alt"></i> {{ $profile->address }}</p>
                </div>
            </div>
            <hr>
            <div>
                @include('components.error')
                <form action="{{ route('oilRecord.store', [base64_encode(($profile->id * 123456789) / 12098), base64_encode(($station->id * 123456789) / 12098)]) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="quantity">Quantity / <span class="text-urdu-kasheeda">مقدار</span> <span class="required">*</span></label>
                        <input type="text" name="quantity" id="quantity" placeholder="Quantity" class="form-control" value="{{ old('quantity') }}">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success float-right">Create Record</button>
                        <a href="{{ route('oilRecord.fillingStations', base64_encode(($profile->id * 123456789) / 12098)) }}" class="btn btn-outline-danger float-right mr-2">Close</a>
                        <br class="clear">
                    </div>
                </form>
            </div>
        </div>
        @else
            <div class="alert alert-danger w-50 mx-auto">No record to show.</div>
        @endif
    </section>
@endsection
