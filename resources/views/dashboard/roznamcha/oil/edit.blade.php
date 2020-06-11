@extends('master.dashboard-master')

@section('title')
    <title>Edit Bill - {{ config('app.name') }}</title>
@endsection

@section('style')
    <style>
        .slip {max-width:600px;}
        .slip-logo {width: 100px; float: left; margin-right: 15px;}
        .slip-detail {width: calc(100% - 115px);float: left;}
    </style>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('edit_oil_records', $record) }}
@endsection

@section('content')
    <section class="content-fluid py-3">
        @if ($record)
        <div class="slip mx-auto">
            <div class="slip-header">
                <div class="slip-logo"><img src="{{ asset('images/logos/'.$record->fillingStation->oilCompany->avatar) }}" width="100%" alt="Image not found"></div>
                <div class="slip-detail pt-2">
                    <h2 class="fw-900">{{ $record->fillingStation->name }}</h2>
                    <div>
                        <h5 class="float-left mr-5"><i class="fas fa-gas-pump"></i> {{ $record->fillingStation->oilCompany->name }}</h5>
                        <h5 class="float-left"><i class="fas fa-phone"></i> {{ $record->fillingStation->phone_number }}</h5>
                        <br class="clear">
                    </div>
                    <h5><i class="fas fa-map-marker-alt"></i> {{ $record->fillingStation->address }}</h5>
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
                    <p class="mb-1"><i class="fas fa-address-card"></i> {{ $record->profile->name }}</p>
                    <p class="mb-1"><i class="fas fa-address-card"></i> {{ $record->profile->cnic }}</p>
                    <p class="mb-1"><i class="fas fa-phone"></i> {{ $record->profile->phone_number }}</p>
                    <p class="mb-1"><i class="fas fa-map-marker-alt"></i> {{ $record->profile->address }}</p>
                </div>
            </div>
            <hr>
            <div>
                @include('components.error')
                <form action="{{ route('oilRecord.update', base64_encode(($record->id * 123456789) / 12098)) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price">Price per Litre / <span class="text-urdu-kasheeda">قیمت فی لٹر</span> <span class="required">*</span></label>
                                <input type="text" name="price_per_litre" id="price" placeholder="Price per Litre ..." value="{{ $record->price_per_litre }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="paid">Paid per Litre / <span class="text-urdu-kasheeda">فی لٹر ادائیگی</span> <span class="required">*</span></label>
                                <input type="text" name="paid_per_litre" id="paid" placeholder="Paid per Litre ..." value="{{ $record->paid_per_litre }}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success float-right">Update Bill</button>
                        <a href="{{ route('oilRecord.index') }}" class="btn btn-outline-danger float-right mr-2">Cancel</a>
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
