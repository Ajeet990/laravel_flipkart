@extends('layouts/master_layout')
@section('content')
    <div class="container">
        <h3>My Items</h3>
        <div class="row">
            <div class="col-md-8 border me-1">
                <!-- Content for the left side -->
                <h5>Cart Items</h5>
                <input type="hidden" value="{{csrf_token()}}" id="csrf_token_1">
                <div class="row" id="cart_items">
                    @foreach ($cartItems as $item)
                        <div class="col-md-6 mb-3">
                            <div class="card" style="width: 18rem;">
                                <img src="{{ 'images/' . $item['product']['product_image'] }}" class="card-img-top" height="175px" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item['product']['product_name'] }}</h5>
                                    {{-- <p class="card-text">{{ $item['product']['description'] }}</p> --}}
                                    <p class="card-text">
                                        @if (strlen($item['product']['description']) > 70)
                                            {{ substr($item['product']['description'], 0, 67) }}...
                                        @else
                                            {{ $item['product']['description'] }}
                                        @endif
                                    </p>
                                    <h6>Quantity : {{ $item['quantity'] }}</h6>
                                    <h6>Price : Rs. {{ $item['product']['price'] }}</h6>
                                </div>
                                <a href="#" data-url="{{route('remove_from_cart')}}" data-cart_id="{{$item['id']}}" class="btn btn-primary mx-1 mb-1 removeFromCart">Remove</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-3 ms-4">
                <!-- Content for the right side -->
                <div class="border mx-1 my-1">
                    <h5>Payment Options</h4>
                    <div class="mx-1 my-1">
                        <div class="form-check">
                            <input class="form-check-input payment_method" name="payment_method" type="radio" id="upi" checked>
                            <label class="form-check-label" for="flexRadioDefault1">
                                UPI
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input payment_method" name="payment_method" type="radio" id="c_d_card">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Credit/Debit Card
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input payment_method" name="payment_method" type="radio"  id="cod">
                            <label class="form-check-label" for="flexRadioDefault2">
                                COD
                            </label>
                        </div>
                    </div>
                    <hr>
                    <div class="mx-1 my-3">
                        <div class="upi_payment" id="upi_payment">
                            <h6>UPI payment</h6>
                            <input type="text" class="form-control" placeholder="UPI address">
                        </div>
                        <div class="upi_payment" id="card_payment" style="display:none">
                            <h6>Credit/Debit payment</h6>
                            <div>
                                <label for="exampleInputEmail1" class="form-label">Card No.</label>
                                <input type="text" class="form-control" placeholder="Card no.">
                                <label for="exampleInputEmail1" class="form-label">Expiry Date</label>
                                <input type="text" class="form-control" placeholder="Expiry date">
                                <label for="exampleInputEmail1" class="form-label">CVV</label>
                                <input type="text" class="form-control" placeholder="CVV">
                            </div>
                            {{-- <input type="text" class="form-control" id="upi_payment"> --}}
                        </div>
                        <hr>
                        <a href="#" class="btn btn-primary btn-sm my-1">CheckOut</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
