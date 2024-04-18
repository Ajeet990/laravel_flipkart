@extends('layouts/master_layout')
@section('content')
    <div class="container col-md-5 my-2">
        <h1>Register To Flipkart</h1>
        <form method="POST" action="{{route('register.submit')}}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" class="form-control" value="{{old('name')}}" id="name" name="name">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" value="{{old('email')}}" name="email" id="email">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" value="{{old('password')}}" name="password" id="password">
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" value="{{old('password_confirmation')}}" name="password_confirmation" id="password_confirmation">
                @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-8">
                        <label for="exampleInputPassword1" class="form-label">Address</label>
                        <input type="text" class="form-control" value="{{old('address')}}" name="address" id="address">
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="exampleInputPassword1" class="form-label">Zipcode</label>
                        <input type="number" class="form-control" value="{{old('zipcode')}}" name="zipcode" id="zipcode">
                        @error('zipcode')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Profile</label>
                <input type="file" class="form-control" value="{{old('profile')}}" name="profile" id="profile">
                @error('profile')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection