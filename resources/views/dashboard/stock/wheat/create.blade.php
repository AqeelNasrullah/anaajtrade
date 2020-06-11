@extends('master.dashboard-master')

@section('title')
    <title>Stock for {{ $profile->name ?? 'Unkown User' }} - {{ config('app.name') }}</title>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('add_wheat_stock', $profile) }}
@endsection

@section('content')
    <section class="container-fluid py-3">
        <div class="row">
            <aside class="col-md-3">
                @include('components.sidebar-profile')
            </aside>
            <main class="col-md-9">
                <h1 class="text-success fw-900 text-center mb-3">Add Wheat Stock / <span class="text-urdu-kasheeda">گندم کا اسٹاک شامل کریں</span></h1>
                <div style="max-width:700px;margin:0px auto;">
                    @include('components.error')
                    <form action="{{ route('wheatStock.store', base64_encode(($profile->id * 123456789) / 12098)) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no-of-sacks">No of Sacks / <span class="text-urdu-kasheeda">بوریوں کی تعداد</span> <span class="required">*</span>:</label>
                                    <input type="text" name="num_of_sacks" id="no-of-sacks" class="form-control" placeholder="No of sacks ..." value="{{ old('num_of_sacks') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="weight-per-sack">Weight per Sack / <span class="text-urdu-kasheeda">فی بوری وزن</span> <span class="required">*</span>:</label>
                                    <input type="text" name="weight_per_sack" id="weight-per-sack" class="form-control" placeholder="Weight per sack ..." value="{{ old('weight_per_sack') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price-per-sack">Price per Sack / <span class="text-urdu-kasheeda">فی بوری قیمت</span> <span class="required">*</span>:</label>
                                    <input type="text" name="price_per_sack" id="price-per-sack" class="form-control" placeholder="Price per sack ..." value="{{ old('price_per_sack') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="commission">Commission / <span class="text-urdu-kasheeda">منافع</span> <span class="required">*</span>:</label>
                                    <input type="text" name="commission" id="commission" class="form-control" placeholder="Commission ..." value="{{ old('commission') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">Category / <span class="text-urdu-kasheeda">گندم کی قسم</span> <span class="required">*</span></label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="">-- Select --</option>
                                        <option value="A" {{ old('category') == 'A' ? 'selected' : '' }}>A</option>
                                        <option value="B" {{ old('category') == 'B' ? 'selected' : '' }}>B</option>
                                        <option value="C" {{ old('category') == 'C' ? 'selected' : '' }}>C</option>
                                        <option value="D" {{ old('category') == 'D' ? 'selected' : '' }}>D</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success float-right">Add Stock</button>
                            <a href="{{ route('profile.show', base64_encode(($profile->id * 123456789) / 12098)) }}" class="btn btn-outline-danger float-right mr-2">Close</a>
                            <br class="clear">
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </section>
@endsection
