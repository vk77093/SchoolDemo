@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<x-box-comp>
    <x-slot name="boxTitle">Add Employee Leave</x-slot>
    <x-slot name="buttonArea">
        <a class="btn btn-app btn-info" href="{{route('leave.view')}}" style="float: right;">
            <i class="fa fa-eye"></i> View Employee Leave Data
        </a>
    </x-slot> 
    <div class="row">
      <div class="col-sm-4">
        <div class="form-group">
            <h5>Attendence Date<x-required-sign/></h5>
            <div class="input-group">
                <input type="date" class="form-control" id="attendence_date" name="attendence_date" required/>
            </div>
        </div>
      </div> 
      <div class="col-sm-2 mt-2" style="padding-top:15px;">
        <a id="search" class="btn btn-primary" name="search"> Search</a>
        </div> 
    </div>
    <div class="row">
        <div class="col-md-12">
         <div id="DocumentResults">
            <script id="document-template" type="text/x-handlebars-template">

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
               </script>
            </div>   
        </div>
    </div>
</x-box-comp>
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js" type="text/javascript"></script> 
<script type="text/javascript">
    $(document).on('click','#search',function(){
      var attendence_date = $('#attendence_date').val();   
       $.ajax({
        url: "{{ route('monthlysalary.get')}}",
        type: "get",
        data: {'attendence_date':attendence_date},
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