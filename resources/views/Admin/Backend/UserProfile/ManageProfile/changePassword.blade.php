@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<x-box-comp>
    <x-slot name="boxTitle">Edit Your Password</x-slot>
    <x-slot name="buttonArea">
        <a class="btn btn-app btn-info" href="{{route('profile.view')}}" style="float: right;">
            <i class="fa fa-eye"></i> View Profile
        </a>
    </x-slot>
<form method="post" action="{{route('profile.updatepassword')}}">
@csrf
<div class="row">
    <div class="col-sm-12 mb-1">
        <div class="form-group">
            <h5>Current Password : <x-required-sign/></h5>
            <div class="input-group">    
                <input type="password" name="oldpassword" class="form-control" id="id_password" required value="{{old('oldpassword')}}"> 
                <span class="input-group-addon"><i class="fa fa-eye" id="togglePassword" style="cursor: pointer;"></i></span> 
            </div>
            @error('oldpassword')
               <x-alert-comp>{{$message}}</x-alert-comp> 
            @enderror
        </div>
        <div class="form-group mt-1 mb-1">
            <h5>New Password : <x-required-sign/></h5>
            <div class="input-group">    
                <input type="password" name="password" class="form-control" id="id_password1" required value="{{old('password')}}"> 
                <span class="input-group-addon"><i class="fa fa-eye" id="togglePassword" style="cursor: pointer;"></i></span> 
            </div>
            @error('password')
               <x-alert-comp>{{$message}}</x-alert-comp> 
            @enderror
        </div>
        <div class="form-group mt-1 mb-1">
            <h5>Confirm Password : <x-required-sign/></h5>
            <div class="input-group">    
                <input type="password" name="password_confirmation" class="form-control" id="id_password2" required value="{{old('password_confirmation')}}"> 
                <span class="input-group-addon"><i class="fa fa-eye" id="togglePassword" style="cursor: pointer;"></i></span> 
            </div>
            @error('password_confirmation')
               <x-alert-comp>{{$message}}</x-alert-comp> 
            @enderror
        </div>
    </div>
</div>
<x-submit-button-comp/>
</form>
</x-box-comp>
@section('js')
   <script>
    const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#id_password');
  const password1 = document.querySelector('#id_password1');
  const password2 = document.querySelector('#id_password2');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    password1.setAttribute('type', type);
    password2.setAttribute('type',type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
    </script> 
@endsection
@endsection