@extends('master')
@push('css')
    <style>
        .btn.btn-info {
            height: 50px;
            width: 120px;
            font-size: 18px;
            border-radius: 5px;
            line-height: 33px;
        }
    </style>
@endpush
@section('title')
    {{ $problem -> name }}
@endsection
@section('title-button')
    <a type="role" class="btn btn-info" href="#"><i class="fa fa-upload"></i>{{" Submit"}}</a>
@endsection
@section('content')
    <embed
        src="https://core.ac.uk/download/pdf/82147433.pdf"
        style="width:100%; height:650px;"
        frameborder="0"
    >
    {{ $problem }}
@endsection