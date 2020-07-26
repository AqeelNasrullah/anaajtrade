@extends('master.dashboard-master')

@section('title')
    <title>Account Book - {{ config('app.name') }}</title>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('account_books') }}
@endsection

@section('content')
    <section class="container-fluid py-3">
        @include('components.customer-search')

        <div class="row">
            <div class="col-md-3 offset-md-3 mb-3">
                <h4 class="alert alert-success text-center"><strong>Loan:</strong> Rs {{ $loan->amount ?? 0 }} /-</h4>
            </div>
            <div class="col-md-3 mb-3">
                <h4 class="alert alert-success text-center"><strong>Returned:</strong> Rs {{ $returned->amount ?? 0 }} /-</h4>
            </div>
        </div>

        <div class="pt-3">
            <h1 class="text-center fw-900 text-success mb-3">Account Book / <span class="text-urdu-kasheeda">کھاتہ</span></h1>
            @include('components.success')
            <div id="account-books">
                @if ($dates->count() > 0)
                    @foreach ($dates as $date)
                        <h3 class="fw-700 text-success mb-3">{{ date('d-F-Y (l)', strtotime($date->date)) }}</h3>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="table-success">
                                    <tr>
                                        <th style="width: 20%;">Name / <span class="text-urdu-kasheeda">نام</span></th>
                                        <th style="width: 20%;">Amount / <span class="text-urdu-kasheeda">رقم</span></th>
                                        <th style="width: 20%;">Amount Type / <span class="text-urdu-kasheeda">رقم کی قسم</span></th>
                                        <th style="width: 20%;">Time / <span class="text-urdu-kasheeda">وقت</span></th>
                                        <th style="width: 20%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($account_books as $record)
                                        @if (date('Y-m-d', strtotime($record->created_at)) == $date->date)
                                            <tr>
                                                <td><a href="" data-id="{{ base64_encode(($record->profile->id * 123456789) / 12098) }}" class="view-customers">{{ $record->profile->name }}</a></td>
                                                <td>Rs {{ $record->amount }} /-</td>
                                                <td>{{ $record->type }}</td>
                                                <td>{{ date('h:i A', strtotime($record->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ route('accountBook.show', base64_encode(($record->id * 123456789) / 12098)) }}" class="d-inline">View</a>
                                                    <p class="mb-0 d-inline"> | </p>
                                                    <a href="{{ route('accountBook.edit', base64_encode(($record->id * 123456789) / 12098)) }}" class="d-inline">Edit</a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-danger w-50 mx-auto text-center font-italic">No record to show</div>
                @endif
                <div class="d-flex justify-content-between">
                    <div>
                        {{ $dates->links() }}
                    </div>
                    <div>
                        Showing {{ $dates->firstItem() ?? 0 }} - {{ $dates->lastItem() ?? 0 }} of {{ $dates->count() }} results
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    @include('components.customer-search-js')
    <script>
        $(document).ready(function() {
        $('#account-books').on('click', '.view-customers', function(e) {
            var key = $(this).data('id');
            $.get('{{ route("customerSearch.searchCustomer") }}', {id:key}, function(data){
                $('#data-popup').html(data.profile);
                $('#display-customer').modal('show');
            }, 'json');
            e.preventDefault();
        });
    });
    </script>
@endsection
