@extends('master.dashboard-master')

@section('title')
    <title>Edit Fertilizer Stock for {{ $stock->fertilizerTrader->name ?? 'Unknown Trader' }} - {{ config('app.name') }}</title>
@endsection

@section('style')
    <style>
        .slip-header .logo {width: 75px;height: 75px;overflow: hidden;float:left;margin-right: 15px;}
        .slip-header .txt {width: calc('100% - 90px');float: left;}

        @media screen and (max-width: 699px) {
            .w-50 {width: 100% !important;}
        }
    </style>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('edit_fertilizer_stocks', $stock) }}
@endsection

@section('content')
    <section class="container-fluid py-3">
        <div class="w-50 mx-auto">
            @if ($stock)
                <div class="edit-form">
                    <div class="slip-header">
                        <div class="logo"><img src="{{ asset('images/logos/' . $stock->fertilizerTrader->avatar) }}" width="100%" alt="Image not found"></div>
                        <div class="txt">
                            <h1 class="fw-900 mb-1">{{ $stock->fertilizerTrader->name }}</h1>
                            <p><span><i class="fas fa-phone"></i> {{ $stock->fertilizerTrader->phone_number }}</span> &nbsp;&nbsp;&nbsp; <span><i class="fas fa-map-marker-alt"></i> {{ $stock->fertilizerTrader->address }}</span></p>
                        </div>
                        <br class="clear">
                    </div>
                    <hr class="mt-0">
                    <div class="slip-body">
                        <h4 class="mb-3 fw-700">Commission Agent</h4>
                        <div class="row">
                            <p class="col-md-6 mb-1"><i class="fas fa-address-card"></i> &nbsp; {{ $stock->user->profile->name }}</p>
                            <p class="col-md-6 mb-1"><i class="fas fa-address-card"></i> &nbsp; {{ $stock->user->profile->cnic }}</p>
                            <p class="col-md-6 mb-0"><i class="fas fa-phone"></i> &nbsp; {{ $stock->user->profile->phone_number }}</p>
                            <p class="col-md-6 mb-0"><i class="fas fa-map-marker-alt"></i> &nbsp; {{ $stock->user->profile->address }}</p>
                        </div>
                        <hr>
                        <h4 class="mb-3 fw-700">Edit Fertilizer Stock / <span class="text-urdu-kasheeda">کھاد کا اسٹاک تبدیل کریں</span></h4>

                        @include('components.error')

                        <form action="{{ route('fertilizerStock.update', base64_encode(($stock->id * 123456789) / 12098)) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="quantity">Quantity / <span class="text-urdu-kasheeda">مقدار</span> <span class="required">*</span>:</label>
                                        <input type="text" name="quantity" id="quantity" class="form-control" value="{{ $stock->quantity }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="weight">Weight / <span class="text-urdu-kasheeda">وزن</span> <span class="required">*</span>:</label>
                                        <input type="text" name="weight" id="quantity" class="form-control" value="{{ $stock->weight }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">Price / <span class="text-urdu-kasheeda">قیمت</span> <span class="required">*</span>:</label>
                                        <input type="text" name="price" id="price" class="form-control" value="{{ $stock->price }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">Fertilizer Type / <span class="text-urdu-kasheeda">کھاد کی قسم</span> <span class="required">*</span>:</label>
                                        <select name="type" id="type" class="form-control">
                                            <option value="">-- Select --</option>
                                            <option value="Urea" {{ $stock->type == 'Urea' ? 'selected' : '' }}>Urea</option>
                                            <option value="DAP" {{ $stock->type == 'DAP' ? 'selected' : '' }}>DAP</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-success float-right">Update Fertilizer Stock</button>
                                <a href="{{ route('fertilizerStock.index') }}" class="btn btn-outline-danger float-right mr-2">Close</a>
                                <br class="clear">
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <p class="mb-0 alert alert-danger w-50 mx-auto text-center font-italic">No record to show.</p>
            @endif
        </div>
    </section>
@endsection
