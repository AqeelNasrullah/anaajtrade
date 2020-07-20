@extends('master.dashboard-master')

@section('title')
    <title>Filling Stations - {{ config('app.name') }}</title>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('filling_stations') }}
@endsection

@section('content')
    <section>
        <div class="station-search-result m-0 p-0"></div>
        <div class="container-fluid py-3">
            <h1 class="text-center fw-900 text-success mb-3">Filling Stations / <span class="text-urdu-kasheeda">پیٹرول پمپ</span></h1>

            @include('components.error')
            @include('components.success')

            <div>
                <div class="float-left mb-3">
                    <input type="text" name="search" id="station-search" class="form-control" placeholder="Search" width="175px">
                </div>
                <div class="float-right mb-3">
                    <a href="{{ route('fillingStation.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Add Filling Station</a>
                </div>
                <br class="clear">
            </div>
            <div class="table-responsive">
                <table class="table table-striped" id="stations-table">
                    <thead class="table-success">
                        <tr>
                            <th></th>
                            <th class="align-middle">Station Name / <span class="text-urdu-kasheeda">پیٹرول پمپ کا نام</span></th>
                            <th class="align-middle">Phone Number / <span class="text-urdu-kasheeda">فون نمبر</span></th>
                            <th class="align-middle">Address / <span class="text-urdu-kasheeda">پتہ</span></th>
                            <th class="align-middle">Oil Company / <span class="text-urdu-kasheeda">تیل کی کمپنی</span></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="stations-table-body">
                        @if ($stations->count() > 0)
                            @foreach ($stations as $station)
                            <tr>
                                <td class="align-middle"><img src="{{ asset('images/logos/'.$station->oilCompany->avatar) }}" width="40px" alt="Image not found"></td>
                                <td class="align-middle">{{ $station->name }}</td>
                                <td class="align-middle">{{ $station->phone_number }}</td>
                                <td class="align-middle">{{ $station->address }}</td>
                                <td class="align-middle">{{ $station->oilCompany->name }}</td>
                                <td class="align-middle">
                                    <a class="d-inline station-popup" data-id="{{ base64_encode(($station->id * 123456789) / 12098) }}" href="{{ route('fillingStation.show', base64_encode(($station->id * 123456789) / 12098)) }}">View</a>
                                    <p class="mb-0 d-inline"> | </p>
                                    <a class="d-inline" href="{{ route('fillingStation.edit', base64_encode(($station->id * 123456789) / 12098)) }}">Edit</a>
                                    <p class="mb-0 d-inline"> | </p>
                                    <form action="{{ route('fillingStation.destroy', base64_encode(($station->id * 123456789) / 12098)) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-link p-0 m-0 d-inline stations-delete">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center font-italic">No filling station to show.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div>
                <div class="float-left pagination">
                    {{ $stations->links() }}
                </div>
                <div class="float-right no-of-results">
                    <p class="mb-0">Showing {{ $stations->firstItem() ?? 0 }} - {{ $stations->lastItem() ?? 0 }} of {{ $stations->total() }} results</p>
                </div>
                <br class="clear">
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#station-search').keyup(function() {
                var station = $(this).val();
                $.get('{{ route("fillingStation.filterFillingStation") }}', {station:station}, function(data) {
                    $('#stations-table-body').html(data.data_output);
                    if (data.flag) {
                        $('.pagination, .no-of-results').addClass('d-none');
                    } else {
                        $('.pagination, .no-of-results').removeClass('d-none');
                    }
                }, 'json');
            });

            // $('#stations-table').on('click', '.station-popup', function(e) {
            //     var id = $(this).data('id');
            //     $.get('{{ route("fillingStation.searchFillingStation") }}', {id:id}, function(data){
            //         $('.station-search-result').html(data.data_output);
            //         $('#station-search-popup').modal('show');
            //     }, 'json');
            //     e.preventDefault();
            // });

            $('#stations-table').on('click', '.stations-delete', function() {
                if (confirm('Are you sure you want to delete filling station?')) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>
@endsection
