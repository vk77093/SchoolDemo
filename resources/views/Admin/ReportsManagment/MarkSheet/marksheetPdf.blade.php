@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<x-box-comp>
    <x-slot name="boxTitle">Student Mark Sheet</x-slot>
    <x-slot name="buttonArea">
        <a class="btn btn-app btn-info" href="{{route('leave.view')}}" style="float: right;">
            <i class="fa fa-eye"></i> View Employee Leave Data
        </a>
    </x-slot> 
    <div class="row">
        <div class="col-md-3 sm-3">
            <img src="{{(!empty($allMarks['0']['UserName']['profile_photo_path']) ? url($allMarks['0']['UserName']['profile_photo_path']) :url('AdminAsset/UserProfileImage/no_image.jpg'))}}">
        </div>
        <div class="col-md-2 text-center">
  			
        </div>
        <div class="col-md-4 text-center" style="float: left;">
            <h4><strong>Easy Learning School</strong></h4>
            <h6><strong>Kolkata India</strong></h6>
            <h5><strong><u><i>Academic Transcript</i></u></strong></h5>
            <h6><strong>{{ $allMarks['0']['ExamTypeName']['exam_name'] }}</strong></h6>
     </div>
     <div class="col-md-12">
        <hr style="border: solid 1px; width: 100%; color: #ddd; margin-bottom: 0px;">
        <p style="text-align: right;"><u><i>Print Date: </i>{{ date('d M Y') }} </u></p>
                    
                </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <table border="1" style="border-color: #ffffff;" width="100%" cellpadding="8" cellspacing="2">
                <tr>
                    <td width="50%">Student Id</td>
	<td width="50%">{{ $allMarks['0']['stu_IdNumber'] }}</td>
                </tr>
                <tr>
                    <td width="50%">Roll No</td>
                    <td width="50%">{{ $allMarks['0']['AssignedStudent']['roll_number'] }}</td>
                </tr>
                
                <tr>
                    <td width="50%">Name </td>
                    <td width="50%">{{ $allMarks['0']['UserName']['name'] }}</td>
                </tr>
                
                
                <tr>
                    <td width="50%">Class</td>
                    <td width="50%">{{ $allMarks['0']['ClassName']['class_name'] }}</td>
                </tr>
                
                
                <tr>
                    <td width="50%">Session</td>
                    <td width="50%">{{ $allMarks['0']['YearName']['year_name'] }}</td>
                </tr>
            </table>
        </div>
        <div class="col-sm-6">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th> Letter Grade </th>
				<th> Marks Interval </th>
				<th> Grade Point </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allGrades as $grade)
                        <tr>
                            <td>{{ $grade->grade_name }}</td>
<td>{{ $grade->start_marks }} - {{ $grade->end_marks }}</td>
<td>{{ number_format((float)$grade->grade_point,2) }} - {{ ($grade->grade_point == 5)?(number_format((float)$grade->grade_point,2)):(number_format((float)$grade->grade_point+1,2) - (float)0.01) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mt-2">
       <div class="col-md-12 col-sm-12">
    <table class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th class="text-center">SL</th>

    <th class="text-center">Get Marks</th>
    <th class="text-center">Letter Grade</th>
    <th class="text-center">Grade Point</th> 
    </tr>    
    </thead> 
    <tbody>
    @php
    $total_marks = 0;
      $total_point = 0;
    @endphp 
    @foreach ($allMarks as $mark)
        @php
             $get_mark = $mark->marks;
  $total_marks = (float)$total_marks+(float)$get_mark;
  
  $total_subject=App\Models\MarksManagement\StudentMarks::where('year_id',$mark->year_id)->where('class_id',$mark->class_id)->where('exam_type_id',$mark->exam_type_id)->where('stu_IdNumber',$mark->stu_IdNumber)->get()->count();
        @endphp
        <tr>
            <td class="text-center">{{$loop->iteration}}</td>
            <td class="text-center">{{ $get_mark }}</td>
            @php
            $grade_marks = App\Models\MarksManagement\MarksGrade::where([['start_marks','<=', (int)$get_mark],['end_marks', '>=',(int)$get_mark ]])->first();
            $grade_name = $grade_marks->grade_name;
            $grade_point = number_format((float)$grade_marks->grade_point,2);
            $total_point = (float)$total_point+(float)$grade_point;
          @endphp 
          <td class="text-center">{{ $grade_name }}</td>
          <td class="text-center">{{ $grade_point }}</td>
        </tr>
    @endforeach  
    <tr>
        <td colspan="3"><strong style="padding-left: 30px;">Total Maks</strong></td>
        <td colspan="3"><strong style="padding-left: 38px;">{{ $total_marks }}</strong></td>
      </tr> 
    </tbody>   
    </table>    
    </div> 
    </div>
</x-box-comp>
@endsection