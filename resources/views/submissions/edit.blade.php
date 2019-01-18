@extends('master')
@section('title')
  {{ '#' . $id }}
@endsection
@push('css')
  <style>
    .row.custom-control {
      padding: 15px 0px 15px 1.5rem;
      margin-left: 20px;
    }
    #btn-row,
    .col-1 {
      padding-left: 0;
    }
  </style>
@endpush
@section('content')
  <?php
    $status_list = ['YES', 'NO:TimeLimitExceed', 'NO:CompilationError', 'NO:RunTimeError', 'NO:WrongAnswer',
    'NO:ContactTA', 'DELETED', 'PENDING']
  ?>
  <h3 class="display-4" style="font-size: 2.5rem;">Edit Status</h3>
  <form method="post" action="{{ '/submissions/' . $id }}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="form-group">
      @foreach ($status_list as $status)
        @if ($submission->status === $status)
          <div class="row custom-control custom-radio custom-control-inline">
            <input checked type="radio" class="custom-control-input" name="status" id="{{ $status }}" value="{{ $status }}">
            <label class="custom-control-label" for="{{ $status }}">{{ $status }}</label>
          </div>
        @else
          <div class="row custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" name="status" id="{{ $status }}" value="{{ $status }}">
            <label class="custom-control-label" for="{{ $status }}">{{ $status }}</label>
          </div>
        @endif
      @endforeach
      <div class="row" id="btn-row">
        <div class="col-10"></div>
        <div class="col-1">
          <a role=button class="btn btn-outline-danger" href="javascript:history.back()">Cancel</a>
        </div>
        <div class="col-1">
          <button type="submit" class="btn btn-info">Submit</button>
        </div>
      </div>
    </div>
  </form>
@endsection