@extends('master.dashboard-master')

@section('title')
    <title>{{ $profile->name ?? 'Unknown User' }} - {{ config('app.name') }}</title>
@endsection

@section('content')
    <section class="container-fluid py-3">
        <div class="p-0 m-0" id="filling-station-popup"></div>
        <div class="row">
            <aside class="col-md-3">
                @include('components.sidebar-profile')
            </aside>
            <main class="col-md-9">
                <section class="mb-3">
                    <div class="float-left">
                        <div class="card" style="width: 250px;">
                            <div class="card-header">
                                <h3 class="text-center">Rs 2000 /-</h3>
                            </div>
                            <div class="card-body p-2">
                                <p class="text-center fw-700 mb-0">Balance</p>
                            </div>
                        </div>
                    </div>
                    <div class="float-right">
                        <div class="dropdown float-right">
                            <a href="" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Go for Transaction <i class="fas fa-angle-down"></i></a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <a href="" class="dropdown-item">Account Book / <span class="text-urdu-kasheeda">کھاتہ</span></a>
                                <a href="{{ route('oilRecord.fillingStations', base64_encode(($profile->id * 123456789) / 12098)) }}" class="dropdown-item">Oil / <span class="text-urdu-kasheeda">تیل</span></a>
                                <a href="" class="dropdown-item">Fertilizer / <span class="text-urdu-kasheeda">کھاد</span></a>
                                <a href="" class="dropdown-item">Agricultural Medicine / <span class="text-urdu-kasheeda">زرعی ادویات</span></a>
                                <a href="" class="dropdown-item">Wheat / <span class="text-urdu-kasheeda">گندم</span></a>
                                <a href="" class="dropdown-item">Rice / <span class="text-urdu-kasheeda">چاول</span></a>
                                <a href="" class="dropdown-item">Others / <span class="text-urdu-kasheeda">دیگر اشیاء</span></a>
                            </ul>
                        </div>
                        <div class="dropdown float-right mr-2">
                            <a href="" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Stock Intake <i class="fas fa-angle-down"></i></a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <a href="" class="dropdown-item">Fertilizer / <span class="text-urdu-kasheeda">کھاد</span></a>
                                <a href="" class="dropdown-item">Agricultural Medicine / <span class="text-urdu-kasheeda">زرعی ادویات</span></a>
                                <a href="" class="dropdown-item">Wheat / <span class="text-urdu-kasheeda">گندم</span></a>
                                <a href="" class="dropdown-item">Rice / <span class="text-urdu-kasheeda">چاول</span></a>
                            </ul>
                        </div>
                    </div>
                    <br class="clear">
                </section>
                <section>
                    <h3 class="text-success fw-700 mb-3">Oil / <span class="text-urdu-kasheeda">تیل</span></h3>
                    <div class="table-responsive">
                        <table class="table table-striped" id="oil-table">
                            <thead class="table-success">
                                <tr>
                                    <th>Filling Station / <span class="text-urdu-kasheeda">پیٹرول پمپ</span></th>
                                    <th>Quantity / <span class="text-urdu-kasheeda">مقدار</span></th>
                                    <th>Price Paid / <span class="text-urdu-kasheeda">ادا شدہ قیمت</span></th>
                                    <th>Total Price / <span class="text-urdu-kasheeda">کل قیمت</span></th>
                                    <th>Date &amp; Time / <span class="text-urdu-kasheeda">تاریخ اور وقت</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($oil_records->count() > 0)
                                    @foreach ($oil_records as $record)
                                        <tr>
                                            <td><a data-id="{{ base64_encode(($record->filling_station_id * 123456789) / 12098) }}" class="view-station" href="">{{ $record->fillingStation->name }}</a></td>
                                            <td>{{ $record->quantity }} Litres</td>
                                            <td>Rs {{ $record->paid_per_litre }} /-</td>
                                            <td>{{ $record->quantity * $record->paid_per_litre }} /-</td>
                                            <td>{{ date('d-F-Y h:i A', strtotime($record->created_at)) }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center font-italic">No record to show.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </section>
            </main>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#oil-table').on('click', '.view-station', function(e) {
                var id = $(this).data('id');
                $.get('{{ route("fillingStation.searchFillingStation") }}', {id:id}, function(data) {
                    $('#filling-station-popup').html(data.data_output);
                    $('#station-search-popup').modal('show');
                }, 'json');
                e.preventDefault();
            });
        });
    </script>
@endsection
