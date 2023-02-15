@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<x-box-comp>
    <x-slot name="boxTitle">View Monthly and Yearly profit</x-slot>
    <x-slot name="buttonArea">
        <a class="btn btn-app btn-info" href="{{route('student.view.class')}}" style="float: right;">
            <i class="fa fa-eye"></i> View Classes
        </a>
    </x-slot>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <h5>Starting Date <x-required-sign/></h5>
                <div class="input-group">
                    <input type="date" class="form-control" name="start_date" id="start_date" required value="{{old('start_date')}}"/>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <h5>End Date <x-required-sign/></h5>
                <div class="input-group">
                    <input type="date" class="form-control" name="end_date" id="end_date" required value="{{old('end_date')}}"/>
                </div>
            </div>
        </div>
        <div class="col-sm-4" style="padding-top: 22px">
            <a id="search" class="btn btn-primary" name="search"> Search</a> 
        </div>
    </div>  
    <!--Profit data View-->
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
                      
                         <tr>
                             @{{{tdsource}}}	
                         </tr>
                      
                     </tbody>
                    </table>
                </script>
            </div>
        </div>
    </div>
    <!--end of Profit View--->
</x-box-comp>
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js" type="text/javascript"></script> 
<script type="text/javascript">
    $(document).on('click','#search',function(){
      var start_date = $('#start_date').val();   
      var end_date = $('#end_date').val();
       $.ajax({
        url: "{{ route('profit.datewisegetjson')}}",
        type: "get",
        data: {'start_date':start_date,'end_date':end_date},
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