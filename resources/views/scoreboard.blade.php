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
            <th style="text-align: center;">Rank</th>
            <th style="text-align: center;">ID</th>
            <th>Name</th>
            @foreach($problems as $problem)
            <th style="text-align: center;">{{ $problem->name }}</th>
            @endforeach
            <th style="text-align: center;">Total</th>
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
            <td score="row" align="center">{{ $rank }}</td>
            <td scope="row" align="center">{{ $user->std_id }}</td>
            <td scope="row">{{ $user->name }}</td>
            @foreach($scores as $key => $score)
              <td scope="row" align="center">
              @if ($key == "total")
                {{$score}}
              @else
                @if ($score == -1)
                -
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
