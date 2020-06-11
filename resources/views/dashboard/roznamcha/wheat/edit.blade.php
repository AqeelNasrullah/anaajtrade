@extends('master.dashboard-master')

@section('title')
    <title>Edit Wheat Record for {{ $wheat_record->profile->name ?? 'Unknown User' }} - {{ config('app.name') }}</title>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('edit_wheat_records', $wheat_record) }}
@endsection

@section('content')
    <section class="container-fluid py-3">
        <div class="row">
            <main class="col-md-12">
                <h1 class="text-center mb-3 text-success fw-900">Edit Wheat Record / <span class="text-urdu-kasheeda">گندم کا ریکارڈ تبدیل کریں</span></h1>

                    <div style="max-width:700px;margin:0px auto;">
                        @include('components.error')
                        <form action="{{ route('wheatRecord.update', base64_encode(($wheat_record->id * 123456789) / 12098)) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <p class="mb-1 col-md-6"><strong>Customer:</strong> {{ $wheat_record->profile->name }}</p>
                                <p class="mb-1 col-md-6"><strong>Phone Number:</strong> {{ $wheat_record->profile->phone_number }}</p>
                                <p class="mb-1 col-md-6"><strong>CNIC:</strong> {{ $wheat_record->profile->cnic }}</p>
                                <p class="mb-1 col-md-6"><strong>Address:</strong> {{ $wheat_record->profile->address }}</p>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="quantity">Quantity / <span class="text-urdu-kasheeda">مقدار</span> <span class="required">*</span></label>
                                        <input type="text" name="quantity" id="quantity" class="form-control" placeholder="Quantity" value="{{ $wheat_record->quantity }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price-per-mann">Price per 40Kgs / <span class="text-urdu-kasheeda">فی من قیمت</span> <span class="required">*</span></label>
                                        <input type="text" name="price_per_mann" id="price-per-mann" class="form-control" placeholder="Price per 40Kgs" value="{{ $wheat_record->price_per_mann }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="paid-per-mann">Paid per 40Kgs / <span class="text-urdu-kasheeda">فی من ادائیگی</span> <span class="required">*</span></label>
                                        <input type="text" name="paid_per_mann" id="paid-per-mann" class="form-control" placeholder="Paid per 40Kgs" value="{{ $wheat_record->paid_per_mann }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">Category / <span class="text-urdu-kasheeda">گندم کی قسم</span> <span class="required">*</span></label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="">-- Select --</option>
                                            <option value="A" {{ $wheat_record->category == 'A' ? 'selected' : '' }}>A</option>
                                            <option value="B" {{ $wheat_record->category == 'B' ? 'selected' : '' }}>B</option>
                                            <option value="C" {{ $wheat_record->category == 'C' ? 'selected' : '' }}>C</option>
                                            <option value="D" {{ $wheat_record->category == 'D' ? 'selected' : '' }}>D</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-success float-right">Update Wheat Record</button>
                                <a href="{{ route('wheatRecord.index') }}" class="btn btn-outline-danger float-right mr-2">Close</a>
                                <br class="clear">
                            </div>
                        </form>
                    </div>

            </main>
        </div>
    </section>
@endsection
