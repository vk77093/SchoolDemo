@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<x-box-comp>
    <x-slot name="boxTitle">Promote Student To Next Class</x-slot>
    <x-slot name="buttonArea">
        <a class="btn btn-app btn-info" href="{{route('registration.index')}}" style="float: right;">
            <i class="fa fa-eye"></i> View Registred Students
        </a>
    </x-slot> 
    <form method="post" action="{{ route('registration.updatepromote',$editData->stu_id) }}">
   @csrf
   <input type="hidden" name="id" value="{{$editData->id}}"/>
   <div class="row">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <h5>Student Name <x-required-sign/></h5>
            <div class="input-group">
                <input type="text" class="form-control" name="name" required value="{{$editData->UserName->name}}" readonly/>
            </div>
        </div>
    </div> <!--end of col-->
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <h5>Father Name <x-required-sign/></h5>
            <div class="input-group">
                <input type="text" class="form-control" name="fname" required value="{{$editData->UserName->fname}}" readonly/>
            </div>
        </div>
    </div> <!--end of col-->
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <h5>Mother Name <x-required-sign/></h5>
            <div class="input-group">
                <input type="text" class="form-control" name="mname" required value="{{$editData->UserName->mname}}" readonly/>
            </div>
        </div>
    </div> <!--end of col-->
   </div> <!--first row end non editiable--->
   <h4 class="text-center text-info">Promote Student to Next Class</h4>
   <div class="row mt-1 mb-1">
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
    </div> <!--end of col--->
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
    <div class="col-sm-4 col-md-4 mt-2">
        <button type="button" class="btn btn-info" id="buttonText" onclick="ShowAreaButton()">Do You Want To Update More Data</button>
    </div>
   </div> <!--end of 2nd row--->
   <!--more filed Show---->
   <div id="ShowField" style="display: none">
    <div class="row mt-1 mb-1">
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
            <h5>Allowed Discount <x-required-sign/></h5>
            <div class="input-group">
                <input type="number" class="form-control" name="discount" id="discount" required value="{{$editData->discount->discount}}"/>
            </div>
        </div> <!--end of col-->
    </div><!---end of row-->
    </div>
   <!--end of more filed Show---->
   <div class="mt-2">
    <button type="submit" class="btn btn-info">Promote Student</button>
   </div>
    </form>
</x-box-comp>
@section('js')
  <script>
    var showArea=document.getElementById('ShowField');
    var buttonText=document.getElementById('buttonText');
   function ShowAreaButton(){
    if(showArea.style.display=='none'){
        showArea.style.display="block";
buttonText.textContent="No I Don't want to Add More";
    }else{
        showArea.style.display="none";
buttonText.textContent="Yes I Want To Update More Data";
    }

   }
  </script>

@endsection
@endsection