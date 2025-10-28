<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // List
    public function list()
    {
        $order = Order::select('orders.*', 'users.name as user_name', 'users.email as contact_mail')
            ->leftJoin('users', 'orders.user_id', 'users.id')
            ->orderBy('created_at','desc')
            ->get();
        // dd($order->toArray());
        return view('admin.order.list', compact('order'));
    }
    //  Search Accept or reject or pending
    public function searchStatus(Request $request)
    {
        // dd($request->all());
        $order = Order::select('orders.*', 'users.name as user_name', 'users.email as contact_mail')
                        ->leftJoin('users', 'orders.user_id', 'users.id')
                        ->orderBy('created_at','desc');

        if ($request->orderStatus == null) {
            $order = $order->get();
        } else {
            $order =$order->where('orders.status', $request->orderStatus)->get();
        }
        return view('admin.order.list', compact('order'));
    }
    // Change Status
    public function changeStatus(Request $request)
    {
        // logger($request->all());
        Order::where('id', $request->orderId)->update([
            'status' => $request->status
        ]);
    }

    // Code View
    public function codeView($code){
        $order = Order::where('order_code',$code)->first();

        $list = OrderList::select('order_lists.*','users.name as user_name','users.email as user_email',
                'products.name as product_name','products.image as product_image')
                ->leftJoin('products','order_lists.product_id','products.id')
                ->leftJoin('users', 'users.id', 'order_lists.user_id')
                ->where('order_lists.order_code', $code)
                ->get();
        return view('admin.code.codeView', compact('list','order'));
    }
}
