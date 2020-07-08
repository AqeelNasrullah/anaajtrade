@extends('master.dashboard-master')

@section('title')
    <title>Edit Account Book for {{ $record->profile->name }} - {{ config('app.name') }}</title>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('edit_account_books', $record) }}
@endsection

@section('content')
    <section class="container-fluid py-3">
        <div class="w-50 mx-auto">
            <h1 class="text-center fw-900 text-success mb-3">Edit Account Book / <span class="text-urdu-kasheeda">کھاتہ تبدیل کریں</span></h1>
            <div class="row">
                <p class="col-md-6 mb-1"><strong>Name:</strong> {{ $record->profile->name }}</p>
                <p class="col-md-6 mb-1"><strong>Phone Number:</strong> {{ $record->profile->phone_number }}</p>
                <p class="col-md-6 mb-1"><strong>CNIC:</strong> {{ $record->profile->cnic }}</p>
                <p class="col-md-6 mb-1"><strong>Address:</strong> {{ $record->profile->address }}</p>
            </div>
            <hr>
            <div>
                @include('components.error')

                <form action="{{ route('accountBook.update', base64_encode(($record->id * 123456789) / 12098)) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="amount">Amount / <span class="text-urdu-kasheeda">رقم</span> <span class="required">*</span>:</label>
                                <input type="text" name="amount" id="amount" class="form-control" value="{{ $record->amount }}" placeholder="Amount">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type">Amount Type / <span class="text-urdu-kasheeda">رقم کی قسم</span> <span class="required">*</span>:</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="">-- Select --</option>
                                    <option value="Loan" {{ $record->type == 'Loan' ? 'selected' : '' }}>Loan</option>
                                    <option value="Returned" {{ $record->type == 'Returned' ? 'selected' : '' }}>Returned</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success float-right">Update</button>
                        <a href="{{ route('accountBook.index') }}" class="btn btn-outline-danger float-right mr-2"><i class="fas fa-times"></i> Close</a>
                        <br class="clear">
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
