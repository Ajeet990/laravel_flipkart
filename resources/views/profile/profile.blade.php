@extends('layouts/master_layout')
@section('content')

    <div class="container my-1">
        @if(session('message'))
            <div class="alert alert-{{session('color')}} alert-dismissible fade show" role="alert">
                <strong>{{session('message')}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <a type="button" href="{{route('new_product')}}" class="btn btn-primary">Add product</a>
        

        <div class="row my-1">
            {{-- Filter Section --}}
            <div class="col-md-2">
                <div class="card">
                    <h3>Filters</h3>
                    <hr>
                    <div class="form-check">
                        <p>Order by price</p>
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">Ascending</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Descending
                        </label>
                    </div>
                    <hr>
                </div>
            </div>
            {{-- Filter Section End --}}
        
            {{-- Product Listing Section --}}
            <div class="col-md-10">
                <div class="row">
                    @foreach ($productList as $products)
                        <h4>{{$products['category']}}</h4>
                        @foreach ($products['products'] as $product)
                            <div class="col-md-4 mb-2">
                                <div class="card" style="width: 18rem;">
                                    <img src="{{ asset('images/' . $product->product_image) }}" height="175px"
                                    class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $product->product_name }}</h5>
                                        <p class="card-text">
                                            @if (strlen($product->description) > 70)
                                                {{ substr($product->description, 0, 67) }}...
                                            @else
                                                {{ $product->description }}
                                            @endif
                                        </p>
                                        <span><b>Price </b>Rs. {{ $product->price }} /-</span><br>
                                        <a href="#" class="btn btn-primary">View</a>
                                        <a href="#" class="btn btn-primary">Edit</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                    @endforeach
                </div>
            </div>
            {{-- Product Listing Section End --}}
        </div>
        
    </div>
    
@endsection