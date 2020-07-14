@extends('master.dashboard-master')

@section('title')
    <title>Create Fertilizer Trader - {{ config('app.name') }}</title>
@endsection

@section('style')
    <style>
        @media screen and (max-width:599px) {
            .form-area { width: 100% !important; }
            .avatar-area {float:none !important; width: 300px;margin: 0px auto;margin-bottom: 15px;}
        }
    </style>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('create_fertilizer_traders') }}
@endsection

@section('content')
    <section class="container-fluid py-3">
        <div class="w-50 form-area mx-auto">
            <h1 class="text-success mb-3 fw-900 text-center">Add Fertilizer Trader / <span class="text-urdu-kasheeda">کھاد کا تاجر شامل کریں</span></h1>
            @include('components.error')
            <form action="{{ route('fertilizerTraders.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <aside class="col-md-4 avatar-area">
                        <label for="avatar" class="w-100 text-center">Fertilizer Trader Image:</label>
                        <div class="img w-75 mx-auto mb-3">
                            <img src="{{ asset('images/logos/logo.png') }}" id="avatar-img" width="100%" alt="Image not found">
                        </div>
                        <input type="file" name="avatar" id="avatar" class="d-none">
                        <button class="select btn btn-success btn-block w-75 mx-auto"><i class="fas fa-upload"></i> Select Image</button>
                    </aside>
                    <main class="col-md-8">
                        <div class="form-group">
                            <label for="name">Name / <span class="text-urdu-kasheeda">نام</span> <span class="required">*</span>:</label>
                            <input type="text" name="name" id="name" placeholder="Name" class="form-control" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="phone-number">Phone Number / <span class="text-urdu-kasheeda">فون نمبر</span> <span class="required">*</span>:</label>
                            <input type="text" name="phone_number" id="phone-number" placeholder="Phone Number" data-mask="0000 0000000" class="form-control" value="{{ old('phone_number') }}">
                        </div>
                        <div class="form-group">
                            <label for="address">Address / <span class="text-urdu-kasheeda">پتہ</span> <span class="required">*</span>:</label>
                            <textarea name="address" id="address" class="form-control" placeholder="Address">{{ old('address') }}</textarea>
                        </div>
                    </main>
                </div>
                <div>
                    <button type="submit" class="btn btn-success float-right">Add Fertilizer Trader</button>
                    <br class="clear">
                </div>
            </form>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.select').click(function(e) {
                $('#avatar').click();
                e.preventDefault();
            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#avatar-img').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            $("#avatar").change(function() {
                readURL(this);
            });
        });
    </script>
@endsection
