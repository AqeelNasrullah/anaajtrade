@extends('master.dashboard-master')

@section('title')
    <title>Wheat - {{ config('app.name') }}</title>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('wheat_records') }}
@endsection

@section('content')
    <section class="container-fluid py-3">
        @include('components.customer-search')

        <div class="row">
            <div class="col-md-3">
                <h4 class="alert alert-success mb-3 text-center"><strong>Sale:</strong> {{ $wheat->quantity ?? 0 }} Kgs</h4>
            </div>
            <div class="col-md-3">
                <h4 class="alert alert-success mb-3 text-center"><strong>Price per 40Kg:</strong> Rs {{ $wheat_mann->paid ?? 0 }} /-</h4>
            </div>
            <div class="col-md-3">
                <h4 class="alert alert-success mb-3 text-center"><strong>Total Price:</strong> Rs {{ (integer)$wheat_paid->amount ?? 0 }} /-</h4>
            </div>
            <div class="col-md-3">
                <h4 class="alert alert-success mb-3 text-center"><strong>Profit:</strong> Rs {{ (integer)$wheat_profit ?? 0 }} /-</h4>
            </div>
        </div>

        <div>
            <h1 class="text-center text-success mb-3 fw-900">Wheat / <span class="text-urdu-kasheeda">گندم</span></h1>
            @include('components.error')
            @include('components.success')

            <div class="mb-3">
                <select name="" id="select-page" class="form-control float-right" style="width: 175px;">
                    <option value="0">Wheat Records</option>
                    <option value="1">Wheat Stock</option>
                </select>
                <br class="clear">
            </div>

            <div id="wheat-record-tables">
                @if ($dates->count() > 0)
                    @foreach ($dates as $date)
                        <h3 class="text-success fw-700 mb-3">{{ date('d-F-Y (l)', strtotime($date->date)) }}</h3>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="table-success">
                                    <tr>
                                        <th style="width: 20%" class="align-middle">Name / <span class="text-urdu-kasheeda">نام</span></th>
                                        <th style="width: 10%" class="align-middle">Quantity / <span class="text-urdu-kasheeda">مقدار</span></th>
                                        <th style="width: 10%" class="align-middle">Price per 40Kgs / <span class="text-urdu-kasheeda">قیمت فی من</span></th>
                                        <th style="width: 10%" class="align-middle">Paid per 40Kgs / <span class="text-urdu-kasheeda">فی من ادائیگی</span></th>
                                        <th style="width: 20%" class="align-middle">Total Price / <span class="text-urdu-kasheeda">کل قیمت</span></th>
                                        <th style="width: 10%" class="align-middle">Category / <span class="text-urdu-kasheeda">گندم کی قسم</span></th>
                                        <th style="width: 10%" class="align-middle">Time / <span class="text-urdu-kasheeda">وقت</span></th>
                                        <th style="width: 10%" class="align-middle"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($records->count() > 0)
                                        @foreach ($records as $record)
                                            @if (date('Y-m-d', strtotime($record->created_at)) == $date->date)
                                                <tr>
                                                    <td class="align-middle"><a href="" data-id="{{ base64_encode(($record->profile->id * 123456789) / 12098) }}" class="view-customers">{{ $record->profile->name }}</a></td>
                                                    <td class="align-middle">{{ $record->quantity }} Kgs</td>
                                                    <td class="align-middle">Rs {{ $record->price_per_mann }} /-</td>
                                                    <td class="align-middle">RS {{ $record->paid_per_mann }} /-</td>
                                                    <td class="align-middle">Rs {{ ($record->quantity / 40) * $record->paid_per_mann }} /-</td>
                                                    <td class="align-middle">{{ $record->category }}</td>
                                                    <td class="align-middle">{{ date('h:i A', strtotime($record->created_at)) }}</td>
                                                    <td class="align-middle">
                                                        <a href="{{ route('wheatRecord.show', base64_encode(($record->id * 123456789) / 12098)) }}" class="d-inline">View</a>
                                                        <p class="mb-0 d-inline"> | </p>
                                                        <a href="{{ route('wheatRecord.edit', base64_encode(($record->id * 123456789) / 12098)) }}" class="d-inline">Edit</a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center font-italic" colspan="7">No record to show.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <div>
                            <div class="float-left">
                                {{ $dates->links() }}
                            </div>
                            <div class="float-right">
                                <p class="mb-0">Showing {{ $dates->firstItem() ?? 0 }} - {{ $dates->lastItem() ?? 0 }} of {{ $dates->count() }} days</p>
                            </div>
                            <br class="clear">
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-danger text-center font-italic w-50 mx-auto">No record to show.</div>
                @endif
            </div>
        </div>
    </section>
@endsection

@section('script')
    @include('components.customer-search-js')
    <script>
        $(document).ready(function() {
            $('#wheat-record-tables').on('click', '.view-customers', function(e) {
                var key = $(this).data('id');
                $.get('{{ route("customerSearch.searchCustomer") }}', {id:key}, function(data){
                    $('#data-popup').html(data.profile);
                    $('#display-customer').modal('show');
                }, 'json');
                e.preventDefault();
            });
            $('#select-page').change(function() {
                var page_id = $(this).val();
                if (page_id == 1) {
                    window.location.href = "{{ route('wheatStock.index') }}";
                } else {
                    window.location.href = "{{ route('wheatRecord.index') }}";
                }
            });
        });
    </script>
@endsection
