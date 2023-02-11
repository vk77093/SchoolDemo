@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<x-box-comp>
    <x-slot name="boxTitle">Add Student Marks</x-slot>
    <x-slot name="buttonArea">
        <a class="btn btn-app btn-info" href="{{route('leave.view')}}" style="float: right;">
            <i class="fa fa-eye"></i> View Employee Leave Data
        </a>
    </x-slot> 
    <form method="post" action="{{ route('marks.save') }}">
        @csrf
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
                    <h5>Select Subject <x-required-sign/></h5>
                    <div class="input-group">
                        <select name="assign_subject_id" id="assign_subject_id"  required="" class="form-control">
                            <option  selected="" >Select Subject</option>
                              
                             
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3">
                <div class="form-group">
                    <h5>Select Exam Type <x-required-sign/></h5>
                    <div class="input-group">
                        <select class="form-control" name="exam_type_id" id="exam_type_id" value="{{old('exam_type_id')}}">
                        <option selected value disabled>{{old('exam_type_id')}}--Select Exam Type--</option>
                        @foreach ($examTypes as $exam)
                            <option value="{{$exam->id}}">{{$exam->exam_name}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-3"  >

                <a id="search" class="btn btn-primary" name="search"> Search</a>
                    
                           </div> <!-- End Col md 3 --> 
        </div>

        <!---Marks ENtry Form--->
        <div class="row d-none" id="marks-entry">
<div class="col-md-12">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                   <th>ID No</th>
 					<th>Student Name </th>
 					<th>Father Name </th>
 					<th>Gender</th>
 					<th>Marks</th>
            </tr>
        </thead>
        <tbody id="marks-entry-tr">

        </tbody>
    </table>
    <input type="submit" class="btn btn-rounded btn-primary" value="Submit">
</div>
        </div>
        <!--end of marks Entry--->
    </form>
</x-box-comp>
@section('js')
<script type="text/javascript">
$(document).on('click','#search',function(){
    var year_id=$('#year_id').val();
    var class_id=$('#class_id').val();
    var assign_subject_id=$('#assign_subject_id').val();
    var exam_type_id=$('#exam_type_id').val();
    //console.log(year_id,class_id,assign_subject_id,exam_type_id);
    $.ajax({
url:"{{route('marks.getstudentjson')}}",
type:"GET",
data:{"year_id":year_id,"class_id":class_id},
success:function(data){
    $('#marks-entry').removeClass('d-none');
    var html='';
    $.each(data,function(key,v){
        html +=
          '<tr>'+
          '<td>'+v.user_name.stu_IdNumber+'<input type="hidden" name="stu_id[]" value="'+v.stu_id+'"> <input type="hidden" name="stu_IdNumber[]" value="'+v.user_name.stu_IdNumber+'"> </td>'+
          '<td>'+v.user_name.name+'</td>'+
          '<td>'+v.user_name.fname+'</td>'+
          '<td>'+v.user_name.gender+'</td>'+
          '<td><input type="text" class="form-control form-control-sm" name="marks[]" ></td>'+
          '</tr>';
    });
    html = $('#marks-entry-tr').html(html);
}
    });
}) ;
    </script>
    <!--   // for get Student Subject  -->

<script type="text/javascript">
    $(function(){
      $(document).on('change','#class_id',function(){
        var class_id = $('#class_id').val();
        $.ajax({
          url:"{{ route('marks.getsubjectjson') }}",
          type:"GET",
          data:{"class_id":class_id},
          success:function(data){
            var html = '<option value="">Select Subject</option>';
            $.each( data, function(key, v) {
            html += '<option value="'+v.id+'">'+v.subject_name.subject_name+'</option>';
          });
            $('#assign_subject_id').html(html);
          }
        });
      });
    });
  </script>
 
@endsection
@endsection