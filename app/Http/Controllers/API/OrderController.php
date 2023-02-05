<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Order\OrderResource;
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

        $userId  = Auth::user()->id;
        $userEmail  = Auth::user()->email;
        $company  = Auth::user()->company_id;

                $product      = new Order();
                $product->name            = $this->rand_string(10);
                $product->full_name       = $request->full_name;
                $product->company_id      = $company;
                $product->user_id         = $userId ;
                $product->payment_type_id = $request->payment_type_id;
                $product->total         = $request->total;
                $product->reste         = $request->reste;
                $product->address       = $request->address;
                $product->city          = $request->city;
                $product->country       = $request->country;
                $product->status        = $request->status;
                $product->save();

                // array products of order

                $productArray = explode("," ,$request->products);
                $product->products()->attach($productArray);

                $product = new OrderResource($product);

                Notification::route('mail', $userEmail)->notify(new CreateOrderNotification($product));

                return response([
                    new OrderResource($product) ,
                    'message'    => 'Créez un nouveau code promotion !',
                ], 200);

     }

}
