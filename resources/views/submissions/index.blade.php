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
      @for ($i = count($submissions)-1; $i >= 0; $i--)
          <tr>
            <td scope="row">
              <a href="{{ 'submissions/' . $submissions[$i] -> id }}">{{ $submissions[$i] -> id }}</a>
            </td>
            <td>{{ $submissions[$i] -> problem -> name }}</td>
            <td>{{ $submissions[$i] -> sender -> name}}</td>
            <td>{{ $submissions[$i] -> status}}</td>
          </tr>
            
      @endfor
    @elseif (Auth::check() && Auth::user()->type === "student")
      @for ($i = count($submissions)-1; $i >= 0; $i--)
        <tr>
          <td scope="row">
            <a href="{{ 'submissions/' . $submissions[$i] -> id }}">{{ $submissions[$i] -> id }}</a>
          </td>
          <td>{{ $submissions[$i] -> problem -> name }}</td>
          <td>{{ $submissions[$i] -> sender -> name}}</td>
          <td>{{ $submissions[$i] -> status}}</td>
        </tr>
      @endfor
    @endif
    </tbody>
  </table>
@endsection