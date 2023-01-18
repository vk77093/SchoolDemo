@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<x-box-comp>
    <x-slot name="boxTitle">Edit Fee Category</x-slot>
    <x-slot name="buttonArea">
        <a class="btn btn-app btn-info" href="{{route('feecategory.index')}}" style="float: right;">
            <i class="fa fa-eye"></i> View fee Category
        </a>
    </x-slot> 
    <form method="post" action="{{route('feecategory.update',$feecategory->id)}}">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="col-sm-6">
            <x-input-form-comp>
                <x-slot name="labelName">Fee Category Name</x-slot>
                <input type="text" class="form-control" name="fee_cate_name" required value="{{$feecategory->fee_cate_name}}" autofocus/>
                @error('fee_cate_name')
                    <x-alert-comp>{{$message}}</x-alert-comp>
                @enderror
            </x-input-form-comp>
        </div>
    </div>
    <x-submit-button-comp/>
    </form>
</x-box-comp>
@endsection