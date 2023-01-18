@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<x-box-comp>
    <x-slot name="boxTitle">Create Fee Category Amount</x-slot>
    <x-slot name="buttonArea">
        <a class="btn btn-app btn-info" href="{{route('feecateamount.index')}}" style="float: right;">
            <i class="fa fa-eye"></i> View Fee Category AMount
        </a>
    </x-slot> 
    <form method="post" action="{{ route('feecateamount.store') }}">
    @csrf
     <!--Add Item Div--->
    <div class="add_item">
    <div class="row">
       
        <div class="col-sm-12">
           
           
            <x-input-form-comp>
                <x-slot name="labelName">Select fee Category</x-slot>
                <select class="form-control form-select" name="fee_cate_id" required value="{{old('fee_cate_id')}}">
                <option selected value disabled>--select Fee Category--</option>
                @foreach ($categories as $cate)
                    <option value="{{$cate->id}}">{{$cate->fee_cate_name}}</option>
                @endforeach
                @error('fee_cate_id')
                    <x-alert-comp>{{$message}}</x-alert-comp>
                @enderror
                </select>
            </x-input-form-comp>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-sm-5">
            <x-input-form-comp>
            <x-slot name="labelName">Select Class</x-slot>
            <select class="form-control form-select" name="class_id[]" required value="{{old('class_id[]')}}">
            <option selected value disabled>--select Class--</option>
            @foreach ($classes as $cls)
                <option value="{{$cls->id}}">{{$cls->class_name}}</option>
            @endforeach
            @error('class_id')
                <x-alert-comp>{{$message}}</x-alert-comp>
            @enderror
            </select>
        </x-input-form-comp> 
        </div>
        <div class="col-sm-5">
            <x-input-form-comp>
                <x-slot name="labelName">Amount</x-slot>
                <input type="number" class="form-control" name="cate_amount[]" value="{{old('cate_amount[]')}}" required/>
                @error('cate_amount')
                <x-alert-comp>{{$message}}</x-alert-comp>
                @enderror
            </x-input-form-comp>
        </div>
        <div class="col-md-2" style="padding-top: 2px;">
            <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> </span>    		
        </div>
   
    </div>
</div> <!--end of add_item -->
<div class="text-xs-right">
    <input type="submit" class="btn btn-rounded btn-info mb-5" value="Submit">
    </div>
    </form>
    <div style="visibility: hidden;">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                <div class="form-row">
  
      <div class="col-md-5">
                        
     <div class="form-group">
      <h5>Student Class <span class="text-danger">*</span></h5>
      <div class="controls">
       <select name="class_id[]" required="" class="form-control">
          <option value="" selected="" disabled="">Select Class</option>
          @foreach($classes as $class)
          <option value="{{ $class->id }}">{{ $class->class_name }}</option>
          @endforeach	
          @error('class_id')
                    <x-alert-comp>{{$message}}</x-alert-comp>
                @enderror 
          </select>
       </div>
            </div> <!-- // end form group -->
           </div> <!-- End col-md-5 -->
  
           <div class="col-md-5">
               
        <div class="form-group">
          <h5>Amount <span class="text-danger">*</span></h5>
          <div class="controls">
       <input type="text" name="cate_amount[]" class="form-control" > 
        </div>	
        @error('cate_amount')
        <x-alert-comp>{{$message}}</x-alert-comp>
    @enderror  
      </div>
           </div><!-- End col-md-5 -->
  
           <div class="col-md-2" style="padding-top: 25px;">
   <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> </span>
    <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i> </span>    		
           </div><!-- End col-md-2 -->
           
  
  
                    
                </div>  			
            </div>  		
        </div>  	
    </div>
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