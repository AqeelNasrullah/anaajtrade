@extends('master.dashboard-master')

@section('title')
    <title>Add Medicine Record for {{ $profile->name ?? 'Unknown User' }} - {{ config('app.name') }}</title>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('add_medicine_records', $profile) }}
@endsection

@section('content')
    <section class="container-fluid py-3">
        <div class="row">
            <aside class="col-md-3">
                @include('components.sidebar-profile')
            </aside>
            <main class="col-md-9">
                <div style="max-width: 700px;margin: 0px auto;">
                    <h1 class="text-center text-success fw-900 mb-3">Add Medicine Record / <span class="text-urdu-kasheeda">دوائی کا ریکارڈ شامل کریں</span></h1>
                    @if ($remain > 0)

                    @include('components.error')

                    <form action="{{ route('medicineRecord.store', base64_encode(($profile->id * 123456789) / 12098)) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">Medicine Name / <span class="text-urdu-kasheeda">دوائی کی قسم</span> <span class="required">*</span>:</label>
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="paid">Price paid / <span class="text-urdu-kasheeda">اداشدہ قیمت</span> <span class="required">*</span>:</label>
                                    <input type="text" name="paid" id="paid" placeholder="Price paid" value="{{ old('paid') }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success float-right">Add Medicine Record</button>
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
