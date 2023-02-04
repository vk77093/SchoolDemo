@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<div class="row">
    <div class="col-md-12">
       <div class="box bb-3 border-warning">
        <div class="box-header">
            <h4 class="box-title">Student Registration</h4>  <strong>Fees</strong></h4>
          </div>
          <div class="box-body">
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
                </div>
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
            </div>
            <!---Table Handlebar js-->
            <div class="row">
                <div class="col-md-12">
                    <div id="DocumentResults">
                        <script id="document-template" type="text/x-handlebars-template">
                        <table class="table table-striped table-hover">
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
          </div>
        </div> 
    </div>
</div>
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).on('click','#search',function(){
          var year_id = $('#year_id').val();
          var class_id = $('#class_id').val();
           $.ajax({
            url: "{{ route('registrationfee.fees.classwiseget')}}",
            type: "get",
            data: {'year_id':year_id,'class_id':class_id},
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