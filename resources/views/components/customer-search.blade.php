<section class="mb-2">
    <div id="data-popup"></div>
    @if ($profile = session()->get('profile'))
    <div class="modal fade" id="customer-popup">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="profile-header">
                        <div class="float-left mr-3" style="width: 100px;height: 100px;border: 1px solid black;border-radius: 5px;overflow: hidden;">
                            <img src="{{ asset('images/dps/'.$profile->avatar) }}" width="100%" alt="Image not found">
                        </div>
                        <div class="float-left">
                            <h3 class="mb-1 fw-700">{{ $profile->name ?? 'Unknown' }}</h3>
                            <h5 class="fw-700">{{ $profile->father_name ?? 'Unknown' }}</h5>
                            <h5 class="fw-700"><i class="fas fa-address-card"></i> {{ $profile->cnic ?? '#####-#######-#' }}</h5>
                            <h5 class="fw-700"><i class="fas fa-phone"></i> {{ $profile->phone_number ?? '+## ### #######' }}</h5>
                        </div>
                        <br class="clear">
                    </div>
                    <hr>
                    <div>
                        <div class="row mb-3">
                            <p class="col-md-6 mb-0"><strong>Property:</strong> {{ $profile->property . ' Acres' ?? '' }}</p>
                            <p class="col-md-6 mb-0"><strong>Role:</strong> {{ $profile->role->name ?? 'Customer' }}</p>
                            <p class="col-12 mb-0"><strong>Address:</strong> {{ $profile->address ?? '' }}</p>
                        </div>
                        <div>
                            <a href="{{ route('profile.edit', base64_encode(($profile->id * 123456789) / 12098)) }}" class="btn btn-success float-right"><i class="fas fa-edit"></i> Edit Customers</a>
                            <a href="{{ route('profile.show', base64_encode(($profile->id * 123456789) / 12098)) }}" class="btn btn-outline-danger float-right mr-2"><i class="fas fa-user"></i> View Detail</a>
                            <button class="btn btn-danger float-right mr-2" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                            <br class="clear">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="customer-search-form" id="customer-search-form">
        <h1 class="text-center text-success fw-900 mb-3">Customer Search / <span class="text-urdu-kasheeda">خریدار تلاش کریں</span></h1>
        @include('components.error')
        <form action="{{ route('customerSearch.customer') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-3 mb-3 dropdown">
                    <input type="text" name="name" id="cus-name" value="{{ old('name') }}" class="form-control dropdown-toggle" data-toggle="dropdown" placeholder="Name">
                    <ul class="dropdown-menu dropdown-menu-left d-none p-0" id="names-list" style="max-width:275px;"></ul>
                </div>
                <div class="col-md-1 text-center pt-1 fw-700 mb-3" style="font-size: large;">
                    OR
                </div>
                <div class="col-md-3 mb-3">
                    <input type="text" name="phone_number" id="phone-number" value="{{ old('phone_number') }}" class="form-control" data-mask="0000 0000000" placeholder="Phone Number">
                </div>
                <div class="col-md-1 text-center pt-1 fw-700 mb-3" style="font-size: large;">
                    OR
                </div>
                <div class="col-md-3 mb-3">
                    <input type="text" name="cnic" id="cnic" class="form-control" placeholder="CNIC" value="{{ old('cnic') }}" data-mask="00000-0000000-0">
                </div>
                <div class="col-md-1 mb-3">
                    <button type="submit" class="btn btn-success btn-block"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>

    @if ($profiles = session()->get('profiles'))
        <div class="result">
            <div class="table-responsive">
                <table class="table table-striped" id="customer-table-common">
                    <thead class="table-success">
                        <tr>
                            <th class="align-middle"></th>
                            <th class="align-middle">Name / <span class="text-urdu-kasheeda">نام</span></th>
                            <th class="align-middle">Phone Number / <span class="text-urdu-kasheeda">فون نمبر</span></th>
                            <th class="align-middle">CNIC / <span class="text-urdu-kasheeda">شناختی کارڈ نمبر</span></th>
                            <th class="align-middle">Address / <span class="text-urdu-kasheeda">پتہ</span></th>
                            <th class="align-middle"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($profiles as $profile)
                            <tr>
                                <td class="align-middle"><img src="{{ asset('images/dps/'.$profile->avatar) }}" width="40px" alt="Image not found"></td>
                                <td class="align-middle">{{ $profile->name }}</td>
                                <td class="align-middle">{{ $profile->phone_number }}</td>
                                <td class="align-middle">{{ $profile->cnic }}</td>
                                <td class="align-middle">{{ $profile->address }}</td>
                                <td class="align-middle"><a data-id="{{ base64_encode(($profile->id * 123456789) / 12098) }}" class="view-customers" href="">View Customer</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</section>
