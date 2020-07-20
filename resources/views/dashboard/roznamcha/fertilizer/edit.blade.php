@extends('master.dashboard-master')

@section('title')
    <title>Edit Fertilizer Record for {{ $record->profile->name ?? 'Unknown User' }} - {{ config('app.name') }}</title>
@endsection

@section('style')
    <style>
        @media screen and (max-width: 599px) {
            .w-50 {width: 100% !important;}
        }
    </style>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('edit_fertilizer_records', $record) }}
@endsection

@section('content')
    <section class="container-fluid py-3">
        <div class="w-50 mx-auto">
            <h2 class="text-center text-success mb-3 fw-900">Edit Fertilizer Record / <span class="text-urdu-kasheeda">کھاد کا ریکارڈ تبدیل کریں</span></h2>
            @if ($record)
            <div class="row">
                <p class="col-md-6 mb-1"><strong>Name:</strong> {{ $record->profile->name }}</p>
                <p class="col-md-6 mb-1"><strong>Phone Number:</strong> {{ $record->profile->phone_number }}</p>
                <p class="col-md-6 mb-1"><strong>CNIC:</strong> {{ $record->profile->cnic }}</p>
                <p class="col-md-6 mb-1"><strong>Address:</strong> {{ $record->profile->address }}</p>
            </div>
            <hr class="mt-0">

            @include('components.error')

            <form action="{{ route('fertilizerRecord.update', base64_encode(($record->id * 123456789) / 12098)) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="quantity">Quantity / <span class="text-urdu-kasheeda">مقدار</span> <span class="required">*</span>:</label>
                            <input type="text" name="quantity" id="quantity" placeholder="Quantity" value="{{ $record->quantity }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="weight">Weigth per sack / <span class="text-urdu-kasheeda">فی بوری وزن</span> <span class="required">*</span>:</label>
                            <input type="text" name="weight" id="weight" placeholder="Weight" value="{{ $record->weight }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="quantity">Price per sack / <span class="text-urdu-kasheeda">فی بوری قیمت</span> <span class="required">*</span>:</label>
                            <input type="text" name="price" id="price" placeholder="Price" value="{{ $record->price }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="paid">Price paid per sack / <span class="text-urdu-kasheeda">فی بوری اداشدہ قیمت</span> <span class="required">*</span>:</label>
                            <input type="text" name="paid" id="paid" placeholder="Price" value="{{ $record->paid }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="type">Fertilizer Type / <span class="text-urdu-kasheeda">کھاد کی قسم</span> <span class="required">*</span>:</label>
                            <select name="type" id="type" class="form-control">
                                <option value="">-- Select --</option>
                                <option value="Urea" {{ $record->type == 'Urea' ? 'selected' : '' }}>Urea</option>
                                <option value="DAP" {{ $record->type == 'DAP' ? 'selected' : '' }}>DAP</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-success float-right">Update Fertilizer Record</button>
                    <a href="{{ route('fertilizerRecord.index') }}" class="btn btn-outline-danger float-right mr-2">Close</a>
                    <br class="clear">
                </div>
            </form>
            @else
                <p class="mb-0 alert alert-danger w-50 mx-auto text-center font-italic">No record to show.</p>
            @endif
        </div>
    </section>
@endsection
