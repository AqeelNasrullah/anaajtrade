@extends('master.dashboard-master')

@section('title')
    <title>Add Fertilizer Record for {{ $profile->name ?? 'Unknown User' }} - {{ config('app.name') }}</title>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('add_fertilizer_records', $profile) }}
@endsection

@section('content')
    <section class="container-fluid py-3">
        <div class="row">
            <aside class="col-md-3">
                @include('components.sidebar-profile')
            </aside>
            <main class="col-md-9">
                <div style="max-width: 700px;margin: 0px auto;">
                    <h1 class="text-center text-success fw-900 mb-3">Add Fertilizer Record / <span class="text-urdu-kasheeda">کھاد کا ریکارڈ شامل کریں</span></h1>
                    @if ($remain > 0)

                    @include('components.error')

                    <form action="{{ route('fertilizerRecord.store', base64_encode(($profile->id * 123456789) / 12098)) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="quantity">Quantity / <span class="text-urdu-kasheeda">مقدار</span> <span class="required">*</span>:</label>
                                    <input type="text" name="quantity" id="quantity" placeholder="Quantity" value="{{ old('quantity') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="weight">Weigth per sack / <span class="text-urdu-kasheeda">فی بوری وزن</span> <span class="required">*</span>:</label>
                                    <input type="text" name="weight" id="weight" placeholder="Weight" value="{{ old('weight') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">Price per sack / <span class="text-urdu-kasheeda">فی بوری قیمت</span> <span class="required">*</span>:</label>
                                    <input type="text" name="price" id="price" placeholder="Price" value="{{ old('price') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="paid">Price paid per sack / <span class="text-urdu-kasheeda">فی بوری اداشدہ قیمت</span> <span class="required">*</span>:</label>
                                    <input type="text" name="paid" id="paid" placeholder="Price" value="{{ old('paid') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">Fertilizer Type / <span class="text-urdu-kasheeda">کھاد کی قسم</span> <span class="required">*</span>:</label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="">-- Select --</option>
                                        <option value="Urea" {{ old('type') == 'Urea' ? 'selected' : '' }}>Urea</option>
                                        <option value="DAP" {{ old('type') == 'DAP' ? 'selected' : '' }}>DAP</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success float-right">Add Fertilizer Record</button>
                            <a href="{{ route('profile.show', base64_encode(($profile->id * 123456789) / 12098)) }}" class="btn btn-outline-danger float-right mr-2">Close</a>
                            <br class="clear">
                        </div>
                    </form>
                    @else
                    <p class="mb-0 alert alert-danger w-50 mx-auto text-center font-italic">Stock is empty.</p>
                    @endif
                </div>
            </main>
        </div>
    </section>
@endsection
