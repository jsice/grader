@extends('master')
@section('title')
  All Submissions
@endsection
@section('content')
  <?php
    use Illuminate\Support\Facades\Auth;
    $user_id = Auth::user()->id;
    $user_type = Auth::user()->type;
  ?>
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
        @if ($user_type === "admin")
          <tr>
            <td scope="row">
              <a href="{{ 'submissions/' . $submission -> id }}">{{ $submission -> id }}</a>
            </td>
            <td>{{ $submission -> problem -> name }}</td>
            <td>{{ $submission -> sender -> name}}</td>
            <td>{{ $submission -> status}}</td>
          </tr>
        @elseif ($user_type === "student")
          @if ($submission->user_id === $user_id)
            <tr>
              <td scope="row">
                <a href="{{ 'submissions/' . $submission -> id }}">{{ $submission -> id }}</a>
              </td>
              <td>{{ $submission -> problem -> name }}</td>
              <td>{{ $submission -> sender -> name}}</td>
              <td>{{ $submission -> status}}</td>
            </tr>
          @endif
        @endif
      @endforeach
    </tbody>
  </table>
@endsection