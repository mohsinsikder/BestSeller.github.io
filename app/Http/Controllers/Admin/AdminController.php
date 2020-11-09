<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Admin;
use Session;

class AdminController extends Controller
{
  public function login(Request $request)

  {
    if($request->isMethod('post')) {
      $data = $request->input();
        // echo "<pre>";print_r($data);die;
   $adminCount = Admin::where(['username'=>$data['username'],'password'=>md5($data['password']),'status'=>1])->count();
   // echo "<pre>";print_r($adminCount);die;

      if($adminCount>0) {
     // echo "success"; die;
     Session::put('adminSession',$data['username']);
      return redirect()->route('admin.dashboard');
    }else {
      return redirect()->route('admin.login')->with('flash_message_error','Invaild Username or Password');
    }
    }
  return view('admin.admin_login');
  }



  public function dashboard()
  {
// if (Session::has('adminSession')) {
//   // code...
// }else {
//   return redirect()->route('admin.login')->with('flash_message_error','Please Login Frist');
// }
    return view('admin.dashboard');
  }

  public function setting()
  {
    $adminDetails = Admin::where(['username'=>Session::get('adminSession')])->first();
    // echo "<pre>";print_r($adminDetails);die;
   return view('admin.settings',compact('adminDetails'));
    }

    public function chkPassword(Request $request)
    {
      $data = $request->all();
    $adminCount = Admin::where(['username'=>Session::get('adminSession'),'password'=>md5($data['current_pwd'])])->count();
      if($adminCount == 1) {
      echo "true"; die;
    }else {
      echo "false"; die;
    }
    }

    public function updatePassword(Request $request)

    {
      if($request->isMethod('post')) {
        $data = $request->all();
        $adminCount = Admin::where(['username'=>Session::get('adminSession'),'password'=>md5($data['current_pwd'])])->count();
        if($adminCount == 1) {
        $password = md5($data['new_pwd']);
        Admin::where('username',Session::get('adminSession'))->update(['password'=>$password]);
        return redirect()->route('admin.setting')->with('flash_message_success',' Password update Successfully');
      }else {
        return redirect()->route('admin.setting')->with('flash_message_error',' Passwordis not  update ');
      }
    }

  }


  public function logout()
  {
    Session::flush();
      return redirect()->route('admin.login')->with('flash_message_success','Logout Successfully');
  }
 public function viewAdmins()
 {
   $admins = Admin::get();
   // $admins = json_decode(json_encode($admins));
   // echo "<pre>";print_r($admins);die;

   return view('admin.admins.view_admins',compact('admins'));
 }

 public function addAdmins(Request $request)
 {
   if ($request->isMethod('post')) {
    $data = $request->all();
    // echo "<pre>";print_r($data);die;
    $adminCount = Admin::where('username',$data['username'])->count();
    if ($adminCount>0) {
    return redirect()->back()->with('flash_message_error','Admin Username already sxists! Please choose another.');
  }else {
    $admin = new Admin;
    $admin->username = $data['username'];
    $admin->password = md5($data['password']);
    $admin->status = $data['status'];
    $admin->save();
    return redirect()->route('admin.viewAdmins')->with('flash_message_success','Admin Username added successfully');
  }
   }
  return view('admin.admins.add_admins');
 }
}
