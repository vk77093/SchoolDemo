@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<x-box-comp>
    <x-slot name="boxTitle">Edit The Student Data</x-slot>
    <x-slot name="buttonArea">
        <a class="btn btn-app btn-info" href="{{route('registration.index')}}" style="float: right;">
            <i class="fa fa-eye"></i> View Registred Students
        </a>
    </x-slot> 
    <form method="post" action="{{route('registration.update',$editData->stu_id)}}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <input type="hidden" name="id" value="{{$editData->id}}"/>
    <div class="row">
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <h5>Student Name <x-required-sign/></h5>
                <div class="input-group">
                    <input type="text" class="form-control" name="name" required value="{{$editData->UserName->name}}"/>
                </div>
            </div>
        </div> <!--end of col-->
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <h5>Father Name <x-required-sign/></h5>
                <div class="input-group">
                    <input type="text" class="form-control" name="fname" required value="{{$editData->UserName->fname}}"/>
                </div>
            </div>
        </div> <!--end of col-->
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <h5>Mother Name <x-required-sign/></h5>
                <div class="input-group">
                    <input type="text" class="form-control" name="mname" required value="{{$editData->UserName->mname}}"/>
                </div>
            </div>
        </div> <!--end of col-->
    </div> <!--end of first row -->
    <div class="row mb-1 mt-1">
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <h5>Mobile Number <x-required-sign/></h5>
                <div class="input-group">
                    <input type="text" class="form-control" name="mobile" required value="{{$editData->UserName->mobile}}"/>
                </div>
            </div>
        </div> <!--end of col-->
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <h5>Student Address <x-required-sign/></h5>
                <div class="input-group">
                    <input type="text" class="form-control" name="address" required value="{{$editData->UserName->address}}"/>
                </div>
            </div>
        </div> <!--end of col-->
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <h5>Select Gender <x-required-sign/></h5>
                <div class="input-group">
                   <select class="form-control form-select" name="gender" id="gender" required value="{{old('gender')}}">
                    <option selected value disabled>--select Gender-- {{old('gender')}}</option>
                    <option value="Male" {{($editData->UserName->gender =='Male') ?'Selected' :''}}>Male</option>
                    <option value="FeMale" {{($editData->UserName->gender =='FeMale') ?'Selected' :''}}>FeMale</option>
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
                   <select class="form-control form-select" name="religion" id="religion" required value="{{old('religion')}}">
                    <option selected value disabled>--Select Religion-- {{old('religion')}}</option>
                    <option value="Hindu" {{($editData->UserName->religion=='Hindu')? 'selected':''}}>Hindu</option>
                    <option value="Muslim" {{($editData->UserName->religion=='Muslim')? 'selected':''}}>Muslim</option>
                    <option value="Sikh" {{($editData->UserName->religion=='Sikh')? 'selected':''}}>Sikh</option>
                    <option value="Christan" {{($editData->UserName->religion=='Christan')? 'selected':''}}>Christan</option>
                  </select>
                </div>
            </div>
        </div> <!--end of col-->
        <div class="col-sm-4 col-md-4">
            <h5>Date Of Birth <x-required-sign/></h5>
            <div class="input-group">
                <input type="date" class="form-control" name="dob" id="dob" required value="{{$editData->UserName->dob}}"/>
            </div>
        </div> <!--end of col-->
        <div class="col-sm-4 col-md-4">
            <h5>Allowed Discount <x-required-sign/></h5>
            <div class="input-group">
                <input type="number" class="form-control" name="discount" id="discount" required value="{{$editData->discount->discount}}"/>
            </div>
        </div> <!--end of col-->
    </div> <!--end of 3rd row-->
    <div class="row mt-1 mb-1">
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <h5>Select Year <x-required-sign/></h5>
                <div class="input-group">
                   <select class="form-control form-select" name="year_id" id="year_id" required>
                    <option selected value disabled>--Select year-- {{old('year_id')}}</option>
                    @foreach ($years as $item)
                        <option value="{{$item->id}}" {{($editData->YearName->id==$item->id) ? ' selected="selected"' : ''}}>{{$item->year_name}}</option>
                    @endforeach
                  </select>
                </div>
            </div>
        </div> <!--end of col-->
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <h5>Select Class <x-required-sign/></h5>
                <div class="input-group">
                   <select class="form-control form-select" name="class_id" id="class_id" required value="{{old('class_id')}}">
                    <option selected value disabled>--Select Class-- {{old('class_id')}}</option>
                    @foreach ($classes as $item)
                        <option value="{{$item->id}}" {{($editData->ClassName->id==$item->id) ? ' selected="selected"' : ''}}>{{$item->class_name}}</option>
                    @endforeach
                  </select>
                </div>
            </div>
        </div> <!--end of col-->
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <h5>Select Student Group <x-required-sign/></h5>
                <div class="input-group">
                   <select class="form-control form-select" name="group_id" id="group_id" required value="{{old('group_id')}}">
                    <option selected value disabled>--Select year-- {{old('group_id')}}</option>
                    @foreach ($groups as $item)
                        <option value="{{$item->id}}" {{($editData->GroupName->id==$item->id) ? ' selected="selected"' : ''}}>{{$item->group_name}}</option>
                    @endforeach
                  </select>
                </div>
            </div>
        </div> <!--end of col-->
    </div> <!--end of 4th row-->
    <div class="row mb-1 mt-1">
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <h5>Select Student Shifts <x-required-sign/></h5>
                <div class="input-group">
                   <select class="form-control form-select" name="shift_id" id="shift_id" required value="{{old('shift_id')}}">
                    <option selected value disabled>--Select Shift-- {{old('shift_id')}}</option>
                    @foreach ($shifts as $item)
                        <option value="{{$item->id}}" {{($editData->ShiftName->id==$item->id) ?'selected' :''}}>{{$item->shift_name}}</option>
                    @endforeach
                  </select>
                </div>
            </div>
        </div> <!--end of col-->
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <h5>Select Profile Image <x-required-sign/> </h5>
                <input type="file" class="form-control" name="profile_photo_path" id="profile_photo_path"/>
            </div>
        </div>
        <div class="col-sm-4 col-md-4 mt-2">
            <img src="{{(empty($editData->UserName->profile_photo_path)? url('AdminAsset/UserProfileImage/no_image.jpg') : url($editData->UserName->profile_photo_path))}}" id="showImage" class="rounded avatar-lg img-centered"/>
        </div>
    </div><!--end of 5th row-->
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