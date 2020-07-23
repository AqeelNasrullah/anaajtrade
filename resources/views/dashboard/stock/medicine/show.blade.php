@extends('master.dashboard-master')

@section('title')
    <title>View Medicine Stock for {{ $stock->medicineTrader->name }} - {{ config('app.name') }}</title>
@endsection

@section('style')
    <style>
        .slip-header .logo {width: 75px;height: 75px;overflow: hidden;float:left;margin-right: 15px;}
        .slip-header .txt {width: calc('100% - 90px');float: left;}

        @media screen and (max-width: 699px) {
            .w-50 {width: 100% !important;}
        }

        @media print {
            .w-50 {width: 75% !important;}
            .header, .print, .footer {display: none;}
        }
    </style>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('view_medicine_stocks', $stock) }}
@endsection

@section('content')
    <section class="container-fluid py-3">
        <div class="w-50 mx-auto">
            @if ($stock)
            <div class="print mb-3">
                <button class="btn btn-success float-right print-btn"><i class="fas fa-print"></i> Print</button>
                <form action="{{ route('medicineStock.destroy', base64_encode(($stock->id * 123456789) / 12098)) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger delete float-right mr-2"><i class="fas fa-trash-alt"></i> Delete</button>
                </form>
                <a href="{{ route('medicineStock.index') }}" class="btn btn-outline-danger float-right mr-2"><i class="fas fa-times"></i> Close</a>
                <br class="clear">
            </div>
            @include('components.error')
            @include('components.success')
                <div class="slip">
                    <div class="slip-inner" style="border-bottom: 1px dashed gray;margin-bottom: 15px;">
                        <div class="slip-header">
                            <div class="logo"><img src="{{ asset('images/logos/' . $stock->medicineTrader->avatar) }}" width="100%" alt="Image not found"></div>
                            <div class="txt">
                                <h1 class="fw-900 mb-1">{{ $stock->medicineTrader->name }}</h1>
                                <p><span><i class="fas fa-phone"></i> {{ $stock->medicineTrader->phone_number }}</span> &nbsp;&nbsp;&nbsp; <span><i class="fas fa-map-marker-alt"></i> {{ $stock->medicineTrader->address }}</span></p>
                            </div>
                            <br class="clear">
                        </div>
                        <hr class="mt-0">
                        <div class="slip-body">
                            <h4 class="mb-3 fw-700">Commission Agent</h4>
                            <div class="row">
                                <p class="col-md-6 mb-1"><i class="fas fa-address-card"></i> &nbsp; {{ $stock->user->profile->name }}</p>
                                <p class="col-md-6 mb-1"><i class="fas fa-address-card"></i> &nbsp; {{ $stock->user->profile->cnic }}</p>
                                <p class="col-md-6 mb-0"><i class="fas fa-phone"></i> &nbsp; {{ $stock->user->profile->phone_number }}</p>
                                <p class="col-md-6 mb-0"><i class="fas fa-map-marker-alt"></i> &nbsp; {{ $stock->user->profile->address }}</p>
                            </div>
                            <hr>
                            <h4 class="mb-3 fw-700">medicine Stock</h4>
                            <div class="row">
                                <p class="col-md-6 mb-1"><strong>Medicine Type:</strong> {{ $stock->medicineType->type }}</p>
                                <p class="col-md-6 mb-1"><strong>Medicine Name:</strong> {{ $stock->medicineType->name }}</p>
                                <p class="col-md-6 mb-1"><strong>Quantity:</strong> {{ $stock->quantity }}</p>
                                <p class="col-md-6 mb-1"><strong>Price:</strong> Rs {{ $stock->price }} /-</p>
                                <p class="col-md-6 mb-1"><strong>Total Price:</strong> Rs {{ $stock->quantity * $stock->price }} /-</p>
                                <p class="col-md-6 mb-1"><strong>Date &amp; Time:</strong> {{ date('d-F-Y h:i A', strtotime($stock->created_at)) }}</p>
                                <p class="col-md-6"><strong>Signature:</strong></p>
                            </div>
                        </div>
                    </div>
                    <div class="slip-inner">
                        <div class="slip-header">
                            <div class="logo"><img src="{{ asset('images/logos/' . $stock->medicineTrader->avatar) }}" width="100%" alt="Image not found"></div>
                            <div class="txt">
                                <h1 class="fw-900 mb-1">{{ $stock->medicineTrader->name }}</h1>
                                <p><span><i class="fas fa-phone"></i> {{ $stock->medicineTrader->phone_number }}</span> &nbsp;&nbsp;&nbsp; <span><i class="fas fa-map-marker-alt"></i> {{ $stock->medicineTrader->address }}</span></p>
                            </div>
                            <br class="clear">
                        </div>
                        <hr class="mt-0">
                        <div class="slip-body">
                            <h4 class="mb-3 fw-700">Commission Agent</h4>
                            <div class="row">
                                <p class="col-md-6 mb-1"><i class="fas fa-address-card"></i> &nbsp; {{ $stock->user->profile->name }}</p>
                                <p class="col-md-6 mb-1"><i class="fas fa-address-card"></i> &nbsp; {{ $stock->user->profile->cnic }}</p>
                                <p class="col-md-6 mb-0"><i class="fas fa-phone"></i> &nbsp; {{ $stock->user->profile->phone_number }}</p>
                                <p class="col-md-6 mb-0"><i class="fas fa-map-marker-alt"></i> &nbsp; {{ $stock->user->profile->address }}</p>
                            </div>
                            <hr>
                            <h4 class="mb-3 fw-700">medicine Stock</h4>
                            <div class="row">
                                <p class="col-md-6 mb-1"><strong>Medicine Type:</strong> {{ $stock->medicineType->type }}</p>
                                <p class="col-md-6 mb-1"><strong>Medicine Name:</strong> {{ $stock->medicineType->name }}</p>
                                <p class="col-md-6 mb-1"><strong>Quantity:</strong> {{ $stock->quantity }}</p>
                                <p class="col-md-6 mb-1"><strong>Price:</strong> Rs {{ $stock->price }} /-</p>
                                <p class="col-md-6 mb-1"><strong>Total Price:</strong> Rs {{ $stock->quantity * $stock->price }} /-</p>
                                <p class="col-md-6 mb-1"><strong>Date &amp; Time:</strong> {{ date('d-F-Y h:i A', strtotime($stock->created_at)) }}</p>
                                <p class="col-md-6"><strong>Signature:</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-danger w-50 mx-auto text-center font-italic">No record to show.</div>
            @endif
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.print-btn').click(function() {
                window.print();
            });

            $('.delete').click(function() {
                if (confirm('Are you sure you want to delete?')) {
                    return true;
                } else {
                    return false;
                }
            })
        });
    </script>
@endsection
