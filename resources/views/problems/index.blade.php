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
  @if (Auth::check() and Auth::user()->type == "admin")
    <a type="role" class="btn btn-success add-problem" href="/problems/create">
        <i class="fa fa-plus"></i>{{" Problem"}}
    </a>
  @endif
@endsection
@section('content')
    <?php
      $color = "black";
      $status = "-";
    ?>
    <table class="table table-hover">
      <thead>
        <tr class="table-dark">
          <th scope="col">#</th>
          <th scope="col">Name</th>
          @if (Auth::check() and Auth::user()->type == "admin")
            <th scope="col">Created At</th>
            <th scope="col">Status</th>
          @else
            <th scope="col">Submission</th>
          @endif
        </tr>
      </thead>
      <tbody>
        @if (Auth::check() and Auth::user()->type == "admin")
          @foreach ($problems as $problem)
            <tr>
              <td scope="row">{{ $problem -> id }}</td>
              <td>
                <a href="{{ 'problems/' . $problem -> id }}">{{ $problem -> name }}</a>
              </td>
              <td scope="row">{{ $problem -> created_at }}</td>
              <td>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" name="{{ 'status-' . $problem -> id }}" id="{{ 'show-' . $problem -> id }}" value="show">
                  <label class="custom-control-label" for="{{ 'show-' . $problem -> id }}">Show</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" name="{{ 'status-' . $problem -> id }}" id="{{ 'hide-' . $problem -> id }}" value="hide">
                  <label class="custom-control-label" for="{{ 'hide-' . $problem -> id }}">Hide</label>
                </div>
              </td>
            </tr>
          @endforeach
        @elseif (Auth::check() and Auth::user()->type == "student")
          @foreach ($problems as $problem)
            @if ($problem -> status === "show")
              @foreach ($problem->submissions as $submission)
                @if ($submission->user_id == Auth::user()->id)
                  @if ($submission->status == "YES")
                    <?php
                      $color = "green";
                      $status = "YES";
                    ?>
                    @break
                  @else
                    <?php
                      $color = "red";
                      $status = "NO";
                    ?>
                  @endif
                @endif
              @endforeach
              <tr>
                <td scope="row">{{ $problem -> id }}</td>
                <td>
                  <a href="{{ 'problems/' . $problem -> id }}">{{ $problem -> name }}</a>
                </td>
                <td style="{{ 'color: ' . $color . ';' }}">{{ $status }}</td>
              </tr>
            @endif
          @endforeach
        @else
          @foreach ($problems as $problem)
            @if ($problem -> status === "show")
              <tr>
                <td scope="row">{{ $problem -> id }}</td>
                <td>
                  <a href="{{ 'problems/' . $problem -> id }}">{{ $problem -> name }}</a>
                </td>
                <td style="{{ 'color: ' . $color . ';' }}">{{ $status }}</td>
              </tr>
            @endif
          @endforeach
        @endif
      </tbody>
    </table>
    <script>
      const problems = <?php echo json_encode($problems); ?>;
      problems.map((problem) => {
        const { id, status } = problem
        $(`input[name="status-${id}"][value=${status}]`).attr('checked', 'checked');
        $(`input[name="status-${id}"]`).change(function(e) {
          var value = e.target.value
          jQuery.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "PUT",
            url: `/problems/${id}/status`,
            data: `status=${value}`,
          })
          e.preventDefault();
        })
      })
    </script>
@endsection
