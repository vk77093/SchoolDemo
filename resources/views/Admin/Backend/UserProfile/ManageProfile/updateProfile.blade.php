@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<x-box-comp>
    <x-slot name="boxTitle">Edit Your Profile</x-slot>
    <x-slot name="buttonArea">
        <a class="btn btn-app btn-info" href="{{route('profile.view')}}" style="float: right;">
            <i class="fa fa-eye"></i> View Profile
        </a>
    </x-slot>
    <form method="post" action="{{route('profile.update')}}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <h5>User Name <span class="text-danger">*</span></h5>
                <div class="controls">
                    <input type="text" name="name" class="form-control" name="name" value="{{$user->name}}" data-validation-required-message="This field is required" aria-invalid="false">
                    @error('name')
                        <x-alert-comp>{{$message}}</x-alert-comp>
                    @enderror
                </div>

            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <h5>Email Id: <x-required-sign/></h5>
                <div class="controls">
                    <input type="email" name="email" class="form-control" value="{{$user->email}}" required/>
                    @error('email')
                    <x-alert-comp>{{$message}}</x-alert-comp>
                    @enderror
                </div>
            </div>
        </div>
        
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <h5>Mobile Nunber: <x-required-sign/></h5>
                <div class="controls">
                    <input type="number" class="form-control" name="mobile" value="{{$user->mobile}}" required/>
                    @error('mobile')
                    <x-alert-comp>{{$message}}</x-alert-comp>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <h5>Address: <x-required-sign/></h5>
                <div class="controls">
                    <input type="text" class="form-control" name="address" value="{{$user->address}}" required/>
                    @error('address')
                    <x-alert-comp>{{$message}}</x-alert-comp>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <h5>Select Gender : <x-required-sign/></h5>
                <div class="controls">
                    <select name="gender" class="form-control form-select" required>
                        <option selected value disabled>--Select Gender--</option>
                        <option value="Male" {{($user->gender==='Male' ? 'selected' : '')}}>Male</option>
                        <option value="FeMale" {{($user->gender==='FeMale' ? 'selected' : '')}}>Fe-Male</option>
                    </select>
                    @error('gender')
                        <x-alert-comp>{{$message}}</x-alert-comp>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <h5>Select Profile File :</h5>
                <div class="controls">
                    <input type="file" class="form-control" name="profile_photo_path" id="image" value="{{$user->profile_photo_path}}"/>
                </div>
                <div class="mt-2">
                    <img src="{{!empty($user->profile_photo_path) ? url($user->profile_photo_path) : asset('AdminAsset/UserProfileImage/no_image.jpg')}}" id="showImage" class="rounded avatar-lg img-centered" style="width: 30%; height:20%"/>
                </div>
            </div>
        </div>
    </div>
    <x-submit-button-comp/>
    @section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e){
                var reader=new FileReader();
                reader.onload=function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
        </script>
    @endsection
    </form>
</x-box-comp>

@endsection