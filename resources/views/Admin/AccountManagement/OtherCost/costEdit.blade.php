@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<x-box-comp>
    <x-slot name="boxTitle">Edit The Cost Info</x-slot>
    <x-slot name="buttonArea">
        <a class="btn btn-app btn-info" href="{{route('cost.view')}}" style="float: right;">
            <i class="fa fa-eye"></i> View Cost Data
        </a>
    </x-slot> 
    <form method="post" action="{{route('cost.update',$editCost->id)}}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-sm-3 col-md-3">
            <div class="form-group">
                <h5>Date <x-required-sign/></h5>
                <input type="date" class="form-control" name="cost_date" id="cost_date" required value="{{$editCost->cost_date}}">
            </div>
        </div>
        <div class="col-sm-3 col-md-3">
            <div class="form-group">
                <h5>Amount <x-required-sign/></h5>
                <input type="number" class="form-control" name="cost_amount" id="cost_amount" required value="{{$editCost->cost_amount}}">
            </div>
        </div>
        <div class="col-sm-3 col-md-3">
            <div class="form-group">
                <h5>Reference Pic <x-required-sign/></h5>
                <input type="file" class="form-control" name="pro_image_path" id="pro_image_path"  value="{{url($editCost->pro_image_path)}}"/>
                @error('pro_image_path')
                    <x-alert-comp>{{$message}}</x-alert-comp>
                @enderror
            </div>
        </div>
        <div class="col-sm-3 col-md-3">
            <div class="form-group">
                <img src="{{(!empty($editCost->pro_image_path) ? url($editCost->pro_image_path) : url('AdminAsset/UserProfileImage/no_image.jpg'))}}" id="showImage" class="rounded avatar-lg img-centered"> 
            </div>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-sm-6 col-md-6">
            <div class="form-group">
                <h5>Description<x-required-sign/></h5>
               <textarea class="form-control" name="pro_description" id="pro_description" required value="{{$editCost->pro_description}}">
                {{$editCost->pro_description}}
               </textarea>
               @error('pro_description')
                    <x-alert-comp>{{$message}}</x-alert-comp>
                @enderror
            </div>
        </div>
    </div>
    <div class="row mt-1">
        <x-submit-button-comp/>
    </div>
    </form>

</x-box-comp>
@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('#pro_image_path').change(function(e){
            var reader=new FileReader();
            reader.onload=function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    });
    </script> 
@endsection
@endsection