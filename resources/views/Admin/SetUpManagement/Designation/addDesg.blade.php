@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<x-box-comp>
    <x-slot name="boxTitle">Create Designations</x-slot>
    <x-slot name="buttonArea">
        <a class="btn btn-app btn-info" href="{{route('designation.index')}}" style="float: right;">
            <i class="fa fa-eye"></i> View Designations
        </a>
    </x-slot> 
    <form method="post" action="{{route('designation.store')}}">
    @csrf
    <div class="row">
        <div class="col-sm-6">
            <x-input-form-comp>
                <x-slot name="labelName">Designation Name</x-slot>
                <input type="text" class="form-control" name="desg_name" required value="{{old('desg_name')}}" autofocus/>
                @error('desg_name')
                    <x-alert-comp>{{$message}}</x-alert-comp>
                @enderror
            </x-input-form-comp>
        </div>
    </div>
    <x-submit-button-comp/>
    </form>
</x-box-comp>
@endsection