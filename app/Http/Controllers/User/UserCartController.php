<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Support\Facades\Auth;

class UserCartController extends Controller
{
    // direct cart page
    public function cartList () {
        $cartItems = Cart::select('carts.*','products.name as product_name','products.price as product_price','products.image as product_image',)->where('carts.user_id', Auth::user()->id)->leftJoin('products','carts.product_id','products.id')
        ->get()->all();
        $subTotal = 0;
        foreach($cartItems as $cartItem) {
            $subTotal += $cartItem->product_price * $cartItem->quantity;
        }
        return view('user.cart.cartPage',compact('cartItems','subTotal'));
    }

    // add items data to cart ajax
    public function addToCart (Request $request) {
        $addToCartItemData = [
            'user_id' => $request->userId,
            'product_id' => $request->productId,
            'quantity' => $request->quantity
        ];

        Cart::create($addToCartItemData);

        $response = [
            'status' => 'success'
        ];
        return response()->json($response);
    }

    // update cart item ajax
    public function updateCartItem (Request $request) {
        $updateData = [
            'quantity' => $request->quantity
        ];
        Cart::where('id',$request->id)->update($updateData);
        return response()->json(['status' => 'update success']);
    }

     // delete cart item ajax
     public function deleteCartItem (Request $request) {
        Cart::where('id',$request->id)->delete();
        return response()->json(['status' => 'delete success']);
    }

    // retrieve cart data
    public function retrieveCartData (Request $request) {
        $cartItems = Cart::select('carts.*','products.name as product_name','products.price as product_price','products.image as product_image',)->where('carts.user_id', $request->userId)->leftJoin('products','carts.product_id','products.id')
        ->get()->all();
        $subTotal = 0;
        foreach($cartItems as $cartItem) {
            $subTotal += $cartItem->product_price * $cartItem->quantity;
        }
        $response = [
            'cartItems' => $cartItems,
            'total' => $subTotal
        ];
        return response()->json($response);
    }

    // order items via ajax
    public function orderItems (Request $request) {
        $subtotal = 0;
        foreach($request->all() as $item) {
            $itemList = OrderList::create([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'total_price' => $item['total_price'],
                'order_code' => $item['order_code']
            ]);

            $subtotal += $itemList->total_price;
        }
        Cart::where('user_id',Auth::user()->id)->delete();

        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $itemList->order_code,
            'total_price' => $subtotal
        ]);

        return response()->json([
            'status' => true
        ]);
    }
}
