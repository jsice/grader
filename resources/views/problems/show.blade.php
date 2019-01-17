@extends('master')
@section('title')
{{ $problem -> name }}
@endsection
@section('content')
    <embed
        src="https://core.ac.uk/download/pdf/82147433.pdf"
        style="width:100%; height:650px;"
        frameborder="0"
    >
    {{ $problem }}
@endsection