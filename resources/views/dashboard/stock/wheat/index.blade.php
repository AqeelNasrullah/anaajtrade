@extends('master.dashboard-master')

@section('title')
    <title>Wheat Stock - {{ config('app.name') }}</title>
@endsection

@section('content')
    <section class="container-fluid py-3">
        @include('components.customer-search')

        <div id="data-popup"></div>
        <section>
            <h1 class="text-success text-center fw-900 mb-3">Wheat Stock / <span class="text-urdu-kasheeda">گندم کا اسٹاک</span></h1>

            @include('components.error')
            @include('components.success')

            <div id="wheat-stock-tables">
                @if ($dates->count() > 0)
                    @foreach ($dates as $date)
                        <h3 class="fw-700 text-success mb-3">{{ date('d-F-Y (l)', strtotime($date->date)) }}</h3>
                        @if ($records->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="table-success">
                                    <tr>
                                        <th class="align-middle">Name / <span class="text-urdu-kasheeda">نام</span></th>
                                        <th class="align-middle">No of Sacks / <span class="text-urdu-kasheeda">بوریوں کی تعداد</span></th>
                                        <th class="align-middle">Weight per sack / <span class="text-urdu-kasheeda">فی بوری وزن</span></th>
                                        <th class="align-middle">Price per 40KG / <span class="text-urdu-kasheeda">قیمت فی من</span></th>
                                        <th class="align-middle">Total Price / <span class="text-urdu-kasheeda">کل قیمت</span></th>
                                        <th class="align-middle">Commission / <span class="text-urdu-kasheeda">منافع</span></th>
                                        <th class="align-middle">Commissioned Price / <span class="text-urdu-kasheeda">منافع کی ساتھ قیمت</span></th>
                                        <th class="align-middle">Category / <span class="text-urdu-kasheeda">گندم کی قسم</span></th>
                                        <th class="align-middle">Time / <span class="text-urdu-kasheeda">وقت</span></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($records as $record)
                                        @if (date('Y-m-d', strtotime($record->created_at)) == $date->date)
                                            <tr>
                                                <td class="align-middle"><a class="view-customers" data-id="{{ base64_encode(($record->profile->id * 123456789) / 12098) }}" href="">{{ $record->profile->name }}</a></td>
                                                <td class="align-middle">{{ $record->num_of_sack }}</td>
                                                <td class="align-middle">{{ $record->weight_per_sack }} KG</td>
                                                <td class="align-middle">Rs {{ $record->price }} /-</td>
                                                <td class="align-middle">Rs {{ (($record->num_of_sack * $record->weight_per_sack) / 40) * $record->price }} /-</td>
                                                <td class="align-middle">{{ $record->commission }} %</td>
                                                <td class="align-middle">Rs {{ ((($record->num_of_sack * $record->weight_per_sack) / 40) * $record->price) - ((2/100) * ((($record->num_of_sack * $record->weight_per_sack) / 40) * $record->price)) }} /-</td>
                                                <td class="align-middle">{{ $record->category }}</td>
                                                <td class="align-middle">{{ date('h:i A', strtotime($record->created_at)) }}</td>
                                                <td class="align-middle">
                                                    <a href="{{ route('wheatStock.show', base64_encode(($record->id * 123456789) / 12098)) }}" class="d-inline">View Slip</a>
                                                    <p class="mb-0 d-inline"> | </p>
                                                    <a href="{{ route('wheatStock.edit', base64_encode(($record->id * 123456789) / 12098)) }}" class="d-inline">Edit Record</a>
                                                    <p class="mb-0 d-inline"> | </p>
                                                    <form action="{{ route('wheatStock.destroy', base64_encode(($record->id * 123456789) / 12098)) }}" method="post" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-link m-0 p-0 delete-stock" type="submit">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="alert alert-danger w-50 mx-auto text-center font-italic">No record to show.</div>
                        @endif
                    @endforeach
                @else
                    <div class="alert alert-danger w-50 mx-auto text-center font-italic">No record to show.</div>
                @endif
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
        </section>
    </section>
@endsection

@section('script')
    @include('components.customer-search-js')
    <script>
        $(document).ready(function() {
            $('#wheat-stock-tables').on('click', '.view-customers', function(e) {
                var key = $(this).data('id');
                $.get('{{ route("customerSearch.searchCustomer") }}', {id:key}, function(data){
                    $('#data-popup').html(data.profile);
                    $('#display-customer').modal('show');
                }, 'json');
                e.preventDefault();
            });
            $('#wheat-stock-tables').on('click', '.delete-stock',function() {
                if (confirm('Are you sure you want to delete wheat stock?')) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>
@endsection
