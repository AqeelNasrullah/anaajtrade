@extends('master.dashboard-master')

@section('title')
    <title>View Record for {{ $other->profile->name ?? 'Unknown User' }} - {{ config('app.name') }}</title>
@endsection

@section('style')
    <style>
        @media print {
            .header, .print, .footer {display: none;}
        }
    </style>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('view_other', $other) }}
@endsection

@section('content')
    <section class="container-fluid py-3">
        <div class="w-50 mx-auto mb-3 print">
            <button class="print-btn btn btn-success float-right"><i class="fas fa-print"></i> Print</button>
            <form action="{{ route('other.destroy', base64_encode(($other->id * 123456789) / 12098)) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger delete float-right mr-2"><i class="fas fa-trash-alt"></i> Delete</button>
            </form>
            <a href="{{ route('other.index') }}" class="btn btn-outline-danger float-right mr-2"><i class="fas fa-times"></i> Close</a>
            <br class="clear">
        </div>
        @if($other)
        <div class="w-50 mx-auto slip">
            @include('components.error')
            @include('components.success')

            <div class="slip-inner">
                <h3 class="text-center fw-700 mb-3">Others / <span class="text-urdu-kasheeda">دیگر اشیاء</span></h3>
                <div class="row mb-3" style="border-bottom: 1px solid lightgrey;">
                    <div class="col-md-6">
                        <h4 class="fw-700 mb-2">Commission Agent:</h4>
                        <p class="mb-1"><i class="fas fa-address-card"></i> {{ $other->user->profile->name }}</p>
                        <p class="mb-1"><i class="fas fa-address-card"></i> {{ $other->user->profile->cnic }}</p>
                        <p class="mb-1"><i class="fas fa-phone"></i> {{ $other->user->profile->phone_number }}</p>
                        <p class="mb-1"><i class="fas fa-map-marker-alt"></i> {{ $other->user->profile->address }}</p>
                    </div>
                    <div class="col-md-6">
                        <h4 class="fw-700 mb-2">Customer:</h4>
                        <p class="mb-1"><i class="fas fa-address-card"></i> {{ $other->profile->name }}</p>
                        <p class="mb-1"><i class="fas fa-address-card"></i> {{ $other->profile->cnic }}</p>
                        <p class="mb-1"><i class="fas fa-phone"></i> {{ $other->profile->phone_number }}</p>
                        <p class="mb-1"><i class="fas fa-map-marker-alt"></i> {{ $other->profile->address }}</p>
                    </div>
                </div>
                <div class="row">
                    <p class="col-md-6 mb-1"><strong>Description:</strong> {{ $other->description }}</p>
                    <p class="col-md-6 mb-1"><strong>Amount:</strong> {{ 'Rs ' . $other->amount . ' /-' }}</p>
                    <p class="col-md-6 mb-0"><strong>Signature:</strong></p>
                    <p class="col-md-6 mb-0"><strong>Date &amp; Time:</strong> {{ date('d-F-Y h:i A', strtotime($other->created_at)) }}</p>
                </div>
            </div>
            <hr>
            <div class="slip-inner">
                <h3 class="text-center fw-700 mb-3">Others / <span class="text-urdu-kasheeda">دیگر اشیاء</span></h3>
                <div class="row mb-3" style="border-bottom: 1px solid lightgrey;">
                    <div class="col-md-6">
                        <h4 class="fw-700 mb-2">Commission Agent:</h4>
                        <p class="mb-1"><i class="fas fa-address-card"></i> {{ $other->user->profile->name }}</p>
                        <p class="mb-1"><i class="fas fa-address-card"></i> {{ $other->user->profile->cnic }}</p>
                        <p class="mb-1"><i class="fas fa-phone"></i> {{ $other->user->profile->phone_number }}</p>
                        <p class="mb-1"><i class="fas fa-map-marker-alt"></i> {{ $other->user->profile->address }}</p>
                    </div>
                    <div class="col-md-6">
                        <h4 class="fw-700 mb-2">Customer:</h4>
                        <p class="mb-1"><i class="fas fa-address-card"></i> {{ $other->profile->name }}</p>
                        <p class="mb-1"><i class="fas fa-address-card"></i> {{ $other->profile->cnic }}</p>
                        <p class="mb-1"><i class="fas fa-phone"></i> {{ $other->profile->phone_number }}</p>
                        <p class="mb-1"><i class="fas fa-map-marker-alt"></i> {{ $other->profile->address }}</p>
                    </div>
                </div>
                <div class="row">
                    <p class="col-md-6 mb-1"><strong>Description:</strong> {{ $other->description }}</p>
                    <p class="col-md-6 mb-1"><strong>Amount:</strong> {{ 'Rs ' . $other->amount . ' /-' }}</p>
                    <p class="col-md-6 mb-0"><strong>Signature:</strong></p>
                    <p class="col-md-6 mb-0"><strong>Date &amp; Time:</strong> {{ date('d-F-Y h:i A', strtotime($other->created_at)) }}</p>
                </div>
            </div>
        </div>
        @else
            <div class="alert alert-danger w-50 mx-auto text-center font-italic">No record to show.</div>
        @endif
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
            });
        });
    </script>
@endsection
