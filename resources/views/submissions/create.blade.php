@extends('master')
@push('css')
  <style>
    .col-12.file-upload {
      margin: 20px 0px 30px 0px;
    }
    .col-1.button {
      display: flex;
      align-items: center;
      justify-content: center;
      padding-left: 0;
    }
    .btn.cancel,
    .btn.submit {
      border-radius: 5px;
      width: 100%;
      padding: 8px 0px;
    }
    .display-4.title {
      font-size: 2.5rem;
    }
    .alert.alert-danger {
      margin-top: 1rem;
    }
    .error-list {
      margin-bottom: 0;
    }
    .custom-file-label,
    .custom-file-label::after {
      height: 60px;
      display: flex;
      align-items: center;
    }
  </style>
@endpush
@section('title')
  Submit Solution
@endsection
@section('content')
  <h4 class="display-4 title">{{ $problem -> name }}</h3>
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="error-list">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <form method="post" action="{{ '/problems/' . $problem->id . '/submit' }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group row">
      <div class="col-12 file-upload">
        <div class="custom-file" id="customFile" lang="es">
          <input name="codeFile" type="file" class="custom-file-input" id="upload-file" aria-describedby="fileHelp" />
          <label class="custom-file-label" for="upload-file">
            Select file...
          </label>
        </div>
      </div>
      <div class="col-3">
        <div class="form-group">
          <label for="lang-select">Language</label>
          <select name="language" class="form-control custom-select" id="lang-select">
            <option value="c">C</option>
            <option value="cpp">C++</option>
            <option value="java">Java</option>
          </select>
        </div>
      </div>
      <div class="col-7"></div>
      <div class="col-1 button cancel">
        <a role="button" class="btn btn-outline-danger cancel" href="javascript:history.back()">Cancel</a>
      </div>
      <div class="col-1 button submit">
        <button type="submit" class="btn btn-info submit">Submit</button>
      </div>
    </div>
  </form>
  <script>
    $('#upload-file').change(function(e) {
      var fileName = e.target.files[0].name;
      console.log(e.target.files[0])
      $('.custom-file-label').html(fileName);
    })
  </script>
@endsection
