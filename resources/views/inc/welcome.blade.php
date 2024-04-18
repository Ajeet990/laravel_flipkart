@extends('layouts/master_layout')
@section('content')
    
<div class="mb-1">
    <div>
        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item" data-bs-interval="10000">
                <img src="{{asset('images/banner/banner.jpg')}}" height="400px" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item" data-bs-interval="10000">
                <img src="{{asset('images/banner/banner2.jpg')}}" height="400px" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item" data-bs-interval="2000">
                <img src="{{asset('images/banner/banner3.jpg')}}" height="400px" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item active">
                <img src="{{asset('images/banner/banner4.jpg')}}" height="400px" class="d-block w-100" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
    </div>
</div>

<div class="container">
  @foreach ($productList as $product)
    <h4>{{ $product['category'] }}</h4>
    <div class="row">
      @foreach ($product['products'] as $pro) 
        <div class="col-md-3">
          <a href="{{ route('product.show', $pro->id) }}" class="card-link" style="text-decoration: none;">
            <div class="card mb-3">
              <img src="{{ asset('images/' . $pro->product_image) }}" height="175px" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">{{ $pro->product_name }}</h5>
                <p class="card-text">
                  @if (strlen($pro->description) > 70)
                    {{ substr($pro->description, 0, 67) }}...
                  @else
                    {{ $pro->description }}
                  @endif
                </p>
                <p><b>Price:</b> Rs. {{ $pro->price }} /-</p>
              </div>
            </div>
          </a>
        </div>
      @endforeach
    </div>
  @endforeach
</div>


@endsection