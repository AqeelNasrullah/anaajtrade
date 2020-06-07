@extends('master.dashboard-master')

@section('title')
    <title>Stock - {{ config('app.name') }}</title>
@endsection

@section('style')
    <style>
        .content {display: flex;flex-direction: column;justify-content: center;}
    </style>
@endsection

@section('content')
    <section>
        <div class="container py-3">
            <h1 class="text-success text-center fw-900 mb-3">Stock / <span class="text-urdu-kasheeda">اسٹاک</span></h1>

            <div class="row">
                <div class="col-md-4 px-3 mb-3">
                    <a href="" class="text-light">
                        <div class="bg-success px-2 py-4" style="border-radius: 5px;">
                            <h4 class="text-center fw-700">Fertilizer<br><span class="text-urdu-kasheeda">کھاد</span></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 px-3 mb-3">
                    <a href="" class="text-light">
                        <div class="bg-success px-2 py-4" style="border-radius: 5px;">
                            <h4 class="text-center fw-700">Agricultural Medicine<br><span class="text-urdu-kasheeda">زرعی ادویات</span></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 px-3 mb-3">
                    <a href="{{ route('wheatStock.index') }}" class="text-light">
                        <div class="bg-success px-2 py-4" style="border-radius: 5px;">
                            <h4 class="text-center fw-700">Wheat<br><span class="text-urdu-kasheeda">گندم</span></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 px-3 mb-3">
                    <a href="" class="text-light">
                        <div class="bg-success px-2 py-4" style="border-radius: 5px;">
                            <h4 class="text-center fw-700">Rice<br><span class="text-urdu-kasheeda">چاول</span></h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
