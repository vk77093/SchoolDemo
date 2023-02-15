@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<x-box-comp>
    <x-slot name="boxTitle">View Student Marksheet and Generate</x-slot>
    <x-slot name="buttonArea">
        <a class="btn btn-app btn-info" href="{{route('student.view.class')}}" style="float: right;">
            <i class="fa fa-eye"></i> View Classes
        </a>
    </x-slot>
    <form action="{{ route('marksheet.get') }}" method="get" target="_blank">
        @csrf
    
    <div class="row">
        <div class="col-sm-3 col-md-3">
            <div class="form-group">
                <h5>Select Year <x-required-sign/></h5>
                <div class="input-group">
                    <select class="form-control" id="year_id" name="year_id" required value="{{old('year_id')}}">
                    <option selected value disabled>{{old('year_id')}} --Select Year--</option>
                    @foreach ($years as $year)
                        <option value="{{$year->id}}">{{$year->year_name}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-sm-3 col-md-3">
            <div class="form-group">
                <h5>Select Class <x-required-sign/></h5>
                <div class="input-group">
                    <select class="form-control" id="class_id" name="class_id" required value="{{old('class_id')}}">
                    <option selected value disabled>{{old('class_id')}} --Select Year--</option>
                    @foreach ($classes as $cls)
                        <option value="{{$cls->id}}">{{$cls->class_name}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-sm-3 col-md-3">
            <div class="form-group">
                <h5>Select Exam Type <x-required-sign/></h5>
                <div class="input-group">
                    <select class="form-control" id="exam_type_id" name="exam_type_id" required value="{{old('exam_type_id')}}">
                    <option selected value disabled>{{old('exam_type_id')}} --Select Year--</option>
                    @foreach ($examTypes as $exa)
                        <option value="{{$exa->id}}">{{$exa->exam_name}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-sm-3 col-md-3">
            <div class="form-group">
                <h5>Student Id Number <x-required-sign/></h5>
                <div class="input-group">
                    <input type="number" class="form-control" id="stu_IdNumber" name="stu_IdNumber" value="{{old('stu_IdNumber')}}" required>
                </div>
            </div>
        </div>
        <div class="pt-2 pl-2 pr-2">
            <button id="search" type="submit" class="btn btn-primary" name="search"> Search</button> 
        </div>
    </div>
</form>
</x-box-comp>
@endsection