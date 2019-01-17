@extends('master')

@section('title')
Create Admin
@endsection

@section('content')
<!-- <form>
    @csrf
    Name: <input type="text" name="name" required ><br>
    Student ID: <input type="text" name="std_id" required ><br>
    E-Mail: <input type="text" name="email" required ><br>
    Password: <input type="text" name="password" required ><br>
    <input type="submit" value="Submit">
</form> -->
<form method="post" action="/users">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="วิวรรธน์ ชินานุพันธ์" required>
    </div>
    <div class="form-group">
        <label for="std_id">Student ID</label>
        <input type="text" class="form-control" id="std_id" name="std_id" placeholder="60104xxxxx" required>
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="email" name="email" placeholder="adam.w" required>
            <div class="input-group-append">
                <span class="input-group-text">@ku.th</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="โปรดอย่าให้รหัสผ่านกับผู้อื่น">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
