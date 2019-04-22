@extends('master')
@section('title')
  All Submissions
@endsection
@push('css')
  <style>
    .filter-btn {
      font-size: 18px;
      border-radius: 5px;
      line-height: 33px;
      height: 50px;
    }
    .filterModal {
      width: 1200px;
    }
  </style>
@endpush
@section('title-button')
  <button type="button" class="btn btn-warning filter-btn" data-toggle="modal" data-target="#filterModal">
    <i class="fas fa-filter"></i>{{" Filter"}}
  </button>
@endsection
@section('content')
  @if (Auth::user()->type == 'admin')
  <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="filterModalLongTitle">Submissions Filter</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="accordion">
            <div class="card">
              <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                  <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Problem
                  </button>
                </h5>
              </div>
              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                  @foreach ($problems as $problem)
                  <div class="btn-group-toggle d-inline-block mb-1" data-toggle="buttons">
                    <label class="btn btn-outline-success @if(in_array($problem->id, $params["problems"])) active @endif">
                      <input type="checkbox" name="problems-checkbox" @if(in_array($problem->id, $params["problems"])) checked @endif autocomplete="off" value="{{ $problem->id }}"> {{ $problem->name }}
                    </label>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Sender
                  </button>
                </h5>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                <div class="card-body">
                  @foreach ($users as $user)
                  <div class="btn-group-toggle d-inline-block mb-1" data-toggle="buttons">
                    <label class="btn btn-outline-success @if(in_array($user->id, $params["sender"])) active @endif">
                      <input type="checkbox" name="sender-checkbox" @if(in_array($user->id, $params["sender"])) checked @endif autocomplete="off" value="{{ $user->id }}"> {{ $user->email }}
                    </label>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingThree">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Status
                  </button>
                </h5>
              </div>
              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                <div class="card-body">
                  @foreach ($status as $stat)
                  <div class="btn-group-toggle d-inline-block mb-1" data-toggle="buttons">
                    <label class="btn btn-outline-success @if(in_array($stat, $params["status"])) active @endif">
                      <input type="checkbox" name="status-checkbox" @if(in_array($stat, $params["status"])) checked @endif autocomplete="off" value="{{ $stat }}"> {{ $stat }}
                    </label>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="apply-filters-btn">Apply filters</button>
        </div>
      </div>
    </div>
  </div>
  @endif
  <table class="table table-hover">
    <thead>
      <tr class="table-dark">
        <th scope="col">#</th>
        <th scope="col">Problem</th>
        <th scope="col">Sender ID</th>
        <th scope="col">Sender</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
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
          <td>{{ $submission -> sender -> std_id}}</td>
          <td>{{ $submission -> sender -> name}}</td>
          <td>{{ $submission -> status}}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <div style="display: flex; justify-content: center;">{{ $submissions->links() }}</div>
@endsection
@push('js')
<script>
$(document).ready(function(){
  $("#apply-filters-btn").on("click", function() {
    let problems = '';
    $.each($("input[name='problems-checkbox']:checked"), function(){  
      problems += (problems === '' ? '' : ',') + $(this).val();
    });
    let sender = '';
    $.each($("input[name='sender-checkbox']:checked"), function(){  
      sender += (sender === '' ? '' : ',') + $(this).val();
    });
    let status = '';
    $.each($("input[name='status-checkbox']:checked"), function(){  
      status += (status === '' ? '' : ',') + $(this).val();
    });
    let params = [];
    if (problems !== '') params.push(`problems=${problems}`);
    if (sender !== '') params.push(`sender=${sender}`);
    if (status !== '') params.push(`status=${status}`);
    window.location.replace('/submissions' + (params.length > 0) ? '?' + params.join('&') : '');
  });
});
</script>
@endpush