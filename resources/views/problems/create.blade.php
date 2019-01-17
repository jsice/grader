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
Create Problem
@endsection
@section('content')
    <form method="post" action="/problems" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group row">
            Problem Name: <input type="text" name="name"><br>
            <div class="col-12 file-upload">
                <div class="custom-file" id="customFile" lang="es">
                    <input name="pdfFile" type="file" class="custom-file-input" id="upload-pdf-file" aria-describedby="fileHelp" />
                    <label class="custom-file-label" for="upload-file">
                    Select PDF File...
                    </label>
                </div>
            </div>
            <div class="col-12 file-upload">
                <div class="custom-file" id="customFile" lang="es">
                    <input name="inputFiles[]" type="file" class="custom-file-input" id="upload-input-file" aria-describedby="fileHelp" multiple />
                    <label class="custom-file-label" for="upload-file">
                    Select Input File...
                    </label>
                </div>
            </div>
            <div class="col-12 file-upload">
                <div class="custom-file" id="customFile" lang="es">
                    <input name="outputFiles[]" type="file" class="custom-file-input" id="upload-output-file" aria-describedby="fileHelp" multiple />
                    <label class="custom-file-label" for="upload-file">
                    Select Output File...
                    </label>
                </div>
            </div> 
            <div class="col-1 button cancel">
                <a role="button" class="btn btn-outline-danger cancel" href="javascript:history.back()">Cancel</a>
            </div>
            <div class="col-1 button submit">
                <button type="submit" class="btn btn-info submit">Submit</button>
            </div>
        </div>
    </form>
@endsection