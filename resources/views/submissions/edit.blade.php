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
  <h3 class="display-4" style="font-size: 2.5rem;">Edit Status</h3>
  <form>
    <div class="form-group">
      <div class="row custom-control custom-radio custom-control-inline">
        <input type="radio" class="custom-control-input" name="status" id="YES" value="YES">
        <label class="custom-control-label" for="YES">YES</label>
      </div>
      <div class="row custom-control custom-radio custom-control-inline">
        <input type="radio" class="custom-control-input" name="status" id="NO:TimeLimitExceed" value="NO:TimeLimitExceed">
        <label class="custom-control-label" for="NO:TimeLimitExceed">NO:TimeLimitExceed</label>
      </div>
      <div class="row custom-control custom-radio custom-control-inline">
        <input type="radio" class="custom-control-input" name="status" id="NO:CompilationError" value="NO:CompilationError">
        <label class="custom-control-label" for="NO:CompilationError">NO:CompilationError</label>
      </div>
      <div class="row custom-control custom-radio custom-control-inline">
        <input type="radio" class="custom-control-input" name="status" id="No:RunTimeError" value="No:RunTimeError">
        <label class="custom-control-label" for="No:RunTimeError">No:RunTimeError</label>
      </div>
      <div class="row custom-control custom-radio custom-control-inline">
        <input type="radio" class="custom-control-input" name="status" id="No:WrongAnswer" value="No:WrongAnswer">
        <label class="custom-control-label" for="No:WrongAnswer">No:WrongAnswer</label>
      </div>
      <div class="row custom-control custom-radio custom-control-inline">
        <input type="radio" class="custom-control-input" name="status" id="No:ContactTA" value="No:ContactTA">
        <label class="custom-control-label" for="No:ContactTA">No:ContactTA</label>
      </div>
      <div class="row custom-control custom-radio custom-control-inline">
        <input type="radio" class="custom-control-input" name="status" id="DELETED" value="DELETED">
        <label class="custom-control-label" for="DELETED">DELETED</label>
      </div>
      <div class="row custom-control custom-radio custom-control-inline">
        <input type="radio" class="custom-control-input" name="status" id="PENDING" value="PENDING">
        <label class="custom-control-label" for="PENDING">PENDING</label>
      </div>
      <div class="row" id="btn-row">
        <div class="col-10"></div>
        <div class="col-1">
          <a role=button class="btn btn-outline-danger" href="">Cancel</a>
        </div>
        <div class="col-1">
          <button type="submit" class="btn btn-info">Submit</button>
        </div>
      </div>
    </div>
  </form>
@endsection