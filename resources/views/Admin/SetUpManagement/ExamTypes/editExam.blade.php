@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<x-box-comp>
    <x-slot name="boxTitle">Edit Exam Type</x-slot>
    <x-slot name="buttonArea">
        <a class="btn btn-app btn-info" href="{{route('examtype.index')}}" style="float: right;">
            <i class="fa fa-eye"></i> View Exam Type
        </a>
    </x-slot> 
    <form method="post" action="{{route('examtype.update',$exam->id)}}">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="col-sm-6">
            <x-input-form-comp>
                <x-slot name="labelName">Exam Name</x-slot>
                <input type="text" class="form-control" name="exam_name" required value="{{$exam->exam_name}}" autofocus/>
                @error('exam_name')
                    <x-alert-comp>{{$message}}</x-alert-comp>
                @enderror
            </x-input-form-comp>
        </div>
    </div>
    <x-submit-button-comp/>
    </form>
</x-box-comp>
@endsection