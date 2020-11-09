<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use App\Mail\Welcome;
use Auth;
use App\User;
use Session;
use App\Country;
use Carbon\Carbon;

class UsersController extends Controller
{

  public function userLoginRegister()
  {
  return view('users.login_register');
  }

   public function login(Request $request)
       {
         if ($request->isMethod('post')) {
         $data = $request->all();
         // echo "<pre>";print_r($data);die;
        if (Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])) {
  //
     $userStatus = User::where('email',$data['email'])->first();
     if ($userStatus->status == 0) {
      return redirect()->back()->with('flash_message_error','Your Acount is Inactive ! Please Confirm your email to active ypur account !!');
     }
  //
         Session::put('frontSession',$data['email']);
  //
         if (!empty(Session::get('session_id'))) {
           $session_id = Session::get('session_id');
              DB::table('carts')->where('session_id',$session_id)->update(['user_email'=>$data['email']]);
         }
  //
          return redirect('/cart');
        }else {
          return redirect()->back()->with('flash_message_error','Invaild email or password');
        }
        }
      }
    public function register(Request $request)
    {
      if ($request->isMethod('post')) {
        $data = $request->all();
       // echo "<pre>";print_r($data);die;
         $userCount = User::where('email',$data['email'])->count();
         if ($userCount>0) {
           return redirect()->back()->with('flash_message_error','Email already exists!');
         }else {
         $user = new User;
         $user->name = $data['name'];
         $user->email = $data['email'];
         $user->password = bcrypt($data['password']);
         $user->save();
          //  $email =$data['email'];
          // $messageData = ['email'=>$data['email'],'name'=>$data['name']];
        //  Mail::send('email.register',$messageData,function($message) use($email){
        //    $message->to($email)->subject('Registration with E-com Website');
          //  });

          //Send confirm emails
    
          $email =$data['email'];
         $messageData = ['email'=>$data['email'],'name'=>$data['name'],'code'=>base64_encode($data['email'])];
          Mail::send('email.confirmation',$messageData,function($message) use($email){
            $message->to($email)->subject('Confirm your E-com Account');
          });
    
     return redirect()->back()->with('flash_message_success','Please Confirm Your email to Active your account !! ');
    
          if (Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])) {
            Session::put('frontSession',$data['email']);
            if (!empty(Session::get('session_id'))) {
              $session_id = Session::get('session_id');
                 DB::table('carts')->where('session_id',$session_id)->update(['user_email'=>$data['email']]);
            }
    
            return redirect('/cart');
          }
         }
       }
    
     }
    public function forgotPassword(Request $request)
    {
      if ($request->isMethod('post')) {
        $data = $request->all();
        // echo "<pre>";print_r($data);die;
        $userCount = User::where('email',$data['email'])->count();
        if ($userCount == 0) {
          return redirect()->back()->with('flash_message_error','Email does not exist !!');
        }
        $userDetails = User::where('email',$data['email'])->first();

         $random_password = Str::random(8);
        $new_password = bcrypt($random_password);
        User::where('email',$data['email'])->update(['password'=>$new_password]);

        $email = $data['email'];
        $name = $userDetails->name;
        $messageData = [
          'email'=>$email,
          'name'=>$name,
          'password'=>$random_password
        ];
        Mail::send('email.forgotpassword',$messageData,function($message) use($email){
          $message->to($email)->subject('New Password - E-com Website');
        });

        return redirect('login-register')->with('flash_message_success','Please check your email for new password!!');

      }

      return view('users.forgot_password');
    }

    public function confirmAccount($email)
    {
   $email = base64_decode($email);
   $userCount = User::where('email',$email)->count();
   if ($userCount > 0) {
    $userDetails = User::where('email',$email)->first();
    if ($userDetails->status ==1) {
      return redirect('login-register')->with('flash_message_success','Your email account is already active . You can login');
    }else {
      User::where('email',$email)->update(['status'=>1]);


           $messageData = ['email'=>$email,'name'=>$userDetails->name];
            Mail::send('email.welcome',$messageData,function($message) use($email){
              $message->to($email)->subject('Confirm to E-com Website');
            });

            return redirect('login-register')->with('flash_message_success','Your email account is  active now . You can login');
    }
   }else {
     abort(404);
   }
    }
public function account(Request $request)
    {

        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id );
        // echo "<pre>";print_r($userDetails);die;
        $countries = Country::get();
        if ($request->isMethod('post') ) {

            $data = $request->all();

          if (empty($data['name'])) {
            return redirect()->back()->with('flash_message_error','Please enter your name if you update your account details');
          }
          if(empty($data['address'])) {
           $data['address']='';
          }

          if(empty($data['city'])) {
           $data['city']='';
          }

          if(empty($data['state'])) {
           $data['state']='';
          }

          if(empty($data['country'])) {
           $data['country']='';
          }

          if(empty($data['pincode'])) {
           $data['pincode']='';
          }

          if(empty($data['mobile'])) {
           $data['mobile']='';
          }


          $user = User::find($user_id);
          $user->name = $data['name'];
          $user->address = $data['address'];
          $user->city = $data['city'];
          $user->state = $data['state'];
          $user->country = $data['country'];
          $user->pincode = $data['pincode'];
          $user->mobile = $data['mobile'];
          $user->save();
          return redirect()->back()->with('flash_message_success','Profile Update Successfully!!');
        }

    return view('users.account',compact('countries','userDetails'));
    }

  public function chkUserPassword(Request $request){
      $data =  $request->all();
      $current_password = $data['current_pwd'];
      $user_id = Auth::user()->id;
      $check_password = User::where('id',$user_id)->first();
      if(Hash::check($current_password,$check_password->password)) {
      echo "true"; die;
    }else {
      echo "false"; die;
    }


  }

  public function updateUserPassword(Request $request)

  {
    if($request->isMethod('post')) {
      $data = $request->all();

      $old_password = User::where('id', Auth::User()->id)->first();
      $current_password = $data['current_pwd'];
      if(Hash::check($current_password,$old_password->password)) {
      $password = bcrypt($data['new_pwd']);
      User::where('id',Auth::User()->id)->update(['password'=>$password]);
      return redirect()->back()->with('flash_message_success',' Password update Successfully');
    }else {
      return redirect()->back()->with('flash_message_error',' Password is not  update ');
    }
  }

}

public function logout()
{
Auth::logout();
Session::forget('frontSession');
Session::forget('session_id');
return redirect('/');
}

    public function checkEmail(Request $request)
    {

        $data = $request->all();
        // echo "<pre>";print_r($data);die;
        $userCount = User::where('email',$data['email'])->count();
        if ($userCount>0) {
          echo "false";
        }else {
          echo "true"; die;
        }

    }
    public function viewUsers()
    {
      $users = User::get();
      return view('admin.users.view_users',compact('users'));
    }
 public function viewUsersCharts()
 {

  $current_month_users = User::whereYear('created_at',Carbon::now()->year)
                        ->whereMonth('created_at',Carbon::now()->month)->count();
 $last_month_users = User::whereYear('created_at',Carbon::now()->year)
                        ->whereMonth('created_at',Carbon::now()->subMonth(1))->count();
 $last_to_last_month_users = User::whereYear('created_at',Carbon::now()->year)
                      ->whereMonth('created_at',Carbon::now()->subMonth(2))->count();


   return view('admin.users.view_users_charts',compact('current_month_users','last_month_users','last_to_last_month_users'));
 }

 public function viewUsersChartsYear()
 {

  $last_to_last_year_users = User::whereYear('created_at',Carbon::now()->subYear(2))->count();

 $last_year_users = User::whereYear('created_at',Carbon::now()->subYear(1))->count();
  $current_year_users = User::whereYear('created_at',Carbon::now()->year)->count();



   return view('admin.users.view_users_charts_year',compact('current_year_users','last_year_users','last_to_last_year_users'));
 }


 public function redirectToGoogle()
 {
   return Socialite::driver('google')->redirect();
 }

 public function handleGoogleCallback()
 {
  $user = Socialite::driver('google')->user();
$this->_registerOrLoginUser($user);
return redirect()->back();

 }

 public function redirectToFacebook()
 {
   return Socialite::dreive('facebook')->redirect();
 }

 public function handleFacebookCallback()
 {
  $user = Socialite::drive('facebook')->user();
 }

protected function _registerOrLoginUser($data){
  $user = User::where('email' ,'=',$data->email)->first();
  if (!$user) {
    $user = New User();
    $user->name = $data->name;
    $user->email = $data->email;
    $user->provider_id = $data->id;
    $user->avatar = $data->avatar;
    $user->save();
  }
  Auth::login($user);
}

}
