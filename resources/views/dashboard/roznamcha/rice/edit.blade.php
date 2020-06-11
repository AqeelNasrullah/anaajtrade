@extends('master.dashboard-master')

@section('title')
    <title>Edit Rice Record for {{ $record->profile->name ?? 'Unknown User' }} - {{ config('app.name') }}</title>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('edit_rice_records', $record) }}
@endsection

@section('content')
    <section class="container-fluid py-3">
        <div class="row">
            <main class="col-md-12">
                <h1 class="text-center mb-3 text-success fw-900">Edit Rice Record / <span class="text-urdu-kasheeda">چاول کا ریکارڈ تبدیل کریں</span></h1>

                    <div style="max-width:700px;margin:0px auto;">
                        @include('components.error')
                        <form action="{{ route('riceRecord.update', base64_encode(($record->id * 123456789) / 12098)) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <p class="mb-1 col-md-6"><strong>Customer:</strong> {{ $record->profile->name }}</p>
                                <p class="mb-1 col-md-6"><strong>Phone Number:</strong> {{ $record->profile->phone_number }}</p>
                                <p class="mb-1 col-md-6"><strong>CNIC:</strong> {{ $record->profile->cnic }}</p>
                                <p class="mb-1 col-md-6"><strong>Address:</strong> {{ $record->profile->address }}</p>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="quantity">Quantity / <span class="text-urdu-kasheeda">مقدار</span> <span class="required">*</span></label>
                                        <input type="text" name="quantity" id="quantity" class="form-control" placeholder="Quantity" value="{{ $record->quantity }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price-per-mann">Price per 40Kgs / <span class="text-urdu-kasheeda">فی من قیمت</span> <span class="required">*</span></label>
                                        <input type="text" name="price_per_mann" id="price-per-mann" class="form-control" placeholder="Price per 40Kgs" value="{{ $record->price_per_mann }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="paid-per-mann">Paid per 40Kgs / <span class="text-urdu-kasheeda">فی من ادائیگی</span> <span class="required">*</span></label>
                                        <input type="text" name="paid_per_mann" id="paid-per-mann" class="form-control" placeholder="Paid per 40Kgs" value="{{ $record->paid_per_mann }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">Rice Type / <span class="text-urdu-kasheeda">چاول کی قسم</span> <span class="required">*</span></label>
                                        <select name="type" id="type" class="form-control">
                                            <option value="">-- Select --</option>
                                            @if ($types->count() > 0)
                                                @foreach ($types as $type)
                                                    <option value="{{ $type->id }}" {{ $record->rice_type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">Category / <span class="text-urdu-kasheeda">چاول کا معیار</span> <span class="required">*</span></label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="">-- Select --</option>
                                            <option value="A" {{ $record->category == 'A' ? 'selected' : '' }}>A</option>
                                            <option value="B" {{ $record->category == 'B' ? 'selected' : '' }}>B</option>
                                            <option value="C" {{ $record->category == 'C' ? 'selected' : '' }}>C</option>
                                            <option value="D" {{ $record->category == 'D' ? 'selected' : '' }}>D</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-success float-right">Update Rice Record</button>
                                <a href="{{ route('profile.index') }}" class="btn btn-outline-danger float-right mr-2">Close</a>
                                <br class="clear">
                            </div>
                        </form>
                    </div>

            </main>
        </div>
    </section>
@endsection
