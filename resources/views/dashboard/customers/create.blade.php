@extends('master.dashboard-master')

@section('title')
    <title>Create Customer - {{ config('app.name') }}</title>
@endsection

@section('style')
    <style>
        .dp {width: 150px !important;height: 150px !important;overflow: hidden;margin: 0px auto;}
    </style>
@endsection

@section('content')
    <section>
        <div class="container py-3">
            <h2 class="mb-3 text-success text-center fw-900">Create New Customer / <span class="text-urdu-kasheeda">نیا خریدار شامل کریں</span></h2>
            <div style="max-width:550px;margin: 0px auto;">
                @include('components.error')
                <form action="{{ route('profile.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 order-last">
                            <div class="dp mb-2"><img src="{{ asset('images/dps/avatar.jpg') }}" id="display-dp" width="100%" alt="Image not found"></div>
                            <input type="file" name="image" id="dp" style="display: none;">
                            <button class="btn btn-success btn-block" style="width: 150px !important;margin:0px auto;" id="upload-dp"><i class="fas fa-upload"></i> Upload Picture</button>
                        </div>
                        <div class="col-md-6 order-first">
                            <div class="form-group mb-1">
                                <label for="name">Name <span class="required">*</span>:</label>
                                <input type="text" name="name" id="name" placeholder="Name ..." value="{{ old('name') }}" class="form-control">
                            </div>
                            <div class="form-group mb-1">
                                <label for="father-name">Father Name:</label>
                                <input type="text" name="father_name" id="father-name" placeholder="Father Name ..." value="{{ old('father_name') }}" class="form-control">
                            </div>
                            <div class="form-group mb-1">
                                <label for="phone-number">Phone Number <span class="required">*</span>:</label>
                                <input type="text" name="phone_number" id="phone-number" placeholder="Phone Number ..." value="{{ old('phone_number') }}" data-mask="0000 0000000" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label for="cnic">CNIC <span class="required">*</span>:</label>
                                <input type="text" name="cnic" id="cnic" placeholder="CNIC ..." value="{{ old('cnic') }}" data-mask="00000-0000000-0" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label for="property">Property:</label>
                                <input type="text" name="property" id="property" placeholder="Property ..." value="{{ old('property') }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="address">Address <span class="required">*</span>:</label>
                                <input type="text" name="address" id="address" placeholder="Address ..." value="{{ old('address') }}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success float-right">Add Customer</button>
                        <br class="clear">
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#upload-dp').click(function(e) {
            $('#dp').click();
            e.preventDefault();
        });
    });

    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
        $('#display-dp').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
    }

    $("#dp").change(function() {
    readURL(this);
    });
</script>
@endsection
