@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<x-box-comp>
    <x-slot name="boxTitle">Create Subject Types</x-slot>
    <x-slot name="buttonArea">
        <a class="btn btn-app btn-info" href="{{route('subject.index')}}" style="float: right;">
            <i class="fa fa-eye"></i> View Subject Types
        </a>
    </x-slot> 
    <form method="post" action="{{route('subject.store')}}">
    @csrf
    <div class="row">
        <div class="col-sm-6">
            <x-input-form-comp>
                <x-slot name="labelName">Subject Name</x-slot>
                <input type="text" class="form-control" name="subject_name" required value="{{old('subject_name')}}" autofocus/>
                @error('subject_name')
                    <x-alert-comp>{{$message}}</x-alert-comp>
                @enderror
            </x-input-form-comp>
        </div>
    </div>
    <x-submit-button-comp/>
    </form>
</x-box-comp>
@endsection