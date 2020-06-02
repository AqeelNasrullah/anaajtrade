@extends('master.dashboard-master')

@section('title')
    <title>{{ $profile->name ?? 'Unknown User' }} - {{ config('app.name') }}</title>
@endsection

@section('style')
    <style>
        .content {display: flex;flex-direction: column;justify-content: center;}
        .avatar {width: 100px;height: 100px;overflow: hidden;}
    </style>
@endsection

@section('content')
    <section class="container-fluid py-3">
        @if ($profile)
        <div class="mx-auto p-3" style="max-width: 500px;border-radius: 5px;">
            <div class="profile-header">
                <div class="avatar float-left mr-3" style="border: 1px solid black;border-radius: 5px;overflow: hidden;">
                    <img src="{{ asset('images/dps/' . $profile->avatar) }}" width="100%" alt="Image not found">
                </div>
                <div class="float-left">
                    <h3 class="mb-1 fw-700">{{ $profile->name ?? 'Unknown User' }}</h3>
                    <h5 class="fw-700">{{ 'S/O ' . $profile->father_name }}</h5>
                    <h5 class="fw-700"><i class="fas fa-address-card"></i> {{ $profile->cnic }}</h5>
                    <h5 class="fw-700"><i class="fas fa-phone"></i> {{ $profile->phone_number }}</h5>
                </div>
                <br class="clear">
            </div>
            <hr>
            <div>
                <div class="row mb-3">
                    <p class="col-md-6 mb-0"><strong>Property:</strong> {{ $profile->property . ' Acres' }}</p>
                    <p class="col-md-6 mb-0"><strong>Role:</strong> {{ $profile->role->name }}</p>
                    <p class="col-12 mb-0"><strong>Address:</strong> {{ $profile->address }}</p>
                </div>
                <div>
                    <a href="{{ route('profile.index') }}" class="btn btn-success float-right"><i class="fas fa-users"></i> Customers</a>
                    <a href="{{ route('profile.edit', base64_encode(($profile->id * 123456789) / 12098)) }}" class="btn btn-outline-success float-right mr-2"><i class="fas fa-edit"></i> Edit Customers</a>
                    <br class="clear">
                </div>
            </div>
        </div>
        @else
            <h3 class="text-center font-italic">Nothing to Show</h3>
        @endif
    </section>
@endsection
