@extends('master')

@section('title')
All Users
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <h3 class="display-4" style="font-size: 2.5rem;">Admin</h3>
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
<div style="display: flex; justify-content: center;">
    {{ $admins->appends(['admins' => $admins->currentPage()])->links() }}
</div>
<h5 class="display-4" style="font-size: 2.5rem;">Students</h5>
<table class="table table-hover">
    <thead>
    <tr class="table-dark">
        <th>#</th>
        <th>Name</th>
        <th>ID</th>
        <th>E-Mail</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach ($students as $student)
        <tr>
        <td>{{ $student->id }}</td>
        <td>{{ $student->name }}</td>
        <td>{{ $student->std_id }}</td>
        <td>{{ $student->email }}</td>
        <td>
            <form method="post" action="/users/{{ $student->id }}">
            @method('PUT')
            @csrf
            <button type="submit" class="btn btn-success">Promote</button>
            </form>
        </td>
        </tr>
    @endforeach
    </tbody>
</table>
<div style="display: flex; justify-content: center;">
    {{ $students->appends(['students' => $students->currentPage()])->links() }}
</div>
@endsection
