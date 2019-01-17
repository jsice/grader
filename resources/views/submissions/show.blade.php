@extends('master')
@section('title')
  {{ '#' . $submission -> id }}
@endsection
@push('css')
    <style>
        .edit {
          font-size: 18px;
          border-radius: 5px;
          line-height: 33px;
          height: 50px;
          width: 120px;
        }
        .col-2, .col-3, .col-9 {
          padding-top: 10px;
          padding-bottom: 10px;
          font-size: 20px;
          display: flex;
        }
        .label {
          font-weight: bold;
        }
        .fa {
          font-size: 25px;
        }
    </style>
@endpush
@section('title-button')
  @if (Auth::check() and Auth::user()->type == "admin")
    <a type="role" class="btn btn-info edit" href="{{ '/submissions/' . $submission -> id . '/create' }}">
        <i class="fa fa-edit"></i>{{" Edit"}}
    </a>
  @endif
@endsection
@section('content')
  <div class="row">
    <div class="col-3 label submission-id">
      <div style="width: 40px;">
        <i class="fa fa-hashtag"></i>
      </div>
      Submission ID
    </div>
    <div class="col-3">
      {{ $submission->id }}
    </div>
    <div class="col-2 label status">
      <div style="width: 40px;">
        <i class="fa fa-tag"></i>
      </div>
      Status
    </div>
    <div class="col-3">
      {{ $submission->status }}
    </div>
  </div>
  <div class="row">
    <div class="col-3 label sender">
      <div style="width: 40px;">
        <i class="fa fa-user"></i>
      </div>
      Sender
    </div>
    <div class="col-9">
      {{ $submission->user_id }}
    </div>
  </div>
  <div class="row">
    <div class="col-3 label problem">
      <div style="width: 40px;">
        <i class="fa fa-file-code"></i>
      </div>
      Problem
    </div>
    <div class="col-9">
      {{ $submission->problem_id }}
    </div>
  </div>
  <div class="row">
    <div class="col-3 label language">
      <div style="width: 40px;">
        <i class="fa fa-code"></i>
      </div>  
      Language
    </div>
    <div class="col-9">
      {{ $submission->language }}
    </div>
  </div>
  <div class="row">
    <div class="col-3 label submitted-at">
      <div style="width: 40px;">
        <i class="fa fa-calendar-plus"></i>
      </div>
      Submitted At
    </div>
    <div class="col-9">
      {{ $submission->created_at }}
    </div>
  </div>
@endsection