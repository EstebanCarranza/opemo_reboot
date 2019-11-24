@extends('layouts.master')
@section('content')
@if(isset($cardTitle))
    @section('title', $cardTitle)
    
    <h4 class="center">{{$cardTitle}}</h4>
    
    @else
        @section('title', 'OPEMO')
@endif
<div class='row card-panel z-depth-0'>
    @yield('body')
</div>
@stop

    