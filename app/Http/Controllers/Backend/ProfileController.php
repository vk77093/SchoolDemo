<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;

class ProfileController extends Controller
{
    protected string $path="Admin.Backend.UserProfile.ManageProfile.";
    protected string $ImagePath="AdminAsset/UserProfileImage/";

    public function ViewProfile(){
    $currentUser = Auth::user()->id;
    $user=User::findorFail($currentUser);
    $title_page="Profile View";
    return view($this->path."viewProfile",compact('user','title_page'));
    }
    
    public function EditProfile(){
        $currentUser = Auth::user()->id;
        $user=User::findorFail($currentUser);
        $title_page="Profile Edit";
        return view($this->path."updateProfile",compact('user','title_page'));
    }

    public function UpdateProfileAction(Request $request){
        $currentUser = Auth::user()->id;
        $user=User::findorFail($currentUser);
        $request->validate([
         'name'=>'required',
         'email'=>'required|email|unique:users,email,'.$currentUser,
         'mobile'=>'required|min:10|max:10',
         'gender'=>'required|string',
         'address'=>'required|string'
        ]);
        $previousImage=$user->profile_photo_path;
        if($request->hasFile('profile_photo_path')){
        $image=$request->file('profile_photo_path');
        $imageName=$currentUser.$image->getClientOriginalName();
        Image::make($image)->resize(430,327)->save($this->ImagePath.$imageName);
        $saveUrl=$this->ImagePath.$imageName;
        if($previousImage !=null){
            unlink($previousImage);
        }
        $user->name=$request->name;
        $user->email=$request->email;
        $user->mobile=$request->mobile;
        $user->address=$request->address;
        $user->gender=$request->gender;
        $user['profile_photo_path']=$saveUrl;
        $user->save();
        $data=$this->ShowNotification('User profile updated with Image','info');
        return redirect()->route('profile.view')->with($data);

 }else{
    $user->name=$request->name;
    $user->email=$request->email;
    $user->mobile=$request->mobile;
    $user->address=$request->address;
    $user->gender=$request->gender;
    $user->save();
    $data=$this->ShowNotification('User profile Updated withOut Image','warning');
    return redirect()->route('profile.view')->with($data);
        }
    }
    public function ChangePasswordPage(){
     $title_page="Change Password";
     return view($this->path.'changePassword',compact('title_page'));

    }
    public function ChangePasswordPageAction(Request $request){
$request->validate([
    'oldpassword'=>'required',
    'password'=>'required|confirmed',
]);
$hasedPassword = Auth::user()->password;
if(Hash::check($request->oldpassword,$hasedPassword)){
    $user=User::findOrFail(Auth::id());
    $user->password = Hash::make($request->password);
    $user->update();
    Auth::gurard()->logout();
    $data=$this->ShowNotification('User Password got changed successfully','info');
    return redirect()->route('home')->with($data);
}else{
    $data=$this->ShowNotification('Your Current Password is incorrect','error');
    return redirect()->back()->with($data);
}

    }

    private function ShowNotification($message,$alertType) {
        $notifi=array('message'=>$message,'alert-type'=>$alertType);
        return $notifi;
    }

}
