@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<x-box-comp>
    <x-slot name="boxTitle">Create Fee Category Amount</x-slot>
    <x-slot name="buttonArea">
        <a class="btn btn-app btn-info" href="{{route('feecateamount.index')}}" style="float: right;">
            <i class="fa fa-eye"></i> View Fee Category AMount
        </a>
    </x-slot> 

<form method="post" action="{{ route('feecateamount.update',$feecateamt[0]->fee_cate_id) }}">
       @csrf
       @method('PATCH')
                    <div class="row">
                      <div class="col-12">
                      <div class="add_item">
                          
                       

   <div class="form-group">
  <h5>Fee Category<span class="text-danger">*</span></h5>
  <div class="controls">
   <select name="fee_cate_id" required="" class="form-control">
      <option value="" selected="" disabled="">Select Fee Category</option>
      @foreach($categories as $category)
      <option value="{{ $category->id }}" {{ ($feecateamt['0']->fee_cate_id == $category->id)? "selected":"" }}>{{ $category->fee_cate_name }}</option>
      @endforeach	 
      </select>
   </div>
</div> <!-- // end form group -->


@foreach($feecateamt as $edit)
<div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
      <div class="row">
       <div class="col-md-5">

 <div class="form-group">
  <h5>Student Class <span class="text-danger">*</span></h5>
  <div class="controls">
   <select name="class_id[]" required="" class="form-control">
      <option value="" selected="" disabled="">Select Fee Category</option>
      @foreach($classes as $class)
      <option value="{{ $class->id }}" {{ ($edit->class_id == $class->id)? "selected": ""  }}  >{{ $class->class_name }}</option>
      @endforeach	 
      </select>
   </div>
        </div> <!-- // end form group -->


       </div> <!-- End col-md-5 -->

       <div class="col-md-5">
           
    <div class="form-group">
      <h5>Amount <span class="text-danger">*</span></h5>
      <div class="controls">
   <input type="text" name="cate_amount[]" value="{{ $edit->cate_amount }}" class="form-control" > 
    </div>		 
  </div>

       </div><!-- End col-md-5 -->

       <div class="col-md-2" style="padding-top: 25px;">
<span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> </span> 
<span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i> </span>      		
       </div><!-- End col-md-5 -->
       
   </div> <!-- end Row -->
</div> <!-- // End Remove Delete  -->
  @endforeach
   

</div>	<!-- // End add_item -->
                           
           <div class="text-xs-right">
<input type="submit" class="btn btn-rounded btn-info mb-5" value="Update">
                      </div>
                  </form>

                </div>  			
            </div>  		
        </div>  	
    </div>         


<div style="visibility: hidden;">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
        <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
            <div class="form-row">

  <div class="col-md-5">
                    
 <div class="form-group">
  <h5>Student Class <span class="text-danger">*</span></h5>
  <div class="controls">
   <select name="class_id[]" required="" class="form-control">
      <option value="" selected="" disabled="">Select Fee Category</option>
      @foreach($classes as $class)
      <option value="{{ $class->id }}">{{ $class->class_name }}</option>
      @endforeach	 
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