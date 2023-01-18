@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<x-box-comp>
    <x-slot name="boxTitle">Create Student Shift</x-slot>
    <x-slot name="buttonArea">
        <a class="btn btn-app btn-info" href="{{route('shift.index')}}" style="float: right;">
            <i class="fa fa-eye"></i> View Shift
        </a>
    </x-slot> 
    <form method="post" action="{{route('shift.store')}}">
    @csrf
    <div class="row">
        <div class="col-sm-6">
            <x-input-form-comp>
                <x-slot name="labelName">Shift Name</x-slot>
                <input type="text" class="form-control" name="shift_name" required value="{{old('shift_name')}}" autofocus/>
                @error('shift_name')
                    <x-alert-comp>{{$message}}</x-alert-comp>
                @enderror
            </x-input-form-comp>
        </div>
    </div>
    <x-submit-button-comp/>
    </form>
</x-box-comp>
@endsection