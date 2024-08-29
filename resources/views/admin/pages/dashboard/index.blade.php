@extends('admin.layouts.app')
@section('content')
    <div class="my-3">
        <div>Welcome, <strong class="text-capitalize">{{ auth()->user()->name }}</strong></div>
    </div>
@endsection