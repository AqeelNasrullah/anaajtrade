@extends('master.dashboard-master')

@section('title')
    <title>Filling Stations - {{ config('app.name') }}</title>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('filling_stations_oil_records', $profile) }}
@endsection

@section('content')
    <section class="container-fluid py-3">
        <div class="row">
            <aside class="col-md-3">
                @include('components.sidebar-profile')
            </aside>
            <main class="col-md-9">
                <h1 class="text-success text-center mb-3 fw-900">Filling Stations / <span class="text-urdu-kasheeda">پیٹرول پمپ</span></h1>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="table-success">
                            <tr>
                                <th></th>
                                <th class="align-middle">Name / <span class="text-urdu-kasheeda">نام</span></th>
                                <th class="align-middle">Oil Company / <span class="text-urdu-kasheeda">تیل کی کمپنی</span></th>
                                <th class="align-middle">Phone Number / <span class="text-urdu-kasheeda">فون نمبر</span></th>
                                <th class="align-middle">Address / <span class="text-urdu-kasheeda">پتہ</span></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($stations->count() > 0)
                            @foreach ($stations as $station)
                                <tr>
                                    <td class="align-middle"><img src="{{ asset('/images/logos/'. $station->oilCompany->avatar) }}" width="45px" alt="Image not found"></td>
                                    <td class="fw-700 align-middle">{{ $station->name }}</td>
                                    <td class="align-middle">{{ $station->oilCompany->name }}</td>
                                    <td class="align-middle">{{ $station->phone_number }}</td>
                                    <td class="align-middle">{{ $station->address }}</td>
                                    <td class="align-middle"><a href="{{ route('oilRecord.create', [base64_encode(($profile->id * 123456789) / 12098), base64_encode(($station->id * 123456789) / 12098)]) }}" class="btn btn-success">Generate Slip</a></td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center font-italic">No record to show.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </section>
@endsection
