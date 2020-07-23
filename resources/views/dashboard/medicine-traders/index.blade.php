@extends('master.dashboard-master')

@section('title')
    <title>Medicine Traders - {{ config('app.name') }}</title>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('medicine_traders') }}
@endsection

@section('content')
    <section class="container-fluid py-3">
        <h1 class="text-success text-center fw-900 mb-3">Medicine Traders / <span class="text-urdu-kasheeda">ادویات کے تاجر</span></h1>

        @include('components.error')
        @include('components.success')

        <div class="d-flex mb-3" style="justify-content: space-between;">
            <input type="text" id="search" placeholder="Search" class="form-control" style="width: 175px;">
            <a href="{{ route('medicineTraders.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Add Medicine Trader</a>
        </div>
        <div class="table-responsive mb-3" id="fertilizer-traders-table">
            <table class="table table-striped">
                <thead class="table-success">
                    <tr>
                        <th style="width: 5%;" class="align-middle"></th>
                        <th style="width: 20%;" class="align-middle">Name / <span class="text-urdu-kasheeda">نام</span></th>
                        <th style="width: 20%;" class="align-middle">Phone Number / <span class="text-urdu-kasheeda">فون نمبر</span></th>
                        <th style="width: 40%;" class="align-middle">Address / <span class="text-urdu-kasheeda">پتہ</span></th>
                        <th style="width: 15%;" class="align-middle"></th>
                    </tr>
                </thead>
                <tbody id="traders-table-body">
                    @forelse ($traders as $trader)
                        <tr>
                            <td class="align-middle"><img src="{{ asset('images/logos/' . $trader->avatar) }}" alt="Logo not found" width="45px"></td>
                            <td class="align-middle">{{ $trader->name }}</td>
                            <td class="align-middle">{{ $trader->phone_number }}</td>
                            <td class="align-middle">{{ $trader->address }}</td>
                            <td class="align-middle">
                                <a href="{{ route('medicineTraders.show', base64_encode(($trader->id * 123456789) / 12098)) }}" class="d-inline">View</a>
                                <p class="d-inline mb-0"> | </p>
                                <a href="{{ route('medicineTraders.edit', base64_encode(($trader->id * 123456789) / 12098)) }}" class="d-inline">Edit</a>
                                <p class="d-inline mb-0"> | </p>
                                <form action="{{ route('medicineTraders.destroy', base64_encode(($trader->id * 123456789) / 12098)) }}" method="post" class="d-inline">
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
            <p class="results">Showing {{ $traders->firstItem() ?? 0 }} - {{ $traders->lastItem() ?? 0 }} of {{ $traders->total() ?? 0 }} results</p>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#search').keyup(function() {
                var name = $(this).val();
                $.get('{{ route("medicineTraders.searchMedicineTrader") }}', {name:name}, function(data) {
                    $('#traders-table-body').html(data.data_output);
                    if (data.flag == 1) {
                        $('.pagination, .results').addClass('d-none');
                    } else {
                        $('.pagination, .results').removeClass('d-none');
                    }
                }, 'json');
            });

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
