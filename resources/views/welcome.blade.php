@extends('layout.app')

@section('content')
<div id="layout_app">
    <app :data="{{ json_encode(session('error')) }}"></app>
</div>
@endsection