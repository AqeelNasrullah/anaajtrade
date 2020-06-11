@extends('master.dashboard-master')

@section('title')
    <title>{{ $station->name ?? "Filling Station" }} - {{ config('app.name') }}</title>
@endsection

@section('style')
    <style>
        .content {display: flex;flex-direction: column;justify-content: center;}
        .edit-station-card {max-width: 700px;margin: 0px auto;}
    </style>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('edit_filling_stations', $station) }}
@endsection

@section('content')
    <section class="container-fluid">
        <div>
            <h1 class="text-center fw-900 text-success mb-3">Edit Filling Station / <span class="text-urdu-kasheeda">پیٹرول پمپ تبدیل کریں</span></h1>

            <div class="edit-station-card">
                @if ($station)
                <form action="{{ route('fillingStation.update', base64_encode(($station->id * 123456789) / 12098)) }}" method="post">
                    @include('components.error')

                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name / <span class="text-urdu-kasheeda">نام</span> <span class="required">*</span>:</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $station->name }}" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone-number">Phone Number / <span class="text-urdu-kasheeda">فون نمبر</span> <span class="required">*</span>:</label>
                                <input type="text" name="phone_number" id="phone-number" class="form-control" value="{{ $station->phone_number }}" placeholder="Phone Number">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="company">Oil Company / <span class="text-urdu-kasheeda">تیل کی کمپنی</span> <span class="required">*</span>:</label>
                                <select name="company" id="company" class="form-control">
                                    <option value="">-- Select --</option>
                                    @if ($companies->count() > 0)
                                        @foreach ($companies as $company)
                                        <option value="{{ $company->id }}" {{ $station->oil_company_id == $company->id?'selected':'' }}>{{ $company->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Address / <span class="text-urdu-kasheeda">پتہ</span>:</label>
                                <input type="text" name="address" id="address" class="form-control" value="{{ $station->address }}" placeholder="Address">
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success float-right">Update Filling Station</button>
                        <a href="{{ route('fillingStation.index') }}" class="btn btn-outline-danger float-right mr-2">Cancel</a>
                    </div>
                </form>
                @else
                    <h5 class="text-center font-italic">Nothing to show</h5>
                @endif
            </div>
        </div>
    </section>
@endsection
