@extends('master')

@section('title')
Create Admin
@endsection

@section('content')
@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ $errors->first() }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<form method="post" action="/users">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="วิวรรธน์ ชินานุพันธ์" required>
    </div>
    <div class="form-group">
        <label for="std_id">Student ID</label>
        <input type="text" class="form-control" id="std_id" name="std_id" placeholder="60104xxxxx" required pattern="(5[2-9]|6[0-1])104(5|0)[0-9]{4}">
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="text" class="form-control" id="email" name="email" placeholder="adam.w@ku.th" required pattern="[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@ku.th">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="กรุณาอย่าให้รหัสผ่านกับผู้อื่น">
    </div>
    <div class="form-group">
        <label for="password_confirmation">Confirmation Password</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="กรุณากรอกให้เหมือนกับข้างบน">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
