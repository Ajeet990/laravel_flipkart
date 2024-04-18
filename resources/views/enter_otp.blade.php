@extends('layouts/master_layout')
@section('content')
    <form action="{{route('submit.otp')}}" method="post">
        @csrf
        <div class="container my-2">
            @if(session('message'))
                <div class="alert alert-{{session('color')}} alert-dismissible fade show" role="alert">
                    <strong>{{session('message')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <input type="text" name="otp" value="" placeholder="Enter your OTP">
            <input class="btn btn-primary mx-1" type="submit" value="Submit">
            <input type="button" href="{{route('show_login')}}" class="btn btn-primary mx-1" value="Login">
            <input type="hidden" value="{{ session('email') }}" name="email">
        </div>
    </form>
@endsection