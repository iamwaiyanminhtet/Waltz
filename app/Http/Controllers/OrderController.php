<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Mail\orderSendMailable;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    // order list
    public function orderList () {
        $orders = Order::select('orders.*','users.name as user_name','users.image as user_image','users.gender as user_gender')
        ->when(request('searchOrderList'),function ($query){
            $query->orWhere('users.name', 'like', '%' . request('searchOrderList') . '%');
            $query->orWhere('orders.user_id', 'like', '%' . request('searchOrderList') . '%');
            $query->orWhere('orders.order_code', 'like', '%' . request('searchOrderList') . '%');
            $query->orWhere('orders.total_price', 'like', '%' . request('searchOrderList') . '%');
            $query->orWhere('orders.status', 'like', '%' . request('searchOrderList') . '%');
        })->leftJoin('users','orders.user_id','users.id')->paginate(5);
        $orders->append(request()->all());
        return view('admin.order.orderList',compact('orders'));
    }

    // view particular order
    public function particularOrder ($userId,$orderCode) {
        $data = $this->getSpecificOrderData($userId,$orderCode);
        $orderItems = $data['orderItems'];
        $user = $data['user'];
        $order_code = $data['order_code'];
        return view('admin.order.particularOrder',compact('orderItems','user','order_code'));
    }

    // change status
    public function changeStatus ($orderId,$state) {
        // order accept
        if ($state === 'accept') {
            $data = [
                'status' => 1
            ];
            Order::where('id',$orderId)->update($data);
            return redirect()->route('admin#order#orderList')->with(['changeStatusSuccess' => "You've accepted the order!"]);
        }
        // order decline
        if ($state === 'decline') {
            $data = [
                'status' => 2
            ];
            Order::where('id',$orderId)->update($data);
            return redirect()->route('admin#order#orderList')->with(['changeStatusDecline' => "You've declined the order!"]);
        }
    }

    // view order as a web page to download as a pdf
    public function viewOrder ($userId,$orderCode) {
        $data = $this->getSpecificOrderData($userId,$orderCode);
        $orderItems = $data['orderItems'];
        $user = $data['user'];
        $order_code = $data['order_code'];
        return view('admin.order.vieworder',compact('orderItems','user','order_code'));
    }

    // download order page
    public function download ($userId,$orderCode) {
        $returnedData = $this->getSpecificOrderData($userId,$orderCode);
        $data = [
            'orderItems' => $returnedData['orderItems'],
            'user' => $returnedData['user'],
            'order_code' => $returnedData['order_code'],
        ];
        $pdf = Pdf::loadView('admin.order.vieworder', $data);
        return $pdf->download('CustomerName : '.$returnedData['user']->name. ', ' . 'OrderCode : '.$orderCode.'.pdf');
        // note : maximum time too long error
        // you should not include external css file within your html file, in here, blade file ofc as it slows down the loading time
        // although they say using img tag with public_path(), the maximum loading time is still too long
        // note updated :
        // I got it finally using this :
        // <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('/storage/admin/product/'.$orderItem->product_image))) }}" width="75px">
    }

    // send mail to user
    public function sendmail ($userId,$orderCode) {
        $orderItems = OrderList::select('order_lists.*','products.name as product_name','products.image as product_image','products.price as product_price')->where('order_code',$orderCode)
        ->leftJoin('products','order_lists.product_id','products.id')
        ->get();
        $user = User::where('id',$userId)->first();
        try {
            Mail::to($user->email)->send(new orderSendMailable($orderItems));
            return redirect()->route('admin#order#orderList')->with('mailsent','Order Mail has been sent to '.$user->email);
        }catch(Exception $e) {
            return redirect()->route('admin#order#orderList')->with('cantSent','Something was wrong during the process');
        }
    }

    // get the data of specific order
    private function getSpecificOrderData ($userId,$orderCode) {
        $orderItems = OrderList::select('order_lists.*','products.name as product_name','products.image as product_image','products.price as product_price')->where('order_code',$orderCode)
        ->leftJoin('products','order_lists.product_id','products.id')
        ->get();
        $user = User::where('id',$userId)->first();
        $order_code = $orderCode;
        $data = [
            'orderItems' => $orderItems,
            'user' => $user,
            'order_code' => $order_code
        ];
        return $data;
    }
}
