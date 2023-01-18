@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<x-box-comp>
    <x-slot name="boxTitle">Edit Student Group</x-slot>
    <x-slot name="buttonArea">
        <a class="btn btn-app btn-info" href="{{route('studentgroup.index')}}" style="float: right;">
            <i class="fa fa-eye"></i> View Year
        </a>
    </x-slot> 
    <form method="post" action="{{route('studentgroup.update',$student->id)}}">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="col-sm-6">
            <x-input-form-comp>
                <x-slot name="labelName">Group Name</x-slot>
                <input type="text" class="form-control" name="group_name" required value="{{$student->group_name}}" autofocus/>
                @error('group_name')
                    <x-alert-comp>{{$message}}</x-alert-comp>
                @enderror
            </x-input-form-comp>
        </div>
    </div>
    <x-submit-button-comp/>
    </form>
</x-box-comp>
@endsection