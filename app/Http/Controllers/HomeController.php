<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Foundation\Auth;
use App\Models\category;
use App\Models\product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function home()
    {
        $allCategory = category::all();
        $productList = [];
        // dd('hi');

        foreach($allCategory as $category) {
            $data = [];
            $product = product::where('cat_id', $category['id'])->get();
            $data['category'] = $category['category_name'];
            $data['products'] = $product;
            $productList[] = $data;
        }
        // dd($productList);
        return view('inc/welcome', ['productList' => $productList]);
    }

    public function showProductFullDetail(int $productId)
    {
        $productDetails = product::join('users as u', 'u.id', '=', 'products.user_id')
            ->join('categories as c', 'c.id', '=', 'products.cat_id')
            ->where('products.id', $productId)
            ->select('u.name as owner_name', 'c.category_name', 'products.id', 'products.product_name', 'products.description', 'products.price', 'products.product_image', 'products.created_at', 'products.updated_at')
            ->first();
            // dd($productDetails);
        // $productDetails = product::find($productId);
        $productDetails['isUserLoggedIn'] = Auth::check();
        // dd($productDetails);
        return view('inc/viewProductDetails', ['productDetails' => $productDetails]);
    }

    public function flipkartHome()
    {
        if (\Auth::check()) {
            // User is authenticated
            $user = auth()->user();
            dd($user->name);
        }
    }

    public function addToCart(Request $request)
    {
        $result = [
            "status" => false,
            "message" => "Something went wrong."
        ];
        $currentUserId = Auth::user()->id;
        $productId = $request->product_id;
        $cartItem = Cart::select('id', 'quantity')->where('user_id', $currentUserId)->where('product_id', $productId)->first();
        $dataUpdated = false;
        if ($cartItem) {
            $cartItem->quantity = $cartItem->quantity + 1;
            $cartItem->save();
            $dataUpdated = true;
        } else {
            $cartObj = new Cart();
            $cartObj->user_id = $currentUserId;
            $cartObj->product_id = $productId;
            $cartObj->quantity = $request->quantity;
            $cartObj->save();
            $lastInsertedId = $cartObj->id;
            if ($lastInsertedId > 0) {
                $dataUpdated = true;
            }
            // echo $lastInsertedId;
        }
        if ($dataUpdated) {
            $result = [
                "status" => true,
                "message" => "Product added to cart."
            ];
        }
        // echo json_encode($result);
        // die();
        return response()->json($result, 200);
        //increment quantity if already exists
    }

    private function makeCartItemsString($cartItems)
    {
        $html = '';
        foreach ($cartItems as $item) {
            $html .= '<div class="col-md-6 mb-3">
                <div class="card" style="width: 18rem;">
                    <img src="images/' . $item['product']['product_image'] . '" class="card-img-top" height="175px" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">' . $item['product']['product_name'] . '</h5>
                        <p class="card-text">' . (strlen($item['product']['description']) > 70 ? substr($item['product']['description'], 0, 67) . '...' : $item['product']['description']) . '</p>
                        <h6>Quantity : ' . $item['quantity'] . '</h6>
                        <h6>Price : Rs. ' . $item['product']['price'] . '</h6>
                    </div>
                    <a href="#" data-url="' . route('remove_from_cart') . '" data-cart_id="' . $item['id'] . '" class="btn btn-primary mx-1 mb-1 removeFromCart">Remove</a>
                </div>
            </div>';
        }
        return $html;
    }


    public function remove_from_cart()
    {
        // dd("yes here");
        $result = [
            'status' => 0,
            'message' => 'Unable to remove from cart',
            'cartItems' => []
        ];
        $cart_id = isset($_POST['cartId']) ? $_POST['cartId'] : '';
        $currentUserId = Auth::user()->id;
        // $cartObj = Cart::findOrFail(['product_id' => $product_id]);
        // $item = Cart::where('id', $product_id)->where('user_id', $currentUserId);
        $item = Cart::find($cart_id);
        // dd($item);
        if ($item->delete()) {
            // $cartItem = Cart::select()->where('user_id', $currentUserId)->get();
            $cartItems = Cart::where('user_id', $currentUserId)->get();
            $itemDetails = [];
            foreach ($cartItems as $item){
                $data['id'] = $item['id'];
                $data['quantity'] = $item['quantity'];
                $data['product'] = product::select('id', 'product_name', 'description', 'product_image', 'price')->where('id', $item['product_id'])->first();
                $itemDetails[] = $data;
            }
            $result = [
                'status' => 1,
                'message' => 'Product removed form cart',
                'cartItemString' => $this->makeCartItemsString($itemDetails)
            ];
        }
        return response()->json($result, 200);
        // dd($cartObj);

    }
}
