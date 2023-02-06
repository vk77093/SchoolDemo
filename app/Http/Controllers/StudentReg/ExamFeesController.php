<?php

namespace App\Http\Controllers\StudentReg;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentManagement\Year;
use App\Models\StudentManagement\ClassManagement;
use App\Models\StudentReg\AssignStudent;
use App\Models\StudentManagement\FeeCategoryAmount;
use App\Models\StudentManagement\ExamType;

use PDF;

class ExamFeesController extends Controller
{
    public string $path="Admin.StudentRegistration.RegsFees.";
    public function ExamFeesView(){
        $data['title_page']="Student Monthly Fees";
        $data['years']=Year::latest()->get();
        $data['classes']=ClassManagement::latest()->get();
        $data['exams']=ExamType::latest()->get();
        return view($this->path.'examFee',$data);
    }
    public function ClassAndMonthWiseGet(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam=$request->exam;
        
        if ($year_id !='') {
            $where[] = ['year_id','like',$year_id.'%'];
        }
        if ($class_id !='') {
            $where[] = ['class_id','like',$class_id.'%'];
        }
        $allStudents=AssignStudent::with('discount')->where($where)->get();
        $html['thsource']  = '<th>SL</th>';
    	 $html['thsource'] .= '<th>ID No</th>';
    	 $html['thsource'] .= '<th>Student Name</th>';
    	 $html['thsource'] .= '<th>Roll No</th>';
    	 $html['thsource'] .= '<th>Monthly Fee</th>';
    	 $html['thsource'] .= '<th>Discount </th>';
    	 $html['thsource'] .= '<th>Student Fee </th>';
    	 $html['thsource'] .= '<th>Action</th>';
        foreach($allStudents as $key=>$value) {
            //here 3= Exam fee cate
            $montlyFees=FeeCategoryAmount::where('fee_cate_id','3')->where('class_id',$value->class_id)->first();
            $color = 'success';
            $html[$key]['tdsource']  = '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$value['UserName']['stu_IdNumber'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$value['UserName']['name'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$value->roll_number.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$montlyFees->cate_amount.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$value['discount']['discount'].'%'.'</td>';
            
            $originalfee = $montlyFees->cate_amount;
            $discount = $value['discount']['discount'];
            $discounttablefee = $discount/100*$originalfee;
            $finalfee = (float)$originalfee-(float)$discounttablefee;

            $html[$key]['tdsource'] .='<td>'.$finalfee.'$'.'</td>';
            $html[$key]['tdsource'] .='<td>';
            $html[$key]['tdsource'] .='<a class="btn btn-sm btn-'.$color.'" title="PaySlip" target="_blanks" href="'.route("student.examfee.payslip").'?class_id='.$value->class_id.'&student_id='.$value->stu_id.'&exam='.$exam.'">Fee Slip</a>';
            $html[$key]['tdsource'] .= '</td>';
        }
        return response()->json(@$html);
    }
    public function GeneratePaySlip( Request $request){
       
        $student_id = $request->student_id;
    	 $class_id = $request->class_id;
         $data['exam']=$request->exam_id;
         $data['title_page']="Student Exam Slip";
$data['details']=AssignStudent::with(['UserName','discount'])->where('class_id',$class_id)->where('stu_id',$student_id)->first();
    if($data['details']==null){
        
        echo "No data Found";
    }else{
        dd($data);
        $pdf=PDF::loadView($this->path.'registrationFeesPDF',$data);
        
        return $pdf->setPaper('a4')->stream();
    }
    }
}
