<?php

namespace App\Http\Controllers\AccountManagement;

use App\Http\Controllers\Controller;
use App\Http\NotificationHelper;
use App\Models\AccountManagement\StudentFee;
use App\Models\StudentManagement\ClassManagement;
use App\Models\StudentManagement\FeeCategory;
use App\Models\StudentManagement\FeeCategoryAmount;
use App\Models\StudentManagement\Year;
use App\Models\StudentReg\AssignStudent;
use App\Models\User;
use Illuminate\Http\Request;

class StudentFeeController extends Controller
{
    protected string $path="Admin.AccountManagement.Fees.";
    protected object $noti;
    public function __construct(){
        $this->noti = new NotificationHelper();
    }
    public function StudentFeesView(){
        $data['title_page']="View Student Fees";
        $data['fees']=StudentFee::latest()->get();
        return view($this->path.'feeView',$data);
    }
    public function StudentFeesCreate(){
        $data['title_page']="Create Student Fees";
       $data['years']=Year::latest()->get();
       $data['classes']=ClassManagement::latest()->get();
       $data['students']=User::where('userType','Student')->latest()->get();
       $data['feecategories']=FeeCategory::latest()->get();
        return view($this->path.'feeCreate',$data);
    }

    //save Data
    public function SaveFeesData(Request $request){
        $date = date('Y-m',strtotime($request->fee_date));

    	StudentFee::where('year_id',$request->year_id)->where('class_id',$request->class_id)->where('fee_cate_id',$request->fee_cate_id)->where('fee_date',$request->fee_date)->delete();

    	$checkdata = $request->checkmanage;

    	if ($checkdata !=null) {
    		for ($i=0; $i <count($checkdata) ; $i++) { 
    			$data = new StudentFee();
    			$data->year_id = $request->year_id;
    			$data->class_id = $request->class_id;
    			$data->fee_date = $date;
    			$data->fee_cate_id = $request->fee_cate_id;
    			$data->stu_id = $request->stu_id[$checkdata[$i]];
    			$data->fee_amount = $request->fee_amount[$checkdata[$i]];
    			$data->save();
    		} // end for loop
    	} // end if 
        if(!empty(@$data) || empty($checkdata)){
            $dataNoti=$this->noti->ShowNotification("Well done Feess Added Successfully",'success');
            return redirect()->route('fees.view')->with($dataNoti);
        }else{
            $dataNoti=$this->noti->ShowNotification("some Error occured",'error');
            return redirect()->back()->with($dataNoti);
        }
    }
    public function GetStudentJson(Request $request){
        $year_id = $request->year_id;
   	$class_id = $request->class_id;
   	$fee_cate_id = $request->fee_cate_id;
   	$fee_date = date('Y-m',strtotime($request->fee_date));
      	   
    	 
  $data = AssignStudent::with(['discount'])->where('year_id',$year_id)->where('class_id',$class_id)->get();
    	 
    	 $html['thsource']  = '<th>ID No</th>';
    	 $html['thsource'] .= '<th>Student Name</th>';
    	 $html['thsource'] .= '<th>Father Name</th>';
    	 $html['thsource'] .= '<th>Original Fee </th>';
      	 $html['thsource'] .= '<th>Discount Amount</th>';
      	 $html['thsource'] .= '<th>Fee (This Student)</th>';
      	 $html['thsource'] .= '<th>Select</th>';

    	 foreach ($data as $key => $std) {
$registrationfee = FeeCategoryAmount::where('fee_cate_id',$fee_cate_id)->where('class_id',$std->class_id)->first();

$accountstudentfees = StudentFee::where('stu_id',$std->stu_id)->where('year_id',$std->year_id)->where('class_id',$std->class_id)->where('fee_cate_id',$fee_cate_id)->where('fee_date',$fee_date)->first();

if($accountstudentfees !=null) {
 	$checked = 'checked';
 }else{
 	$checked = '';
 }  	 	 
 	$color = 'success';
 	$html[$key]['tdsource']  = '<td>'.$std['UserName']['stu_IdNumber']. '<input type="hidden" name="fee_cate_id" value= " '.$fee_cate_id.' " >'.'</td>';

 	$html[$key]['tdsource']  .= '<td>'.$std['UserName']['name']. '<input type="hidden" name="year_id" value= " '.$std->year_id.' " >'.'</td>';

 	$html[$key]['tdsource']  .= '<td>'.$std['UserName']['fname']. '<input type="hidden" name="class_id" value= " '.$std->class_id.' " >'.'</td>';

 	$html[$key]['tdsource']  .= '<td>'.$registrationfee->cate_amount.'$'.'<input type="hidden" name="fee_date" value= " '.$fee_date.' " >'.'</td>';

 	$html[$key]['tdsource'] .= '<td>'.$std['discount']['discount'].'%'.'</td>';
  
 	 $orginalfee = $registrationfee->cate_amount;
 	 $discount = $std['discount']['discount'];
 	 $discountablefee = $discount/100*$orginalfee;
 	 $finalfee = (int)$orginalfee-(int)$discountablefee;    	 	 

 	$html[$key]['tdsource'] .='<td>'. '<input type="text" name="fee_amount[]" value="'.$finalfee.' " class="form-control" readonly'.'</td>';
 	 
 	$html[$key]['tdsource'] .='<td>'.'<input type="hidden" name="stu_id[]" value="'.$std->stu_id.'">'.'<input type="checkbox" name="checkmanage[]" id="'.$key.'" value="'.$key.'" '.$checked.' style="transform: scale(1.5);margin-left: 10px;"> <label for="'.$key.'"> </label> '.'</td>'; 

    	 }  
    	return response()->json(@$html);
    }
    public function StudentFeesDelete($id){
        StudentFee::findorFail($id)->delete();
        $dataNoti=$this->noti->ShowNotification("Data Deleted Successfully",'warning');
            return redirect()->back()->with($dataNoti);
    }
    public function StudentFeesEdit($id){
        $data['title_page']="Student fee Edit";
        $data['feeEdit']=StudentFee::findOrFail($id);
         $data['years']=Year::latest()->get();
       $data['classes']=ClassManagement::latest()->get();
      // $data['students']=User::where('userType','Student')->latest()->get();
       $data['feecategories']=FeeCategory::latest()->get();
        return view($this->path.'feeEdit',$data);
    }
}
