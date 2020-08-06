@extends('master.dashboard-master')

@section('title')
    <title>Requests - {{ config('app.name') }}</title>
@endsection

@section('content')
    <section class="container-fluid py-3">
        <h1 class="text-center text-success mb-3 fw-900">Requests / <span class="text-urdu-kasheeda">درخواستیں</span></h1>

        @include('components.success')
        @include('components.error')

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-success">
                    <th></th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>CNIC</th>
                    <th>Address</th>
                    <th></th>
                </thead>
                <tbody>
                    @forelse ($profiles as $profile)
                    <tr>
                        <td class="align-middle"><img src="{{ asset('images/dps/' . $profile->avatar) }}" width="45px" alt="Logo not found"></td>
                        <td class="align-middle">{{ $profile->name }}</td>
                        <td class="align-middle">{{ $profile->phone_number }}</td>
                        <td class="align-middle">{{ $profile->cnic }}</td>
                        <td class="align-middle">{{ $profile->address }}</td>
                        <td class="align-middle"><a href="{{ route('request.confirm', $profile->id) }}">Confirm</a> | <a href="{{ route('request.remove', $profile->id) }}">Delete</a></td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center font-italic">No request to show</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex" style="justify-content: space-between;">
                <div class="pagination">{{ $profiles->links() }}</div>
                <p class="mb-0">Showing {{ $profiles->firstItem() ?? 0 }} - {{ $profiles->lastItem() ?? 0 }} of {{ $profiles->total() ?? 0 }} results</p>
            </div>
        </div>
    </section>
@endsection
