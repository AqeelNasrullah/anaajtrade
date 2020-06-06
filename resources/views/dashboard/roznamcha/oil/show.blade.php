@extends('master.dashboard-master')

@section('title')
    <title>Slip - {{ config('app.name') }}</title>
@endsection

@section('style')
    <style>
        .slip-mega {max-width: 600px;margin:0px auto;}
        .slip {max-width:600px;border-bottom: 1px dashed black;}
        .slip-logo {width: 100px; float: left; margin-right: 15px;}
        .slip-detail {width: calc(100% - 115px);float: left;}

        @media print {
            .header, .footer, .prnt {display:none;}
        }
    </style>
@endsection

@section('content')
    <section class="content-fluid py-3">
        <div class="w-50 mx-auto px-5 mb-3 prnt">
            <button class="btn btn-success float-right print-slip"><i class="fas fa-print"></i> Print</button>
            <a href="{{ route('oilRecord.index') }}" class="btn btn-outline-danger float-right mr-2"><i class="fas fa-times"></i> Close</a>
            <br class="clear">
        </div>
        @if ($record)
        <div class="slip-mega">
            @include('components.success')

            <div class="slip mx-auto">
                <div class="slip-header">
                    <div class="slip-logo"><img src="{{ asset('images/logos/'.$record->fillingStation->oilCompany->avatar) }}" width="100%" alt="Image not found"></div>
                    <div class="slip-detail pt-2">
                        <h2 class="fw-900">{{ $record->fillingStation->name }}</h2>
                        <div>
                            <h5 class="float-left mr-5"><i class="fas fa-gas-pump"></i> {{ $record->fillingStation->oilCompany->name }}</h5>
                            <h5 class="float-left"><i class="fas fa-phone"></i> {{ $record->fillingStation->phone_number }}</h5>
                            <br class="clear">
                        </div>
                        <h5><i class="fas fa-map-marker-alt"></i> {{ $record->fillingStation->address }}</h5>
                    </div>
                    <br class="clear">
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="fw-700 mb-2">Commission Agent</h3>
                        <p class="mb-1"><i class="fas fa-address-card"></i> {{ auth()->user()->profile->name }}</p>
                        <p class="mb-1"><i class="fas fa-address-card"></i> {{ auth()->user()->profile->cnic }}</p>
                        <p class="mb-1"><i class="fas fa-phone"></i> {{ auth()->user()->profile->phone_number }}</p>
                        <p class="mb-1"><i class="fas fa-map-marker-alt"></i> {{ auth()->user()->profile->address }}</p>
                    </div>
                    <div class="col-md-6">
                        <h3 class="fw-700 mb-2">Customer</h3>
                        <p class="mb-1"><i class="fas fa-address-card"></i> {{ $record->profile->name }}</p>
                        <p class="mb-1"><i class="fas fa-address-card"></i> {{ $record->profile->cnic }}</p>
                        <p class="mb-1"><i class="fas fa-phone"></i> {{ $record->profile->phone_number }}</p>
                        <p class="mb-1"><i class="fas fa-map-marker-alt"></i> {{ $record->profile->address }}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <p class="mb-1 col-md-6"><strong>Quantity:</strong> {{ $record->quantity }} Litres</p>
                    <p class="mb-1 col-md-6"><strong>Price per Litre:</strong> {{ $record->price_per_litre != 0 ? 'Rs ' . $record->price_per_litre . '/-': '________________________'}}</p>
                    <p class="mb-1 col-md-6"><strong>Total Price:</strong> {{ $record->price_per_litre != 0 ? 'Rs ' . ($record->price_per_litre * $record->quantity) . '/-': '________________________'}}</p>
                    <p class="mb-1 col-md-6"><strong>Date &amp; Time:</strong> {{ date('d-F-Y h:i A', strtotime($record->created_at)) }}</p>
                    <p class="col-md-12"><strong>Signature:</strong></p>
                </div>
            </div>
            <div class="slip mx-auto">
                <div class="slip-header">
                    <div class="slip-logo"><img src="{{ asset('images/logos/'.$record->fillingStation->oilCompany->avatar) }}" width="100%" alt="Image not found"></div>
                    <div class="slip-detail pt-2">
                        <h2 class="fw-900">{{ $record->fillingStation->name }}</h2>
                        <div>
                            <h5 class="float-left mr-5"><i class="fas fa-gas-pump"></i> {{ $record->fillingStation->oilCompany->name }}</h5>
                            <h5 class="float-left"><i class="fas fa-phone"></i> {{ $record->fillingStation->phone_number }}</h5>
                            <br class="clear">
                        </div>
                        <h5><i class="fas fa-map-marker-alt"></i> {{ $record->fillingStation->address }}</h5>
                    </div>
                    <br class="clear">
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="fw-700 mb-2">Commission Agent</h3>
                        <p class="mb-1"><i class="fas fa-address-card"></i> {{ auth()->user()->profile->name }}</p>
                        <p class="mb-1"><i class="fas fa-address-card"></i> {{ auth()->user()->profile->cnic }}</p>
                        <p class="mb-1"><i class="fas fa-phone"></i> {{ auth()->user()->profile->phone_number }}</p>
                        <p class="mb-1"><i class="fas fa-map-marker-alt"></i> {{ auth()->user()->profile->address }}</p>
                    </div>
                    <div class="col-md-6">
                        <h3 class="fw-700 mb-2">Customer</h3>
                        <p class="mb-1"><i class="fas fa-address-card"></i> {{ $record->profile->name }}</p>
                        <p class="mb-1"><i class="fas fa-address-card"></i> {{ $record->profile->cnic }}</p>
                        <p class="mb-1"><i class="fas fa-phone"></i> {{ $record->profile->phone_number }}</p>
                        <p class="mb-1"><i class="fas fa-map-marker-alt"></i> {{ $record->profile->address }}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <p class="mb-1 col-md-6"><strong>Quantity:</strong> {{ $record->quantity }} Litres</p>
                    <p class="mb-1 col-md-6"><strong>Price per Litre:</strong> {{ $record->price_per_litre != 0 ? 'Rs ' . $record->price_per_litre . '/-': '________________________'}}</p>
                    <p class="mb-1 col-md-6"><strong>Total Price:</strong> {{ $record->price_per_litre != 0 ? 'Rs ' . ($record->price_per_litre * $record->quantity) . '/-': '________________________'}}</p>
                    <p class="mb-1 col-md-6"><strong>Date &amp; Time:</strong> {{ date('d-F-Y h:i A', strtotime($record->created_at)) }}</p>
                    <p class="col-md-12"><strong>Signature:</strong></p>
                </div>
            </div>
            <div class="slip mx-auto" style="border-bottom: none;">
                <div class="slip-header">
                    <div class="slip-logo"><img src="{{ asset('images/logos/'.$record->fillingStation->oilCompany->avatar) }}" width="100%" alt="Image not found"></div>
                    <div class="slip-detail pt-2">
                        <h2 class="fw-900">{{ $record->fillingStation->name }}</h2>
                        <div>
                            <h5 class="float-left mr-5"><i class="fas fa-gas-pump"></i> {{ $record->fillingStation->oilCompany->name }}</h5>
                            <h5 class="float-left"><i class="fas fa-phone"></i> {{ $record->fillingStation->phone_number }}</h5>
                            <br class="clear">
                        </div>
                        <h5><i class="fas fa-map-marker-alt"></i> {{ $record->fillingStation->address }}</h5>
                    </div>
                    <br class="clear">
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="fw-700 mb-2">Commission Agent</h3>
                        <p class="mb-1"><i class="fas fa-address-card"></i> {{ auth()->user()->profile->name }}</p>
                        <p class="mb-1"><i class="fas fa-address-card"></i> {{ auth()->user()->profile->cnic }}</p>
                        <p class="mb-1"><i class="fas fa-phone"></i> {{ auth()->user()->profile->phone_number }}</p>
                        <p class="mb-1"><i class="fas fa-map-marker-alt"></i> {{ auth()->user()->profile->address }}</p>
                    </div>
                    <div class="col-md-6">
                        <h3 class="fw-700 mb-2">Customer</h3>
                        <p class="mb-1"><i class="fas fa-address-card"></i> {{ $record->profile->name }}</p>
                        <p class="mb-1"><i class="fas fa-address-card"></i> {{ $record->profile->cnic }}</p>
                        <p class="mb-1"><i class="fas fa-phone"></i> {{ $record->profile->phone_number }}</p>
                        <p class="mb-1"><i class="fas fa-map-marker-alt"></i> {{ $record->profile->address }}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <p class="mb-1 col-md-6"><strong>Quantity:</strong> {{ $record->quantity }} Litres</p>
                    <p class="mb-1 col-md-6"><strong>Price per Litre:</strong> {{ $record->price_per_litre != 0 ? 'Rs ' . $record->price_per_litre . '/-': '________________________'}}</p>
                    <p class="mb-1 col-md-6"><strong>Total Price:</strong> {{ $record->price_per_litre != 0 ? 'Rs ' . ($record->price_per_litre * $record->quantity) . '/-': '________________________'}}</p>
                    <p class="mb-1 col-md-6"><strong>Date &amp; Time:</strong> {{ date('d-F-Y h:i A', strtotime($record->created_at)) }}</p>
                    <p class="col-md-12"><strong>Signature:</strong></p>
                </div>
            </div>
        </div>
        @else
            <div class="alert alert-danger w-50 mx-auto">No record to show.</div>
        @endif
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
