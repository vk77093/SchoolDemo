@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<x-box-comp>
    <x-slot name="boxTitle">Add Student fees</x-slot>
    <x-slot name="buttonArea">
        <a class="btn btn-app btn-info" href="{{route('fees.view')}}" style="float: right;">
            <i class="fa fa-eye"></i> View Student fees Data
        </a>
    </x-slot>  
    <div class="row">
        <div class="col-sm-3 col-md-3">
            <div class="form-group">
                <h5>Select Year <x-required-sign/></h5>
                <div class="input-group">
                    <select class="form-control" name="year_id" id="year_id" value="{{old('year_id')}}">
                    <option selected value disabled>{{old('year_id')}}--Select year--</option>
                    @foreach ($years as $year)
                        <option value="{{$year->id}}">{{$year->year_name}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-sm-3 col-md-3">
            <div class="form-group">
                <h5>Select Class <x-required-sign/></h5>
                <div class="input-group">
                    <select class="form-control" name="class_id" id="class_id" value="{{old('class_id')}}">
                    <option selected value disabled>{{old('class_id')}}--Select Class--</option>
                    @foreach ($classes as $class)
                        <option value="{{$class->id}}">{{$class->class_name}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
        </div>
        
        <div class="col-sm-3 col-md-3">
            <div class="form-group">
                <h5>Select Fee Category Type <x-required-sign/></h5>
                <div class="input-group">
                    <select class="form-control" name="fee_cate_id" id="fee_cate_id" value="{{old('fee_cate_id')}}">
                    <option selected value disabled>{{old('fee_cate_id')}}--Select Exam Type--</option>
                    @foreach ($feecategories as $feecat)
                        <option value="{{$feecat->id}}">{{$feecat->fee_cate_name}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-3">

            <div class="form-group">
           <h5> Date <span class="text-danger">*</span></h5>
           <div class="controls">
        <input type="date" name="fee_date" id="fee_date" class="form-control" required> 
         </div>
            
       </div>
         
                </div> <!-- End Col md 3 --> 
        <div class="col-md-3"  >

            <a id="search" class="btn btn-primary" name="search"> Search</a>
                
                       </div> <!-- End Col md 3 --> 
    </div>
    <!--student fee Entry Table--->
    <div id="row">
        <div class="col-md-12">
            <div id="DocumentResults">
                <script id="document-template" type="text/x-handlebars-template">
                <form action="{{ route('fees.save') }}" method="post">
@csrf
<table class="table table-bordered table-striped" style="width: 100%">
    <thead>
        <tr>
       @{{{thsource}}}
        </tr>
     </thead>
     <tbody>
         @{{#each this}}
         <tr>
             @{{{tdsource}}}	
         </tr>
         @{{/each}}
     </tbody>
    </table>
    <button type="submit" class="btn btn-primary" style="margin-top: 10px">Submit</button>
                </form>
                </script>
            </div>
        </div>
    </div>
    <!--end-->
</x-box-comp>
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js"></script>
<script type="text/javascript">
    $(document).on('click','#search',function(){
        var year_id = $('#year_id').val();
        var class_id = $('#class_id').val();
        var fee_cate_id = $('#fee_cate_id').val();
      var fee_date = $('#fee_date').val();   
       $.ajax({
        url: "{{ route('account.fees.getstudentjosn')}}",
        type: "get",
        data: {'year_id':year_id,'class_id':class_id,'fee_cate_id':fee_cate_id,'fee_date':fee_date},
        beforeSend: function() {       
        },
        success: function (data) {
          var source = $("#document-template").html();
          var template = Handlebars.compile(source);
          var html = template(data);
          $('#DocumentResults').html(html);
          $('[data-toggle="tooltip"]').tooltip();
        }
      });
    });
  
  </script>
    
@endsection
@endsection