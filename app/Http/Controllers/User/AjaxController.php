<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //return pizza list.............................................
    public function pizzaList(Request $request){
        // logger($request->status);
        if($request->status == 'desc'){
            $data = Product::orderBy('created_at','desc')->get();
        }else{
            $data = Product::orderBy('created_at','asc')->get();
        }
        return $data;
    }

    // return pizza list.................................................
    public function addToCart(Request $req){
    //    logger($req->all());
        $data = $this->getOrderData($req);
        Cart::create($data);
        $response = [
            'message' => 'Add To Cart Complete',
            'status' => 'success'
        ];
    //http status codes -> 200
        return response()->json($response,200);
    }

    // OrderList............................................................
    public function orderList(Request $req){
        $total = 0;
        // logger($req->all());
        foreach($req->all() as $item){

          $data =  OrderList::create ([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'total' => $item['total'],
                'order_code' => $item['order_code'],
            ]);//User side

            $total += $data->total;
        }

        Cart::where('user_id',Auth::user()->id)->delete();

        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $data->order_code,
            'total_price' => $total+3000
        ]);//Admin ka u

        return response()->json([
            'status' => 'true',
            'message' => 'order complete'
        ],200);
    }

    // Clear cart
    public function clearCart(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }
    // CancleBtn
    public function cancle(Request $req){
        Cart::where('user_id',Auth::user()->id)
              ->where('product_id',$req->productId)
              ->where('id',$req->orderId)
              ->delete();
    }

    // increaseViewCount
    public function increaseViewCount(Request $req){
        // logger($req->all());
        $product = Product::where('id',$req->productId)->first();

        $viewCount = [
            'view_count' => $product->view_count + 1
        ];

        Product::where('id',$req->productId)->update($viewCount);
    }

    // get order data.........................................................
    private function getOrderData($req){
        //Db name | req->name
        return [
            'user_id' => $req->userId,
            'product_id' => $req->pizzaId,
            'qty' => $req->count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
