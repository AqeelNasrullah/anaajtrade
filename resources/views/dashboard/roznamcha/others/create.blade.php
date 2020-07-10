@extends('master.dashboard-master')

@section('title')
    <title>Add Other Records for {{ $profile->name ?? 'Unknown User' }} - {{ config('app.name') }}</title>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('add_other', $profile) }}
@endsection

@section('content')
    <section class="container-fluid py-3">
        <div class="row">
            <aside class="col-md-3">
                @include('components.sidebar-profile')
            </aside>
            <main class="col-md-9">
                <h1 class="text-center text-success fw-900 mb-3">Add Other Records / <span class="text-urdu-kasheeda">دیگر اشیاء شامل کریں</span></h1>
                <div style="max-width:700px;margin:0px auto">
                    @include('components.error')
                    <form action="{{ route('other.store', base64_encode(($profile->id * 123456789) / 12098)) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="desc">Description / <span class="text-urdu-kasheeda">تفصیل</span> <span class="required">*</span>:</label>
                                    <textarea name="description" id="desc" placeholder="Description" class="form-control">{{ old('description') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount">Amount / <span class="text-urdu-kasheeda">رقم</span> <span class="required">*</span>:</label>
                                    <input type="text" name="amount" id="amount" placeholder="Amount" class="form-control" value="{{ old('amount') }}">
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success float-right">Add Record</button>
                            <a href="{{ route('profile.show', base64_encode(($profile->id * 123456789) / 12098)) }}" class="btn btn-outline-danger float-right mr-2">Close</a>
                            <br class="clear">
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </section>
@endsection
