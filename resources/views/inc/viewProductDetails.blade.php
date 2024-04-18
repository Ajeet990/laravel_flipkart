@extends('layouts/master_layout')
@section('content')
    <div class="container mt-1">
        <div class="d-flex justify-content-between mb-3">
            <div></div> <!-- Placeholder for spacing -->
            <div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mx-auto border">
                <img src="{{asset('images/'.$productDetails->product_image)}}" alt="Product Image" class="mt-2">
                <input type="hidden" value="{{csrf_token()}}" id="csrf_token">
                <div >
                    <h3>{{$productDetails->product_name}}</h3>
                    <p>{{$productDetails->description}}</p>
                    <p><strong>Price:</strong> ${{$productDetails->price}}</p>
                    <p><strong>Owner:</strong> {{$productDetails->owner_name}}</p>
                    @if ($productDetails->isUserLoggedIn)
                        <a href="javascript:" data-add_to_cart_url="{{route('add-to-cart')}}" data-product_id="{{$productDetails->id}}" class="btn btn-primary btn-sm mb-2 addToCart">Add To Cart</a>
                    @endif
                    <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm mb-2">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
