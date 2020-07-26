@extends('master.dashboard-master')

@section('title')
    <title>Statistics - {{ config('app.name') }}</title>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('statistics') }}
@endsection

@section('content')
    <section class="container-fluid py-3">
        <h1 class="text-center text-success mb-3 fw-900">Statistics / <span class="text-urdu-kasheeda">اعداد و شمار</span></h1>

        {{-- Account Book --}}
        <section>
            <h3 class="text-success mb-3 fw-700">Account Book / <span class="text-urdu-kasheeda">کھاتہ</span></h3>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-success">
                        <tr>
                            <th style="width: 10%" class="text-center align-middle"></th>
                            <th style="width: 30%" class="text-center align-middle">Last Week<br>({{ date('d-F-Y', strtotime('-1 week', time())) }} - {{ date('d-F-Y', time()) }})</th>
                            <th style="width: 30%" class="text-center align-middle">Last Month<br>({{ date('d-F-Y', strtotime('-1 month', time())) }} - {{ date('d-F-Y', time()) }})</th>
                            <th style="width: 30%" class="text-center align-middle">Last 6 Months<br>({{ date('d-F-Y', strtotime('-6 months', time())) }} - {{ date('d-F-Y', time()) }})</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center align-middle">Loan</td>
                            <td class="text-center align-middle">Rs {{ $account['weekly_loan']->amount ?? 0  }} /-</td>
                            <td class="text-center align-middle">Rs {{ $account['monthly_loan']->amount ?? 0  }} /-</td>
                            <td class="text-center align-middle">Rs {{ $account['seasonly_loan']->amount ?? 0  }} /-</td>
                        </tr>
                        <tr>
                            <td class="text-center align-middle">Returned</td>
                            <td class="text-center align-middle">Rs {{ $account['weekly_returned']->amount ?? 0 }} /-</td>
                            <td class="text-center align-middle">Rs {{ $account['monthly_returned']->amount ?? 0 }} /-</td>
                            <td class="text-center align-middle">Rs {{ $account['seasonly_returned']->amount ?? 0 }} /-</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        {{-- Oil --}}
        <section>
            <h3 class="text-success mb-3 fw-700">Oil / <span class="text-urdu-kasheeda">تیل</span></h3>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-success">
                        <tr>
                            <th style="width: 10%" class="text-center align-middle"></th>
                            <th style="width: 30%" class="text-center align-middle">Last Week<br>({{ date('d-F-Y', strtotime('-1 week', time())) }} - {{ date('d-F-Y', time()) }})</th>
                            <th style="width: 30%" class="text-center align-middle">Last Month<br>({{ date('d-F-Y', strtotime('-1 month', time())) }} - {{ date('d-F-Y', time()) }})</th>
                            <th style="width: 30%" class="text-center align-middle">Last 6 Months<br>({{ date('d-F-Y', strtotime('-6 months', time())) }} - {{ date('d-F-Y', time()) }})</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center align-middle">Sale</td>
                            <td class="text-center align-middle">{{ $oil['weekly_oil']->quantity ?? 0 }} Litre</td>
                            <td class="text-center align-middle">{{ $oil['monthly_oil']->quantity ?? 0 }} Litre</td>
                            <td class="text-center align-middle">{{ $oil['seasonly_oil']->quantity ?? 0 }} Litre</td>
                        </tr>
                        <tr>
                            <td class="text-center align-middle">Total Amount</td>
                            <td class="text-center align-middle">Rs {{ $oil['weekly_amount']->amount ?? 0 }} /-</td>
                            <td class="text-center align-middle">Rs {{ $oil['monthly_amount']->amount ?? 0 }} /-</td>
                            <td class="text-center align-middle">Rs {{ $oil['seasonly_amount']->amount ?? 0 }} /-</td>
                        </tr>
                        <tr>
                            <td class="text-center align-middle">Profit</td>
                            <td class="text-center align-middle">Rs {{ $oil['weekly_profit']->amount ?? 0 }} /-</td>
                            <td class="text-center align-middle">Rs {{ $oil['monthly_profit']->amount ?? 0 }} /-</td>
                            <td class="text-center align-middle">Rs {{ $oil['seasonly_profit']->amount ?? 0 }} /-</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        {{-- Fertilizer Stock --}}
        <section>
            <h3 class="text-success mb-3 fw-700">Fertilizer Stock / <span class="text-urdu-kasheeda">کھاد کا اسٹاک</span></h3>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-success">
                        <tr>
                            <th style="width: 10%" class="text-center align-middle"></th>
                            <th style="width: 30%" class="text-center align-middle">Last Week<br>({{ date('d-F-Y', strtotime('-1 week', time())) }} - {{ date('d-F-Y', time()) }})</th>
                            <th style="width: 30%" class="text-center align-middle">Last Month<br>({{ date('d-F-Y', strtotime('-1 month', time())) }} - {{ date('d-F-Y', time()) }})</th>
                            <th style="width: 30%" class="text-center align-middle">Last 6 Months<br>({{ date('d-F-Y', strtotime('-6 months', time())) }} - {{ date('d-F-Y', time()) }})</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fertilizer as $k => $l)
                        <tr>
                            <td class="text-center align-middle">{{ $k }} Stock</td>
                            @foreach ($l as $m => $n)
                            <td class="text-center align-middle">{{ $n ?? 0 }} Sacks</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        {{-- Fertilizer Record --}}
        <section>
            <h3 class="text-success mb-3 fw-700">Fertilizer Record / <span class="text-urdu-kasheeda">کھاد کا ریکارڈ</span></h3>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-success">
                        <tr>
                            <th style="width: 10%" class="text-center align-middle"></th>
                            <th style="width: 30%" class="text-center align-middle">Last Week<br>({{ date('d-F-Y', strtotime('-1 week', time())) }} - {{ date('d-F-Y', time()) }})</th>
                            <th style="width: 30%" class="text-center align-middle">Last Month<br>({{ date('d-F-Y', strtotime('-1 month', time())) }} - {{ date('d-F-Y', time()) }})</th>
                            <th style="width: 30%" class="text-center align-middle">Last 6 Months<br>({{ date('d-F-Y', strtotime('-6 months', time())) }} - {{ date('d-F-Y', time()) }})</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fert_record as $k => $l)
                            @foreach ($l as $m => $n)
                                <tr>
                                    <td class="text-center align-middle">{{ $k . ' ' . $m }}</td>
                                    @foreach ($n as $o => $p)
                                    <td class="text-center align-middle"> {{ $m == 'Sale' ? ($p ?? 0) . ' Sacks' : 'Rs ' . ($p ?? 0) . ' /-' }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        {{-- Medicine Stock --}}
        <section>
            <h3 class="text-success mb-3 fw-700">Medicine Stock / <span class="text-urdu-kasheeda">ادویات کا اسٹاک</span></h3>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-success">
                        <tr>
                            <th style="width: 10%" class="text-center align-middle"></th>
                            <th style="width: 30%" class="text-center align-middle">Last Week<br>({{ date('d-F-Y', strtotime('-1 week', time())) }} - {{ date('d-F-Y', time()) }})</th>
                            <th style="width: 30%" class="text-center align-middle">Last Month<br>({{ date('d-F-Y', strtotime('-1 month', time())) }} - {{ date('d-F-Y', time()) }})</th>
                            <th style="width: 30%" class="text-center align-middle">Last 6 Months<br>({{ date('d-F-Y', strtotime('-6 months', time())) }} - {{ date('d-F-Y', time()) }})</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($medicine as $k => $l)
                        <tr>
                            <td class="text-center align-middle">{{ $k }} Stock</td>
                            @foreach ($l as $m => $n)
                            <td class="text-center align-middle">{{ $n ?? 0 }} Packs</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        {{-- Medicine Record --}}
        <section>
            <h3 class="text-success mb-3 fw-700">Medicine Record / <span class="text-urdu-kasheeda">ادویات کا ریکارڈ</span></h3>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-success">
                        <tr>
                            <th style="width: 10%" class="text-center align-middle"></th>
                            <th style="width: 30%" class="text-center align-middle">Last Week<br>({{ date('d-F-Y', strtotime('-1 week', time())) }} - {{ date('d-F-Y', time()) }})</th>
                            <th style="width: 30%" class="text-center align-middle">Last Month<br>({{ date('d-F-Y', strtotime('-1 month', time())) }} - {{ date('d-F-Y', time()) }})</th>
                            <th style="width: 30%" class="text-center align-middle">Last 6 Months<br>({{ date('d-F-Y', strtotime('-6 months', time())) }} - {{ date('d-F-Y', time()) }})</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($med_record as $k => $l)
                            @foreach ($l as $m => $n)
                                <tr>
                                    <td class="align-middle text-center">{{ $k . ' ' . $m }}</td>
                                    @foreach ($n as $o => $p)
                                        <td class="align-middle text-center">{{ $m == 'Sale' ? ($p ?? 0) . ' Packs' : 'Rs ' . ($p ?? 0) . ' /-' }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        {{-- Wheat Stock --}}
        <section>
            <h3 class="text-success mb-3 fw-700">Wheat Stock / <span class="text-urdu-kasheeda">گندم کا اسٹاک</span></h3>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-success">
                        <tr>
                            <th style="width: 10%" class="text-center align-middle"></th>
                            <th style="width: 30%" class="text-center align-middle">Last Week<br>({{ date('d-F-Y', strtotime('-1 week', time())) }} - {{ date('d-F-Y', time()) }})</th>
                            <th style="width: 30%" class="text-center align-middle">Last Month<br>({{ date('d-F-Y', strtotime('-1 month', time())) }} - {{ date('d-F-Y', time()) }})</th>
                            <th style="width: 30%" class="text-center align-middle">Last 6 Months<br>({{ date('d-F-Y', strtotime('-6 months', time())) }} - {{ date('d-F-Y', time()) }})</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($wheat as $k => $l)
                            @foreach ($l as $m => $n)
                                <tr>
                                    <td class="align-middle text-center">{{ $m . ' (' . $k . ')' }}</td>
                                    @foreach ($n as $o => $p)
                                        <td class="align-middle text-center">{{ $m == 'Stock' ? ((integer)$p ?? 0) . ' Kgs' : 'Rs ' . ((integer)$p ?? 0) . ' /-' }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        {{-- Wheat Record --}}
        <section>
            <h3 class="text-success mb-3 fw-700">Wheat Record / <span class="text-urdu-kasheeda">گندم کا ریکارڈ</span></h3>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-success">
                        <tr>
                            <th style="width: 10%" class="text-center align-middle"></th>
                            <th style="width: 30%" class="text-center align-middle">Last Week<br>({{ date('d-F-Y', strtotime('-1 week', time())) }} - {{ date('d-F-Y', time()) }})</th>
                            <th style="width: 30%" class="text-center align-middle">Last Month<br>({{ date('d-F-Y', strtotime('-1 month', time())) }} - {{ date('d-F-Y', time()) }})</th>
                            <th style="width: 30%" class="text-center align-middle">Last 6 Months<br>({{ date('d-F-Y', strtotime('-6 months', time())) }} - {{ date('d-F-Y', time()) }})</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($wh_record as $k => $l)
                            @foreach ($l as $m => $n)
                                <tr>
                                    <td class="align-middle text-center">{{ $m . ' (' . $k . ')' }}</td>
                                    @foreach ($n as $o => $p)
                                        <td class="align-middle text-center">{{ $m == 'Sale' ? ((integer)$p ?? 0) . ' Kgs' : 'Rs ' . ((integer)$p ?? 0) . ' /-' }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        {{-- Rice Stock --}}
        <section>
            <h3 class="text-success mb-3 fw-700">Rice Stock / <span class="text-urdu-kasheeda">چاول کا اسٹاک</span></h3>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-success">
                        <tr>
                            <th style="width: 10%" class="text-center align-middle"></th>
                            <th style="width: 30%" class="text-center align-middle">Last Week<br>({{ date('d-F-Y', strtotime('-1 week', time())) }} - {{ date('d-F-Y', time()) }})</th>
                            <th style="width: 30%" class="text-center align-middle">Last Month<br>({{ date('d-F-Y', strtotime('-1 month', time())) }} - {{ date('d-F-Y', time()) }})</th>
                            <th style="width: 30%" class="text-center align-middle">Last 6 Months<br>({{ date('d-F-Y', strtotime('-6 months', time())) }} - {{ date('d-F-Y', time()) }})</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rice as $k => $l)
                            @foreach ($l as $m => $n)
                                @foreach ($n as $o => $p)
                                    <tr>
                                        <td class="text-center align-middle">{{ $k . ' (' . $m . ') ' . $o }}</td>
                                        @foreach ($p as $q => $r)
                                            <td class="text-center align-middle">{{ $o == 'Stock' ? ((integer)$r ?? 0) . ' Kgs' : 'Rs ' . ((integer)$r ?? 0) . ' /-' }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        {{-- Rice Record --}}
        <section>
            <h3 class="text-success mb-3 fw-700">Rice Record / <span class="text-urdu-kasheeda">چاول کا ریکارڈ</span></h3>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-success">
                        <tr>
                            <th style="width: 10%" class="text-center align-middle"></th>
                            <th style="width: 30%" class="text-center align-middle">Last Week<br>({{ date('d-F-Y', strtotime('-1 week', time())) }} - {{ date('d-F-Y', time()) }})</th>
                            <th style="width: 30%" class="text-center align-middle">Last Month<br>({{ date('d-F-Y', strtotime('-1 month', time())) }} - {{ date('d-F-Y', time()) }})</th>
                            <th style="width: 30%" class="text-center align-middle">Last 6 Months<br>({{ date('d-F-Y', strtotime('-6 months', time())) }} - {{ date('d-F-Y', time()) }})</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ri_record as $k => $l)
                            @foreach ($l as $m => $n)
                                @foreach ($n as $o => $p)
                                    <tr>
                                        <td class="text-center align-middle">{{ $k . ' (' . $m . ') ' . $o }}</td>
                                        @foreach ($p as $q => $r)
                                            <td class="text-center align-middle">{{ $o == 'Sale' ? ((integer)$r ?? 0) . ' Kgs' : 'Rs ' . ((integer)$r ?? 0) . ' /-' }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        {{-- Other --}}
        <section>
            <h3 class="text-success mb-3 fw-700">Other / <span class="text-urdu-kasheeda">دیگر اشیاء</span></h3>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-success">
                        <tr>
                            <th style="width: 10%" class="text-center align-middle"></th>
                            <th style="width: 30%" class="text-center align-middle">Last Week<br>({{ date('d-F-Y', strtotime('-1 week', time())) }} - {{ date('d-F-Y', time()) }})</th>
                            <th style="width: 30%" class="text-center align-middle">Last Month<br>({{ date('d-F-Y', strtotime('-1 month', time())) }} - {{ date('d-F-Y', time()) }})</th>
                            <th style="width: 30%" class="text-center align-middle">Last 6 Months<br>({{ date('d-F-Y', strtotime('-6 months', time())) }} - {{ date('d-F-Y', time()) }})</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center align-middle">Total Amount</td>
                            @foreach ($others as $other)
                                <td class="text-center align-middle">Rs {{ $other ?? 0 }} /-</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </section>
@endsection
