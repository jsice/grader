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
    @if (Auth::check() && Auth::user()->type === "admin")
      @foreach ($submissions as $submission)
          <tr>
            <td scope="row">
              <a href="{{ 'submissions/' . $submission -> id }}">{{ $submission -> id }}</a>
            </td>
            <td>{{ $submission -> problem -> name }}</td>
            <td>{{ $submission -> sender -> name}}</td>
            <td>{{ $submission -> status}}</td>
          </tr>
            
      @endforeach
    @elseif (Auth::check() && Auth::user()->type === "student")
      @foreach (Auth::user()->submissions as $submission)
        <tr>
          <td scope="row">
            <a href="{{ 'submissions/' . $submission -> id }}">{{ $submission -> id }}</a>
          </td>
          <td>{{ $submission -> problem -> name }}</td>
          <td>{{ $submission -> sender -> name}}</td>
          <td>{{ $submission -> status}}</td>
        </tr>
      @endforeach
    @endif
    </tbody>
  </table>
@endsection