@extends('master.dashboard-master')

@section('title')
    <title>{{ $profile->name ?? 'Unknown User' }} - {{ config('app.name') }}</title>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('profile', $profile) }}
@endsection

@section('content')
    <section class="container-fluid py-3">
        <div class="mx-auto" style="max-width: 600px;">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile"><i class="fas fa-user"></i> My Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="change-password-tab" data-toggle="tab" href="#change-password"><i class="fas fa-lock"></i> Change Password</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade py-3" id="profile">
                    @if ($profile)
                    @include('components.success')
                    <div class="d-flex" style="justify-content: space-between">
                        <h3 class="mb-3">Personal Information</h3>
                        <a href="{{ route('profile.editProfile', $profile->cnic) }}"><i class="fas fa-edit"></i> Edit</a>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-2"><h5 class="text-right">Picture:</h5></div>
                        <div class="col-md-8 mb-2">
                            <img src="{{ asset('images/dps/' . $profile->avatar) }}" width="100px" alt="Image not found">
                        </div>
                        <div class="col-md-4 mb-2"><h5 class="text-right">Name:</h5></div>
                        <div class="col-md-8 mb-2"><h5>{{ $profile->name }}</h5></div>
                        <div class="col-md-4 mb-2"><h5 class="text-right">Father Name:</h5></div>
                        <div class="col-md-8 mb-2"><h5>{{ $profile->father_name ?? '' }}</h5></div>
                        <div class="col-md-4 mb-2"><h5 class="text-right">Phone Number:</h5></div>
                        <div class="col-md-8 mb-2"><h5>{{ $profile->phone_number }}</h5></div>
                        <div class="col-md-4 mb-2"><h5 class="text-right">CNIC:</h5></div>
                        <div class="col-md-8 mb-2"><h5>{{ $profile->cnic }}</h5></div>
                        <div class="col-md-4 mb-2"><h5 class="text-right">Address:</h5></div>
                        <div class="col-md-8 mb-2"><h5>{{ $profile->address }}</h5></div>
                        <div class="col-md-4 mb-2"><h5 class="text-right">Property:</h5></div>
                        <div class="col-md-8 mb-2"><h5>{{ $profile->property ?? 0 }} Acre</h5></div>
                        <div class="col-md-4 mb-2"><h5 class="text-right">Role:</h5></div>
                        <div class="col-md-8 mb-2"><h5>{{ $profile->role->name }}</h5></div>
                    </div>
                    <h3 class="mb-3">Account Detail</h3>
                    <div class="row">
                        <div class="col-md-4 mb-2"><h5 class="text-right">IP Address:</h5></div>
                        <div class="col-md-8 mb-2"><h5>{{ request()->ip() == '::1' ? '127.0.0.1' : request()->ip() }}</h5></div>
                        <div class="col-md-4 mb-2"><h5 class="text-right">Device:</h5></div>
                        <div class="col-md-8 mb-2"><h5>{{ request()->userAgent() ?? 'Unknown Device' }}</h5></div>
                        <div class="col-md-4 mb-2"><h5 class="text-right">Memeber Since:</h5></div>
                        <div class="col-md-8 mb-2"><h5>{{ date('F-Y', strtotime($profile->created_at)) }}</h5></div>
                    </div>
                    @else
                    <div class="alert alert-danger text-center">Nothing to show.</div>
                    @endif
                </div>
                <div class="tab-pane fade show active" id="change-password">
                    <div class="py-3 mx-auto" style="max-width: 350px;">
                        @include('components.error')
                        <form action="{{ route('login.updatePassword', $profile->cnic) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="old-pass">Old Password:</label>
                                <input type="password" name="old_password" id="old-pass" placeholder="Old Password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="mew-pass">New Password:</label>
                                <input type="password" name="new_password" id="new-pass" placeholder="New Password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="re-new-pass">Retype New Password:</label>
                                <input type="password" name="retype_new_password" id="re-new-pass" placeholder="Rertype New Password" class="form-control">
                            </div>
                            <div>
                                <button type="submit" class="btn btn-success float-right">Change Password</button>
                                <br class="clear">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
