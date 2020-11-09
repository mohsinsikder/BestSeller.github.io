<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Banner;
use Image;

class BannersController extends Controller
{
  public function addBanner(Request $request)
  {
   if($request->isMethod('post')) {
   $data = $request->all();
   // echo "<pre>"; print_r($date);die;
   $banner = new Banner;
   $banner->title = $data['title'];
   $banner->link = $data['link'];
   if ($request->hasFile('image')) {
   $image_tmp = $request->file('image');
   if ($image_tmp->isValid()) {
   $extension = $image_tmp->getClientOriginalExtension();
   $filename=rand(111,99999).'.'.$extension;
   $banner_path = 'images/backend_images/banners/'.$filename;


   Image::make($image_tmp)->resize(1200,340)->save($banner_path);

    $banner->image =$filename;
   }

   }
   $banner->save();
   return redirect()->route('admin.banner.view')->with('flash_message_success','Banner added successfully');
 }
  return view('admin.banners.add_banner');

}


public function viewBanner()
{
  $banners = Banner::get();
  return view('admin.banners.view_banner',compact('banners'));
}


public function editBanner(Request $request,$id=null)
{
 if($request->isMethod('post')) {
 $data = $request->all();
  // echo "<pre>"; print_r($data);die;

  if (empty($data['status'])) {
  $status = '1';
}else {
    $status = '1';
}
if (empty($data['title'])) {
$title = '';
}
if (empty($data['link'])) {
$link = '';
}

 $banner = Banner::find($id);
 $banner->title = $data['title'];
 $banner->link = $data['link'];
 if ($request->hasFile('image')) {
 $image_tmp = $request->file('image');
 if ($image_tmp->isValid()) {
 $extension = $image_tmp->getClientOriginalExtension();
 $filename=rand(111,99999).'.'.$extension;
 $banner_path = 'images/backend_images/banners/'.$filename;


 Image::make($image_tmp)->resize(1200,340)->save($banner_path);
  $banner->image =$filename;
 }

 }
 $banner->save();
 return redirect()->route('admin.banner.view')->with('flash_message_success','Banner update successfully');
}

$bannerDetails = Banner::where('id',$id)->first();
return view('admin.banners.edit_banner',compact('bannerDetails'));

}


public function deleteBanner($id=null)
{
  $deleteBanneron = Banner::where(['id'=>$id])->delete();

return redirect()->back()->with('flash_message_success',' Banner delete Successfully');
}

}
