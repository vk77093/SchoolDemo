<?php

namespace App\Http\Controllers\ReportsManagment;

use App\Http\Controllers\Controller;
use App\Http\NotificationHelper;
use App\Models\MarksManagement\MarksGrade;
use App\Models\MarksManagement\StudentMarks;
use App\Models\StudentManagement\ClassManagement;
use App\Models\StudentManagement\ExamType;
use App\Models\StudentManagement\Year;
use Illuminate\Http\Request;

class MarkSheetController extends Controller
{
    protected string $path="Admin.ReportsManagment.MarkSheet.";
    protected object $noti;
    public function __construct(){
        $this->noti = new NotificationHelper();
    }

    public function MarkSheetView(){
        $data['title_page']='View Student Marksheet';
        $data['years']=Year::orderBy('id','desc')->get();
        $data['classes']=ClassManagement::orderBy('id','desc')->get();
        $data['examTypes']=ExamType::orderBy('id','desc')->get();
        return view($this->path.'viewMark',$data);
    }
    public function MarkSheetPdf(Request $request){
        $title_page="Mark Sheet PDF";
        $year_id = $request->year_id;
    	$class_id = $request->class_id;
    	$exam_type_id = $request->exam_type_id;
    	$stu_IdNumber = $request->stu_IdNumber;
//dd($class_id);
        $count_fail=StudentMarks::where('year_id',$year_id)->where('class_id',$class_id)
        ->where('exam_type_id',$exam_type_id)->where('stu_IdNumber',$stu_IdNumber)
        ->where('marks','<','33')->get()->count();
       // dd($count_fail);
       $singleStudent=StudentMarks::where('year_id',$year_id)->where('class_id',$class_id)
       ->where('exam_type_id',$exam_type_id)->where('stu_IdNumber',$stu_IdNumber)
      ->get()->first();
      if($singleStudent==true){
        $allMarks=StudentMarks::with(['AssignedSubjectName','YearName','UserName'])->where('class_id',$class_id)->
        where('exam_type_id',$exam_type_id)->where('stu_IdNumber',$stu_IdNumber)->get();
        //dd($allMarks);
        //Getting the Grade and compare
        $allGrades=MarksGrade::all();

        
        return view($this->path.'marksheetPdf',compact('allMarks','allGrades','count_fail','title_page'));
      }else{
        $data=$this->noti->ShowNotification('Sorry These Criteria Does not Matched','error');
        return redirect()->back()->with($data);
      }
    }
}
