@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<x-box-comp>
    <x-slot name="boxTitle">Add/Edit Employee Salary</x-slot>
    <x-slot name="buttonArea">
        <a class="btn btn-app btn-info" href="{{route('acc.empsalary.view')}}" style="float: right;">
            <i class="fa fa-eye"></i> View Employee Salary
        </a>
    </x-slot> 
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <h5>Enter Date <x-required-sign/></h5>
                <div class="input-group">
                    <input type="date" class="form-control" name="sal_date" id="sal_date" required value="{{old('sal_date')}}">
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3" style="padding-top:22px">
            <a id="search" class="btn btn-primary" name="search"> Search</a> 
        </div>
    </div>
    <!--Employee Salary Add--->
    <div class="row">
        <div class="col-md-12">
            <div id="DocumentResults">
                <script id="document-template" type="text/x-handlebars-template">
                    <form action="{{ route('acc.empsalary.save') }}" method="post">
    @csrf
    <table class="table table-bordered table-striped">
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
    <!--end of employee salary-->
</x-box-comp>
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js"></script> 
<script type="text/javascript">
    $(document).on('click', '#search',function(){
var sal_date=$('#sal_date').val();
$.ajax({
url:"{{route('acc.empsalary.getemployeejosn')}}",
type:"get",
data:{'sal_date':sal_date},
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