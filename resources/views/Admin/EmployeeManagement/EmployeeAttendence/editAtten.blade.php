@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<x-box-comp>
    <x-slot name="boxTitle">Edit Employee Attendence</x-slot>
    <x-slot name="buttonArea">
        <a class="btn btn-app btn-info" href="{{route('attendence.view')}}" style="float: right;">
            <i class="fa fa-eye"></i> View Attendence Data
        </a>
    </x-slot> 
    <form method="post" action="{{route('attendence.update',$editData[0]['attendence_date'])}}">
    @csrf
    <div class="row">
        <div class="col-sm-4 col-md-4">
<div class="form-group">
    <h5>Attendence Date <x-required-sign/></h5>
    <div class="input-group">
        <input type="date" class="form-control" name="attendence_date" id="attendence_date" required value="{{$editData[0]['attendence_date']}}">
    </div>
</div>
        </div>
        
    </div>
    <div class="row mt-1">
        <div class="col-md-12">
           <table class="table table-bordered table-stripped table-hover">
            <thead>
                <tr>
                    <th rowspan="2" class="text-center" style="vertical-align: middle;">Sl</th>
   	<th rowspan="2" class="text-center" style="vertical-align: middle;">Employee List</th>
   <th colspan="3" class="text-center" style="vertical-align: middle; width: 30%">Attendance Status</th>
                </tr>
                <tr>
                    <th class="text-center btn present_all" style="display: table-cell; background-color: #000000">Present</th>
                    <th class="text-center btn leave_all" style="display: table-cell; background-color: #000000">Leave</th>
                    <th class="text-center btn absent_all" style="display: table-cell; background-color: #000000">Absent</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($editData as $key => $emp)
                    <tr id="div{{$emp->emp_id}}" class="text-center">
                        <input type="hidden" name="emp_id[]" value="{{$emp->emp_id}}"/>
                    <td>{{$emp->key+1}}</td>
                    <td>{{$emp->UserName->name}}</td>
                    <td colspan="3">
                        <div class="switch-toggle switch-3 switch-candy">
                            <input type="radio" name="attendence_status{{$key}}" id="present{{$key}}" value="Present" checked="checked" {{($emp->attendence_status=='Present') ? 'checked' :''}}/>
                            <label for="present{{$key}}">Present</label>
                            <input name="attendence_status{{$key}}" value="Leave" type="radio" id="leave{{$key}}" {{($emp->attendence_status=='Leave') ? 'checked' :''}} >
 <label for="leave{{$key}}">Leave</label>

 <input name="attendence_status{{$key}}" value="Absent"  type="radio" id="absent{{$key}}" {{($emp->attendence_status=='absent') ? 'checked' :''}} >
 <label for="absent{{$key}}">Absent</label>
                        </div>
                    </td>
                    </tr>
                @endforeach
            </tbody>
            </table> 
        </div>
    </div>
    <div class="text-xs-right">
        <input type="submit" class="btn btn-rounded btn-info mb-5" value="Submit">
                           </div>
    </form>
</x-box-comp>
@endsection