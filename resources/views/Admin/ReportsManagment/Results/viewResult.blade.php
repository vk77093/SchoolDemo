@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<x-box-comp>
    <x-slot name="boxTitle">View Student Results and Generate</x-slot>
    <x-slot name="buttonArea">
        <a class="btn btn-app btn-info" href="{{route('student.view.class')}}" style="float: right;">
            <i class="fa fa-eye"></i> View Classes
        </a>
    </x-slot>
    <form action="{{route('result.getpdf')}}" method="Get" target="_blank">
        @csrf
        <div class="row">
            <div class="col-sm-3 col-md-3">
                <div class="form-group">
                    <h5>Select Year <x-required-sign/></h5>
                    <div class="input-group">
<select class="form-control" id="year_id" name="year_id" required>
    <option selected value disabled>--Select Year---</option>
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
                        <select class="form-control" id="class_id" name="class_id" required>
                            <option selected value disabled>--Select Class---</option>
                            @foreach ($classes as $class)
                                <option value="{{$class->id}}">{{$class->class_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3">
                <div class="form-group">
                    <h5>Select Exam Type <x-required-sign/></h5>
                    <div class="input-group">
                        <select class="form-control" id="exam_type_id" name="exam_type_id" required>
                            <option selected value disabled>--Select Exam Type---</option>
                            @foreach ($examTypes as $exam)
                                <option value="{{$exam->id}}">{{$exam->exam_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3">
                <div class="form-group">
                    <h5></h5>
                    <div class="input-group">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-box-comp>
@endsection