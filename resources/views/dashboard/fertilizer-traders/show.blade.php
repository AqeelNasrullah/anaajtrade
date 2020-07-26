@extends('master.dashboard-master')

@section('title')
    <title>View {{ $trader->name ?? 'Unknown Trader' }} - {{ config('app.name') }}</title>
@endsection

@section('style')
    <style>
        .trader {background-color: lightgray; border-radius: 5px;}
        .trader-logo {width: 150px; height: 150px; overflow: hidden;margin: 0px auto;}
    </style>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('view_fertilizer_traders', $trader) }}
@endsection

@section('content')
    <section class="container-fluid py-3">
        <section class="row">
            <aside class="col-md-3">
                <div class="p-3 trader">
                    <div class="trader-logo mb-2">
                        <img src="{{ asset('images/logos/' . $trader->avatar) }}" width="100%" alt="Image not found">
                    </div>
                    <div>
                        <h4 class="text-center fw-900 mb-1">{{ $trader->name ?? 'Unknown User' }}</h4>
                        <h6 class="text-center mb-1"><i class="fas fa-phone"></i> {{ $trader->phone_number }}</h6>
                        <h6 class="text-center"><i class="fas fa-map-marker-alt"></i> {{ $trader->address }}</h6>
                    </div>
                </div>
            </aside>
            <main class="col-md-9">
                <div class="mb-3">
                    <a href="{{ route('fertilizerStock.create', base64_encode(($trader->id * 123456789) / 12098)) }}" class="float-right btn btn-success"><i class="fas fa-plus"></i> Add Fertilizer Stock</a>
                    <br class="clear">
                </div>
                <h1 class="text-center text-success fw-900 mb-3">Fertilizer Stocks / <span class="text-urdu-kasheeda">کھاد کا اسٹاک</span></h1>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="table-success">
                            <tr>
                                <th>Quantity / <span class="text-urdu-kasheeda">مقدار</span></th>
                                <th>Weight per Sack / <span class="text-urdu-kasheeda">فی بوری وزن</span></th>
                                <th>Price per Sack / <span class="text-urdu-kasheeda">فی بوری قیمت</span></th>
                                <th>Total Price / <span class="text-urdu-kasheeda">کل قیمت</span></th>
                                <th>Type / <span class="text-urdu-kasheeda">قسم</span></th>
                                <th>Date &amp; Time / <span class="text-urdu-kasheeda">تاریخ اور وقت</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($stocks as $stock)
                                <tr>
                                    <td>{{ $stock->quantity }} Sacks</td>
                                    <td>{{ $stock->weight }} Kgs</td>
                                    <td>Rs {{ $stock->price }} /-</td>
                                    <td>Rs {{ $stock->quantity * $stock->price }} /-</td>
                                    <td>{{ $stock->type }}</td>
                                    <td>{{ date('d-F-Y h:i A', strtotime($stock->created_at)) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center font-italic">No record to show.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </main>
        </section>
    </section>
@endsection
