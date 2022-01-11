<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Attributes;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\ProductVal;
use App\Models\Slider;
use App\Models\SubCategory;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    protected $attributes;

    public function __construct()
    {
        $this->attributes = Attributes::with('values')->get();
    }

    public function index()
    {
        $products = Product::where('status', 1)->orderBy('id', 'DESC')->limit(6)->get();
        $sliders = Slider::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $categories = Category::orderBy('category_name_en', 'ASC')->get();

        $featured = Product::where('featured', 1)->orderBy('id', 'DESC')->limit(6)->get();
        $hot_deals = Product::where('hot_deals', 1)->where('discount_price', '!=', null)->orderBy('id', 'DESC')->limit(3)->get();

        return view('frontend.index', compact('categories', 'sliders', 'products', 'featured', 'hot_deals'));

    }

    public function UserLogout()
    {
        Auth::logout();
        return Redirect()->route('login');
    }

    public function UserProfile()
    {
        return view('frontend.profile.user_profile');
    }

    public function UserProfileStore(Request $request)
    {
        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if ($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            $old_img = (!$data->profile_photo_path) ? config('default_user_image') : config('default_user_image_path') . $data->profile_photo_path ?? config('default_user_image');
            if ($old_img !== config('default_user_image')) {
                unlink($old_img);
            }

            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(config('default_user_image_path'), $filename);
            $data['profile_photo_path'] = $filename;
        }
        $data->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('dashboard')->with($notification);

    } // end method

    public function UserChangePassword()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.change_password', compact('user'));
    }

    public function UserPasswordUpdate(Request $request)
    {

        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('user.logout');
        } else {
            return redirect()->back();
        }

    } // end method

    public function ProductDetails($id, $slug)
    {
        $product = Product::findOrFail($id);

        $attributes = ProductVal::where('product_id', $id)->get();

        $multiImag = MultiImg::where('product_id', $id)->get();

        $cat_id = $product->category_id;
        $relatedProduct = Product::where('category_id', $cat_id)->where('id', '!=', $id)->orderBy('id', 'DESC')->get();
        return view('frontend.product.product_details', compact('product', 'multiImag', 'attributes', 'relatedProduct'));

    }

    public function TagWiseProduct($tag)
    {
        $products = Product::where('status', 1)->whereRaw("find_in_set('" . $tag . "',product_tags_en)")->orderBy('id', 'DESC')->paginate(3);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        return view('frontend.tags.tags_view', compact('products', 'categories'))->with('attributes', $this->attributes);

    }

    // Subcategory wise data
    public function SubCatWiseProduct(Request $request, $subcat_id, $slug)
    {
        $products = Product::where('status', 1)->where('subcategory_id', $subcat_id)->orderBy('id', 'DESC')->paginate(3);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $breadsubcat = SubCategory::with(['category'])->where('id', $subcat_id)->get();

        ///  Load More Product with Ajax
        if ($request->ajax()) {
            $grid_view = view('frontend.product.grid_view_product', compact('products'))->with('attributes', $this->attributes)->render();

            $list_view = view('frontend.product.list_view_product', compact('products'))->with('attributes', $this->attributes)->render();
            return response()->json(['grid_view' => $grid_view, 'list_view', $list_view]);

        }
        ///  End Load More Product with Ajax

        return view('frontend.product.subcategory_view', compact('products', 'categories', 'breadsubcat'))->with('attributes', $this->attributes);

    }

    // category wise data
    public function CatWiseProduct(Request $request, $cat_id)
    {
        $products = Product::where('status', 1)->where('category_id', $cat_id)->orderBy('id', 'DESC')->paginate(3);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();

        ///  Load More Product with Ajax
        if ($request->ajax()) {
            $grid_view = view('frontend.product.grid_view_product', compact('products'))->with('attributes', $this->attributes)->render();

            $list_view = view('frontend.product.list_view_product', compact('products'))->with('attributes', $this->attributes)->render();
            return response()->json(['grid_view' => $grid_view, 'list_view', $list_view]);

        }
        ///  End Load More Product with Ajax

        return view('frontend.product.category_view', compact('products', 'categories'))->with('attributes', $this->attributes);

    }

    /// Product View With Ajax
    public function ProductViewAjax($id)
    {
        $product = Product::with('category')->with('values')->findOrFail($id);
        $attributes = array();
        $Pvalues = array();
        $values = ProductVal::where('product_id', $id)->with('val')->get();
        foreach ($values as $value) {
            array_push($attributes, $value->val->attribute->name);
            array_push($Pvalues, [$value->val->attribute->name => $value->val->name]);

        }
        $attributes = array_unique($attributes);

        return response()->json(array(
            'product' => $product,
            'attributes' => $attributes,
            'values' => $Pvalues,

        ));

    } // end method

    // Product Seach
    public function ProductSearch(Request $request)
    {

        $request->validate(["search" => "required"]);

        $item = $request->search;
        // echo "$item";
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $products = Product::where('product_name_en', 'LIKE', "%$item%")->get();
        return view('frontend.product.search', compact('products', 'categories'))->with('attributes', $this->attributes);

    } // end method

    ///// Advance Search Options

    public function SearchProduct(Request $request)
    {

        $request->validate(["search" => "required"]);

        $item = $request->search;

        $products = Product::where('product_name_en', 'LIKE', "%$item%")->select('product_name_en', 'product_thambnail', 'selling_price', 'id', 'product_slug_en')->limit(5)->get();
        return view('frontend.product.search_product', compact('products'));

    } // end method

}
