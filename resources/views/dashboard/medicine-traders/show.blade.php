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
    {{ Breadcrumbs::render('view_medicine_traders', $trader) }}
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
                <div class="d-flex mb-3" style="justify-content: space-between;">
                    <h4><strong>Stock: 3000 Sacks</strong></h4>
                    <a href="{{ route('medicineStock.create', base64_encode(($trader->id * 123456789) / 12098)) }}" class="btn btn-success"><i class="fas fa-plus"></i> Add Medicine Stock</a>
                </div>
                <h1 class="text-center text-success fw-900 mb-3">Medicine Stocks / <span class="text-urdu-kasheeda">ادویات کا اسٹاک</span></h1>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="table-success">
                            <tr>
                                <th>Medicine Type / <span class="text-urdu-kasheeda">دوائی کی قسم</span></th>
                                <th>Medicine Name / <span class="text-urdu-kasheeda">دوائی کانام</span></th>
                                <th>Quantity / <span class="text-urdu-kasheeda">مقدار</span></th>
                                <th>Price / <span class="text-urdu-kasheeda">قیمت</span></th>
                                <th>Total Price / <span class="text-urdu-kasheeda">کل قیمت</span></th>
                                <th>Date &amp; Time / <span class="text-urdu-kasheeda">تاریخ اور وقت</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($stocks as $stock)
                                <tr>
                                    <td>{{ $stock->medicineType->type }}</td>
                                    <td>{{ $stock->medicineType->name }}</td>
                                    <td>{{ $stock->quantity }}</td>
                                    <td>Rs {{ $stock->price }} /-</td>
                                    <td>Rs {{ $stock->quantity * $stock->price }} /-</td>
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
