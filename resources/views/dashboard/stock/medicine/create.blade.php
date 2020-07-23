@extends('master.dashboard-master')

@section('title')
    <title>Add Medicine Stock for {{ $trader->name ?? 'Unknown Trader' }} - {{ config('app.name') }}</title>
@endsection

@section('style')
    <style>
        .trader {background-color: lightgray; border-radius: 5px;}
        .trader-logo {width: 150px; height: 150px; overflow: hidden;margin: 0px auto;}
    </style>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('create_medicine_stocks', $trader) }}
@endsection

@section('content')
    <section class="container-fluid py-3">
        <div class="row">
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
                <div style="max-width:700px;margin:0px auto;">
                    <h1 class="text-center text-success fw-900 mb-3">Add Medicine Stock <br> <span class="text-urdu-kasheeda">ادویات کا اسٹاک شامل کریں</span></h1>

                    @include('components.error')

                    <form action="{{ route('medicineStock.store', base64_encode(($trader->id * 123456789) / 12098)) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">Medicine Name / <span class="text-urdu-kasheeda">دوائی کا نام</span> <span class="required">*</span>:</label>
                                    <select name="medicine" id="type" class="form-control">
                                        <option value="">-- Select --</option>
                                        @if ($types->count() > 0)
                                            @foreach ($types as $type)
                                                <option value="{{ $type->id . ' ' . $type->type }}" {{ old('medicine') == $type->id . ' ' . $type->type ? 'selected' : '' }}>{{ $type->name . ' (' . $type->type . ')' }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="quantity">Quantity / <span class="text-urdu-kasheeda">مقدار</span> <span class="required">*</span>:</label>
                                    <input type="text" name="quantity" id="quantity" placeholder="Quantity" value="{{ old('quantity') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">Price / <span class="text-urdu-kasheeda">قیمت</span> <span class="required">*</span>:</label>
                                    <input type="text" name="price" id="price" placeholder="Price" value="{{ old('price') }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success float-right">Add Medicine Stock</button>
                            <a href="{{ route('medicineTraders.index') }}" class="btn btn-outline-danger float-right mr-2">Close</a>
                            <br class="clear">
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </section>
@endsection
