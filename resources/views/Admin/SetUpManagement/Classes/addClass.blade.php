@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<x-box-comp>
    <x-slot name="boxTitle">View Classes</x-slot>
    <x-slot name="buttonArea">
        <a class="btn btn-app btn-info" href="{{route('student.view.class')}}" style="float: right;">
            <i class="fa fa-eye"></i> View Classes
        </a>
    </x-slot> 
    <form method="post" action="{{route('student.add.class')}}">
    @csrf
    <div class="row">
        <div class="col-sm-6">
            <x-input-form-comp>
                <x-slot name="labelName">Class Name</x-slot>
                <input type="text" class="form-control" name="class_name" required value="{{old('class_name')}}" autofocus/>
                @error('class_name')
                    <x-alert-comp>{{$message}}</x-alert-comp>
                @enderror
            </x-input-form-comp>
        </div>
    </div>
    <x-submit-button-comp/>
    </form>
</x-box-comp>
@endsection