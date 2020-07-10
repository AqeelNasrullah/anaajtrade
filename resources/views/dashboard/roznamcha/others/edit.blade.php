@extends('master.dashboard-master')

@section('title')
    <title>Edit Record for {{ $other->profile->name ?? 'Unknown User' }} - {{ config('app.name') }}</title>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('edit_other', $other) }}
@endsection

@section('content')
    <section class="container-fluid py-3">
        <div class="w-50 mx-auto">
            <h1 class="text-success fw-900 text-center mb-3">Others / <span class="text-urdu-kasheeda">دیگر اشیاء</span></h1>
            @if ($other)
                <div class="row">
                    <p class="col-md-6 mb-1"><strong>Name:</strong> {{ $other->profile->name }}</p>
                    <p class="col-md-6 mb-1"><strong>Phone Number:</strong> {{ $other->profile->phone_number }}</p>
                    <p class="col-md-6 mb-1"><strong>CNIC:</strong> {{ $other->profile->cnic }}</p>
                    <p class="col-md-6 mb-1"><strong>Address:</strong> {{ $other->profile->address }}</p>
                </div>
                <hr>
                @include('components.error')
                <form action="{{ route('other.update', base64_encode(($other->id * 123456789) / 12098)) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="desc">Description / <span class="text-urdu-kasheeda">تفصیل</span> <span class="required">*</span>:</label>
                                <textarea name="desc" id="desc" class="form-control" placeholder="Description">{{ $other->description }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="amount">Amount / <span class="text-urdu-kasheeda">رقم</span> <span class="required">*</span>:</label>
                                <input name="amount" id="amount" class="form-control" placeholder="Amount" value="{{ $other->amount }}">
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success float-right">Update</button>
                        <a href="{{ route('other.index') }}" class="btn btn-outline-danger float-right mr-2">Close</a>
                        <br class="clear">
                    </div>
                </form>
            @else
                <div class="alert alert-danger text-center w-50 mx-auto font-italic">No record to show.</div>
            @endif
        </div>
    </section>
@endsection
