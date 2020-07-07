@extends('master.dashboard-master')

@section('title')
    <title>View Account Book for {{ $record->profile->name }} - {{ config('app.name') }}</title>
@endsection

@section('style')
    <style>
        @media print {
            .header, .footer, .print {display:none;}
        }
    </style>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('view_account_books', $record) }}
@endsection

@section('content')
    <section class="container-fluid py-3">
        <div class="print w-50 mx-auto mb-3">
            <button class="btn btn-success float-right print-btn"><i class="fas fa-print"></i> Print</button>
            <form action="" method="post" class="float-right mr-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger delete-btn"><i class="fas fa-trash-alt"></i>&nbsp; Delete</button>
            </form>
            <a href="{{ route('accountBook.index') }}" class="btn btn-outline-danger float-right mr-2"><i class="fas fa-times"></i> Close</a>
            <br class="clear">
        </div>
        <diV class="slip w-50 mx-auto">
            <div class="slip-inner">
                <h3 class="text-center fw-700 mb-3">Account Book / <span class="text-urdu-kasheeda">کھاتہ</span></h3>
                <div class="row mb-3" style="border-bottom: 1px solid lightgrey;">
                    <div class="col-md-6">
                        <h4 class="fw-700 mb-3">Commission Agent:</h4>
                        <p class="mb-1"><i class="fas fa-address-card"></i> {{ $record->user->profile->name }}</p>
                        <p class="mb-1"><i class="fas fa-address-card"></i> {{ $record->user->profile->cnic }}</p>
                        <p class="mb-1"><i class="fas fa-phone"></i> {{ $record->user->profile->phone_number }}</p>
                        <p class="mb-1"><i class="fas fa-map-marker-alt"></i> {{ $record->user->profile->address }}</p>
                    </div>
                    <div class="col-md-6">
                        <h4 class="fw-700 mb-3">Customer:</h4>
                        <p class="mb-1"><i class="fas fa-address-card"></i> {{ $record->profile->name }}</p>
                        <p class="mb-1"><i class="fas fa-address-card"></i> {{ $record->profile->cnic }}</p>
                        <p class="mb-1"><i class="fas fa-phone"></i> {{ $record->profile->phone_number }}</p>
                        <p class="mb-1"><i class="fas fa-map-marker-alt"></i> {{ $record->profile->address }}</p>
                    </div>
                </div>
                <div class="row">
                    <p class="col-md-6 mb-1"><strong>Amount:</strong> {{ 'Rs ' . $record->amount . ' /-' }}</p>
                    <p class="col-md-6 mb-1"><strong>Amount Type:</strong> {{ $record->type }}</p>
                    <p class="col-md-12 mb-0"><strong>Signature:</strong></p>
                </div>
            </div>
            <hr>
            <div class="slip-inner">
                <h3 class="text-center fw-700 mb-3">Account Book / <span class="text-urdu-kasheeda">کھاتہ</span></h3>
                <div class="row mb-3" style="border-bottom: 1px solid lightgrey;">
                    <div class="col-md-6">
                        <h4 class="fw-700 mb-3">Commission Agent:</h4>
                        <p class="mb-1"><i class="fas fa-address-card"></i> {{ $record->user->profile->name }}</p>
                        <p class="mb-1"><i class="fas fa-address-card"></i> {{ $record->user->profile->cnic }}</p>
                        <p class="mb-1"><i class="fas fa-phone"></i> {{ $record->user->profile->phone_number }}</p>
                        <p class="mb-1"><i class="fas fa-map-marker-alt"></i> {{ $record->user->profile->address }}</p>
                    </div>
                    <div class="col-md-6">
                        <h4 class="fw-700 mb-3">Customer:</h4>
                        <p class="mb-1"><i class="fas fa-address-card"></i> {{ $record->profile->name }}</p>
                        <p class="mb-1"><i class="fas fa-address-card"></i> {{ $record->profile->cnic }}</p>
                        <p class="mb-1"><i class="fas fa-phone"></i> {{ $record->profile->phone_number }}</p>
                        <p class="mb-1"><i class="fas fa-map-marker-alt"></i> {{ $record->profile->address }}</p>
                    </div>
                </div>
                <div class="row">
                    <p class="col-md-6 mb-1"><strong>Amount:</strong> {{ 'Rs ' . $record->amount . ' /-' }}</p>
                    <p class="col-md-6 mb-1"><strong>Amount Type:</strong> {{ $record->type }}</p>
                    <p class="col-md-12 mb-0"><strong>Signature:</strong></p>
                </div>
            </div>
        </diV>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.print-btn').click(function() {
                window.print();
            });
            $('.delete-btn').click(function() {
                if(confirm('Are you sure you want to delete?')) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>
@endsection
