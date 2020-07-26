@extends('master.dashboard-master')

@section('title')
    <title>Others - {{ config('app.name') }}</title>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('others') }}
@endsection

@section('content')
    <section class="container-fluid py-3">
        @include('components.customer-search')

        <div class="row">
            <div class="col-md-4 offset-md-4">
                <h4 class="alert alert-success text-center mb-3"><strong>Total Amount:</strong> Rs {{ $oth->amount ?? 0 }} /-</h4>
            </div>
        </div>

        <div id="other-records">
            <h1 class="text-center text-success mb-3 fw-900">Others / <span class="text-urdu-kasheeda">دیگر اشیاء</span></h1>
            @include('components.success')
            @if ($dates->count() > 0)
                @foreach ($dates as $date)
                    <h3 class="text-success fw-700 mb-3">{{ date('d-F-Y (l)', strtotime($date->date)) }}</h3>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-success">
                                <th style="width: 15%" class="align-middle">Name / <span class="text-urdu-kasheeda">نام</span></th>
                                <th style="width: 45%" class="align-middle">Description / <span class="text-urdu-kasheeda">تفصیل</span></th>
                                <th style="width: 15%" class="align-middle">Amount / <span class="text-urdu-kasheeda">رقم</span></th>
                                <th style="width: 10%" class="align-middle">Time / <span class="text-urdu-kasheeda">وقت</span></th>
                                <th style="width: 10%" class="align-middle"></th>
                            </thead>
                            <tbody>
                                @foreach ($others as $other)
                                    @if (date('Y-m-d', strtotime($other->created_at)) == $date->date)
                                        <tr>
                                            <td><a href="" class="view-customers" data-id="{{ base64_encode(($other->profile->id * 123456789) / 12098) }}">{{ $other->profile->name }}</a></td>
                                            <td>{{ $other->description }}</td>
                                            <td>{{ 'Rs ' . $other->amount . ' /-' }}</td>
                                            <td>{{ date('h:i A', strtotime($other->created_at)) }}</td>
                                            <td>
                                                <a href="{{ route('other.show', base64_encode(($other->id * 123456789) / 12098)) }}" class="d-inline">View</a>
                                                <p class="mb-0 d-inline"> | </p>
                                                <a href="{{ route('other.edit', base64_encode(($other->id * 123456789) / 12098)) }}" class="d-inline">Edit</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach
            @else
                <div class="alert alert-danger mx-auto w-50 text-center font-italic">No record to show.</div>
            @endif
        </div>

        <div style="display: flex; justify-content: space-between;">
            <div class="pagination">
                {{ $dates->links() }}
            </div>
            <p>Showing {{ $dates->firstItem() ?? 0 }} - {{ $dates->lastItem() ?? 0 }} of {{ $dates->count() }} results</p>
        </div>
    </section>
@endsection

@section('script')
    @include('components.customer-search-js')
    <script>
        $(document).ready(function() {
            $('#other-records').on('click', '.view-customers', function(e) {
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
