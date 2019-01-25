@extends('master')

@section('title')
Profile
@endsection

@push('css')
    <style>
        .row {
            margin-top: 10px
        }
        .display-4.md {
            font-size: 40px;
        }
    </style>
@endpush

@section('content')
@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>{{ $errors->first() }}</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
<div class="row">
    <div class="col-12">
        <h3 class="display-4 md">{{ $user->name }}</h3>
    </div>
</div>
<div class="row">
    <div class="col-2">
        E-Mail: 
    </div>
    <div class="col-10">
        {{ $user->email }}
    </div>
</div>
<div class="row">
    @if ($user->std_id == null)
        <form method="post" action="/profile" class="col-12">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="std_id">Student ID:</label>
                <input type="text" name="std_id" class="form-control" id="std_id" placeholder="ใส่รหัสนิสิตให้ถูกต้อง" required pattern="(5[2-9]|6[0-1])104(5|0)[0-9]{4}">
            </div>
            <div>
                <button class="btn btn-success" value="submit">Save</button>
            </div>
        </form>
    @else
        <div class="col-2">
            Student ID:
        </div>
        <div class="col-10">
            {{ $user->std_id }}
        </div>
    @endif
</div>
@endsection