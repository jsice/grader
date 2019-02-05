@extends('master')
@section('title')
  All Submissions
@endsection
@section('content')
  <p>สามารถใช้ตัวกรองหลายตัวได้โดยคั่นด้วย |(or) หรือ &(and)</p>  
  <div id="filter-error" class="alert alert-danger">
    ไม่สามารถใช้ | กับ & พร้อมกันได้
  </div>
  <input class="form-control" id="submissions-filter" type="text" placeholder="Search..">
  <br>
  <table class="table table-hover">
    <thead>
      <tr class="table-dark">
        <th scope="col">#</th>
        <th scope="col">Problem</th>
        <th scope="col">Sender</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody id="submissions-table">
      @foreach ($submissions as $submission)
        <tr>
          <td scope="row">
            @if (Auth::check() and Auth::user()->type == "admin")
              <a href="{{ 'submissions/' . $submission -> id }}">{{ $submission -> id }}</a>
            @else
              {{ $submission -> id }}
            @endif
          </td>
          <td>
            <a href="{{ './problems/' . $submission -> problem_id }}">{{ $submission -> problem -> name }}</a>
          </td>
          <td>{{ $submission -> sender -> name}}</td>
          <td>{{ $submission -> status}}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <div style="display: flex; justify-content: center;">{{ $submissions->links() }}</div>
@endsection
@push("js")
<script>

$(document).ready(function(){
  $("#filter-error").toggle(false);
  $("#submissions-filter").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#filter-error").toggle((value.includes("|") && value.includes("&")));
    if (value.includes("|") && value.includes("&")) {
      return;
    }
    var cmd = value.includes("|") ? 2 : (value.includes("&") ? 1 : 0);
    var values = $(this).val().toLowerCase().split(/\&|\|/);
    $("#submissions-table tr").filter(function() {
      let result = null
      values.forEach(v => {
        if (result === null) {
          result = $(this).text().toLowerCase().indexOf(v) > -1
        } else {
          result = cmd == 2 ? ($(this).text().toLowerCase().indexOf(v) > -1) || result : ($(this).text().toLowerCase().indexOf(v) > -1) && result
        }
      });
      $(this).toggle(result);
    });
  });
});
</script>
@endpush