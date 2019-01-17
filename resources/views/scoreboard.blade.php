@extends('master')

@section('title')
Scoreboard
@endsection

@section('content')
  @if (count($scoreboard) == 0)
  <h3 class="display-5 text-muted text-center mt-5">- SCOREBOARD EMPTY -<h3>
    @else
    <table class="table table-hover">
      <thead>
        <tr class="table-primary">
            <th scope="col">Rank</th>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            @foreach($problems as $problem)
            <th scope="col">{{ $problem->name }}</th>
            @endforeach
            <th scope="col">Total</th>
          </tr>
        </thead>
        <tbody>
          <?php $rank = 1 ?>
          @foreach($scoreboard as $key => $scores)
          <?php $user = \App\User::where('id',$key)->first() ?>
          <tr class="table-light">
            <td score="row">{{ $rank }}</td>
            <td scope="row">{{ $user->std_id }}</td>
            <td scope="row">{{ $user->name }}</td>
            @foreach($scores as $key => $score)
                <td scope="row">{{ $score }}</td>
            @endforeach
            <?php $rank++ ?>
          </tr>
          @endforeach
        </tbody>
      </table>
    @endif
@endsection
