@extends('layouts/master_layout')
@section('content')
    <div class="container col-md-5 my-2">
        <h1>Add New Product</h1>
        <form method="POST" id="addNewProduct" action="{{route('add_new_product')}}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Product category</label>
                <select class="form-select" name="cat_name" id = "cat_name" aria-label="Default select example">
                    <option selected value="">Select Category</option>
                    @foreach($catList as $cat)
                        <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                    @endforeach
                  </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Product description</label>
                <textarea name="description" id="description" cols="70" rows="5"></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Product price</label>
                <input type="number" class="form-control" id="price" name="price">
            </div>
            
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Product Image</label>
                <input type="file" class="form-control" name="product_image" id="product_image">
            </div>

            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection