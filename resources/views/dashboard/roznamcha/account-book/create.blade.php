@extends('master.dashboard-master')

@section('title')
    <title>Add Account Book for {{ $profile->name ?? 'Unknown User' }} - {{ config('app.name') }}</title>
@endsection

@section('style')
    <style>
        .create-account-book {max-width: 700px; width: 100%;margin: 0px auto;}
    </style>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('account_books_create', $profile) }}
@endsection

@section('content')
    <section class="container-fluid py-3">
        <div class="row">
            <aside class="col-md-3">
                @include('components.sidebar-profile')
            </aside>
            <main class="col-md-9">
                <h1 class="text-center fw-900 text-success mb-3">Add Account Book / <span class="text-urdu-kasheeda">کھاتہ شامل کریں</span></h1>
                <div class="create-account-book">
                    @include('components.error')
                    @include('components.success')
                    <form action="{{ route('accountBook.store', base64_encode(($profile->id * 123456789) / 12098)) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount">Amount / <span class="text-urdu-kasheeda">رقم</span> <span class="required">*</span>:</label>
                                    <input type="text" name="amount" id="amount" class="form-control" placeholder="Amount" value="{{ old('amount') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">Amount Type / <span class="text-urdu-kasheeda">رقم کی قسم</span> <span class="required">*</span>:</label>
                                    <select name="amount_type" id="type" class="form-control">
                                        <option value="">-- Select --</option>
                                        <option value="Loan" {{ old('amount_type') == 'Loan' ? 'selected':'' }}>Loan</option>
                                        <option value="Returned" {{ old('amount_type') == 'Returned' ? 'selected':'' }}>Returned</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success float-right">Add Account Book</button>
                            <a href="{{ route('profile.show', base64_encode(($profile->id * 123456789) / 12098)) }}" class="btn btn-outline-danger float-right mr-2">Close</a>
                            <br class="clear">
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </section>
@endsection
