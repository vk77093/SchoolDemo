@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<div class="row">
    <div class="col-12">
        <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-black" style="background: url('AdminAsset/images/gallery/full/10.jpg') center center;">
              <h3 class="widget-user-username">{{$user->name}}</h3>
              <a href="{{ route('profile.edit') }}" class="btn btn-app btn-info" style="float:right">
                <i class="fa fa-edit"></i>Edit Profile</a>
              <h6 class="widget-user-desc">{{!empty($user->userType)? $user->userType : 'No Role Assigned'}}</h6>
            </div>
            <div class="widget-user-image">
              <img class="rounded-circle" src="{{!empty($user->profile_photo_path) ? url($user->profile_photo_path) : url('AdminAsset/UserProfileImage/no_image.jpg')}}" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header">{{$user->mobile}}</h5>
                    <span class="description-text">Mobile Number</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 br-1 bl-1">
                  <div class="description-block">
                    <h5 class="description-header">{{$user->gender}}</h5>
                    <span class="description-text">Gender</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header">{{$user->address}}</h5>
                    <span class="description-text">Address</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
    </div>
</div>
@endsection