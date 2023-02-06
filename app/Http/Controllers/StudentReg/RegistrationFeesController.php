<?php

namespace App\Http\Controllers\StudentReg;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentManagement\Year;
use App\Models\StudentManagement\ClassManagement;
use App\Models\StudentReg\AssignStudent;
use App\Models\StudentManagement\FeeCategoryAmount;
use App\Models\StudentReg\Discount;
use PDF;

class RegistrationFeesController extends Controller
{
    public string $path="Admin.StudentRegistration.RegsFees.";

    public function RegisterationFeesView(){
        $data['title_page']="Student Registration Fees";
        $data['years']=Year::latest()->get();
        $data['classes']=ClassManagement::latest()->get();
        return view($this->path.'stuRegFees',$data);
    }
    public function ClassWiseGet(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        if ($year_id !='') {
            $where[] = ['year_id','like',$year_id.'%'];
        }
        if ($class_id !='') {
            $where[] = ['class_id','like',$class_id.'%'];
        }
        $allstudents = AssignStudent::with('discount')->where($where)->get();
        $html['thsource']  = '<th>SL</th>';
        $html['thsource'] .= '<th>ID No</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Roll No</th>';
        $html['thsource'] .= '<th>Reg Fee</th>';
        $html['thsource'] .= '<th>Discount </th>';
        $html['thsource'] .= '<th>Student Fee </th>';
        $html['thsource'] .= '<th>Action</th>';
        foreach ($allstudents as $key => $v) {
            $registrationfee = FeeCategoryAmount::where('fee_cate_id','1')->where('class_id',$v->class_id)->first();
            $color = 'success';
            $html[$key]['tdsource']  = '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['UserName']['stu_IdNumber'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['UserName']['name'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v->roll_number.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$registrationfee->cate_amount.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['discount']['discount'].'%'.'</td>';
            
            $originalfee = $registrationfee->cate_amount;
            $discount = $v['discount']['discount'];
            $discounttablefee = $discount/100*$originalfee;
            $finalfee = (float)$originalfee-(float)$discounttablefee;

            $html[$key]['tdsource'] .='<td>'.$finalfee.'$'.'</td>';
            $html[$key]['tdsource'] .='<td>';
            $html[$key]['tdsource'] .='<a class="btn btn-sm btn-'.$color.'" title="PaySlip" target="_blanks" href="'.route("student.registrationfee.payslip").'?class_id='.$v->class_id.'&student_id='.$v->stu_id.'">Fee Slip</a>';
            $html[$key]['tdsource'] .= '</td>';
          
        }  
       return response()->json(@$html);
      
       
         
    }
    public function GeneratePaySlip(Request $request){
        $student_id = $request->student_id;
    	 $class_id = $request->class_id;

       
       // $class_id = 4;
$data['title_page']="Student Regsitraion Slip";
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
