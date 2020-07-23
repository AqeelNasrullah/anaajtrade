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
            </aside>
            <main class="col-md-9">
                <h1 class="text-center mb-3 text-success fw-900">Add Wheat Record / <span class="text-urdu-kasheeda">گندم کا ریکارڈ شامل کریں</span></h1>
                @if ($rem_stock > 0)
                    <div style="max-width:700px;margin:0px auto;">
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
                                            <option value="A" {{ old('category') == 'A' ? 'selected' : '' }}>A</option>
                                            <option value="B" {{ old('category') == 'B' ? 'selected' : '' }}>B</option>
                                            <option value="C" {{ old('category') == 'C' ? 'selected' : '' }}>C</option>
                                            <option value="D" {{ old('category') == 'D' ? 'selected' : '' }}>D</option>
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
                @else
                    <div class="alert alert-danger w-50 mx-auto">
                        <h3 class="text-center font-italic">Stock is Empty.</h3>
                    </div>
                @endif
            </main>
        </div>
    </section>
@endsection