@extends('master.dashboard-master')

@section('title')
    <title>{{ $station->name ?? "Filling Station" }} - {{ config('app.name') }}</title>
@endsection

@section('style')
    <style>
        .content {display: flex;flex-direction: column;justify-content: center;}
        .station-card {max-width: 500px;margin: 0px auto;}
        .station-logo {width: 75px;height: 75px;border: 1px solid black;border-radius: 5px;overflow: hidden;}
        .station-detail {width: calc(100% - 85px);}
    </style>
@endsection

@section('content')
    <section class="container-fluid">
        <div class="station-card">
            <div class="station-header">
                <div class="station-logo float-left mr-2"><img src="{{ asset('images/logos/'.$station->oilCompany->avatar) }}" alt="Image not found" width="100%"></div>
                <div class="station-detail float-left">
                    <h2 class="fw-900">{{ $station->name }}</h2>
                    <div class="row">
                        <h5 class=" col-md-12 mb-0 fw-700"><i class="fas fa-phone"></i> {{ $station->phone_number }}</h5>
                        <h6 class=" col-md-12 mb-0"><i class="fas fa-map-marker-alt"></i> {{ $station->address }}</h6>
                    </div>
                </div>
                <br class="clear">
            </div>
            <hr>
            <div class="row mb-3">
                <p class="col-md-6 mb-0"><strong>Oil Company:</strong> {{ $station->oilCompany->name }}</p>
                <p class="col-md-6 mb-0"><strong>Company Phone:</strong> {{ $station->oilCompany->phone_number }}</p>
                <p class="col-md-12 mb-0"><strong>Company Address:</strong> {{ $station->oilCompany->address }}</p>
            </div>
            <div>
                <a href="{{ route('fillingStation.index') }}" class="btn btn-success float-right"><i class="fas fa-gas-pump"></i> Filling Stations</a>
                <a href="{{ route('fillingStation.edit', base64_encode(($station->id * 123456789) / 12098)) }}" class="btn btn-outline-danger float-right mr-2"><i class="fas fa-edit"></i> Edit Filling Station</a>
            </div>
        </div>
    </section>
@endsection
