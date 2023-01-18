@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<x-box-comp>
    <x-slot name="boxTitle">Edit The Assigned Subject</x-slot>
    <x-slot name="buttonArea">
        <a class="btn btn-app btn-info" href="{{route('assignsubject.index')}}" style="float: right;">
            <i class="fa fa-eye"></i> View Assigned Subject
        </a>
    </x-slot> 
    <form method="post" action="{{ route('assignsubject.update',$assSub[0]->class_id) }}">
        @csrf
        @method('PATCH')
    <div class="row">
        <div class="col-12">
            <div class="add_item">
    <div class="form-group">
            <h5>Select Class <x-required-sign/></h5>
            <div class="input-group">
                <select class="form-control" name="class_id" required>
               @foreach ($classes as $cls)
                   <option value="{{$cls->id}}" {{($assSub[0]->class_id==$cls->id) ? 'selected' : ''}}>{{$cls->class_name}}</option>
               @endforeach  
                </select> 
            </div>    
    </div> 
@foreach ($assSub as $sub)
    <div class="delete_whole_extra_item_add" id="delete_whole_extra_item">
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <h5>Select Subject <x-required-sign/></h5>
                    <div class="input-group">
                        <select name="subject_id[]" class="form-control" required>
                            @foreach ($subjects as $subs)
                                <option value="{{$subs->id}}" {{($sub->subject_id==$subs->id) ? 'Selected' : ''}}>{{$subs->subject_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <h5>Passing Mark <x-required-sign/></h5>
                        <div class="input-group">
                            <input type="number" class="form-control" name="pass_mark[]" required value="{{$sub->pass_mark}}"/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <h5>Full Mark <x-required-sign/></h5>
                        <div class="input-group">
                            <input type="number" class="form-control" name="full_mark[]" required value="{{$sub->full_mark}}"/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <h5>Subjective Mark <x-required-sign/></h5>
                        <div class="input-group">
                            <input type="number" class="form-control" name="subjective_mark[]" required value="{{$sub->subjective_mark}}"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-2" style="padding-top: 25px;">
                    <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> </span> 
                    <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i> </span>      		
                </div>
            
        </div>
    </div>
@endforeach

            </div> <!--end Item-->
            <x-submit-button-comp/>
        </div>
        
    </div>
    </form>
<!--Append Field Area--->
<div style="visibility: hidden;">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
    <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">  
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <h5>Select Subject <x-required-sign/></h5>
                    <div class="input-group">
                        <select class="form-control" id="subject_id" name="subject_id[]" required>
                            <option selected value disabled>Select Subject</option>
                            @foreach ($subjects as $sub)
                                <option value="{{$sub->id}}">{{$sub->subject_name}}</option>
                            @endforeach
                        </select>
                        @error('subject_id')
                            <x-alert-comp>{{$message}}</x-alert-comp>
                        @enderror
                    </div>
                </div>
            </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <h5>Full Mark <x-required-sign/></h5>
                        <div class="input-group">
                            <input type="number" class="form-control" name="full_mark[]" required value="{{old('full_mark')}}"/>
                        </div>
                        @error('full_mark')
                        <x-alert-comp>{{$message}}</x-alert-comp>
                        @enderror
                    </div>
                </div>
    
                <div class="col-sm-2">
                    <div class="form-group">
                        <h5>Passing Mark <x-required-sign/></h5>
                        <div class="input-group">
                            <input type="number" class="form-control" name="pass_mark[]" required value="{{old('pass_mark')}}"/>
                        </div>
                        @error('pass_mark')
                        <x-alert-comp>{{$message}}</x-alert-comp>
                        @enderror
                    </div>
                </div>
    
                <div class="col-sm-2">
                    <div class="form-group">
                        <h5>Subjective Mark <x-required-sign/></h5>
                        <div class="input-group">
                            <input type="number" class="form-control" name="subjective_mark[]" required value="{{old('subjective_mark')}}"/>
                        </div>
                        @error('subjective_mark')
                        <x-alert-comp>{{$message}}</x-alert-comp>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-2 col-md-2" style="padding-top: 16px">
                    <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> </span>
                    <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i> </span>     		
                </div>
           
        </div>
    </div>
    </div>
    <!--end of Append Field Area-->
</x-box-comp>
@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        var counter = 0;
        $(document).on("click",".addeventmore",function(){
            var whole_extra_item_add = $('#whole_extra_item_add').html();
            $(this).closest(".add_item").append(whole_extra_item_add);
            counter++;
        });
        $(document).on("click",'.removeeventmore',function(event){
            $(this).closest(".delete_whole_extra_item_add").remove();
            counter -= 1
        });

    });
</script>
@endsection
@endsection