@extends('master.dashboard-master')

@section('title')
    <title>Fertilizer Traders - {{ config('app.name') }}</title>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('fertilizer_traders') }}
@endsection

@section('content')
    <section class="container-fluid py-3">
        <h1 class="text-success text-center fw-900 mb-3">Fertilizer Traders / <span class="text-urdu-kasheeda">کھاد کے تاجر</span></h1>

        @include('components.error')
        @include('components.success')

        <div class="d-flex mb-3" style="justify-content: space-between;">
            <input type="text" id="search" placeholder="Search" class="form-control" style="width: 175px;">
            <a href="{{ route('fertilizerTraders.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Add Fertilizer Trader</a>
        </div>
        <div class="table-responsive mb-3" id="fertilizer-traders-table">
            <table class="table table-striped">
                <thead class="table-success">
                    <tr>
                        <th class="align-middle"></th>
                        <th class="align-middle">Name / <span class="text-urdu-kasheeda">نام</span></th>
                        <th class="align-middle">Phone Number / <span class="text-urdu-kasheeda">فون نمبر</span></th>
                        <th class="align-middle">Address / <span class="text-urdu-kasheeda">پتہ</span></th>
                        <th class="align-middle"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($traders as $trader)
                        <tr>
                            <td style="width: 5%;" class="align-middle"><img src="{{ asset('images/logos/' . $trader->avatar) }}" alt="Logo not found" width="45px"></td>
                            <td style="width: 20%;" class="align-middle">{{ $trader->name }}</td>
                            <td style="width: 20%;" class="align-middle">{{ $trader->phone_number }}</td>
                            <td style="width: 40%;" class="align-middle">{{ $trader->address }}</td>
                            <td style="width: 15%;" class="align-middle">
                                <a href="{{ route('fertilizerTraders.show', base64_encode(($trader->id * 123456789) / 12098)) }}" class="d-inline">View</a>
                                <p class="d-inline mb-0"> | </p>
                                <a href="{{ route('fertilizerTraders.edit', base64_encode(($trader->id * 123456789) / 12098)) }}" class="d-inline">Edit</a>
                                <p class="d-inline mb-0"> | </p>
                                <form action="{{ route('fertilizerTraders.destroy', base64_encode(($trader->id * 123456789) / 12098)) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-0 m-0 btn btn-link delete-trader d-inline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center font-italic">Nothing to show</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex" style="justify-content: space-between;">
            <div class="pagination">
                {{ $traders->links() }}
            </div>
            <p>Showing {{ $traders->firstItem() ?? 0 }} - {{ $traders->lastItem() ?? 0 }} of {{ $traders->total() ?? 0 }} results</p>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#fertilizer-traders-table').on('click', '.delete-trader', function() {
                if (confirm('Are you sure you want to delete?')) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>
@endsection
