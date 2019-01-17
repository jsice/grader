@extends('master')
@section('title')
Problems
@endsection
@push('css')
    <style>
        .add-problem {
            font-size: 18px;
            border-radius: 5px;
            line-height: 33px;
            height: 50px;
            width: 130px;
        }
    </style>
@endpush
@section('title-button')
    <a type="role" class="btn btn-success add-problem" href="/problems/create">
        <i class="fa fa-plus"></i>{{" Problem"}}
    </a>
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
            @if ($problem -> status === "show")
              <tr>
              <td scope="row">{{ $problem -> id }}</td>
                <td>
                  <a href="{{ 'problems/' . $problem -> id }}">{{ $problem -> name }}</a>
                </td>
                <td style="color: green;">{{ $problem -> status }}</td>
              </tr>
            @endif
            <p>{{$problem}}</p>
        @endforeach
      </tbody>
    </table>
@endsection