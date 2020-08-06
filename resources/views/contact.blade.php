@extends('master.master')

@section('title')
    <title>Help - {{ config('app.name') }}</title>
@endsection

@section('style')
    <style>
        .content {display: flex;flex-direction: column;justify-content: center;}
    </style>
@endsection

@section('content')
    <section class="container-fluid">
        <h3 class="text-urdu-kasheeda text-light text-center fw-700 mb-3">کسی بھی قسم کی معلومات کے لیے درج زیل نمبروں پر رابطہ کریں</h3>
        <h1 class="text-center text-light"><i class="fas fa-phone"></i> 0317 7236924 &nbsp;&nbsp;&nbsp; <i class="fab fa-whatsapp"></i> 0317 7236924</h1>
    </section>
@endsection
