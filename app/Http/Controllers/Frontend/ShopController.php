<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Attributes; 
use App\Models\AttributesVal; 
use App\Models\Product;
use App\Models\ProductVal;


class ShopController extends Controller
{
    public function ShopPage(){

        $products = Product::query();

        if (!empty($_GET['category'])) {
            $slugs = explode(',',$_GET['category']);            
            $catIds = Category::select('id')->whereIn('category_slug_en',$slugs)->pluck('id')->toArray();
            if (!empty($_GET['attributes'])){
                $attributes = explode(',',$_GET['attributes']);
                $products = $products->select('products.*')->groupby('products.id')->whereIn('category_id',$catIds)->whereBetween('selling_price', array($_GET['min'], $_GET['max']))
                ->join('product_vals', 'product_vals.product_id', '=', 'products.id')->whereIn('product_vals.val_id',$attributes )->paginate(3);
            }
            else $products = $products->whereIn('category_id',$catIds)->whereBetween('selling_price', array($_GET['min'], $_GET['max']))->paginate(3);
        }
        elseif(!empty($_GET['min'])){
            if (!empty($_GET['attributes'])){
                $attributes = explode(',',$_GET['attributes']);
                $products = $products->select('products.*')->groupby('products.id')->whereBetween('selling_price', array($_GET['min'], $_GET['max']))
            ->join('product_vals', 'product_vals.product_id', '=', 'products.id')->whereIn('product_vals.val_id',$attributes)->paginate(3);
            }
            else $products = $products->whereBetween('selling_price', array($_GET['min'], $_GET['max']))->paginate(3);
        }
        else{
             $products = Product::where('status',1)->orderBy('id','DESC')->paginate(3);
        }

        $categories = Category::orderBy('category_name_en','ASC')->get();
        $attributes = Attributes::with('values')->get();
        return view('frontend.shop.shop_page',compact('products','categories','attributes'));

    } // end Method 



    public function ShopFilter(Request $request){
        // dd($request->all());

        $data = $request->all();

        // Filter Category

        $catUrl = "";
            if (!empty($data['category'])) {
               foreach ($data['category'] as $category) {
                  if (empty($catUrl)) {
                     $catUrl .= '&category='.$category;
                  }else{
                    $catUrl .= ','.$category;
                  }
               } // end foreach condition
            } // end if condition 


 // Filter price 

        $priceUrl = "";
            if (!empty($data['price'])) {
                $split=explode(",",$data['price']);
                $priceUrl = '&min='.$split[0].'&max='.$split[1];
            } // end if condition 


// Filter all attributes
        $attributesURL = "";

        if (!empty($data['attributes'])) {
            $attributesURL = '&attributes='.implode(',',$data['attributes']);
                }


            return redirect()->route('shop.page',$catUrl.$priceUrl.$attributesURL);

    } // end Method 




}
 