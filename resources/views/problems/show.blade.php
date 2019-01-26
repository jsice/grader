@extends('master')
@push('css')
    <style>
        .btn.btn-info.title-submit,
        .btn.btn-danger.title-delete,
        .btn.btn-info.btn-block {
            font-size: 18px;
            border-radius: 5px;
            line-height: 33px;
        }
        .col-12.submit-button {
            height: 80px;
            padding: 15px 15px;
        }
        .btn.btn-info.title-submit,.btn.btn-danger.title-delete {
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
    @if (Auth::check() && Auth::user()->type == 'admin')
    <form method="POST" action="/problems/{{ $problem->id }}">
        @method('DELETE')
        @csrf
        <button class="btn btn-danger title-delete" style="margin-right:10px" value="submit"><i class="far fa-trash-alt"></i> Delete</button>
    </form>
    @endif
    <a type="role" class="btn btn-info title-submit" href="{{ $problem -> id . '/submit' }}">
        <i class="fa fa-upload"></i>{{" Submit"}}
    </a>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <embed
            src="{{ '/pdf' . '/' . $problem -> id . '/' . $problem -> pdf_path }}"
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