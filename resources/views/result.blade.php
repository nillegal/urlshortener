@extends('layouts.master')

@section('content')
<h1>Find your shortened URL below:</h1>
<a href="{{ config('app.url') }}/{{ $shortened }}" target="_blank">
    {{ config('app.url') }}/{{ $shortened }}
</a>

@stop