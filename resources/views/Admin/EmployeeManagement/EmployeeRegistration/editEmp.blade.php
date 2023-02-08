@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<x-box-comp>
    <x-slot name="boxTitle">Edit The Employee {{$editData->name}}</x-slot>
    <x-slot name="buttonArea">
        <a class="btn btn-app btn-info" href="{{route('empregistration.ViewEmpRegis')}}" style="float: right;">
            <i class="fa fa-eye"></i> View Employee Data
        </a>
    </x-slot> 
    <form method="post" action="{{ route('empregistration.update',$editData->id) }}" enctype="multipart/form-data">
@csrf
<div class="row">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <h5>Employee Name <x-required-sign/></h5>
            <div class="input-group">
                <input type="text" class="form-control" name="name" required value="{{$editData->name}}"/>
            </div>
        </div>
    </div> <!--end of col-->
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <h5>Father Name <x-required-sign/></h5>
            <div class="input-group">
                <input type="text" class="form-control" name="fname" required value="{{$editData->fname}}"/>
            </div>
        </div>
    </div> <!--end of col-->
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <h5>Mother Name <x-required-sign/></h5>
            <div class="input-group">
                <input type="text" class="form-control" name="mname" required value="{{$editData->mname}}"/>
            </div>
        </div>
    </div> <!--end of col-->
</div> <!--end of first row -->
<div class="row mb-1 mt-1">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <h5>Mobile Number <x-required-sign/></h5>
            <div class="input-group">
                <input type="text" class="form-control" name="mobile" required value="{{$editData->mobile}}"/>
            </div>
        </div>
    </div> <!--end of col-->
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <h5>Student Address <x-required-sign/></h5>
            <div class="input-group">
                <input type="text" class="form-control" name="address" required value="{{$editData->address}}"/>
            </div>
        </div>
    </div> <!--end of col-->
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <h5>Select Gender <x-required-sign/></h5>
            <div class="input-group">
               <select class="form-control form-select" name="gender" id="gender" required >
                <option selected value disabled>--select Gender-- {{old('gender')}}</option>
                <option value="Male" {{($editData->gender == 'Male') ? 'selected' :''}}>Male</option>
                <option value="FeMale" {{($editData->gender == 'FeMale') ? 'selected' :''}}>FeMale</option>
              </select>
            </div>
        </div>
    </div> <!--end of col-->
</div> <!--end of 2nd row-->
<div class="row mt-1 mb-1">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <h5>Select Religion <x-required-sign/></h5>
            <div class="input-group">
               <select class="form-control form-select" name="religion" id="religion" required>
                <option selected value disabled>--Select Religion-- {{old('religion')}}</option>
                <option value="Hindu" {{($editData->religion =='Hindu')? 'selected' :''}}>Hindu</option>
                <option value="Muslim" {{($editData->religion =='Muslim')? 'selected' :''}}>Muslim</option>
                <option value="Sikh" {{($editData->religion =='Sikh')? 'selected' :''}}>Sikh</option>
                <option value="Christan" {{($editData->religion =='Christan')? 'selected' :''}}>Christan</option>
              </select>
            </div>
        </div>
    </div> <!--end of col-->
    <div class="col-sm-4 col-md-4">
        <h5>Date Of Birth <x-required-sign/></h5>
        <div class="input-group">
            <input type="date" class="form-control" name="dob" id="dob" required value="{{$editData->dob}}"/>
        </div>
    </div> <!--end of col-->
    @if (!$editData)
    <div class="col-sm-4 col-md-4">
        <h5>Joining Date <x-required-sign/></h5>
        <div class="input-group">
            <input type="date" class="form-control" name="join_date" id="join_date" required value="{{$editData->join_date}}"/>
        </div>
    </div> <!--end of col-->
</div> <!--end of 3rd row-->
<div class="row mt-1 mb-1">
    <div class="col-sm-3 col-md-3">
        <div class="form-group">
            <h5>Select Destination <x-required-sign/></h5>
            <div class="input-group">
                <select class="form-control" name="designation_id" id="designation_id" value="{{old('designation_id')}}" required>
                    <option selected value disabled>--Select Designations-- {{old('designation_id')}}</option>
                    @foreach ($designations as $desg)
                        <option value="{{$desg->id}}" {{$editData->designation_id==$desg->id ? 'selected':''}}>{{$desg->desg_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div> <!--end of col-->
  
        
    
    <div class="col-sm-3 col-md-3">
        <h5>Salary <x-required-sign/></h5>
        <div class="input-group">
            <input type="number" class="form-control" name="salary" id="salary" required value="{{old('salary')}}"/>
        </div>
    </div> <!--end of col-->
    @endif
    <div class="col-sm-3 col-md-3">
        <div class="form-group">
            <h5>Select Profile Image <x-required-sign/> </h5>
            <input type="file" class="form-control" name="profile_photo_path" id="profile_photo_path"/>
        </div>
    </div>
    <div class="col-sm-3 col-md-3 mt-2">
        <img src="{{(empty($editData->profile_photo_path) ? url('AdminAsset/UserProfileImage/no_image.jpg') : url($editData->profile_photo_path))}}" id="showImage" class="rounded avatar-lg img-centered"/>
    </div>
    
</div>
<div class="mt-2">
    <x-submit-button-comp/>
</div>
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