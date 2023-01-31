@extends('Admin.Backend.Layouts.adminMaster')
@section('main')

<div class="row">

      
<div class="col-12">
<div class="box bb-3 border-warning">
                <div class="box-header">
                  <h4 class="box-title">Student <strong>Roll Generator</strong></h4>
                </div>

                <div class="box-body">
              
      <form method="post" action="{{ route('assignrolenumber.post') }}">
          @csrf
          <div class="row">



<div class="col-md-4">

        <div class="form-group">
      <h5>Year <span class="text-danger"> </span></h5>
      <div class="controls">
   <select name="year_id" id="year_id" required="" class="form-control">
          <option value="" selected="" disabled="">Select Year</option>
           @foreach($years as $year)
<option value="{{ $year->id }}" >{{ $year->year_name }}</option>
           @endforeach
           
      </select>
    </div>		 
    </div>
    
           </div> <!-- End Col md 4 --> 



           
       <div class="col-md-4">

        <div class="form-group">
      <h5>Class <span class="text-danger"> </span></h5>
      <div class="controls">
   <select name="class_id" id="class_id"  required="" class="form-control">
          <option value="" selected="" disabled="">Select Class</option>
           @foreach($classes as $class)
          <option value="{{ $class->id }}">{{ $class->class_name }}</option>
           @endforeach
           
      </select>
    </div>		 
    </div>
    
           </div> <!-- End Col md 4 --> 


           <div class="col-md-4" style="padding-top: 25px;">

<a id="search" class="btn btn-primary" name="search"> Search</a>
    
           </div> <!-- End Col md 4 --> 		
          </div><!--  end row --> 


<!--  ////////////////// Roll generate table /////////////  -->


<div class="row d-none" id="roll-generate">
   <div class="col-md-12">
       <table class="table table-bordered table-striped" style="width: 100%">
           <thead>
               <tr>
                   <th>ID No</th>
                   <th>Student Name </th>
                   <th>Father Name </th>
                   <th>Gender</th>
                   <th>Roll</th>
                </tr> 
               			
           </thead>
           <tbody id="roll-generate-tr">
               
           </tbody>
           
       </table>
       
   </div>
   
</div>

<input type="submit" class="btn btn-info" value="Roll Generator">


      </form> 

                 
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
</div>
</div>    
    
    
@section('js')
<script type="text/javascript">
    $(document).on('click','#search',function(){
      var year_id = $('#year_id').val();
      var class_id = $('#class_id').val();
       $.ajax({
        url: "{{ route('jsonfetch.getstudents')}}",
        type: "GET",
        data: {'year_id':year_id,'class_id':class_id},
        success: function (data) {
          $('#roll-generate').removeClass('d-none');
          var html = '';
          $.each( data, function(key, v){
            html +=
            '<tr>'+
            '<td>'+v.user_name.stu_IdNumber+'<input type="hidden" name="stu_id[]" value="'+v.stu_id+'"></td>'+
            '<td>'+v.user_name.name+'</td>'+
            '<td>'+v.user_name.fname+'</td>'+
            '<td>'+v.user_name.gender+'</td>'+
            '<td><input type="text" class="form-control form-control-sm" name="rollnumber[]" value="'+v.roll_number+'"></td>'+
            '</tr>';
          });
          html = $('#roll-generate-tr').html(html);
        }
      });
    });
  
  </script>
 
  
@endsection
@endsection