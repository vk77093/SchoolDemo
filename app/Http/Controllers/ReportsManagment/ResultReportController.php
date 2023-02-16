<?php

namespace App\Http\Controllers\ReportsManagment;

use App\Http\Controllers\Controller;
use App\Http\NotificationHelper;
use App\Models\MarksManagement\StudentMarks;
use App\Models\StudentManagement\ClassManagement;
use App\Models\StudentManagement\ExamType;
use App\Models\StudentManagement\Year;
use App\Models\StudentReg\AssignStudent;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ResultReportController extends Controller
{
    protected string $path="Admin.ReportsManagment.Results.";
    protected string $path2="Admin.ReportsManagment.IdCards.";
    protected object $noti;
    public function __construct(){
        $this->noti = new NotificationHelper();
    }
    public function ViewStudentResults(){
        $data['title_page']="Student Results";
        $data['years']=Year::latest()->get();
        $data['classes']=ClassManagement::latest()->get();
        $data['examTypes']=ExamType::latest()->get();
        return view($this->path.'viewResult',$data);
    }
    public function GetStudentResultsPdf(Request $request){
        $year_id = $request->year_id;
    	$class_id = $request->class_id;
    	$exam_type_id = $request->exam_type_id;

        if($year_id !=null && $class_id !=null && $exam_type_id !=null){
            $where[]=['year_id',$year_id];
            $where[]=['class_id',$class_id];
            $where[]=['exam_type_id',$exam_type_id];
            $singleResult =StudentMarks::where($where)->first();
            // dd($singleResult);
            if($singleResult==true) {
                $data['allData']=StudentMarks::select('year_id','class_id','exam_type_id','stu_id')
                ->where($where)->groupBy('year_id')->groupBy('class_id')->groupBy('exam_type_id')->groupBy('stu_id')->get();
                 //dd($data['allData']->toArray());
                 $pdf=Pdf::loadView($this->path.'ResultPdf',$data);
                 return $pdf->setPaper('a4')->stream('StudentResult.pdf');
            }else{
                $dataNoti=$this->noti->ShowNotification('Sorry No Data Is Found','error');
               return redirect()->back()->with($dataNoti);
            }
        }
       

    }
    public function StudentIdCardView(){
        $data['title_page']="View Student Id Card";
        $data['years']=Year::latest()->get();
        $data['classes']=ClassManagement::latest()->get();
        return view($this->path2.'viewIdCard',$data);
    }
    public function StudentIdCardGetPdf(Request $request){
        $year_id = $request->year_id;
    	$class_id = $request->class_id;
        if($year_id !=null && $class_id !=null){
            $where[]=['year_id',$year_id];
            $where[]=['class_id',$class_id];
            $checkData=AssignStudent::where($where)->first();
            if($checkData==true){
                $data['allData']=AssignStudent::where($where)->get();
                $pdf=Pdf::loadView($this->path2.'IdCardPdf',$data);
                return $pdf->setPaper('a4')->stream('StudentIdCard.pdf');
            }else{
                $dataNoti=$this->noti->ShowNotification('Sorry No Data Is Found','error');
               return redirect()->back()->with($dataNoti);
            }
        }
    }
}
