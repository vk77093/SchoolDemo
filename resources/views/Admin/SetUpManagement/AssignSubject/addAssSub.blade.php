@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<x-box-comp>
    <x-slot name="boxTitle">Assign Subject</x-slot>
    <x-slot name="buttonArea">
        <a class="btn btn-app btn-info" href="{{route('assignsubject.index')}}" style="float: right;">
            <i class="fa fa-eye"></i> View Fee Assigned Subject
        </a>
    </x-slot> 
    <form method="post" action="{{ route('assignsubject.store') }}">
        @csrf
        <div class="add_item"> <!-- Button Action-->
            <div class="row">
                <div class="col-sm-12 mb-1">
                    <div class="form-group">
                        <h5>Select Class : <x-required-sign/></h5>
                        <div class="input-group">
                            <select class="form-control form-select" name="class_id" required>
                                <option selected value disabled>Select class</option>
                                @foreach ($classes as $cls)
                                    <option value="{{$cls->id}}">{{$cls->class_name}}</option>
                                @endforeach
                            </select>
                            @error('class_id')
                                <x-alert-comp>{{$message}}</x-alert-comp>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
         <!--end of class-->
         <hr/>
         <div class="row">
            <div class="col-sm-4">
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
            </div>

        </div>   
        </div> <!--end of Button Add-->
        <x-submit-button-comp/>
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