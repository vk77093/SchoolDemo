@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<x-box-comp>
    <x-slot name="boxTitle">Add New User</x-slot>
    <x-slot name="buttonArea">
        <a class="btn btn-app btn-info" href="{{route('user.view')}}" style="float: right;">
            <i class="fa fa-eye"></i> View User
        </a>
    </x-slot>
   <form method="post" action="{{route('user.updatepost',$user->id)}}" enctype="multipart/form-data">
@csrf
<div class="row">
    <div class="col-sm-6">
        <x-input-form-comp>
            <x-slot name="labelName">User name</x-slot>
            <input type="text" class="form-control" name="name" value="{{$user->name}}" required autofocus/>
            @error('name')
                <x-alert-comp>{{$message}}</x-alert-comp>
            @enderror
        </x-input-form-comp>
    </div>
    <div class="col-sm-6">
        <x-input-form-comp>
            <x-slot name="labelName">Email Id</x-slot>
            <input type="email" class="form-control" name="email" value="{{$user->email}}" required/>
            @error('email')
                <x-alert-comp>{{$message}}</x-alert-comp>
            @enderror
        </x-input-form-comp>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <x-input-form-comp>
            <x-slot name="labelName">Password</x-slot>
            <input type="password" class="form-control" name="password" value="{{$user->password}}" required/>
            @error('password')
                <x-alert-comp>{{$message}}</x-alert-comp>
            @enderror
        </x-input-form-comp>
    </div>
    
</div>
<div class="row">
    <div class="controls col-sm-6">
        <x-input-form-comp>
            <x-slot name="labelName">User Role</x-slot>
            <select name="userType" class="form-control" required>
                <option value={{$user->userType}}>{{$user->userType}}</option>
                <option value="Admin">Admin</option>
                <option value="Operator">Operator</option>
            </select>
            
        </x-input-form-comp>
        </div>
    <div class="col-sm-6">
<x-input-form-comp>
    <x-slot name="labelName">Profile Image</x-slot>
    <input type="file" class="form-control" name="profile_photo_path" id="profile_photo_path"/>
    <div class="mt-2">
        <img src="{{!empty($user->profile_photo_path) ? url($user->profile_photo_path) : asset('AdminAsset/UserProfileImage/no_image.jpg')}}" id="showImage" class="rounded avatar-lg img-centered"/>
    </div>
</x-input-form-comp>
    </div>
</div>

<x-submit-button-comp/>
   </form>
</x-box-comp>
@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('#profile_photo_path').change(function(e){
            var reader=new FileReader();
            reader.onload=function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    });
    </script>
@endsection
@endsection