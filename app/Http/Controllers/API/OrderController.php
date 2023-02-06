<?php

namespace App\Http\Controllers\API;

use App\Events\orderCreate;
use App\Http\Controllers\Controller;
use App\Http\Resources\Order\OrderResource;
use App\Models\Company;
use App\Models\Order;
use App\Notifications\CreateOrderNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function listOrders(){

        $company  = Auth::user()->company_id;
        $date = Carbon::today()->subDays(5);
        $products = OrderResource::collection(Order::latest()
                    ->where('company_id', $company)
                    ->where('created_at','>', $date)
                    ->orderBy('created_at')
                    ->get());
        return response([
            $products,
            'message'    => 'list the product !',
                ], 200);
    }

    public function showOrder($id){
        $showOrder = Order::find($id);
        if (!$showOrder) {
            return response([
                'message'    => 'order does not existing  !',
                    ], 400);
        }else{
            return response([
                new OrderResource($showOrder),
                'message'    => 'show the order !',
                    ], 200);
        }

    }

    function rand_string($length) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars),0,$length);
    }

     public function storeOrder(Request $request){

        $userId     = Auth::user()->id;
        $userEmail  = Auth::user()->email;
        $company    = Auth::user()->company_id;
       // $adminEmail = Auth::user()->company_id;
       $adminEmail = Company::find($company);

                $order      = new Order();
                $order->name            = $this->rand_string(10);
                $order->full_name       = $request->full_name;
                $order->company_id      = $company;
                $order->user_id         = $userId ;
                $order->payment_type_id = $request->payment_type_id;
                $order->total         = $request->total;
                $order->reste         = $request->reste;
                $order->address       = $request->address;
                $order->city          = $request->city;
                $order->country       = $request->country;
                $order->status        = $request->status;
                $order->save();

                // array products of order

                $productArray = explode("," ,$request->products);
                $order->products()->attach($productArray);

                $order = new OrderResource($order);

                Notification::route('mail', [$userEmail, $adminEmail->email])
                              ->notify(new CreateOrderNotification($order));

                event(new orderCreate($order));
                return response([
                    new OrderResource($order) ,
                    'message'    => 'Créez un nouveau order !',
                ], 200);

     }

}
