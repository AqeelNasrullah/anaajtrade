@extends('master.dashboard-master')

@section('title')
    <title>Dashboard - {{ config('app.name') }}</title>
@endsection

@section('style')
    <style>
        .content {display: flex;flex-direction: column;justify-content: center;}
    </style>
@endsection

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-3 p-3">
                    <a href="" class="text-light">
                        <div class="bg-success p-3" style="border-radius: 5px;">
                            <h1 class="text-center mb-3"><i class="fas fa-address-book"></i></h1>
                            <h4 class="text-center">Roznamcha <br> <span class="text-urdu-kasheeda">روزنامچہ</span></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 p-3">
                    <a href="" class="text-light">
                        <div class="bg-success p-3" style="border-radius: 5px;">
                            <h1 class="text-center mb-3"><i class="fas fa-database"></i></h1>
                            <h4 class="text-center">Oil <br> <span class="text-urdu-kasheeda">تیل</span></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 p-3">
                    <a href="" class="text-light">
                        <div class="bg-success p-3" style="border-radius: 5px;">
                            <h1 class="text-center mb-3"><i class="fas fa-dollar-sign"></i></h1>
                            <h4 class="text-center">Prices <br> <span class="text-urdu-kasheeda">قیمتیں</span></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 p-3">
                    <a href="{{ route('profile.index') }}" class="text-light">
                        <div class="bg-success p-3" style="border-radius: 5px;">
                            <h1 class="text-center mb-3"><i class="fas fa-users"></i></h1>
                            <h4 class="text-center">Customers <br> <span class="text-urdu-kasheeda">خریدار</span></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 p-3">
                    <a href="{{ route('fillingStation.index') }}" class="text-light">
                        <div class="bg-success p-3" style="border-radius: 5px;">
                            <h1 class="text-center mb-3"><i class="fas fa-gas-pump"></i></h1>
                            <h4 class="text-center">Filling Stations <br> <span class="text-urdu-kasheeda">پیٹرول پمپ</span></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 p-3">
                    <a href="" class="text-light">
                        <div class="bg-success p-3" style="border-radius: 5px;">
                            <h1 class="text-center mb-3"><i class="fas fa-layer-group"></i></h1>
                            <h4 class="text-center">Fertilizer Traders <br> <span class="text-urdu-kasheeda">کھاد کے تاجر</span></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 p-3">
                    <a href="" class="text-light">
                        <div class="bg-success p-3" style="border-radius: 5px;">
                            <h1 class="text-center mb-3"><i class="fas fa-file-prescription"></i></h1>
                            <h4 class="text-center">Medicine Traders <br> <span class="text-urdu-kasheeda">ادویات کے تاجر</span></h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
