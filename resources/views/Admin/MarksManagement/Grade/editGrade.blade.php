@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<x-box-comp>
    <x-slot name="boxTitle">Edit Grade</x-slot>
    <x-slot name="buttonArea">
        <a class="btn btn-app btn-info" href="{{route('grade.view')}}" style="float: right;">
            <i class="fa fa-eye"></i> View Grade
        </a>
    </x-slot> 
   <form method="post" action="{{ route('grade.update',$grade->id) }}">
    @csrf
    <div class="row mb-1">
        <div class="col-sm-3 col-md-3">
<div class="form-group">
    <h5>Grade Name <x-required-sign/></h5>
    <div class="input-group">
        <input type="text" class="form-control" required name="grade_name" id="grade_name" value="{{$grade->grade_name}}">
        @error('grade_name')
        <x-alert-comp>{{$message}}</x-alert-comp>
        @enderror
    </div>
</div>
        </div>
         <div class="col-sm-3 col-md-3">
<div class="form-group">
    <h5>Grade Point <x-required-sign/></h5>
    <div class="input-group">
        <input type="number" class="form-control" required name="grade_point" id="grade_point" value="{{$grade->grade_point}}">
        @error('grade_point')
        <x-alert-comp>{{$message}}</x-alert-comp>
        @enderror
    </div>
</div>
        </div>
         <div class="col-sm-3 col-md-3">
<div class="form-group">
    <h5>Start Marks <x-required-sign/></h5>
    <div class="input-group">
        <input type="number" class="form-control" required name="start_marks" id="start_marks" value="{{$grade->start_marks}}">
    </div>
</div>
        </div>
         <div class="col-sm-3 col-md-3">
<div class="form-group">
    <h5>End Marks <x-required-sign/></h5>
    <div class="input-group">
        <input type="number" class="form-control" required name="end_marks" id="end_marks" value="{{$grade->end_marks}}">
    </div>
</div>
        </div>
    </div> <!--end of row-->
    <div class="row mt-1">
<div class="col-sm-4 col-md-4">
<div class="form-group">
    <h5>Start Point <x-required-sign/></h5>
    <div class="input-group">
        <input type="number" class="form-control" required name="start_point" id="start_point" value="{{$grade->start_point}}">
    </div>
</div>
        </div>
        <div class="col-sm-3 col-md-3">
<div class="form-group">
    <h5>End Point <x-required-sign/></h5>
    <div class="input-group">
        <input type="number" class="form-control" required name="end_point" id="end_point" value="{{$grade->end_point}}">
    </div>
</div>
        </div>
        <div class="col-sm-3 col-md-3">
            <div class="form-group">
                <h5>Remarks <x-required-sign/></h5>
                <div class="input-group">
                    <input type="text" class="form-control" required name="remarks" id="remarks" value="{{$grade->remarks}}">
                </div>
            </div>
            </div>
    </div>
    <div class="row mt-1">
        <button class="btn btn-primary" type="submit">Update Grade Point</button>
    </div>
   </form>
</x-box-comp>
@endsection