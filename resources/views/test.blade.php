@extends('layouts.cards')
@section('title', 'Ubicaciones')
@section('body')
@if($userData)
    {{$userData->getPathAvatar()}}
    <img src="{{url('/imagen/profile/avatar/'.$userData->getIdUsuario())}}">
    {{url('/imagen/profile/avatar/'.$userData->getIdUsuario())}}
@endif
@stop