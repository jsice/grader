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
  </style>
@endpush
@section('title')
Create Problem
@endsection
@section('content')
<form method="post" action="/problems" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="row">
    <div class="col-2"></div>
    <div class="col-8">
      <div class="form-group row">
        <div class="form-group col-8">
          <label for="name">Problem</label>
          <input type="text" name="name" class="form-control" id="name" placeholder="Enter Ploblem name">
        </div>
        <div class="form-group col-4">
          <label for="time">Time Limit</label>
          <input type="number" name="time" class="form-control" id="time" aria-describedby="timeHelp">
          <small id="timeHelp" class="form-text text-muted">Please Careful.</small>
        </div>
        <div class="col-12 file-upload">
          <div class="custom-file" id="customFile" lang="es">
            <input name="pdfFile" type="file" class="custom-file-input" id="upload-pdf-file"/>
            <label class="custom-file-label custom-pdf-label" for="upload-file">
              Select PDF File...
            </label>
          </div>
        </div>
        <div class="form-inline">
          <div class="col-6 file-upload">
            <div class="custom-file" id="customFile" lang="es">
              <label class="custom-file-label custom-input-label" for="upload-file">
                Select Input File...
              </label>
              <input name="inputFiles[]" type="file" class="custom-file-input form-control" id="upload-input-file" aria-describedby="inputHelp" multiple />
              <small id="inputHelp" class="form-text text-muted">You Can Select Multiple Files.</small>
            </div>
          </div>
          <div class="col-6 file-upload">
            <div class="custom-file" id="customFile" lang="es">
              <label class="custom-file-label custom-output-label" for="upload-file">
                Select Output File...
              </label>
              <input name="outputFiles[]" type="file" class="custom-file-input form-control" id="upload-output-file" aria-describedby="outputHelp" multiple />
              <small id="outputHelp" class="form-text text-muted">You Can Select Multiple Files.</small>
            </div>
          </div>
        </div>
        <div class="col-12 row">
          <div class="col-6" style="margin-right: 15px">
            <small id="inputFiles" class="text-muted">t</small>
          </div>
          <div class="col-6">
            <small id="outputFiles" class="text-muted">t</small>
          </div>
        </div>
        <div class="col-12 row" style="padding: 0;">
          <div class="button cancel col-md-2 offset-md-8" style="padding-left: 0; padding-right:3px">
            <a role="button" class="btn btn-outline-danger cancel" href="javascript:history.back()">Cancel</a>
          </div>
          <div class="button submit col-md-2 offset-md-0" style="padding-right: 0; padding-left:3px">
            <button type="submit" class="btn btn-info submit">Submit</button>
          </div>
        </div>
      </div>
    </div>
    <div class="col-2"></div>
  </div>
</form>
    <script>
      $('#upload-pdf-file').change(function(e) {
        var fileName = e.target.files[0].name;
        $('.custom-pdf-label').html(fileName);
      });
      $('#upload-input-file').change(function(e) {
        var filenames = ""
        for (var i = 0; i < e.target.files.length; i++) {
          filenames += e.target.files[i].name + "<br>";
        }
        $('#inputFiles').html(filenames);
      });
      $('#upload-output-file').change(function(e) {
        var filenames = ""
        for (var i = 0; i < e.target.files.length; i++) {
          filenames += e.target.files[i].name + "<br> ";
        }
        $('#outputFiles').html(filenames);
      });
    </script>
@endsection
