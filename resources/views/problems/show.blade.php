@extends('master')
@push('css')
    <style>
        .btn.btn-info.title-submit,
        .btn.btn-info.btn-block {
            font-size: 18px;
            border-radius: 5px;
            line-height: 33px;
        }
        .col-12.submit-button {
            height: 80px;
            padding: 15px 15px;
        }
        .btn.btn-info.title-submit {
            height: 50px;
            width: 120px;
        }
        .btn.btn-info.btn-block {
            height: 100%;
        }
    </style>
@endpush
@section('title')
    {{ $problem -> name }}
@endsection
@section('title-button')
    <a type="role" class="btn btn-info title-submit" href="{{ $problem -> id . '/submit' }}">
        <i class="fa fa-upload"></i>{{" Submit"}}
    </a>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <embed
            src="https://core.ac.uk/download/pdf/82147433.pdf"
            style="width:100%; height:650px;"
            frameborder="0"
        >
    </div>
    <div class="col-12 submit-button">
        <a role="button" class="btn btn-info btn-lg btn-block" href="{{ $problem -> id . '/submit' }}">
            <i class="fa fa-upload"></i>{{" Submit"}}
        </a>
    </div>
</div>
@endsection