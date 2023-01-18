@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<x-box-comp>
    <x-slot name="boxTitle">Edit Year</x-slot>
    <x-slot name="buttonArea">
        <a class="btn btn-app btn-info" href="{{route('student.view.year')}}" style="float: right;">
            <i class="fa fa-eye"></i> View Year
        </a>
    </x-slot> 
    <form method="post" action="{{route('student.update.year',$year->id)}}">
    @csrf
    <div class="row">
        <div class="col-sm-6">
            <x-input-form-comp>
                <x-slot name="labelName">Year Name</x-slot>
                <input type="text" class="form-control" name="year_name" required value="{{$year->year_name}}" autofocus/>
                @error('year_name')
                    <x-alert-comp>{{$message}}</x-alert-comp>
                @enderror
            </x-input-form-comp>
        </div>
    </div>
    <x-submit-button-comp/>
    </form>
</x-box-comp>
@endsection