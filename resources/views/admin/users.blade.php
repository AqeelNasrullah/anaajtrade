@extends('master.dashboard-master')

@section('title')
    <title>Users - {{ config('app.name') }}</title>
@endsection

@section('content')
    <section class="container-fluid py-3">
        <h1 class="text-center text-success mb-3 fw-900">Users / <span class="text-urdu-kasheeda">صارفین</span></h1>

        @include('components.error')
        @include('components.success')

        @if (auth()->user()->profile->role_id == 1)
        <h3 class="text-success mb-3">Admins</h3>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-success">
                    <th></th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>CNIC</th>
                    <th>Address</th>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    @if ($user->profile->role_id == 1)
                    <tr>
                        <td class="align-middle"><img src="{{ asset('images/dps/' . $user->profile->avatar) }}" width="45px" alt="Logo not found"></td>
                        <td class="align-middle">{{ $user->profile->name }}</td>
                        <td class="align-middle">{{ $user->phone_number }}</td>
                        <td class="align-middle">{{ $user->profile->cnic }}</td>
                        <td class="align-middle">{{ $user->profile->address }}</td>
                    </tr>
                    @endif
                    @empty
                        <tr>
                            <td colspan="6" class="text-center font-italic">No request to show</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @endif
        <h3 class="text-success mb-3">Moderators</h3>
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
                    @forelse ($users as $user)
                    @if ($user->profile->role_id == 2)
                    <tr>
                        <td class="align-middle"><img src="{{ asset('images/dps/' . $user->profile->avatar) }}" width="45px" alt="Logo not found"></td>
                        <td class="align-middle">{{ $user->profile->name }}</td>
                        <td class="align-middle">{{ $user->phone_number }}</td>
                        <td class="align-middle">{{ $user->profile->cnic }}</td>
                        <td class="align-middle">{{ $user->profile->address }}</td>
                        <td class="align-middle"><a href="">{!! auth()->user()->profile->role_id == 1 ? '<a href="' . route('privileges.removeMod', $user->profile->id) . '">Remove Moderator</a>':'' !!}</td>
                    </tr>
                    @endif
                    @empty
                        <tr>
                            <td colspan="6" class="text-center font-italic">No request to show</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <h3 class="text-success mb-3">Commission Agents</h3>
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
                    @forelse ($users as $user)
                    @if ($user->profile->role_id == 3)
                    <tr>
                        <td class="align-middle"><img src="{{ asset('images/dps/' . $user->profile->avatar) }}" width="45px" alt="Logo not found"></td>
                        <td class="align-middle">{{ $user->profile->name }}</td>
                        <td class="align-middle">{{ $user->phone_number }}</td>
                        <td class="align-middle">{{ $user->profile->cnic }}</td>
                        <td class="align-middle">{{ $user->profile->address }}</td>
                        <td class="align-middle"><a href="{{ route('privileges.addMod', $user->profile->id) }}">Add Moderator</a></td>
                    </tr>
                    @endif
                    @empty
                        <tr>
                            <td colspan="6" class="text-center font-italic">No request to show</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
