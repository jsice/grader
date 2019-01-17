@extends('master')

@section('title')
All Users
@endsection

@section('content')
<div class="row">
    <div class="col-10">
        <h3 class="display-4">Admin</h3>
    </div>
    <div class="col-2 title-button">
        <a type="role" class="btn btn-success add-problem" href="users/create">
            <i class="fa fa-plus"></i> Admin
        </a>
    </div>
</div>
<table class="table table-hover">
    <thead>
    <tr class="table-dark">
        <th>#</th>
        <th>Name</th>
        <th>ID</th>
        <th>E-Mail</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($admins as $admin)
        <tr>
            <td>{{ $admin->id }}</td>
            <td>{{ $admin->name }}</td>
            <td>{{ $admin->std_id }}</td>
            <td>{{ $admin->email }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<h5 class="display-4">Students</h5>
<table class="table table-hover">
    <thead>
    <tr class="table-dark">
        <th>#</th>
        <th>Name</th>
        <th>ID</th>
        <th>E-Mail</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($students as $student)
        <tr>
        <td>{{ $student->id }}</td>
        <td>{{ $student->name }}</td>
        <td>{{ $student->std_id }}</td>
        <td>{{ $student->email }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
