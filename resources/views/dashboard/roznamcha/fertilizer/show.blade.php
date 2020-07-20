@extends('master.dashboard-master')

@section('title')
    <title>View Fertilizer Record for {{ $record->profile->name }} - {{ config('app.name') }}</title>
@endsection

@section('style')
    <style>
        @media print {
            .header, .print, .footer {
                display: none;
            }
            .w-50 {width: 75% !important;}
        }

        @media screen and (max-width:599px) {
            .w-50 {width: 100% !important;}
        }
    </style>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('view_fertilizer_records', $record) }}
@endsection

@section('content')
    <section class="container-fluid py-3">
        <div class="w-50 mx-auto">
            <div class="print mb-3">
                <button class="btn btn-success print-slip float-right"><i class="fas fa-print"></i> Print</button>
                <form action="{{ route('fertilizerRecord.destroy', base64_encode(($record->id * 123456789) / 12098)) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger float-right delete-slip mr-2"><i class="fas fa-trash-alt"></i> Delete</button>
                </form>
                <a href="{{ route('fertilizerRecord.index') }}" class="btn btn-outline-danger float-right mr-2"><i class="fas fa-times"></i> Close</a>
                <br class="clear">
            </div>

            @include('components.error')
            @include('components.success')

            <div class="slip">
                <div class="slip-inner mb-3" style="border-bottom: 1px dashed grey;">
                    <h3 class="text-center fw-700 mb-3">Fetilizer Record / <span class="text-urdu-kasheeda">کھاد کا ریکارڈ</span></h3>
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="fw-700 mb-3">Commission Agent:</h5>
                            <p class="mb-1"><i class="fas fa-address-card"></i> &nbsp; {{ $record->user->profile->name }}</p>
                            <p class="mb-1"><i class="fas fa-address-card"></i> &nbsp; {{ $record->user->profile->cnic }}</p>
                            <p class="mb-1"><i class="fas fa-phone"></i> &nbsp; {{ $record->user->profile->phone_number }}</p>
                            <p class="mb-1"><i class="fas fa-map-marker-alt"></i> &nbsp; {{ $record->user->profile->address }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="fw-700 mb-3">Customer:</h5>
                            <p class="mb-1"><i class="fas fa-address-card"></i> &nbsp; {{ $record->profile->name }}</p>
                            <p class="mb-1"><i class="fas fa-address-card"></i> &nbsp; {{ $record->profile->cnic }}</p>
                            <p class="mb-1"><i class="fas fa-phone"></i> &nbsp; {{ $record->profile->phone_number }}</p>
                            <p class="mb-1"><i class="fas fa-map-marker-alt"></i> &nbsp; {{ $record->profile->address }}</p>
                        </div>
                    </div>
                    <hr class="mt-0">
                    <div class="row">
                        <p class="col-md-6 mb-1"><strong>Quantity:</strong> {{ $record->quantity }} Sacks</p>
                        <p class="col-md-6 mb-1"><strong>Fertilizer Type:</strong> {{ $record->type }}</p>
                        <p class="col-md-6 mb-1"><strong>Weight per sack:</strong> {{ $record->weight }} Kgs</p>
                        <p class="col-md-6 mb-1"><strong>Price per sack:</strong> Rs {{ $record->paid }} /-</p>
                        <p class="col-md-6 mb-1"><strong>Total price:</strong> Rs {{ $record->paid * $record->quantity }} /-</p>
                        <p class="col-md-6 mb-1"><strong>Date &amp; Time:</strong> {{ date('d-M-Y h:i A') }}</p>
                        <p class="offset-md-6 col-md-6"><strong>Signature:</strong></p>
                    </div>
                </div>
                <div class="slip-inner">
                    <h3 class="text-center fw-700 mb-3">Fetilizer Record / <span class="text-urdu-kasheeda">کھاد کا ریکارڈ</span></h3>
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="fw-700 mb-3">Commission Agent:</h5>
                            <p class="mb-1"><i class="fas fa-address-card"></i> &nbsp; {{ $record->user->profile->name }}</p>
                            <p class="mb-1"><i class="fas fa-address-card"></i> &nbsp; {{ $record->user->profile->cnic }}</p>
                            <p class="mb-1"><i class="fas fa-phone"></i> &nbsp; {{ $record->user->profile->phone_number }}</p>
                            <p class="mb-1"><i class="fas fa-map-marker-alt"></i> &nbsp; {{ $record->user->profile->address }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="fw-700 mb-3">Customer:</h5>
                            <p class="mb-1"><i class="fas fa-address-card"></i> &nbsp; {{ $record->profile->name }}</p>
                            <p class="mb-1"><i class="fas fa-address-card"></i> &nbsp; {{ $record->profile->cnic }}</p>
                            <p class="mb-1"><i class="fas fa-phone"></i> &nbsp; {{ $record->profile->phone_number }}</p>
                            <p class="mb-1"><i class="fas fa-map-marker-alt"></i> &nbsp; {{ $record->profile->address }}</p>
                        </div>
                    </div>
                    <hr class="mt-0">
                    <div class="row">
                        <p class="col-md-6 mb-1"><strong>Quantity:</strong> {{ $record->quantity }} Sacks</p>
                        <p class="col-md-6 mb-1"><strong>Fertilizer Type:</strong> {{ $record->type }}</p>
                        <p class="col-md-6 mb-1"><strong>Weight per sack:</strong> {{ $record->weight }} Kgs</p>
                        <p class="col-md-6 mb-1"><strong>Price per sack:</strong> Rs {{ $record->paid }} /-</p>
                        <p class="col-md-6 mb-1"><strong>Total price:</strong> Rs {{ $record->paid * $record->quantity }} /-</p>
                        <p class="col-md-6 mb-1"><strong>Date &amp; Time:</strong> {{ date('d-M-Y h:i A', strtotime($record->created_at)) }}</p>
                        <p class="offset-md-6 col-md-6"><strong>Signature:</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.print-slip').click(function() {
                window.print();
            });

            $('.delete-slip').click(function() {
                if (confirm('Are you sure you want to delete?')) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>
@endsection
