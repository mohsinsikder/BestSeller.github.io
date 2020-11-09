<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use App\CmsPage;
use App\Category;

class CmsController extends Controller
{
    public function addCmsPage(Request $request)
    {
      if ($request->isMethod('post')) {
      $data = $request->all();
      // echo "<pre>"; print_r($data);die;
      $cmspage = new CmsPage;
      $cmspage->title = $data['title'];
      $cmspage->url = $data['url'];
      $cmspage->description = $data['description'];
      if (empty($data['status'])) {
        $status =0;
      }else {
        $status =1;
      }
      $cmspage->status =$status;
      $cmspage->save();
      return redirect()->route('admin.cms.view')->with('flash_message_success','CMS added successfully');
      }
      return view('admin.pages.add_cms_page');
    }

    public function editCmsPage(Request $request,$id=null)
    {
      if ($request->isMethod('post')) {
      $data = $request->all();
      // echo "<pre>"; print_r($data);die;
      $cmspage =  CmsPage::find($id);
      $cmspage->title = $data['title'];
      $cmspage->url = $data['url'];
      $cmspage->description = $data['description'];
      if (empty($data['status'])) {
        $status =0;
      }else {
        $status =1;
      }
      $cmspage->status =$status;
      $cmspage->save();
      return redirect()->route('admin.cms.view')->with('flash_message_success','CMS Update successfully');
      }
      $cmsPages = CmsPage::find($id);
      return view('admin.pages.edit_cms_page',compact('cmsPages'));
    }

    public function viewCmsPage()
    {
      $cmsPages = CmsPage::get();
      return view('admin.pages.view_cms_page',compact('cmsPages'));
    }

    public function deleteCmsPage($id=null)
    {
      $deleteCms = CmsPage::where(['id'=>$id])->delete();
      return redirect()->back()->with('flash_message_success',' CMS delete Successfully');
    }
    public function cmsPage($url)
    {
    $cmsPageDetails = CmsPage::where('url',$url)->first();
    return view('pages.cms_page',compact('cmsPageDetails'));
    }

    public function contact(Request $request)
    {
      if ($request->isMethod('post')) {
        $data = $request->all();
        // echo "<pre>";print_r($data);die;
        $email = "mohsinsikder895@gmail.com";
        $messageData =[
          'name'=>$data['name'],
          'email'=>$data['email'],
          'subject'=>$data['subject'],
          'message'=>$data['message']
        ];
        Mail::send('emails.enquiry',$messageData,function($message)use($email){
          $message->to($email)->subject('Enquiry from E-com Website');
        });
        echo "test";die;
      }
      $categories_menu = "";
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        $categories = json_decode(json_encode($categories));
            foreach($categories as $cat){

        $categories_menu .= " <div class='panel-heading'>
                <h4 class='panel-title'>
                  <a data-toggle='collapse' data-parent='#accordian' href='#" .$cat->id."'>
                    <span class='badge pull-right'><i class='fa fa-plus'></i></span>
                ".$cat->name."
                  </a>
                </h4>
              </div>
              <div id='".$cat->id."' class='panel-collapse collapse'>
                <div class='panel-body'>
                  <ul>";
                  $sub_categories = Category::with('categories')->where(['parent_id' =>$cat->id])->get();
                  foreach ($sub_categories as $subcat) {

                      $categories_menu .= " <li><a href='".$subcat->url."'>".$subcat->name." </a></li>";

                  }

                  $categories_menu .= "
                  </ul>
                </div>
              </div>
              ";
           }
    return view('pages.contact',compact('categories','categories_menu'));
    }
}
