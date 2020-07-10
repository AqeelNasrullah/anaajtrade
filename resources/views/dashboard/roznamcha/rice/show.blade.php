@extends('master.dashboard-master')

@section('title')
    <title>Rice Slip for {{ $record->profile->name ?? 'Unknown User' }} - {{ config('app.name') }}</title>
@endsection

@section('style')
    <style>
        .content {display: flex;flex-direction: column;justify-content: center;}

        @media print {
            .header, .footer, .print-section {display: none;}
        }
    </style>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('view_rice_records', $record) }}
@endsection

@section('content')
    <section class="container-fluid py-3">
        <div style="max-width:500px;margin: 0px auto">
            @include('components.success')
            <div class="print-section mb-3">
                <button class="print-slip btn btn-success float-right"><i class="fas fa-print"></i> Print</button>
                <form action="{{ route('riceRecord.destroy', base64_encode(($record->id * 123456789) / 12098)) }}" method="post" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger delete-wheat float-right mr-2"><i class="fas fa-trash-alt"></i> Delete</button>
                </form>
                <a href="{{ route('riceRecord.index') }}" class="btn btn-outline-danger float-right mr-2"><i class="fas fa-times"></i> Close</a>
                <br class="clear">
            </div>
            <div class="slip">
                <div class="slip-inner mb-3" style="border-bottom: 1px dashed black;">
                    <h3 class="text-center mb-3 fw-700">Rice Record / <span class="text-urdu-kasheeda">چاول کا ریکارڈ</span></h3>
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mb-3 fw-700">Commission Agent</h4>
                            <p class="mb-1"><i class="fas fa-address-card"></i> {{ auth()->user()->profile->name }}</p>
                            <p class="mb-1"><i class="fas fa-address-card"></i> {{ auth()->user()->profile->cnic }}</p>
                            <p class="mb-1"><i class="fas fa-phone"></i> {{ auth()->user()->profile->phone_number }}</p>
                            <p class="mb-1"><i class="fas fa-map-marker-alt"></i> {{ auth()->user()->profile->address }}</p>
                        </div>
                        <div class="col-md-6">
                            <h4 class="mb-3 fw-700">Customer</h4>
                            <p class="mb-1"><i class="fas fa-address-card"></i> {{ $record->profile->name }}</p>
                            <p class="mb-1"><i class="fas fa-address-card"></i> {{ $record->profile->cnic }}</p>
                            <p class="mb-1"><i class="fas fa-phone"></i> {{ $record->profile->phone_number }}</p>
                            <p class="mb-1"><i class="fas fa-map-marker-alt"></i> {{ $record->profile->address }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <p class="col-md-6 mb-1"><strong>Quantity:</strong> {{ $record->quantity }} Kgs</p>
                        <p class="col-md-6 mb-1"><strong>Paid price per 40Kgs:</strong> Rs {{ $record->paid_per_mann }} /-</p>
                        <p class="col-md-6 mb-1"><strong>Total Price (paid):</strong> Rs {{ ($record->quantity / 40) * $record->paid_per_mann }} /-</p>
                        <p class="col-md-6 mb-1"><strong>Rice Type:</strong> {{ $record->rice_type_id }}</p>
                        <p class="col-md-6 mb-1"><strong>Category:</strong> {{ $record->category }}</p>
                        <p class="col-md-6 mb-0"><strong>Date &amp; Time:</strong> {{ date('d-F-Y h:i A', strtotime($record->created_at)) }}</p>
                        <p class="col-md-12"><strong>Signature:</strong></p>
                    </div>
                </div>
                <div class="slip-inner mb-3" style="border-bottom: 1px dashed black;">
                    <h3 class="text-center mb-3 fw-700">Rice Record / <span class="text-urdu-kasheeda">چاول کا ریکارڈ</span></h3>
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mb-3 fw-700">Commission Agent</h4>
                            <p class="mb-1"><i class="fas fa-address-card"></i> {{ auth()->user()->profile->name }}</p>
                            <p class="mb-1"><i class="fas fa-address-card"></i> {{ auth()->user()->profile->cnic }}</p>
                            <p class="mb-1"><i class="fas fa-phone"></i> {{ auth()->user()->profile->phone_number }}</p>
                            <p class="mb-1"><i class="fas fa-map-marker-alt"></i> {{ auth()->user()->profile->address }}</p>
                        </div>
                        <div class="col-md-6">
                            <h4 class="mb-3 fw-700">Customer</h4>
                            <p class="mb-1"><i class="fas fa-address-card"></i> {{ $record->profile->name }}</p>
                            <p class="mb-1"><i class="fas fa-address-card"></i> {{ $record->profile->cnic }}</p>
                            <p class="mb-1"><i class="fas fa-phone"></i> {{ $record->profile->phone_number }}</p>
                            <p class="mb-1"><i class="fas fa-map-marker-alt"></i> {{ $record->profile->address }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <p class="col-md-6 mb-1"><strong>Quantity:</strong> {{ $record->quantity }} Kgs</p>
                        <p class="col-md-6 mb-1"><strong>Paid price per 40Kgs:</strong> Rs {{ $record->paid_per_mann }} /-</p>
                        <p class="col-md-6 mb-1"><strong>Total Price (paid):</strong> Rs {{ ($record->quantity / 40) * $record->paid_per_mann }} /-</p>
                        <p class="col-md-6 mb-1"><strong>Rice Type:</strong> {{ $record->riceType->name }}</p>
                        <p class="col-md-6 mb-1"><strong>Category:</strong> {{ $record->category }}</p>
                        <p class="col-md-6 mb-0"><strong>Date &amp; Time:</strong> {{ date('d-F-Y h:i A', strtotime($record->created_at)) }}</p>
                        <p class="col-md-12"><strong>Signature:</strong></p>
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

            $('.delete-wheat').click(function() {
                if (confirm('Are you sure you want to delete?')) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>
@endsection
