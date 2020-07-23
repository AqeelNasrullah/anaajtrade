@extends('master.dashboard-master')

@section('title')
    <title>Edit Medicine Record for {{ $record->profile->name ?? 'Unknown User' }} - {{ config('app.name') }}</title>
@endsection

@section('style')
    <style>
        @media screen and (max-width: 599px) {
            .w-50 {width: 100% !important;}
        }
    </style>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('edit_medicine_records', $record) }}
@endsection

@section('content')
    <section class="container-fluid py-3">
        <div class="w-50 mx-auto">
            <h2 class="text-center text-success mb-3 fw-900">Edit Medicine Record / <span class="text-urdu-kasheeda">دوائی کا ریکارڈ تبدیل کریں</span></h2>
            @if ($record)
            <div class="row">
                <p class="col-md-6 mb-1"><strong>Name:</strong> {{ $record->profile->name }}</p>
                <p class="col-md-6 mb-1"><strong>Phone Number:</strong> {{ $record->profile->phone_number }}</p>
                <p class="col-md-6 mb-1"><strong>CNIC:</strong> {{ $record->profile->cnic }}</p>
                <p class="col-md-6 mb-1"><strong>Address:</strong> {{ $record->profile->address }}</p>
            </div>
            <hr class="mt-0">

            @include('components.error')

            <form action="{{ route('medicineRecord.update', base64_encode(($record->id * 123456789) / 12098)) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="type">Medicine Name / <span class="text-urdu-kasheeda">دوائی کا نام</span> <span class="required">*</span>:</label>
                            <select name="medicine" id="type" class="form-control">
                                <option value="">-- Select --</option>
                                @if ($types->count() > 0)
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id . ' ' . $type->type }}" {{ $type->id == $record->medicine_type_id ? 'selected' : '' }}>{{ $type->name . ' (' . $type->type . ')' }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="quantity">Quantity / <span class="text-urdu-kasheeda">مقدار</span> <span class="required">*</span>:</label>
                            <input type="text" name="quantity" id="quantity" placeholder="Quantity" value="{{ $record->quantity }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="quantity">Price / <span class="text-urdu-kasheeda">قیمت</span> <span class="required">*</span>:</label>
                            <input type="text" name="price" id="price" placeholder="Price" value="{{ $record->price }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="paid">Price paid / <span class="text-urdu-kasheeda">اداشدہ قیمت</span> <span class="required">*</span>:</label>
                            <input type="text" name="paid" id="paid" placeholder="Price" value="{{ $record->paid }}" class="form-control">
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-success float-right">Update Fertilizer Record</button>
                    <a href="{{ route('medicineRecord.index') }}" class="btn btn-outline-danger float-right mr-2">Close</a>
                    <br class="clear">
                </div>
            </form>
            @else
                <p class="mb-0 alert alert-danger w-50 mx-auto text-center font-italic">No record to show.</p>
            @endif
        </div>
    </section>
@endsection
