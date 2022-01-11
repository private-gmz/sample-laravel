<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Attributes;
use App\Models\AttributesVal;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\ProductVal;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Image;

class ProductController extends Controller
{

    public function AddProduct()
    {
        $categories = Category::latest()->get();
        return view('backend.product.product_add', compact('categories'));

    }

    public function StoreProduct(Request $request)
    {

        $input = $request->all();
        $request->validate([
            'product_thambnail' => 'mimes:jpeg,png,jpg|max:2048',
            'file' => 'mimes:zip,pdf|max:2048',
            'multi_img.*' => 'mimes:jpeg,png,jpg|max:2048',
        ]);

        $digitalItem = '';
        if ($files = $request->file('file')) {
            $destinationPath = 'upload/pdf'; // upload path
            $digitalItem = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $digitalItem);
        }

        $save_url = config('default_product_image');
        if ($files = $request->file('product_thambnail')) {
            $image = $request->file('product_thambnail');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = config('default_product_image_path') . 'thambnail/' . $name_gen;
            Image::make($image)->resize(917, 1000)->save($save_url);
        }

        // insert product
        $product_id = Product::insertGetId([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_code' => $request->product_code,

            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp_en' => $request->short_descp_en,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,

            'product_thambnail' => $save_url,

            'digital_file' => $digitalItem,
            'status' => 1,
            'created_at' => Carbon::now(),

        ]);
        /////// end insert product

        //// insert new values
        foreach ($input['attributes'] as $key => $vals) {
            foreach (explode(',', $vals) as $val) {
                $AttrVal = AttributesVal::firstOrCreate(
                    ['name' => $val],
                    ['attribute_id' => Attributes::where('name', $key)->pluck('id')[0]],

                );

                //// insert product_value

                ProductVal::insert([

                    'product_id' => $product_id,
                    'val_id' => $AttrVal->id,
                    'created_at' => Carbon::now(),

                ]);

                //// end insert product_value
            }
        }
        ///// end insert new values

        ////////// Multiple Image Upload Start ///////////

        if ($images = $request->file('multi_img')) {
            foreach ($images as $img) {
                $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                $uploadPath = config('default_product_image_path') . 'multi-image/' . $make_name;
                Image::make($img)->resize(917, 1000)->save($uploadPath);
                try {
                    MultiImg::insert([

                        'product_id' => $product_id,
                        'photo_name' => $uploadPath,
                        'created_at' => Carbon::now(),

                    ]);

                } catch (\Illuminate\Database\QueryException $exception) {
                    // You can check get the details of the error using `errorInfo`:
                    $errorInfo = $exception->errorInfo;

                    // Return the response to the client..
                }
            }
        }
        ////////// Enn Multiple Image Upload Start ///////////

        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('manage-product')->with($notification);

    } // end method

    public function ManageProduct()
    {

        $products = Product::latest()->get();
        return view('backend.product.product_view', compact('products'));
    }

    public function EditProduct($id)
    {

        $multiImgs = MultiImg::where('product_id', $id)->get() ?? null;

        $categories = Category::latest()->get();
        $subcategory = SubCategory::latest()->get();
        $Pattributes = ProductVal::where('product_id', $id)->get();
        $products = Product::findOrFail($id);
        return view('backend.product.product_edit', compact('categories', 'Pattributes', 'subcategory', 'products', 'multiImgs'));

    }

    public function ProductDataUpdate(Request $request)
    {

        $product_id = $request->id;
        $input = $request->all();
        Product::findOrFail($product_id)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_code' => $request->product_code,

            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp_en' => $request->short_descp_en,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,

        ]);

        //// update other attr
        $values_set = array();
        foreach ($input['attributes'] as $key => $vals) {
            foreach (explode(',', $vals) as $val) {
                $AttrVal = AttributesVal::firstOrCreate(
                    ['name' => $val],
                    ['attribute_id' => Attributes::where('name', $key)->pluck('id')[0]],

                );

                array_push($values_set, $AttrVal->id);
                //// insert new product_value

                ProductVal::firstOrCreate([

                    'product_id' => $product_id,
                    'val_id' => $AttrVal->id,

                ]);

                //// end insert new product_value
            }
        }
        ProductVal::whereNotIn('val_id', $values_set)->delete();
        ///// end update other attr

        $notification = array(
            'message' => 'Product Updated Without Image Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('manage-product')->with($notification);

    } // end method

/// add multiple images
    public function MultiImageAdd(Request $request, $productId)
    {

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $uploadPath = config('default_product_image_path') . 'multi-image/' . $name;
        Image::make($file)->resize(917, 1000)->save($uploadPath);

        $id = MultiImg::insertGetId([

            'product_id' => $productId,
            'photo_name' => $uploadPath,
            'created_at' => Carbon::now(),

        ]);

        return response()->json([
            'name' => $name,
            'id' => $id,
        ]);
    }

    public function MultiImageDestroy(Request $request)
    {
        $filename = $request->get('filename');
        $path = asset(config('default_product_image_path') . 'multi-image/') . $filename;
        $file_path = config('default_product_image_path') . 'multi-image/' . $filename;
        if (file_exists($path)) {
            unlink($path);
            MultiImg::where('photo_name', $file_path)->delete();
        }
        return response()->json(['success' => $path]);
    }

/// Multiple Image Update (alter later_zozo)
    public function MultiImageUpdate(Request $request)
    {

        $imgs = $request->multi_img;

        foreach ($imgs as $id => $img) {
            $imgDel = MultiImg::findOrFail($id);
            unlink($imgDel->photo_name);

            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            $uploadPath = config('default_product_image_path') . 'multi-image/' . $make_name;
            Image::make($img)->resize(917, 1000)->save($uploadPath);

            MultiImg::where('id', $id)->update([
                'photo_name' => $uploadPath,
                'updated_at' => Carbon::now(),

            ]);

        } // end foreach

        $notification = array(
            'message' => 'Product Image Updated Successfully',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);

    } // end mehtod

    /// Product Main Thambnail Update ///
    public function ThambnailImageUpdate(Request $request)
    {
        $pro_id = $request->id;
        $oldImage = $request->old_img;
        if ($oldImage !== config('default_product_image')) {
            unlink($oldImage);
        }

        $image = $request->file('product_thambnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $save_url = config('default_product_image_path') . 'thambnail/' . $name_gen;
        Image::make($image)->resize(917, 1000)->save($save_url);

        Product::findOrFail($pro_id)->update([
            'product_thambnail' => $save_url,
        ]);

        $notification = array(
            'message' => 'Product Image Thambnail Updated Successfully',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);

    } // end method

    //// Multi Image Delete ////
    public function MultiImageDelete($id)
    {
        $oldimg = MultiImg::findOrFail($id);
        unlink($oldimg->photo_name);
        MultiImg::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Product Image Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);

    } // end method

    public function ProductInactive($id)
    {
        Product::findOrFail($id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Product Inactive',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function ProductActive($id)
    {
        Product::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Product Active',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);

    }

    public function ProductDelete($id)
    {
        $product = Product::findOrFail($id);
        if ($product->product_thambnail !== config('default_product_image')) {
            unlink($product->product_thambnail);
        }

        Product::findOrFail($id)->delete();

        $images = MultiImg::where('product_id', $id)->get();
        foreach ($images as $img) {
            unlink($img->photo_name);
            MultiImg::where('product_id', $id)->delete();
        }

        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);

    } // end method

    // product Stock
    public function ProductStock()
    {

        $products = Product::latest()->get();
        return view('backend.product.product_stock', compact('products'));
    }

}
