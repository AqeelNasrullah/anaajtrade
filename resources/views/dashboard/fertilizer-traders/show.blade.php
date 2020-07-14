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
                <h1 class="text-center text-success fw-900 mb-3">Fertilizer Record / <span class="text-urdu-kasheeda">کھاد کا ریکارڈ</span></h1>
                <p class="alert alert-danger font-italic text-center w-50 mx-auto">Noting to show.</p>
            </main>
        </section>
    </section>
@endsection
