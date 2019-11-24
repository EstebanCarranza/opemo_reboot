@extends('layouts.master')
@section('title', 'Error')

@section('content')
<style>
body
{
    background-color:#3498db;
    color:white;
}
a{
    color:white;
}
</style>
@if(isset($error_message))
    <h1>{{$error_message}}</h1>
    @if(!Auth::guest())
        <h4><a href="/dashboard"> Ir al inicio </a></h4>
    @else 
        <h4><a href="/"> Ir al inicio </a></h4>
    @endif
@endif
@stop