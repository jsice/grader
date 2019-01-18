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
        <tr class="table-dark">
            <th class="text-center">Rank</th>
            <th class="text-center">ID</th>
            <th class="text-center">Name</th>
            @foreach($problems as $problem)
            <th class="text-center">{{ $problem->name }}</th>
            @endforeach
            <th class="text-center">Total</th>
        </tr>
        </thead>
        <tbody>
          <?php
            $rank = 1
          ?>
          @foreach($scoreboard as $key => $scores)
          <?php
            $user = \App\User::where('id',$key)->first();
          ?>
          <tr>
            <td score="row" class="text-center"><h5>{{ $rank }}</h5></td>
            <td scope="row" class="text-center"><h6>{{ $user->std_id }}</h6></td>
            <td scope="row"><h6>{{ $user->name }}</h6></td>
            @foreach($scores as $key => $score)
              <td scope="row" class="text-center">
              @if ($key == "total")
                <h5>{{$score}}</h5>
              @else
                @if ($score == -1)
                <h6>-</h6>
                @elseif ($score == 0)
                <img src="icons/wrong.png" />
                @elseif ($score == 1)
                <img src="icons/correct.png" />
                @endif
              @endif
              </td>
            @endforeach
            <?php $rank++ ?>
          </tr>
          @endforeach
        </tbody>
      </table>
    @endif
@endsection
