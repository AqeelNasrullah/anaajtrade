@extends('master.dashboard-master')

@section('title')
    <title>Fertilizer Record - {{ config('app.name') }}</title>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('fertilizer_records') }}
@endsection

@section('content')
    <section class="container-fluid py-3">
        @include('components.customer-search')

        <div class="row">
            <div class="col-md-3">
                <h5 class="alert alert-success text-center mb-3"><strong>Sale:</strong> {{ $urea->quantity ?? 0 }} Sacks</h5>
            </div>
            <div class="col-md-3">
                <h5 class="alert alert-success text-center mb-3"><strong>Price per sack:</strong> Rs {{ $urea_sack->paid ?? 0 }} /-</h5>
            </div>
            <div class="col-md-3">
                <h5 class="alert alert-success text-center mb-3"><strong>Total Price:</strong> Rs {{ $urea_paid->amount ?? 0 }} /-</h5>
            </div>
            <div class="col-md-3">
                <h5 class="alert alert-success text-center mb-3"><strong>Profit:</strong> Rs {{ $urea_profit ?? 0 }} /-</h5>
            </div>
        </div>

        <h1 class="text-center text-success fw-900 mb-3">Fertilizer Record / <span class="text-urdu-kasheeda">کھاد کا ریکارڈ</span></h1>

        @include('components.success')

        <div>
            <select id="fertilizer" class="form-control float-right" style="width: 175px;">
                <option value="0">Fertilizer Record</option>
                <option value="1">Fertilizer Stock</option>
            </select>
            <br class="clear">
        </div>

        <div id="fertilizer-records">
            @forelse ($dates as $date)
                <h3 class="text-success mb-3 fw-700">{{ date('d-F-Y (l)', strtotime($date->date)) }}</h3>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="table-success">
                            <tr>
                                <th style="width: 14%;" class="align-middle">Name / <span class="text-urdu-kasheeda">نام</span></th>
                                <th style="width: 10%;" class="align-middle">Quantity / <span class="text-urdu-kasheeda">مقدار</span></th>
                                <th style="width: 10%;" class="align-middle">Weight per sack / <span class="text-urdu-kasheeda">فی بوری وزن</span></th>
                                <th style="width: 10%;" class="align-middle">Price per sack / <span class="text-urdu-kasheeda">فی بوری قیمت</span></th>
                                <th style="width: 10%;" class="align-middle">Paid per sack / <span class="text-urdu-kasheeda">فی بوری ادایئگی</span></th>
                                <th style="width: 10%;" class="align-middle">Total Price / <span class="text-urdu-kasheeda">کل قیمت</span></th>
                                <th style="width: 10%;" class="align-middle">Fertilizer Type / <span class="text-urdu-kasheeda">کھاد کی قسم</span></th>
                                <th style="width: 6%;" class="align-middle">Time / <span class="text-urdu-kasheeda">وقت</span></th>
                                <th style="width: 10%;" class="align-middle"><span class="text-urdu-kasheeda"></span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($records as $record)
                                @if ($date->date == date('Y-m-d', strtotime($record->created_at)))
                                    <tr>
                                        <td class="align-middle"><a data-id="{{ base64_encode(($record->profile->id * 123456789) / 12098) }}" class="view-customers" href="">{{ $record->profile->name }}</a></td>
                                        <td class="align-middle">{{ $record->quantity }} Sacks</td>
                                        <td class="align-middle">{{ $record->weight }} Kgs</td>
                                        <td class="align-middle">Rs {{ $record->price }} /-</td>
                                        <td class="align-middle">Rs {{ $record->paid }} /-</td>
                                        <td class="align-middle">Rs {{ $record->quantity * $record->paid }} /-</td>
                                        <td class="align-middle">{{ $record->type }}</td>
                                        <td class="align-middle">{{ date('h:i A', strtotime($record->created_at)) }}</td>
                                        <td class="align-middle">
                                            <a href="{{ route('fertilizerRecord.show', base64_encode(($record->id * 123456789) / 12098)) }}" class="d-inline">View</a>
                                            <p class="mb-0 d-inline"> | </p>
                                            <a href="{{ route('fertilizerRecord.edit', base64_encode(($record->id * 123456789) / 12098)) }}" class="d-inline">Edit</a>
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center font-italic">No record to show.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @empty
                <p class="mb-0 alert alert-danger w-50 mx-auto text-center font-italic">No record to show.</p>
            @endforelse
        </div>
        <div class="d-flex" style="justify-content: space-between;">
            <div class="paginate">{{ $dates->links() }}</div>
            <p class="mb-0">Showing {{ $dates->firstItem() ?? 0 }} - {{ $dates->lastItem() ?? 0 }} of {{ $dates->count() }} results</p>
        </div>
    </section>
@endsection

@section('script')
    @include('components.customer-search-js')
    <script>
        $(document).ready(function () {
            $('#fertilizer').change(function() {
                var inte = $(this).val();
                if(inte == 0) {
                    window.location.href = "{{ route('fertilizerRecord.index') }}";
                } else if (inte == 1) {
                    window.location.href = "{{ route('fertilizerStock.index') }}";
                }
            });

            $('#fertilizer-records').on('click', '.view-customers', function(e) {
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
