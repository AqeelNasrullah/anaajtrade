@extends('master.dashboard-master')

@section('title')
    <title>Stock Slip for {{ $stock->profile->name ?? 'Unknown User' }} - {{ config('app.name') }}</title>
@endsection

@section('style')
    <style>
        .content {display: flex;flex-direction: column;justify-content: center;}
        .slip {max-width: 500px;margin: 0px auto;}

        @media print {
            .header, .footer, .print {display: none;}
        }
    </style>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('view_rice_stock', $stock) }}
@endsection

@section('content')
    <section class="container-fluid py-3">
        <div class="slip">
            <div class="mb-3 print">
                <button class="btn btn-success float-right print-slip"><i class="fas fa-print"></i> Print</button>
                <a href="{{ route('riceStock.index') }}" class="btn btn-outline-danger float-right mr-2"><i class="fas fa-times"></i> Close</a>
                <br class="clear">
            </div>
            @include('components.success')
            @if ($stock)
            <div class="slip-inner mb-3" style="border-bottom: 1px dashed black;">
                <h3 class="mb-3 text-center fw-700">Rice Stock / <span class="text-urdu-kasheeda">چاول کا اسٹاک</span></h3>
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
                        <p class="mb-1"><i class="fas fa-address-card"></i> {{ $stock->profile->name }}</p>
                        <p class="mb-1"><i class="fas fa-address-card"></i> {{ $stock->profile->cnic }}</p>
                        <p class="mb-1"><i class="fas fa-phone"></i> {{ $stock->profile->phone_number }}</p>
                        <p class="mb-1"><i class="fas fa-map-marker-alt"></i> {{ $stock->profile->address }}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <p class="col-md-6 mb-1"><strong>Rice Type:</strong> {{ $stock->riceType->name }}</p>
                    <p class="col-md-6 mb-1"><strong>Category:</strong> {{ $stock->category }}</p>
                    <p class="col-md-6 mb-1"><strong>No of Sacks:</strong> {{ $stock->num_of_sack }}</p>
                    <p class="col-md-6 mb-1"><strong>Weight per Sack:</strong> {{ $stock->weight_per_sack }} Kgs</p>
                    <p class="col-md-6 mb-1"><strong>Total Weight:</strong> {{ ($stock->num_of_sack * $stock->weight_per_sack) }} Kgs</p>
                    <p class="col-md-6 mb-1"><strong>Price per Sack:</strong> Rs {{ $stock->price }} /-</p>
                </div>
                <hr>
                <div class="row">
                    <p class="col-6 mb-0 text-right">Total Price:</p>
                    <p class="col-6 mb-0">Rs {{ (($stock->num_of_sack * $stock->weight_per_sack) / 40) * $stock->price }} /-</p>
                    <p class="col-6 mb-1 text-right">Commission ({{ $stock->commission }}%):</p>
                    <p class="col-6 mb-0">Rs {{ (($stock->commission / 100) * (($stock->num_of_sack * $stock->weight_per_sack) / 40) * $stock->price) }} /-</p>
                    <p class="col-6 text-right">Total Price (after commission):</p>
                    <p class="col-6">Rs {{ ((($stock->num_of_sack * $stock->weight_per_sack) / 40) * $stock->price) - (($stock->commission / 100) * (($stock->num_of_sack * $stock->weight_per_sack) / 40) * $stock->price) }} /-</p>
                    <p class="col-12">Signature:</p>
                </div>
            </div>
            <div class="slip-inner mb-3" style="border-bottom: 1px dashed black;">
                <h3 class="mb-3 text-center fw-700">Rice Stock / <span class="text-urdu-kasheeda">چاول کا اسٹاک</span></h3>
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
                        <p class="mb-1"><i class="fas fa-address-card"></i> {{ $stock->profile->name }}</p>
                        <p class="mb-1"><i class="fas fa-address-card"></i> {{ $stock->profile->cnic }}</p>
                        <p class="mb-1"><i class="fas fa-phone"></i> {{ $stock->profile->phone_number }}</p>
                        <p class="mb-1"><i class="fas fa-map-marker-alt"></i> {{ $stock->profile->address }}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <p class="col-md-6 mb-1"><strong>Rice Type:</strong> {{ $stock->riceType->name }}</p>
                    <p class="col-md-6 mb-1"><strong>Category:</strong> {{ $stock->category }}</p>
                    <p class="col-md-6 mb-1"><strong>No of Sacks:</strong> {{ $stock->num_of_sack }}</p>
                    <p class="col-md-6 mb-1"><strong>Weight per Sack:</strong> {{ $stock->weight_per_sack }} Kgs</p>
                    <p class="col-md-6 mb-1"><strong>Total Weight:</strong> {{ ($stock->num_of_sack * $stock->weight_per_sack) }} Kgs</p>
                    <p class="col-md-6 mb-1"><strong>Price per Sack:</strong> Rs {{ $stock->price }} /-</p>
                </div>
                <hr>
                <div class="row">
                    <p class="col-6 mb-0 text-right">Total Price:</p>
                    <p class="col-6 mb-0">Rs {{ (($stock->num_of_sack * $stock->weight_per_sack) / 40) * $stock->price }} /-</p>
                    <p class="col-6 mb-1 text-right">Commission ({{ $stock->commission }}%):</p>
                    <p class="col-6 mb-0">Rs {{ (($stock->commission / 100) * (($stock->num_of_sack * $stock->weight_per_sack) / 40) * $stock->price) }} /-</p>
                    <p class="col-6 text-right">Total Price (after commission):</p>
                    <p class="col-6">Rs {{ ((($stock->num_of_sack * $stock->weight_per_sack) / 40) * $stock->price) - (($stock->commission / 100) * (($stock->num_of_sack * $stock->weight_per_sack) / 40) * $stock->price) }} /-</p>
                    <p class="col-12">Signature:</p>
                </div>
            </div>
            @else
            <div class="alert alert-danger text-center font-italic w-50 mx-auto"></div>
            @endif
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.print-slip').click(function() {
                window.print();
            });
        });
    </script>
@endsection
