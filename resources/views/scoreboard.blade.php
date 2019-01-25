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
            <th>Rank</th>
            <th>ID</th>
            <!-- <th>Name</th> -->
            @foreach($problems as $problem)
            <th>{{ $problem->name }}</th>
            @endforeach
            <th>Total</th>
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
            <td score="row"><h5>{{ $rank }}</h5></td>
            <td scope="row"><h6>{{ $user->std_id }}</h6></td>
            <!-- <td scope="row"><h6>{{ $user->name }}</h6></td> -->
            @foreach($scores as $key => $score)
              <td scope="row">
              @if ($key == "total")
                <h5>{{$score}}</h5>
              @else
                <h5>
                @if ($score == -1)
                -
                @elseif ($score == 0)
                <i class="far fa-times-circle text-danger"></i>
                @elseif ($score == 1)
                <i class="far fa-check-circle text-success"></i>
                @endif
                </h5>
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
