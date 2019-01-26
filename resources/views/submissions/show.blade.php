@extends('master')
@section('title')
  {{ '#' . $submission -> id }}
@endsection
@push('css')
    <style>
        .edit, .code, .rejudge {
          font-size: 18px;
          border-radius: 5px;
          line-height: 33px;
          height: 50px;
          width: 120px;
          margin-left:10px;
        }
        .col-2, .col-3, .col-9 {
          padding-top: 10px;
          padding-bottom: 10px;
          font-size: 18px;
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
    <form method="POST" action="{{ '/submissions/' . $submission -> id . '/rejudge' }}">
      @method('PUT')
      @csrf
      <button class="btn btn-success rejudge" value="submit"><i class="fas fa-redo-alt"></i>{{" Re-Judge"}}</button>
    </form>
    <a type="role" class="btn btn-danger code" href="{{ '/code/' . $submission -> id }}" target="_blank">
      <i class="fas fa-code"></i>{{" Code"}}
    </a>
    <a type="role" class="btn btn-info edit" href="{{ '/submissions/' . $submission -> id . '/edit' }}">
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
      {{ $submission->sender->name }}
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
      {{ $submission->problem->name }}
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
      {{ ucfirst($submission->language) }}
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