<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use App\Product;
use App\Category;
use App\ProductAttribute;
use App\Coupon;
use App\User;
use App\Country;
use App\DeliveryAddress;
use App\Order;
use App\OrdersProduct;
use Auth;
Use Image;
use Carbon\Carbon;

class ProductController extends Controller
{
  public function add(Request $request)
  {


     if ($request->isMethod('post')) {
       $data = $request->all();
  //echo "<pre>"; print_r($data); die;
       if (empty($data['category_id'])) {
        return redirect()->back()->with('flash_message_error',' Under Category is missing');
      }

       $product = new Product;
       $product->category_id =$data['category_id'];
       $product->product_name =$data['product_name'];
       $product->product_code =$data['product_code'];
       $product->product_color =$data['product_color'];

       if (!empty($data['description'])) {
        $product->description =$data['description'];
      }else {
        $product->description ='';
      }

      if (!empty($data['care'])) {
       $product->care =$data['care'];
     }else {
       $product->care ='';
     }

     if (empty($data['status'])) {
      $status ='0';
    }else {
      $status ='1';
    }

    if (empty($data['feature_item'])) {
     $feature_item ='0';
   }else {
     $feature_item ='1';
   }

       $product->price =$data['price'];

       //upload Image
        if ($request->hasFile('image')) {
        $image_tmp = $request->file('image');
        if ($image_tmp->isValid()) {
        $extension = $image_tmp->getClientOriginalExtension();
        $filename=rand(111,99999).'.'.$extension;
        $large_image_path = 'images/backend_images/products/large/'.$filename;
        $medium_image_path = 'images/backend_images/products/medium/'.$filename;
        $small_image_path = 'images/backend_images/products/small/'.$filename;

        Image::make($image_tmp)->resize(600,600)->save($large_image_path);
        Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
        Image::make($image_tmp)->resize(20,20)->save($small_image_path);
           $product->image =$filename;
        }
        }
        $product->feature_item = $feature_item;
        $product->status = $status;
       $product->save();
       return redirect()->route('admin.product.view')->with('flash_message_success',' Product add Successfully');
         //return redirect()->back()->with('flash_message_success',' Product add Successfully');
}
  $categories = Category::where(['parent_id' =>0])->get();
  $categories_dropdown = "<option value='' selected disabled>Select</option>";
  foreach($categories  as $cat){
    $categories_dropdown .="<option value='".$cat->id." '>".$cat->name."</option>";
    $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
    foreach($sub_categories as $sub_cat){
      $categories_dropdown .="<option value='".$sub_cat->id." '>&nbsp;--&nbsp;".$sub_cat->name."</option>";

    }
  }


      return view('admin.products.add_product',compact('categories_dropdown'))->with('flash_message_success',' Product Add Successfully');

  }
  public function edit(Request $request,$id=null)
  {

    if ($request->isMethod('post')) {
      $data = $request->all();
      // echo "<pre>"; print_r($data); die;
      if (empty($data['status'])) {
       $status ='0';
     }else {
       $status ='1';
     }

     if (empty($data['feature_item'])) {
      $feature_item ='0';
    }else {
      $feature_item ='1';
    }

      if ($request->hasFile('image')) {
      $image_tmp = $request->file('image');
      if ($image_tmp->isValid()) {
      $extension = $image_tmp->getClientOriginalExtension();
      $filename=rand(111,99999).'.'.$extension;
      $large_image_path = 'images/backend_images/products/large/'.$filename;
      $medium_image_path = 'images/backend_images/products/medium/'.$filename;
      $small_image_path = 'images/backend_images/products/small/'.$filename;

      Image::make($image_tmp)->save($large_image_path);
      Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
      Image::make($image_tmp)->resize(20,20)->save($small_image_path);
}
    }else if(!empty($data['current_image'])) {
        $filename = $data['current_image'];
    }else{
      $filename ='';
    }

    if (empty($data['description'])) {
     $description ='';
   }

   if (empty($data['care'])) {
    $care ='';
  }

      Product::where(['id'=>$id])->update(['status'=>$status,'feature_item'=>$feature_item,'category_id'=>$data['category_id'],
      'product_name'=>$data['product_name'],'product_code'=>$data['product_code'],
      'product_color'=>$data['product_color'],'description'=>$data['description'],
      'care'=>$data['care'],'price'=>$data['price'],'image'=>$filename]);

        return redirect()->route('admin.product.view')->with('flash_message_success',' Product has update Successfully');

    }
    $productDetails = Product::where(['id' =>$id])->first();
    $categories = Category::where(['parent_id' =>0])->get();
    $categories_dropdown = "<option value='' selected disabled>Select</option>";
    foreach($categories  as $cat){
      if($cat->id == $productDetails->category_id) {
    $selected = "selected";
  }else {
    $selected ="";
  }
      $categories_dropdown .="<option value='".$cat->id." ' ".$selected.">".$cat->name."</option>";

      $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
      foreach($sub_categories as $sub_cat){
        if($sub_cat->id == $productDetails->category_id) {
      $selected = "selected";
    }else {
      $selected ="";
    }
        $categories_dropdown .="<option value='".$sub_cat->id." ' ".$selected.">&nbsp;--&nbsp;".$sub_cat->name."</option>";

      }
    }

    return view('admin.products.edit_product',compact('productDetails','categories_dropdown'));
  }

public function delete($id = null)
{
  $productImage = Product::where(['id'=>$id])->delete();

return redirect()->back()->with('flash_message_success',' Product delete Successfully');

}


 public function deleteProductImage($id = null)
 {
   $productImage = Product::where(['id'=>$id])->first();
   $large_image_path = 'images/backend_images/products/large/';
   $medium_image_path = 'images/backend_images/products/medium/';
   $small_image_path = 'images/backend_images/products/small/';

   if(file_exists($large_image_path.$productImage->image)) {
   unlink($large_image_path.$productImage->image);
   }

   if(file_exists($medium_image_path.$productImage->image)) {
   unlink($medium_image_path.$productImage->image);
   }

   if(file_exists($small_image_path.$productImage->image)) {
   unlink($small_image_path.$productImage->image);
   }
   Product::where(['id'=>$id])->update(['image'=>'']);
 return redirect()->back()->with('flash_message_success',' Product Image delete Successfully');

 }

  public function view()
  {
    $products = Product::orderBy('id','desc')->get();
    $products =json_decode(json_encode($products));
    foreach($products as $key => $val){

      $category_name = Category::where(['id' => $val->category_id])->first();
      $products[$key]->category_name = $category_name->name;
    }
// echo "<pre>";print_r($products); die;
    return view('admin.products.view_product',compact('products'));
  }

public function addAttributes(Request $request,$id=null)
{
$productDetails = Product::with('attributes')->where(['id'=>$id])->first();
// $productDetails = json_decode(json_encode($productDetails));
// echo "<pre>";print_r($productDetails); die;
  $categoryDetails = Category::where(['id'=>$productDetails->category_id])->first();
   $category_name = $categoryDetails->name;
if($request->isMethod('post')) {
  $data = $request->all();
// echo "<pre>";print_r($data); die;
  foreach($data['sku'] as $key => $val){
    if (!empty($val)) {
          $attrCountSKU = ProductAttribute::where('sku',$val)->count();
          if ($attrCountSKU>0) {
          return redirect('/admin/product/add-attributetes/'.$id)->with('flash_message_error',' SKU already exists ! Please add another SKU');
          }
            // $attrCountSizes = ProductAttribute::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
            // if ($attrCountSize>0) {
            //    return redirect('/admin/product/add-attributetes/'.$id)->with('flash_message_error',' Size already exists ! Please add another Size');
            // }

      $attribute = new ProductAttribute;
      $attribute->product_id =$id;
      $attribute->sku =$val;
      $attribute->size = $data['size'][$key];
      $attribute->price = $data['price'][$key];
      $attribute->stock = $data['stock'][$key];
      $attribute->save();

    }
  }
  return redirect('/admin/product/add-attributetes/'.$id)->with('flash_message_success',' Product Attribute Add Successfull');
}
$title = "Add Attributes";

  return view('admin.products.add_attributes',compact('productDetails','title','category_name'));
}


public function addImages(Request $request,$id=null)
{
$productDetails = Product::with('attributes')->where(['id'=>$id])->first();

if($request->isMethod('post')) {

}
  return view('admin.product.AddImages',compact('productDetails'));
}



public function products($url = null)
{

   $categoryCount = Category::where(['url'=>$url,'status'=>1])->count();
   if ($categoryCount==0) {
     abort(404);
   }

    $categories = Category::with('categories')->where(['parent_id'=> 0])->get();
    $categoryDetails = Category::where(['url'=>$url])->first();
    if($categoryDetails->parent_id==0) {
    $subCategories = Category::where(['parent_id'=>$categoryDetails->id])->get();
   $subCategories= json_decode(json_encode($subCategories));
    foreach($subCategories as $subcat){

      $cat_ids[] = $subcat->id;
    }

    $productsAll = Product::whereIn('products.category_id',$cat_ids)
    ->where('products.status','1')->orderBy('products.id','Desc');
    $breadcrumb = "<a href='/'>Home</a> > <a href='".$categoryDetails->url."'>
    ".$categoryDetails->name."</a>";

  }else {
     $productsAll = Product::where(['products.category_id'=>$categoryDetails->id])
     ->where('products.status','1')->orderBy('products.id','Desc');
     $mainCategory = Category::where('id',$categoryDetails->parent_id)->first();
         $breadcrumb = "<a href='/'>Home</a> > <a href='".$mainCategory->url."'>
        ".$mainCategory->name."</a>
          > <a href='".$categoryDetails->url."'>
         ".$categoryDetails->name."</a>";
  }
if (!empty($_GET['color'])) {
$colorArray = explode('-',$_GET['color']);
$productsAll = $productsAll->whereIn('product_color',$colorArray);
}
$productsAll = $productsAll->paginate(6);
 $colorArray = Product::select('product_color')->groupBy('product_color')->get();
 $colorArray = Arr::flatten(json_decode(json_encode($colorArray),true));
  return view('products.listing',compact('categories','categoryDetails',
  'productsAll','url','colorArray','breadcrumb'));
}

public function filter(Request $request)
{
$data = $request->all();
// echo "<pre>";print_r($data);die;
$colorUrl="";
if (!empty($data['colorFilter'])) {
foreach ($data['colorFilter'] as $color) {
if (empty($colorUrl)) {
$colorUrl = "&color=".$color;
}else {
  $colorUrl .="-".$color;
}
}
}
$finalUrl = "products/".$data['url']."?".$colorUrl;
return redirect::to($finalUrl);
}

public function searchProducts(Request $request)
{
 if ($request->isMethod('post')) {
   $data = $request->all();
   // echo "<pre>";print_r($data);die;  $categories = Category::with('categories')->where(['parent_id'=>0])->get();
     $categories = Category::with('categories')->where(['parent_id'=>0])->get();
   $search_product = $data['product'];
   // $productsAll = Product::where('product_name','like','%'.$search_product.'%')->orWhere('product_code',$search_product)->where('status','1')->get();
  $productsAll=Product::where(function($query) use($search_product){
    $query->where('product_name','like','%'.$search_product.'%')
    ->orWhere('product_code','like'.$search_product.'%')
    ->orWhere('product_color','like'.$search_product.'%')
    ->orWhere('description','like'.$search_product.'%');
  })->where('status',1)->get();
$breadcrumb = "<a href='/'>Home</a> / ".$search_product;
     return view('products.listing',compact('categories','search_product','productsAll','breadcrumb'));
 }
}


public function product($id = null)
{

     $productDetails = Product::with('attributes')->where('id',$id)->first();
     $productDetails = json_decode(json_encode($productDetails));
      // echo "<pre>"; print_r($productDetails);die;

      $categories = Category::with('categories')->where(['parent_id'=>0])->get();

      $categoryDetails = Category::where('id',$productDetails->category_id)->first();
       if($categoryDetails->parent_id==0){
           $breadcrumb = "<a href='/'>Home</a> / <a href='".$categoryDetails->url."'>".$categoryDetails->name."</a> / ".$productDetails->product_name;
       }else{
           $mainCategory = Category::where('id',$categoryDetails->parent_id)->first();
           $breadcrumb = "<a style='color:#333;' href='/'>Home</a> / <a style='color:#333;' href='/products/".$mainCategory->url."'>".$mainCategory->name."</a> / <a style='color:#333;' href='/products/".$categoryDetails->url."'>".$categoryDetails->name."</a> / ".$productDetails->product_name;
       }
      //$productAltImages = ProductImages::where('parent_id',$id)->get();
      $total_stock = ProductAttribute::where('product_id',$id)->sum('stock');

      return view('products.detail',compact('productDetails','categories','total_stock'));
}

public function getProductPrice(Request $request)
{

$data = $request->all();
// echo "<pre>";print_r($data); die;
$proArr = explode("-",$data['idSize']);
$proAttr = ProductAttribute::where(['product_id'=>$proArr[0], 'size'=>$proArr[1]])->first();
echo $proArr->price;
echo "#";
echo $proAttr->stock;
}

public function addtocart(Request $request)
{
Session::forget('CouponAmount');
Session::forget('CouponCode');
$data = $request->all();
  // echo "<pre>"; print_r($data);die;
 if (empty(Auth::user()->email)) {
$data['user_email']='';
}else {
  $data['user_email']= Auth::user()->email;
}

$session_id = Session::get('session_id');
 if(!isset($session_id)) {
   $session_id = Str::random(40);
   Session::put('session_id',$session_id);
 }
 $sizeArr = explode("-",$data['size']);
if (empty(Auth::check())) {
  $countProducts=DB::table('carts')->where(['product_id'=>$data['product_id'],
    'product_color'=>$data['product_color'],'size'=>$data['size'],
    'session_id'=>$session_id])->count();
if($countProducts>0) {
 return redirect()->back()->with('flash_message_error','Product already exists in Cart!');
}
}else {
  $countProducts=DB::table('carts')->where(['product_id'=>$data['product_id'],
              'product_color'=>$data['product_color'],'size'=>$data['size'],
              'user_email'=>$data['user_email']])->count();

if($countProducts>0) {
 return redirect()->back()->with('flash_message_error','Product already exists in Cart!');

}
}

  DB::table('carts')->insert(['product_id'=>$data['product_id'],
  'product_name'=>$data['product_name'],'product_code'=>$data['product_code'],
  'product_color'=>$data['product_color'],'price'=>$data['price'],
  'size'=>$data['size'],'quantity'=>$data['quantity'],
  'user_email'=>$data['user_email'],'session_id'=>$session_id]);


 return redirect('cart')->with('flash_message_success','Product has been added in Cart!');
}

public function cart()
{
  if(Auth::check()) {
  $user_email = Auth::user()->email;
  $userCart = DB::table('carts')->where(['user_email'=>$user_email])->get();
}else{
  $session_id = Session::get('session_id');
  $userCart = DB::table('carts')->where(['session_id'=>$session_id])->get();
}
  foreach ($userCart as $key => $product) {
   $productDetails = Product::where('id',$product->product_id)->first();
   $userCart[$key]->image = $productDetails->image;
  }
   // echo "<pre>"; print_r($userCart);die;
return view('products.cart',compact('userCart'));
}

public function deleteCartProduct($id=null)
{
    Session::forget('CouponAmount');
    Session::forget('CouponCode');

DB::table('carts')->where('id',$id )->delete();
return redirect('cart')->with('flash_message_success','Cart Item has delete successfully');
}


public function updateCartQuantity($id=null,$quantity=null)
{
  Session::forget('CouponAmount');
 Session::forget('CouponCode');
$getCartDetails =  DB::table('carts')->where('id',$id)->first();
  DB::table('carts')->where('id',$id)->increment('quantity',$quantity);
  return redirect('cart')->with('flash_message_success','Product Quantity has been update successfully ');
}


public function applyCoupon(Request $request)
{
   Session::forget('CouponAmount');
 Session::forget('CouponCode');
$data = $request->all();
// echo "<pre>"; print_r($data);die;
$couponCount =Coupon::where('coupon_code',$data['coupon_code'])->count();
if ($couponCount == 0) {
return redirect()->back()->with('flash_message_error','Coupon is not valid');
}else {
$couponDetails =Coupon::where('coupon_code',$data['coupon_code'])->first();
if($couponDetails->status==0) {
return redirect()->back()->with('flash_message_error','Coupon is not active');
}
$expiry_date = $couponDetails->expiry_date;
 $currebt_date = date('Y-m-d');
 if ($expiry_date<$currebt_date) {
   return redirect()->back()->with('flash_message_error','Coupon is expired!!');
 }
$session_id = Session::get('session_id');

if (Auth::check()) {
$user_email = Auth::user()->email;
$userCart = DB::table('carts')->where(['user_email'=>$user_email])->get();
}else{
$session_id = Session::get('session_id');
$userCart = DB::table('carts')->where(['session_id'=>$session_id])->get();
}

$total_amount = 0;
foreach ($userCart as $item) {
$total_amount = $total_amount + ($item->price * $item->quantity);
}

if ($couponDetails->amount_type=='Fixed') {
  $couponAmount = $couponDetails->amount;

}else {

  $couponAmount = $total_amount * ($couponDetails->amount/100);
}
Session::put('CouponAmount', $couponAmount);
Session::put('CouponCode', $data['coupon_code']);

return redirect()->back()->with('flash_message_success','Coupon Code successfully Applied. You are availing discount!!');
}

}
public function checkout(Request $request)
{
  $user_id = Auth::user()->id;
  $user_email = Auth::user()->email;
  $userDetails = User::find($user_id);
  $countries = Country::get();
  $shippingDetails = DeliveryAddress::get();
    $shippingCount = DeliveryAddress::where('user_id',$user_id)->count();
    if ($shippingCount>0) {
    $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();
    }
  $session_id =Session::get('session_id');
  DB::table('carts')->where(['session_id'=>$session_id])->update(['user_email'=>$user_email]);

  if ($request->isMethod('post')) {
 $data = $request->all();
 // echo "<pre>";print_r($data);die;
 if (empty($data['billing_name']) || empty($data['billing_address']) || empty($data['billing_city'])
|| empty($data['billing_state']) || empty($data['billing_country']) || empty($data['billing_pincode']) || empty($data['billing_mobile'])
|| empty($data['shipping_name']) || empty($data['shipping_address']) || empty($data['shipping_city'])
|| empty($data['shipping_state']) || empty($data['shipping_country']) || empty($data['shipping_pincode']) || empty($data['shipping_mobile'])) {
  return redirect()->back()->with('flash_message_error','Please Fill up all fields to checkout');
 }
 User::where('id',$user_id)->update(['name'=>$data['billing_name'],'address'=>$data['billing_address'],'city'=>$data['billing_city'],'state'=>$data['billing_state'],
'country'=>$data['billing_country'],'pincode'=>$data['billing_pincode'],'mobile'=>$data['billing_mobile']]);
if ($shippingCount>0) {
  DeliveryAddress::where('id',$user_id)->update(['name'=>$data['billing_name'],'address'=>$data['billing_address'],'city'=>$data['billing_city'],'state'=>$data['billing_state'],
 'country'=>$data['billing_country'],'pincode'=>$data['billing_pincode'],'mobile'=>$data['billing_mobile']]);
}else {
$shipping = new DeliveryAddress;
$shipping->user_id = $user_id;
$shipping->user_email = $user_email;
$shipping->name=$data['billing_name'];
$shipping->address=$data['billing_address'];
$shipping->city=$data['billing_city'];
$shipping->state=$data['billing_state'];
$shipping->country=$data['billing_country'];
$shipping->pincode=$data['billing_pincode'];
$shipping->mobile=$data['billing_mobile'];
$shipping->save();

}
return redirect()->route('user.orderReview');
  }
return view('products.checkout',compact('userDetails','countries','shippingDetails'));
}
public function orderReview()
{
  $user_id = Auth::user()->id;
  $user_email = Auth::user()->email;
  $userDetails = User::where('id',$user_id)->first();
 $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();
  $shippingDetails=json_decode(json_encode($shippingDetails));
  $userCart = DB::table('carts')->where(['user_email'=>$user_email])->get();

  foreach ($userCart as $key => $product) {
   $productDetails = Product::where('id',$product->product_id)->first();
   $userCart[$key]->image = $productDetails->image;
  }
  // echo "<pre>";print_r($userCart);die;
  // echo "<pre>";print_r($shippingDetails);die;
return view('products.order_review',compact('userDetails','shippingDetails','userCart'));
}


public function placeOrder(Request $request){
  if($request->isMethod('post')) {
    $data = $request->all();
      $user_id = Auth::user()->id;
      $user_email = Auth::user()->email;
      //shipping Address of User
      $shippingDetails = DeliveryAddress::where(['user_email'=>$user_email])->first();

      if(empty(Session::get('CouponCode'))) {
      $coupon_code = '';
    }else {
      $coupon_code = Session::get('CouponCode');
    }

      if(empty(Session::get('CouponAmount'))) {
          $coupon_amount = '';
      }else {
          $coupon_amount = Session::get('CouponAmount');
      }

    // echo "<pre>"; print_r($data);die;
    $order = new Order;
    $order->user_id = $user_id;
    $order->user_email = $user_email;
    $order->name= $shippingDetails->name;
    $order->address= $shippingDetails->address;
    $order->city= $shippingDetails->city;
    $order->state= $shippingDetails->state;
    $order->country= $shippingDetails->country;
    $order->pincode= $shippingDetails->pincode;
    $order->mobile= $shippingDetails->mobile;
    $order->coupon_code = $coupon_code;
    $order->coupon_amount = $coupon_amount;
    $order->order_status = "new";
    $order->payment_method = $data['payment_method'];
    $order->grand_total = $data['grand_total'];
    $order->save();

    $order_id = DB::getPdo()->lastInsertId();
    $cartProducts = DB::table('carts')->where(['user_email'=>$user_email])->get();
    foreach($cartProducts as $pro){
      $cartPro = new OrdersProduct;

      $cartPro->order_id = $order_id;
      $cartPro->user_id = $user_id;
      $cartPro->product_id = $pro->product_id;
      $cartPro->product_code = $pro->product_code;
      $cartPro->product_name = $pro->product_name;
      $cartPro->product_color = $pro->product_color;
      $cartPro->product_size = $pro->size;
      $cartPro->product_price = $pro->price;
      $cartPro->product_qty = $pro->quantity;
      $cartPro->save();

    }
    Session::put('order_id',$order_id);
    Session::put('grand_total',$data['grand_total']);
if ($data['payment_method']=="COD") {
  $productDetails = Order::with('orders')->where('id',$order_id)->first();
  $productDetails = json_decode(json_encode($productDetails),true);
  // echo "<pre>";print_r($productDetails);die;
 $userDetails = User::where('id',$user_id)->first();
 $userDetails = json_decode(json_encode($userDetails),true);
 // echo "<pre>";print_r($userDetails);die;

  $email = $user_email;
  $messageData=[
    'email' =>$email,
    'name'=>$shippingDetails->name,
    'order_id'=>$order_id,
    'productDetails' =>$productDetails,
    'userDetails'=>$userDetails
  ];
  Mail::send('email.order',$messageData,function($message) use($email){
    $message->to($email)->subject('order Placed - E-com Website');
  });
  return redirect()->route('user.thanks');
}else {
  return redirect()->route('user.paypal');
}

  }
 }

 public function thanks(Request $request)
 {
   $user_email = Auth::user()->email;
   DB::table('carts')->where('user_email',$user_email)->delete();
  return view('orders.thanks');
 }

 public function paypal(Request $request)
 {
   $user_email = Auth::user()->email;
   DB::table('carts')->where('user_email',$user_email)->delete();

  return view('orders.paypal');
 }

 public function userOrders()
 {
   $user_id = Auth::user()->id;
   $orders =Order::with('orders')->where('user_id',$user_id)->orderBy('id','DESC')->get();
    // $orders =json_decode(json_encode($orders));
    // echo "<pre>";print_r($orders);die;
   return view('orders.users_orders',compact('orders'));
 }
 public function userOrderDetails($order_id)
 {
   $user_id = Auth::user()->id;
   $orderDetails = Order::with('orders')->where('id',$order_id)->first();
   $orderDetails = json_decode(json_encode($orderDetails));
   // echo "<pre>";print_r($orderDetails);die;
   return view('orders.users_order_details',compact('orderDetails'));
 }

 public function viewOrders()
 {
  $orders = Order::with('orders')->orderBy('id','Desc')->get();
  $orders = json_decode(json_encode($orders));
  // echo "<pre>";print_r($orders);die;
   return view('admin.orders.view_orders',compact('orders'));
 }

 public function viewOrderDetails($order_id)
 {
  $orderDetails = Order::with('orders')->where('id',$order_id)->first();
  $orderDetails = json_decode(json_encode($orderDetails));
   // echo "<pre>";print_r($orderDetails);die;
 $user_id = $orderDetails->user_id;
 $userDetails =User::where('id',$user_id)->first();
 // $userDetails = json_decode(json_encode($userDetails));
 // echo "<pre>";print_r($userDetails);die;

   return view('admin.orders.order_details',compact('orderDetails','userDetails'));
 }

 public function viewOrderInvoice($order_id)
 {
  $orderDetails = Order::with('orders')->where('id',$order_id)->first();
  $orderDetails = json_decode(json_encode($orderDetails));
 // echo "<pre>";print_r($orderDetails);die;
 $user_id = $orderDetails->user_id;
 $userDetails =User::where('id',$user_id)->first();
 // $userDetails = json_decode(json_encode($userDetails));
 // echo "<pre>";print_r($userDetails);die;

   return view('admin.orders.order_invoice',compact('orderDetails','userDetails'));
 }

 public function updateOrderStatus(Request $request)
 {
   if ($request->isMethod('post')) {
  $data = $request->all();
Order::where('id',$data['order_id'])->update(['order_status'=>$data['order_status']]);
return redirect()->back()->with('flash_message_success','Order Status has been update successfully !!');
   }
 }



 public function viewOrdersMonthCharts()
 {
   $current_month_orders = Order::whereYear('created_at',Carbon::now()->year)
                         ->whereMonth('created_at',Carbon::now()->month)->count();
  $last_month_orders = Order::whereYear('created_at',Carbon::now()->year)
                         ->whereMonth('created_at',Carbon::now()->subMonth(1))->count();
  $last_to_last_month_orders = Order::whereYear('created_at',Carbon::now()->year)
                       ->whereMonth('created_at',Carbon::now()->subMonth(2))->count();




   return view('admin.ordersCharts.view_orders_monthly_charts',compact('current_month_orders','last_month_orders','last_to_last_month_orders'));
 }

 public function viewOrdersDailyCharts()
 {
   $day1_orders = Order::whereMonth('created_at',Carbon::now()->month)
                         ->whereDay('created_at',Carbon::now()->day)->count();
  $day2_orders = Order::whereMonth('created_at',Carbon::now()->month)
                         ->whereDay('created_at',Carbon::now()->subDay(1))->count();
  $day3_orders = Order::whereMonth('created_at',Carbon::now()->month)
                       ->whereDay('created_at',Carbon::now()->subDay(2))->count();
   $day4_orders = Order::whereMonth('created_at',Carbon::now()->month)
                       ->whereDay('created_at',Carbon::now()->subDay(3))->count();
  $day5_orders = Order::whereMonth('created_at',Carbon::now()->month)
                       ->whereDay('created_at',Carbon::now()->subDay(4))->count();
  $day6_orders = Order::whereMonth('created_at',Carbon::now()->month)
                     ->whereDay('created_at',Carbon::now()->subDay(5))->count();
   $day7_orders = Order::whereMonth('created_at',Carbon::now()->month)
                        ->whereDay('created_at',Carbon::now()->subDay(6))->count();




   return view('admin.ordersCharts.view_orders_daily_charts',compact('day1_orders','day2_orders','day3_orders','day4_orders','day5_orders','day6_orders','day7_orders'));
 }


 public function viewOrdersYearCharts()
 {

  $last_to_last_year_orders = Order::whereYear('created_at',Carbon::now()->subYear(2))->count();

 $last_year_orders = Order::whereYear('created_at',Carbon::now()->subYear(1))->count();
  $current_year_orders = Order::whereYear('created_at',Carbon::now()->year)->count();



   return view('admin.ordersCharts.view_orders_yearly_charts',compact('current_year_orders','last_year_orders','last_to_last_year_orders'));
 }

}
