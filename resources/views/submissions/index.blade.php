@extends('master')
@section('title')
  All Submissions
@endsection
@section('content')
  <table class="table table-hover">
    <thead>
      <tr class="table-dark">
        <th scope="col">#</th>
        <th scope="col">Problem</th>
        <th scope="col">Sender</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($submissions as $submission)
        <tr>
          <td scope="row">
            <a href="{{ 'submissions/' . $submission -> id }}">{{ $submission -> id }}</a>
          </td>
          <td>
            <a href="{{ './problems/' . $submission -> problem_id }}">{{ $submission -> problem -> name }}</a>
          </td>
          <td>{{ $submission -> sender -> name}}</td>
          <td>{{ $submission -> status}}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <div style="display: flex; justify-content: center;">{{ $submissions->links() }}</div>
@endsection