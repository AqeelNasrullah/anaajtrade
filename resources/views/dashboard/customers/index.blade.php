@extends('master.dashboard-master')

@section('title')
    <title>Customers - {{ config('app.name') }}</title>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('customers') }}
@endsection

@section('content')
    <section>
        <div class="customer-modal p-0 m-0"></div>
        <div class="container-fluid py-3">
            <h1 class="text-center fw-900 text-success mb-3">Customers / <span class="text-urdu-kasheeda">خریدار</span></h1>

            @include('components.error')
            @include('components.success')

            <div>
                <div class="float-left mb-3">
                    <input type="text" name="search_customer" id="search-customer" placeholder="Search ..." width="175px" class="form-control">
                </div>
                <div class="float-right mb-3">
                    <a href="{{ route('profile.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Add New Customer</a>
                </div>
                <br class="clear">
            </div>
            <div class="table-responsive">
                <table class="table table-striped" id="customer-table">
                    <thead class="table-success">
                        <tr>
                            <th></th>
                            <th class="align-middle">Name / <span class="text-urdu-kasheeda">نام</span></th>
                            <th class="align-middle">Phone Number / <span class="text-urdu-kasheeda">فون نمبر</span></th>
                            <th class="align-middle">CNIC / <span class="text-urdu-kasheeda">شناختی کارڈ نمبر</span></th>
                            <th class="align-middle">Address / <span class="text-urdu-kasheeda">پتہ</span></th>
                            <th class="align-middle">Role / <span class="text-urdu-kasheeda">کردار</span></th>
                            <th class="align-middle"></th>
                        </tr>
                    </thead>
                    <tbody id="customers-table">
                        @if ($customers->count() > 0)
                            @foreach ($customers as $profile)
                            <tr>
                                <td class="align-middle"><img src="{{ asset('images/dps/' . $profile->avatar) }}" width="40px" alt="Image not found"></td>
                                <td class="align-middle">{{ $profile->name }}</td>
                                <td class="align-middle">{{ $profile->phone_number }}</td>
                                <td class="align-middle">{{ $profile->cnic }}</td>
                                <td class="align-middle">{{ $profile->address }}</td>
                                <td class="align-middle">{{ $profile->role->name }}</td>
                                <td class="align-middle">
                                    <a class="d-inline view-customer" data-id="{{ base64_encode(($profile->id * 123456789) / 12098) }}" href="">View</a>
                                    <p class="mb-0 d-inline">|</p>
                                    <a class="d-inline" href="{{ route('profile.edit', base64_encode(($profile->id * 123456789) / 12098)) }}">Edit</a>
                                    <p class="mb-0 d-inline">|</p>
                                    <form class="d-inline" action="{{ route('profile.destroy', base64_encode(($profile->id * 123456789) / 12098)) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link delete-customer" style="margin: 0px !important;padding: 0px !important;">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center font-italic">Nothing to Show</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div>
                <div class="mb-0 float-left pager">{{ $customers->links() }}</div>
                <p class="mb-0 float-right show-results">Showing {{ $customers->firstItem() ?? 0 }} - {{ $customers->lastItem() ?? 0 }} of {{ $customers->total() }} results</p>
                <br class="clear">
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#search-customer').keyup(function() {
                var customer = $(this).val();
                $.get('{{ route("profile.searchCustomers") }}', {name:customer}, function(data) {
                    $('#customers-table').html(data.data_output);
                    $('.pager, .show-results').addClass('d-none');
                }, 'json');
            });
            $('#customer-table').on('click', '.view-customer',function(e) {
                var id = $(this).data('id');
                $.get('{{ route("customerSearch.searchCustomer") }}', {id:id}, function(data) {
                    $('.customer-modal').html(data.profile);
                    $('#display-customer').modal('show');
                }, 'json');
                e.preventDefault();
            });
            $('#customer-table').on('click', '.delete-customer', function() {
                if (confirm('Are you sure you want to delete customer?')) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>
@endsection
