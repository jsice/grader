@extends('master')

@section('content')
<div class="container">
  <h3 class="display-4">Problems</h3>
  <hr>
  <div class="container">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Submission</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td scope="row">1</td>
          <td>Mark</td>
          <td style="color: green;">Passed</td>
        </tr>
        <tr>
          <td scope="row">2</td>
          <td>Jacob</td>
          <td style="color: red">Not Passed</td>
        </tr>
        <tr>
          <td scope="row">3</td>
          <td>Larry</td>
          <td>-</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection
