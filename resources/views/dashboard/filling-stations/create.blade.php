@extends('master.dashboard-master')

@section('title')
    <title>Create Filling Station - {{ config('app.name') }}</title>
@endsection

@section('style')
    <style>
        .content {display: flex;flex-direction: column;justify-content: center;}
        .station-form {max-width:750px;margin:0px auto;}
    </style>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('add_filling_stations') }}
@endsection

@section('content')
    <section class="container-fluid">
        <h1 class="text-center text-success mb-3 fw-900">Create Filling Station / <span class="text-urdu-kasheeda">پیٹرول پمپ شامل کریں</span></h1>
        <div class="station-form">
            @include('components.error')
            @include('components.success')

            <form action="{{ route('fillingStation.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name <span class="required">*</span>:</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone-number">Phone Number <span class="required">*</span>:</label>
                            <input type="text" name="phone_number" id="phone-number" value="{{ old('phone_number') }}" class="form-control" placeholder="Phone Number">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="company">Company <span class="required">*</span>:</label>
                            <select name="company" id="company" class="form-control">
                                <option value="">-- Select --</option>
                                @if ($companies->count() > 0)
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}" {{ old('company') == $company->id ? 'selected':'' }}>{{ $company->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" name="address" id="address" value="{{ old('address') }}" class="form-control" placeholder="Address">
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-success float-right">Add Filling Station</button>
                    <br class="clear">
                </div>
            </form>
        </div>
    </section>
@endsection
