@extends('master.dashboard-master')

@section('title')
    <title>Add Wheat Record for {{ $profile->name ?? 'Unknown User' }} - {{ config('app.name') }}</title>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('add_wheat_records', $profile) }}
@endsection

@section('content')
    <section class="container-fluid py-3">
        <div class="row">
            <aside class="col-md-3">
                @include('components.sidebar-profile')
                <div class="mb-3">
                    <h5 class="alert alert-success mt-3"><strong>Quality A:</strong> {{ $stock['A'] }} Kgs</h5>
                    <h5 class="alert alert-success mt-3"><strong>Quality B:</strong> {{ $stock['B'] }} Kgs</h5>
                    <h5 class="alert alert-success mt-3"><strong>Quality C:</strong> {{ $stock['C'] }} Kgs</h5>
                    <h5 class="alert alert-success mt-3"><strong>Quality D:</strong> {{ $stock['D'] }} Kgs</h5>
                </div>
            </aside>
            <main class="col-md-9">
                <h1 class="text-center mb-3 text-success fw-900">Add Wheat Record / <span class="text-urdu-kasheeda">گندم کا ریکارڈ شامل کریں</span></h1>

                    <div style="max-width:700px;margin:0px auto;position: sticky;top: 15px;">
                        @include('components.error')
                        <form action="{{ route('wheatRecord.store', base64_encode(($profile->id * 123456789) / 12098)) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="quantity">Quantity / <span class="text-urdu-kasheeda">مقدار</span> <span class="required">*</span></label>
                                        <input type="text" name="quantity" id="quantity" class="form-control" placeholder="Quantity" value="{{ old('quantity') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price-per-mann">Price per 40Kgs / <span class="text-urdu-kasheeda">فی من قیمت</span> <span class="required">*</span></label>
                                        <input type="text" name="price_per_mann" id="price-per-mann" class="form-control" placeholder="Price per 40Kgs" value="{{ old('price_per_mann') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="paid-per-mann">Paid per 40Kgs / <span class="text-urdu-kasheeda">فی من ادائیگی</span> <span class="required">*</span></label>
                                        <input type="text" name="paid_per_mann" id="paid-per-mann" class="form-control" placeholder="Paid per 40Kgs" value="{{ old('paid_per_mann') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">Category / <span class="text-urdu-kasheeda">گندم کی قسم</span> <span class="required">*</span></label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="">-- Select --</option>
                                            <option value="A" class="{{ $stock['A'] <= 0 ? 'd-none' : '' }}" {{ old('category') == 'A' ? 'selected' : '' }}>A</option>
                                            <option value="B" class="{{ $stock['B'] <= 0 ? 'd-none' : '' }}" {{ old('category') == 'B' ? 'selected' : '' }}>B</option>
                                            <option value="C" class="{{ $stock['C'] <= 0 ? 'd-none' : '' }}" {{ old('category') == 'C' ? 'selected' : '' }}>C</option>
                                            <option value="D" class="{{ $stock['D'] <= 0 ? 'd-none' : '' }}" {{ old('category') == 'D' ? 'selected' : '' }}>D</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-success float-right">Add Wheat Record</button>
                                <a href="{{ route('profile.show', base64_encode(($profile->id * 123456789) / 12098)) }}" class="btn btn-outline-danger float-right mr-2">Close</a>
                                <br class="clear">
                            </div>
                        </form>
                    </div>
            </main>
        </div>
    </section>
@endsection
