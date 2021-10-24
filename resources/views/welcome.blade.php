@extends('layouts.master')

@section('content')
<h1>The best URL Shortener out there!</h1>

<form action="/" method="post">
    {{ csrf_field() }}
    <input type="text" name="url" id="" placeholder="Enter your URL here">
    <input type="submit" value="Shorten URL ">
</form>
@stop