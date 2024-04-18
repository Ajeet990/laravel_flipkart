<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\category;
use App\Models\product;
use App\Models\Cart;


class UserController extends Controller
{
    private $productObj;
    public function __construct()
    {
        $this->productObj = new product();
    }
    public function getCurrentUserId()
    {
        return Auth::user()->id;
    }

    public function profile()
    {
        $user_id = $this->getCurrentUserId();
        // $productList = $this->productObj->getUserAllProducts($user_id);
        // $productList = product::where('user_id', $user_id)->get();
        // $productsByCategory = Product::join('categories', 'products.cat_id', '=', 'categories.id')
        // ->select('categories.category_name', DB::raw('MAX(products.id) as id'), DB::raw('MAX(products.user_id)'), DB::raw('MAX(products.product_name)'), DB::raw('MAX(products.cat_id)'), DB::raw('MAX(products.description)'), DB::raw('MAX(products.product_image)'), DB::raw('MAX(products.price)'))
        // ->groupBy('products.cat_id')
        // ->where('products.user_id', $user_id)
        // ->get();
        // dd($productsByCategory);
        $allCategory = category::all();
        // dd($allCategory);
        $productList = [];

        foreach($allCategory as $category) {
            $data = [];
            $product = product::where('user_id', $user_id)->where('cat_id', $category['id'])->get();
            $data['category'] = $category['category_name'];
            $data['products'] = $product;
            $productList[] = $data;
        }
        return view('profile/profile', ['productList'=>$productList]);
    }

    public function newProduct()
    {
        $catList = $this->getAllCategory();
        return view('profile/add_new_product',['catList'=>$catList]);
    }
    public function getAllCategory()
    {
        $cat = new Category();
        $catList = $cat->all();
        // dd($catList);
        return $catList;
    }
    public function addNewProduct(Request $request)
    {
        $productObj = new Product();
        $productObj->user_id = $this->getCurrentUserId();
        $productObj->product_name = trim($request->name);
        $productObj->cat_id = $request->cat_name;
        $productObj->description = trim($request->description);
        $productObj->price = trim($request->price);
        if ($request->file('product_image') != "") {
            $imagePath = $request->file('product_image')->store('products', 'public');
            $productObj->product_image = $imagePath;
            $productObj->save();
            $insert_id = $productObj->id;
            if ($insert_id > 0) {
                return redirect('/profile')->with('message', "Product added successfully")->with('color', 'success');
            }
        }
        return redirect('/profile')->with('message', "Something went wrong.")->with('color', 'danger');
    }

    public function becomeASeller()
    {

    }

    public function myCart()
    {
        $userId = $this->getCurrentUserId();
        $cartItems = Cart::where('user_id', $userId)->get();
        $itemDetails = [];
        foreach ($cartItems as $item){
            $data['id'] = $item['id'];
            $data['quantity'] = $item['quantity'];
            $data['product'] = product::select('id', 'product_name', 'description', 'product_image', 'price')->where('id', $item['product_id'])->first();
            $itemDetails[] = $data;
        }
        // dd($itemDetails);
        return view('inc/myCart', ['cartItems' => $itemDetails]);
    }
}
