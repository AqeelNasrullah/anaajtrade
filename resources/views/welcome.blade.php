@extends('master.master')

@section('title')
    <title>{{ config('app.name') }} - اناج تجارت کا نظام</title>
@endsection

@section('style')
    <style>
        .content {display: flex;flex-direction: column;justify-content: center;}
        .title {max-width: 500px;margin: 0px auto;}
        .logo {max-width: 200px; margin: 0px auto;}
    </style>
@endsection

@section('content')
    <section class="container-fluid">
        <div class="title">
            <div class="logo"><img src="{{ asset('images/logo-v.png') }}" width="100%" alt="Logo not found"></div>
            <h1 class="text-light text-center"><span class="text-urdu-kasheeda">اناج تجارت کا نظام</span></h1>
        </div>
    </section>
@endsection
