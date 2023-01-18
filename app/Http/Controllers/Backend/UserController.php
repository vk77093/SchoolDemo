<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Image;


class UserController extends Controller
{
    protected string $path="Admin.Backend.UserProfile.";
    protected string $ImagePath="AdminAsset/UserProfileImage/";
     // $notific=new Notification();

    public function GoToAdminDashboard(){
        $title_page="Admin Dashboard";
        return view("dashboard",compact('title_page'));
    }
    public function GoToLoginPage(){
        $title_page="Login Page";
        return view("auth.login",compact('title_page'));
    }
    public function LogoutUser(){
        Auth::logout();
        return redirect()->route('home');
    }
    public function ViewUser(){
     $title_page="View User";
    $users=User::latest()->get();
      return view($this->path.'viewuser',compact('title_page','users'));
    }
    public function CreateUser(){
        $title_page="Create User";
        return view($this->path.'createuser',compact('title_page'));
    }
    public function CreateUserPost(Request $request){
        
$request->validate([
'name'=>'required|min:3',
'email'=>'required|email|unique:users',
'password'=>['required','min:4','confirmed'],
]);
if($request->file('profile_photo_path')){
    $image=$request->file('profile_photo_path');
    $imageName=Auth::user()->id.$image->getClientOriginalName();
    Image::make($image)->resize(430,327)->save($this->ImagePath.$imageName);
    $saveUrl=$this->ImagePath.$imageName;
       User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password),
        'userType'=>$request->userType,
        'profile_photo_path'=>$saveUrl,
        ]);
        
        $data=$this->ShowNotification('User Data added with Image','success');
        return redirect()->route('user.view')->with($data);

}
else{
    User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password),
        'userType'=>$request->userType,
      
        ]);
        
        $data=$this->ShowNotification('User Data added without Image','info');
        return redirect()->route('user.view')->with($data);
}

    }
    public function EditUser($id){
        $title_page="Edit User";
        $user=User::findorFail($id);
        return view($this->path.'edituser',compact('title_page','user'));
    }
    public function UpdateUserPost(Request $request,$iddata){
        $id=User::findOrFail($iddata);
$request->validate([
    'name'=>'required',
    'email'=>'required|email|unique:users,email,'.$id->id,
]);
$previousImage=$id->profile_photo_path;

 if($request->file('profile_photo_path')){
    $image=$request->file('profile_photo_path');
    $imageName=Auth::user()->id.$image->getClientOriginalName();
    Image::make($image)->resize(430,327)->save($this->ImagePath.$imageName);
    $saveUrl=$this->ImagePath.$imageName;
    unlink($previousImage); // remove previous image
    User::findOrFail($iddata)->update([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password),
        'userType'=>$request->userType,
        'profile_photo_path'=>$saveUrl,
    ]);
    $data=$this->ShowNotification('User profile Updated with Image','info');
    return redirect()->route('user.view')->with($data);
}
else{
    User::findOrFail($iddata)->update([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password),
        'userType'=>$request->userType,
       
    ]);
    $data=$this->ShowNotification('User profile Updated withOut Image','warning');
    return redirect()->route('user.view')->with($data);
}



    }
    public function DeleteUser($id){
$userData=User::findorFail($id);
$previousImage=$userData->profile_photo_path;
if($previousImage !=null){
    unlink($previousImage);
User::findorFail($id)->delete();
$data=$this->ShowNotification('User deleted with image Successfully','danger');
return redirect()->back()->with($data);
}else{
    User::findorFail($id)->delete();
$data=$this->ShowNotification('User deleted without image Successfully','warning');
return redirect()->back()->with($data);
}
    }
    private function ShowNotification($message,$alertType) {
        $notifi=array('message'=>$message,'alertType'=>$alertType);
        return $notifi;
    }
}
