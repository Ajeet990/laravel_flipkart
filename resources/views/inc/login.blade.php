@extends('layouts/master_layout')
@section('content')
    <div class="container col-md-5 my-2">
        <h1>Login To Flipkart</h1>
        @if(session('message'))
            <div class="alert alert-{{session('color')}} alert-dismissible fade show" role="alert">
                <strong>{{session('message')}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form method="POST" action="{{route('form.login')}}" id="loginForm">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1">
            </div>
            
            <button type="submit" class="btn btn-primary">Log In</button>
        </form>
    </div>    
    @endsection