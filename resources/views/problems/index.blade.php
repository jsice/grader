@extends('master')
@section('title')
Problems
@endsection
@section('content')
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Submission</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($problems as $problem)
            <p>{{$problem}}</p>
            @if ($problem -> status === "show")
              <tr>
              <td scope="row">{{ $problem -> id }}</td>
                <td>
                  <a href="{{ 'problems/' . $problem -> id }}">{{ $problem -> name }}</a>
                </td>
                <td style="color: green;">{{ $problem -> status }}</td>
              </tr>
            @endif
        @endforeach
      </tbody>
    </table>
@endsection