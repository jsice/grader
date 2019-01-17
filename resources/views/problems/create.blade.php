@extends('master')
@section('title')
Create Problem
@endsection
@section('content')
    <form method="post" action="/problems">
        {{ csrf_field() }}
        Problem Name: <input type="text" name="name"><br>
        PDF file: <input type="file" name="pdfFile"><br>
        Input file: <input type="file" name="inputFiles"><br>
        Output file: <input type="file" name="outputFiles"><br>
        <input type="submit" value="Submit">
    </form>
@endsection