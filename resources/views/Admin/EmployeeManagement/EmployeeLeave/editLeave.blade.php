@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<x-box-comp>
    <x-slot name="boxTitle">Update Employee Leave</x-slot>
    <x-slot name="buttonArea">
        <a class="btn btn-app btn-info" href="{{route('leave.view')}}" style="float: right;">
            <i class="fa fa-eye"></i> View Employee Leave Data
        </a>
    </x-slot> 
    <form method="POST" action="{{route('leave.update',$editData->id)}}">
    @csrf
    <div class="row">
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <h5>Employee Name <x-required-sign/></h5>
                <div class="input-group">
                    <select class="form-control form-select" name="emp_id" id="emp_id" required>
                        <option selected value disabled>Employee Name {{old('emp_id')}}</option>
                        @foreach ($employees as $emp)
                           <option value="{{$emp->id}}" {{($editData->emp_id==$emp->id) ? ' selected="selected"' : ''}}>{{$emp->name}}</option> 
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <h5>From Date <x-required-sign/></h5>
                <div class="input-group">
                    <input type="date" class="form-control" name="start_date" id="start_date" required value="{{$editData->start_date}}">
                </div>
            </div>

        </div>
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <h5>To Date <x-required-sign/></h5>
                <div class="input-group">
                    <input type="date" class="form-control" name="end_date" id="end_date" required value="{{$editData->end_date}}">
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-sm-6">

<div class="form-group">
<h5>Select Pupose <x-required-sign/></h5>
<div class="input-group">
    <select class="form-control form-select" name="leave_purpose_id" id="leave_purpose_id" required>
        
@foreach ($leavesPurpose as $leave)
    <option value="{{$leave->id}}" {{($editData->leave_purpose_id==$leave->id) ? ' selected="selected"' : ''}}>{{$leave->purpose_name}}</option>
@endforeach
 <option value="0">New Purpose</option>
    </select>
</div>
</div>

        </div>
        <div class="col-sm-6 col-sm-6" id="add_more" style="display: none">
            <h5>Create New Purpose <x-required-sign/></h5>
            <div class="input-group">
                <input type="text" class="form-control" name="purpose_name" value="{{old('purpose_name')}}">
            </div>
        </div>
    </div>
<div class="mt-2">
    <x-submit-button-comp/>
</div>
    </form>
</x-box-comp>
@section('js')
    <script type="text/javascript">
    $(document).ready(function(){
$(document).on('change','#leave_purpose_id',function(){
   var leavePurId=$(this).val();
   if(leavePurId==='0'){
    $('#add_more').show();
   }else{
    $('#add_more').hide();
   }
});
    });
    </script>
@endsection
@endsection