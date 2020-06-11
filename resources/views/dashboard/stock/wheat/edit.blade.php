@extends('master.dashboard-master')

@section('title')
    <title>Edit Stock - {{ config('app.name') }}</title>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('edit_wheat_stock', $stock) }}
@endsection

@section('content')
    <section class="container-fluid py-3">
        <h1 class="text-success fw-900 text-center mb-3">Update Wheat Stock / <span class="text-urdu-kasheeda">چاول کا اسٹاک تبدیل کریں</span></h1>
        <div style="max-width:700px;margin:0px auto;">
            @include('components.error')
            <form action="{{ route('wheatStock.update', base64_encode(($stock->id * 123456789) / 12098)) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <p class="mb-1 col-md-6"><strong>Customer:</strong> {{ $stock->profile->name }}</p>
                    <p class="mb-1 col-md-6"><strong>Phone Number:</strong> {{ $stock->profile->phone_number }}</p>
                    <p class="mb-1 col-md-6"><strong>CNIC:</strong> {{ $stock->profile->cnic }}</p>
                    <p class="mb-1 col-md-6"><strong>Address:</strong> {{ $stock->profile->address }}</p>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no-of-sacks">No of Sacks / <span class="text-urdu-kasheeda">بوریوں کی تعداد</span> <span class="required">*</span>:</label>
                            <input type="text" name="num_of_sacks" id="no-of-sacks" class="form-control" placeholder="No of sacks ..." value="{{ $stock->num_of_sack }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="weight-per-sack">Weight per Sack / <span class="text-urdu-kasheeda">فی بوری وزن</span> <span class="required">*</span>:</label>
                            <input type="text" name="weight_per_sack" id="weight-per-sack" class="form-control" placeholder="Weight per sack ..." value="{{ $stock->weight_per_sack }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price-per-sack">Price per Sack / <span class="text-urdu-kasheeda">فی بوری قیمت</span> <span class="required">*</span>:</label>
                            <input type="text" name="price_per_sack" id="price-per-sack" class="form-control" placeholder="Price per sack ..." value="{{ $stock->price }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="commission">Commission / <span class="text-urdu-kasheeda">منافع</span> <span class="required">*</span>:</label>
                            <input type="text" name="commission" id="commission" class="form-control" placeholder="Commission ..." value="{{ $stock->commission }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category">Category / <span class="text-urdu-kasheeda">گندم کی قسم</span> <span class="required">*</span></label>
                            <select name="category" id="category" class="form-control">
                                <option value="">-- Select --</option>
                                <option value="A" {{ $stock->category == 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ $stock->category == 'B' ? 'selected' : '' }}>B</option>
                                <option value="C" {{ $stock->category == 'C' ? 'selected' : '' }}>C</option>
                                <option value="D" {{ $stock->category == 'D' ? 'selected' : '' }}>D</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-success float-right">Update Stock</button>
                    <a href="{{ route('wheatStock.index') }}" class="btn btn-outline-danger float-right mr-2">Close</a>
                    <br class="clear">
                </div>
            </form>
        </div>
    </section>
@endsection
