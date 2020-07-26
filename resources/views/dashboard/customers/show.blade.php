@extends('master.dashboard-master')

@section('title')
    <title>{{ $profile->name ?? 'Unknown User' }} - {{ config('app.name') }}</title>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('edit_customers', $profile) }}
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
                                <h3 class="text-center">Rs {{ (integer)$balance ?? 0 }} /-</h3>
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
                                <a href="{{ route('accountBook.create', base64_encode(($profile->id * 123456789) / 12098)) }}" class="dropdown-item">Account Book / <span class="text-urdu-kasheeda">کھاتہ</span></a>
                                <a href="{{ route('oilRecord.fillingStations', base64_encode(($profile->id * 123456789) / 12098)) }}" class="dropdown-item">Oil / <span class="text-urdu-kasheeda">تیل</span></a>
                                <a href="{{ route('fertilizerRecord.create', base64_encode(($profile->id * 123456789) / 12098)) }}" class="dropdown-item">Fertilizer / <span class="text-urdu-kasheeda">کھاد</span></a>
                                <a href="{{ route('medicineRecord.create', base64_encode(($profile->id * 123456789) / 12098)) }}" class="dropdown-item">Agricultural Medicine / <span class="text-urdu-kasheeda">زرعی ادویات</span></a>
                                <a href="{{ route('wheatRecord.create', base64_encode(($profile->id * 123456789) / 12098)) }}" class="dropdown-item">Wheat / <span class="text-urdu-kasheeda">گندم</span></a>
                                <a href="{{ route('riceRecord.create', base64_encode(($profile->id * 123456789) / 12098)) }}" class="dropdown-item">Rice / <span class="text-urdu-kasheeda">چاول</span></a>
                                <a href="{{ route('other.create', base64_encode(($profile->id * 123456789) / 12098)) }}" class="dropdown-item">Others / <span class="text-urdu-kasheeda">دیگر اشیاء</span></a>
                            </ul>
                        </div>
                        <div class="dropdown float-right mr-2">
                            <a href="" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Stock Intake <i class="fas fa-angle-down"></i></a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <a href="{{ route('wheatStock.create', base64_encode(($profile->id * 123456789) / 12098)) }}" class="dropdown-item">Wheat / <span class="text-urdu-kasheeda">گندم</span></a>
                                <a href="{{ route('riceStock.create', base64_encode(($profile->id * 123456789) / 12098)) }}" class="dropdown-item">Rice / <span class="text-urdu-kasheeda">چاول</span></a>
                            </ul>
                        </div>
                        <a href="{{ route('profile.index') }}" class="btn btn-outline-danger float-right mr-2"><i class="fas fa-times"></i> Close</a><br>
                        <h3 class="float-right mt-3 text-right text-urdu-kasheeda">اگر بیلنس کے ساتھ (-) ھوا تو کمیشن ایجنٹ (دوکاندار) خریدار کو رقم ادا کرنے کا پابند ہو گا۔</h3>
                    </div>
                    <br class="clear">
                </section>
                <section id="account-section">
                    <h3 class="text-success fw-700 mb-3">Account Book / <span class="text-urdu-kasheeda">کھاتہ</span></h3>
                    <div class="table-responsive">
                        <table class="table table-striped" id="oil-table">
                            <thead class="table-success">
                                <tr>
                                    <th>Amount / <span class="text-urdu-kasheeda">رقم</span></th>
                                    <th>Amount Type / <span class="text-urdu-kasheeda">رقم کی قسم</span></th>
                                    <th>Date &amp; Time / <span class="text-urdu-kasheeda">تاریخ اور وقت</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($account_books->count() > 0)
                                    @foreach ($account_books as $record)
                                        <tr>
                                            <td>Rs {{ $record->amount }} /-</td>
                                            <td>{{ $record->type }}</td>
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
                <section>
                    <section id="oil-section">
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
                    <section id="fertilizer-records-section">
                        <h3 class="text-success fw-700 mb-3">Fertilizer Records / <span class="text-urdu-kasheeda">کھاد کا ریکارڈ</span></h3>
                        <div class="table-responsive">
                            <table class="table table-striped" id="fertilizer-records-table">
                                <thead class="table-success">
                                    <tr>
                                        <th class="align-middle">Quantity / <span class="text-urdu-kasheeda">مقدار</span></th>
                                        <th class="align-middle">Weight per sack / <span class="text-urdu-kasheeda">وزن فی بوری</span></th>
                                        <th class="align-middle">Price / <span class="text-urdu-kasheeda">قیمت</span></th>
                                        <th class="align-middle">Total Price / <span class="text-urdu-kasheeda">کل قیمت</span></th>
                                        <th class="align-middle">ٖFertilizer Type / <span class="text-urdu-kasheeda">کھاد کی قسم</span></th>
                                        <th class="align-middle">Date &amp; Time / <span class="text-urdu-kasheeda">تاریخ اور وقت</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($fertilizers->count() > 0)
                                        @foreach ($fertilizers as $fertilizer)
                                            <tr>
                                                <td class="align-middle">{{ $fertilizer->quantity }} Sacks</td>
                                                <td class="align-middle">{{ $fertilizer->weight }} Kgs</td>
                                                <td class="align-middle">Rs {{ $fertilizer->paid }} /-</td>
                                                <td class="align-middle">Rs {{ $fertilizer->quantity * $fertilizer->paid }} /-</td>
                                                <td class="align-middle">{{ $fertilizer->type }}</td>
                                                <td class="align-middle">{{ date('d-F-Y h:i A', strtotime($fertilizer->created_at)) }}</td>
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
                    <section id="fertilizer-records-section">
                        <h3 class="text-success fw-700 mb-3">Medicine Records / <span class="text-urdu-kasheeda">ادویات کا ریکارڈ</span></h3>
                        <div class="table-responsive">
                            <table class="table table-striped" id="medicine-records-table">
                                <thead class="table-success">
                                    <tr>
                                        <th class="align-middle">Medicine / <span class="text-urdu-kasheeda">دوائی</span></th>
                                        <th class="align-middle">Quantity / <span class="text-urdu-kasheeda">مقدار</span></th>
                                        <th class="align-middle">Price / <span class="text-urdu-kasheeda">قیمت</span></th>
                                        <th class="align-middle">Total Price / <span class="text-urdu-kasheeda">کل قیمت</span></th>
                                        <th class="align-middle">ٖMedicine Type / <span class="text-urdu-kasheeda">دوائی کی قسم</span></th>
                                        <th class="align-middle">Date &amp; Time / <span class="text-urdu-kasheeda">تاریخ اور وقت</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($medicines->count() > 0)
                                        @foreach ($medicines as $medicine)
                                            <tr>
                                                <td class="align-middle">{{ $medicine->medicineType->name }}</td>
                                                <td class="align-middle">{{ $medicine->quantity }}</td>
                                                <td class="align-middle">Rs {{ $medicine->paid }} /-</td>
                                                <td class="align-middle">Rs {{ $medicine->quantity * $medicine->paid }} /-</td>
                                                <td class="align-middle">{{ $medicine->medicineType->type }}</td>
                                                <td class="align-middle">{{ date('d-F-Y h:i A', strtotime($medicine->created_at)) }}</td>
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
                    <section id="wheat-stock-section">
                        <h3 class="text-success fw-700 mb-3">Wheat Stocks / <span class="text-urdu-kasheeda">گندم کا اسٹاک</span></h3>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="table-success">
                                    <tr>
                                        <th class="align-middle">No of sacks / <span class="text-urdu-kasheeda">بوریوں کی تعداد</span></th>
                                        <th class="align-middle">Weight per sack / <span class="text-urdu-kasheeda">فی بوری وزن</span></th>
                                        <th class="align-middle">Price per 40Kg / <span class="text-urdu-kasheeda">قیمت فی من</span></th>
                                        <th class="align-middle">Total Price / <span class="text-urdu-kasheeda">کل قیمت</span></th>
                                        <th class="align-middle">Category / <span class="text-urdu-kasheeda">گندم کی قسم</span></th>
                                        <th class="align-middle">Date &amp; Time / <span class="text-urdu-kasheeda">تاریخ اور وقت</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($wheat_stocks->count() > 0)
                                        @foreach ($wheat_stocks as $stock)
                                            <tr>
                                                <td class="align-middle">{{ $stock->num_of_sack }}</td>
                                                <td class="align-middle">{{ $stock->weight_per_sack }} Kgs</td>
                                                <td class="align-middle">Rs {{ $stock->price }} /-</td>
                                                <td class="align-middle">Rs {{ ((($stock->num_of_sack * $stock->weight_per_sack) / 40) * $stock->price) - (($stock->commission/100) * ((($stock->num_of_sack * $stock->weight_per_sack) / 40) * $stock->price)) }} /-</td>
                                                <td class="align-middle">{{ $stock->category }}</td>
                                                <td class="align-middle">{{ date('d-F-Y h:i A', strtotime($stock->created_at)) }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center font-italic">No record to show.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </section>
                    <section id="wheat-record-section">
                        <h3 class="text-success mb-3 fw-700">Wheat / <span class="text-urdu-kasheeda">گندم</span></h3>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="table-success">
                                    <tr>
                                        <th class="align-middle">Quantity / <span class="text-urdu-kasheeda">مقدار</span></th>
                                        <th class="align-middle">Price paid per 40Kgs / <span class="text-urdu-kasheeda">فی من ادائیگی</span></th>
                                        <th class="align-middle">Total Price / <span class="text-urdu-kasheeda">کل قیمت</span></th>
                                        <th class="align-middle">Category / <span class="text-urdu-kasheeda">گندم کی قسم</span></th>
                                        <th class="align-middle">Date &amp; Time / <span class="text-urdu-kasheeda">تاریخ اور وقت</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($wheat_records->count() > 0)
                                        @foreach ($wheat_records as $record)
                                            <tr>
                                                <td class="align-middle">{{ $record->quantity }} Kgs</td>
                                                <td class="align-middle">Rs {{ $record->paid_per_mann }} /-</td>
                                                <td class="align-middle">Rs {{ ($record->quantity / 40) * $record->paid_per_mann }} /-</td>
                                                <td class="align-middle">{{ $record->category }}</td>
                                                <td class="align-middle">{{ date('d-F-Y h:i A', strtotime($record->created_at)) }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center font-italic" colspan="5">No record to show.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </section>
                    <section id="wheat-stock-section">
                        <h3 class="text-success fw-700 mb-3">Rice Stocks / <span class="text-urdu-kasheeda">چاول کا اسٹاک</span></h3>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="table-success">
                                    <tr>
                                        <th class="align-middle">No of sacks / <span class="text-urdu-kasheeda">بوریوں کی تعداد</span></th>
                                        <th class="align-middle">Weight per sack / <span class="text-urdu-kasheeda">فی بوری وزن</span></th>
                                        <th class="align-middle">Price per 40Kg / <span class="text-urdu-kasheeda">قیمت فی من</span></th>
                                        <th class="align-middle">Total Price / <span class="text-urdu-kasheeda">کل قیمت</span></th>
                                        <th class="align-middle">Rice Type / <span class="text-urdu-kasheeda">چاول کی قسم</span></th>
                                        <th class="align-middle">Category / <span class="text-urdu-kasheeda">چاول کا معیار</span></th>
                                        <th class="align-middle">Date &amp; Time / <span class="text-urdu-kasheeda">تاریخ اور وقت</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($rice_stocks->count() > 0)
                                        @foreach ($rice_stocks as $stock)
                                            <tr>
                                                <td class="align-middle">{{ $stock->num_of_sack }}</td>
                                                <td class="align-middle">{{ $stock->weight_per_sack }} Kgs</td>
                                                <td class="align-middle">Rs {{ $stock->price }} /-</td>
                                                <td class="align-middle">Rs {{ ((($stock->num_of_sack * $stock->weight_per_sack) / 40) * $stock->price) - (($stock->commission/100) * ((($stock->num_of_sack * $stock->weight_per_sack) / 40) * $stock->price)) }} /-</td>
                                                <td class="align-middle">{{ $stock->riceType->name }}</td>
                                                <td class="align-middle">{{ $stock->category }}</td>
                                                <td class="align-middle">{{ date('d-F-Y h:i A', strtotime($stock->created_at)) }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center font-italic">No record to show.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </section>
                    <section id="wheat-record-section">
                        <h3 class="text-success mb-3 fw-700">Rice / <span class="text-urdu-kasheeda">چاول</span></h3>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="table-success">
                                    <tr>
                                        <th class="align-middle">Quantity / <span class="text-urdu-kasheeda">مقدار</span></th>
                                        <th class="align-middle">Price paid per 40Kgs / <span class="text-urdu-kasheeda">فی من ادائیگی</span></th>
                                        <th class="align-middle">Total Price / <span class="text-urdu-kasheeda">کل قیمت</span></th>
                                        <th class="align-middle">Rice Type / <span class="text-urdu-kasheeda">چاول کی قسم</span></th>
                                        <th class="align-middle">Category / <span class="text-urdu-kasheeda">چاول کا معیار</span></th>
                                        <th class="align-middle">Date &amp; Time / <span class="text-urdu-kasheeda">تاریخ اور وقت</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($rice_records->count() > 0)
                                        @foreach ($rice_records as $record)
                                            <tr>
                                                <td class="align-middle">{{ $record->quantity }} Kgs</td>
                                                <td class="align-middle">Rs {{ $record->paid_per_mann }} /-</td>
                                                <td class="align-middle">Rs {{ ($record->quantity / 40) * $record->paid_per_mann }} /-</td>
                                                <td class="align-middle">{{ $record->riceType->name }}</td>
                                                <td class="align-middle">{{ $record->category }}</td>
                                                <td class="align-middle">{{ date('d-F-Y h:i A', strtotime($record->created_at)) }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center font-italic" colspan="6">No record to show.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </section>
                    <section id="account-section">
                        <h3 class="text-success fw-700 mb-3">Others / <span class="text-urdu-kasheeda">دیگر اشیاء</span></h3>
                        <div class="table-responsive">
                            <table class="table table-striped" id="oil-table">
                                <thead class="table-success">
                                    <tr>
                                        <th>Description / <span class="text-urdu-kasheeda">تفصیل</span></th>
                                        <th>Amount / <span class="text-urdu-kasheeda">رقم</span></th>
                                        <th>Date &amp; Time / <span class="text-urdu-kasheeda">تاریخ اور وقت</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($others->count() > 0)
                                        @foreach ($others as $record)
                                            <tr>
                                                <td>{{ $record->description }}</td>
                                                <td>Rs {{ $record->amount }} /-</td>
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
                </section>
            </main>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#oil-section').on('click', '.view-station', function(e) {
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
