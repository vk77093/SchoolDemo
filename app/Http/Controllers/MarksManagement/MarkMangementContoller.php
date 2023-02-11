<?php

namespace App\Http\Controllers\MarksManagement;

use App\Http\Controllers\Controller;
use App\Http\NotificationHelper;
use App\Models\MarksManagement\StudentMarks;
use App\Models\StudentManagement\AssignSubject;
use App\Models\StudentManagement\ClassManagement;
use App\Models\StudentManagement\ExamType;
use App\Models\StudentManagement\Year;
use App\Models\StudentReg\AssignStudent;
use Illuminate\Http\Request;

class MarkMangementContoller extends Controller
{
    protected string $path="Admin.MarksManagement.Marks.";
    protected object $noti;
    public function __construct(){
        $this->noti = new NotificationHelper();
    }
    public function AddMarks(){
        $data['title_page']="Add Student Marks";
        $data['classes']=ClassManagement::latest()->get();
        $data['years']=Year::latest()->get();
        $data['examTypes']=ExamType::latest()->get();
        return view($this->path.'MarkAdd',$data);
    }

    //Json Function For dataset
    public function GetSubjectJson(Request $request){
        $classId=$request->class_id;
        $allData=AssignSubject::with(['SubjectName'])->where('class_id',$classId)->get();
        //here subjectName is going as subject_name
        return response()->json($allData);

    }
    //json function for get Dataset
    public function GetStudentJson(Request $request){
        $yearId=$request->year_id;
        $classId=$request->class_id;

        //dd($classId,$yearId);
        $allData=AssignStudent::with(['UserName'])->where('year_id',$yearId)
        ->where('class_id',$classId)->get();
        return response()->json($allData);
    }

    //saving Marks
    public function SaveStudentMarks(Request $request){
        $studentCount=count($request->stu_id);
        if($studentCount){
            for($i=0;$i<$studentCount;$i++){
                $data=new StudentMarks();
                $data->year_id = $request->year_id;
    		$data->class_id = $request->class_id;
    		$data->assign_subject_id = $request->assign_subject_id;
    		$data->exam_type_id = $request->exam_type_id;
            $data->stu_id = $request->stu_id[$i];
    		$data->stu_IdNumber = $request->stu_IdNumber[$i];
    		$data->marks = $request->marks[$i];
    		$data->save();

            }
            $dataNoti=$this->noti->ShowNotification("Student Marks Added Successfully",'success');
            return redirect()->back()->with($dataNoti);
        }else{
            $dataNoti=$this->noti->ShowNotification("Some Error occured",'warnging');
            return redirect()->back()->with($dataNoti);
        }
       
    }
     //edit marks
    public function EditStudentMarks(){
        $data['title_page']="Edit Student Marks";
        $data['classes']=ClassManagement::latest()->get();
        $data['years']=Year::latest()->get();
        $data['examTypes']=ExamType::latest()->get();
        return view($this->path.'editMarks',$data);
    }

    //Json Function for Edit method to get the previous 
    //student Marks
    public function GetPreviousStudentMarks(Request $request){
        $yearId=$request->year_id;
        $classId=$request->class_id;
        $assignSubId=$request->assign_subject_id;
        $examTypeId=$request->exam_type_id;
        $studentMarks=StudentMarks::with(['UserName'])->where('year_id',$yearId)
        ->where('class_id',$classId)->where('assign_subject_id',$assignSubId)->
        where('exam_type_id',$examTypeId)->get();
        return response()->json($studentMarks);
    }

    /* 
    Update the student Marks
    */
    public function UpdateStudentMarks(Request $request){
        $yearId=$request->year_id;
        $classId=$request->class_id;
        $assignSubId=$request->assign_subject_id;
        $examTypeId=$request->exam_type_id;
        $studentMarks=StudentMarks::with(['UserName'])->where('year_id',$yearId)
        ->where('class_id',$classId)->where('assign_subject_id',$assignSubId)->
        where('exam_type_id',$examTypeId)->delete();

        //Once delete previous Now Update new 
        $studentCount=count($request->stu_id);
        if($studentCount){
            for($i=0;$i<$studentCount;$i++){
                $data=new StudentMarks();
                $data->year_id = $request->year_id;
    		$data->class_id = $request->class_id;
    		$data->assign_subject_id = $request->assign_subject_id;
    		$data->exam_type_id = $request->exam_type_id;
            $data->stu_id = $request->stu_id[$i];
    		$data->stu_IdNumber = $request->stu_IdNumber[$i];
    		$data->marks = $request->marks[$i];
    		$data->save();

            }
            $dataNoti=$this->noti->ShowNotification("Student Marks Updated Successfully",'success');
            return redirect()->back()->with($dataNoti);
        }else{
            $dataNoti=$this->noti->ShowNotification("Some Error occured",'warnging');
            return redirect()->back()->with($dataNoti);
        }
    }
}
