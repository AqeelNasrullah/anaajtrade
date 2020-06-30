@extends('master.dashboard-master')

@section('title')
    <title>Roznamcha - {{ config('app.name') }}</title>
@endsection

@section('style')
    <style>
        .content {display: flex;flex-direction: column;justify-content: center;}
    </style>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('roznamcha') }}
@endsection

@section('content')
    <section>
        <div class="container">
            <h1 class="text-center text-success fw-900 mb-3">Roznamcha / <span class="text-urdu-kasheeda">روزنامچہ</span></h1>
            <div class="row">
                <div class="col-md-4 px-3 mb-3">
                    <a href="{{ route('accountBook.index') }}" class="text-light">
                        <div class="bg-success px-2 py-4" style="border-radius: 5px;">
                            <h4 class="text-center fw-700">Account Book<br><span class="text-urdu-kasheeda">کھاتہ</span></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 px-3 mb-3">
                    <a href="{{ route('oilRecord.index') }}" class="text-light">
                        <div class="bg-success px-2 py-4" style="border-radius: 5px;">
                            <h4 class="text-center fw-700">Oil<br><span class="text-urdu-kasheeda">تیل</span></h4>
                        </div>
                    </a>
                </div>
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
                    <a href="{{ route('wheatRecord.index') }}" class="text-light">
                        <div class="bg-success px-2 py-4" style="border-radius: 5px;">
                            <h4 class="text-center fw-700">Wheat<br><span class="text-urdu-kasheeda">کندم</span></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 px-3 mb-3">
                    <a href="{{ route('riceRecord.index') }}" class="text-light">
                        <div class="bg-success px-2 py-4" style="border-radius: 5px;">
                            <h4 class="text-center fw-700">Rice<br><span class="text-urdu-kasheeda">چاول</span></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 px-3">
                    <a href="" class="text-light">
                        <div class="bg-success px-2 py-4" style="border-radius: 5px;">
                            <h4 class="text-center fw-700">Others<br><span class="text-urdu-kasheeda">دیگر اشیاء</span></h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
