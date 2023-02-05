<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\Productresource;
use App\Models\CompanyProduct;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function listProducts(){
        $products = Productresource::collection(Product::latest()
        ->paginate(10));
        return response([
            $products,
            'message'    => 'list the product !',
                ], 200);
    }

    public function showProduct($id){
        $showProduct = Product::find($id);
        if (!$showProduct) {
            return response([
                'message'    => 'prouct does not existing  !',
                    ], 400);
        }else{
            return response([
                new Productresource($showProduct),
                'message'    => 'show the product !',
                    ], 200);
        }

    }

    public function storeProduct(Request $request){

        $product = Product::create([
            'name'          => $request['name'],
            'devise_id'     => $request['devise_id'],
            'stock_initial' => $request['stock_initial'],
            'available'     => $request['available'],
        ]);

        $companyArray    = explode("," ,$request->companies);
        $priceArray      = explode("," ,$request->price);
        $index =0 ;

        foreach ($companyArray as $companySingle){
            $productArray                  = new CompanyProduct();
            $productArray->product_id = $product->id;
            $productArray->company_id = $companySingle;
            $productArray->price      = $priceArray[$index];
            $productArray->save();
            $index++;
        }


        return response([
            $product,
            'message'    => 'create a new product !',
            ], 200);

    }

    public function bestSelling(Request $request){

        $orderBay = $request->get('filter_type') == 'DESC' ? 'DESC' : 'ASC';

        $products = OrderProduct::select(
            [DB::raw('count(product_id) as productCount'),
             DB::raw('(product_id) as product'),
            ])
                ->orderBy('productCount', $orderBay)
                ->groupBy('product_id')
                ->get();
        return response([
            $products,
            'message'    => 'best Selling of product !',
            ], 200);

    }
}
