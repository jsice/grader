@extends('master')
@section('title')
Create Problem
@endsection
@section('content')
    <form method="post" action="/problems" enctype="multipart/form-data">
        {{ csrf_field() }}
        Problem Name: <input type="text" name="name"><br>
        PDF file: <input type="file" name="pdfFile"><br>
        Input file: <input type="file" name="inputFiles[]" multiple><br>
        Output file: <input type="file" name="outputFiles[]" multiple><br>
        <input type="submit" value="Submit">
    </form>
@endsection