@extends('master.dashboard-master')

@section('title')
    <title>{{ $station->name ?? "Filling Station" }} - {{ config('app.name') }}</title>
@endsection

@section('style')
    <style>
        .station {background-color: lightgray; border-radius: 5px;}
        .station-logo {width: 150px; height: 150px; overflow: hidden;margin: 0px auto;}
    </style>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('view_filling_stations', $station) }}
@endsection

@section('content')
    <section class="container-fluid py-3">
        <div id="data-popup" class="p-0 m-0"></div>
        <div class="row">
            <aside class="col-md-3">
                <div class="p-3 station">
                    <div class="station-logo mb-2">
                        <img src="{{ asset('images/logos/' . $station->oilCompany->avatar) }}" width="100%" alt="Image not found">
                    </div>
                    <div>
                        <h4 class="text-center fw-900 mb-1">{{ $station->name ?? 'Unknown User' }}</h4>
                        <h6 class="text-center mb-1"><i class="fas fa-gas-pump"></i> {{ $station->oilCompany->name }}</h6>
                        <h6 class="text-center mb-1"><i class="fas fa-phone"></i> {{ $station->phone_number }}</h6>
                        <h6 class="text-center"><i class="fas fa-map-marker-alt"></i> {{ $station->address }}</h6>
                    </div>
                </div>
            </aside>
            <main class="col-md-9">
                <h1 class="text-center fw-900 text-success">Oil Records / <span class="text-urdu-kasheeda">تیل کا ریکارڈ</span></h1>

                <div id="stations-table">
                    @if ($dates->count() > 0)
                        @foreach ($dates as $date)
                            <h3 class="mb-3 fw-700 text-success">{{ date('d-F-Y (l)', strtotime($date->date)) }}</h3>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead class="table-success">
                                        <tr>
                                            <th class="align-middle">Name / <span class="text-urdu-kasheeda">نام</span></th>
                                            <th class="align-middle">Quantity / <span class="text-urdu-kasheeda">مقدار</span></th>
                                            <th class="align-middle">Price per litre / <span class="text-urdu-kasheeda">فی لٹر قیمت</span></th>
                                            <th class="align-middle">Paid per litre / <span class="text-urdu-kasheeda">فی لٹر ادائیگی</span></th>
                                            <th class="align-middle">Total Price / <span class="text-urdu-kasheeda">کل قیمت</span></th>
                                            <th class="align-middle">Time / <span class="text-urdu-kasheeda">وقت</span></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($records->count() > 0)
                                            @foreach ($records as $record)
                                                @if ($date->date == date('Y-m-d', strtotime($record->created_at)))
                                                    <tr>
                                                        <td class="align-middle"><a data-id="{{ base64_encode(($record->profile->id * 123456789) / 12098) }}" class="view-customer" href="">{{ $record->profile->name }}</a></td>
                                                        <td class="align-middle">{{ $record->quantity }} Litres</td>
                                                        <td class="align-middle">Rs {{ $record->price_per_litre }} /-</td>
                                                        <td class="align-middle">Rs {{ $record->paid_per_litre }} /-</td>
                                                        <td class="align-middle">Rs {{ $record->quantity*$record->paid_per_litre }} /-</td>
                                                        <td class="align-middle">{{ date('h:i A' ,strtotime($record->created_at)) }}</td>
                                                        <td class="align-middle"><a href="{{ route('oilRecord.show', base64_encode(($record->id * 123456789)/12098)) }}">View Bill</a></td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7" class="text-center font-italic">No record to show.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    @else
                    <div class="alert alert-danger w-50 mx-auto text-center font-italic">No record to show.</div>
                    @endif
                </div>
            </main>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#stations-table').on('click', '.view-customer', function(e) {
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
