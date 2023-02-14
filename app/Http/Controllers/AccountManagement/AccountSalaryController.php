<?php

namespace App\Http\Controllers\AccountManagement;

use App\Http\Controllers\Controller;
use App\Http\NotificationHelper;
use App\Models\AccountManagement\AccountEmployeeSalary;
use App\Models\EmployeeManagement\EmployeeAttendence;
use Illuminate\Http\Request;

class AccountSalaryController extends Controller
{
    protected string $path="Admin.AccountManagement.Salary.";
    protected object $noti;
    public function __construct(){
        $this->noti = new NotificationHelper();
    }
    public function EmployeeSalaryView(){
        $data['title_page']="Account Employee Salary";
        $data['employeeSalaries']=AccountEmployeeSalary::latest()->get();
        return view($this->path.'viewSal',$data);
    }
    public function EmployeeSalaryAddEdit(){
        $data['title_page']="Add or Edit the Employee Salary";
        return view($this->path.'addeditSal',$data);
    }
    public function EmployeeSalaryDelete($id){
AccountEmployeeSalary::findorFail($id)->delete();
$data=$this->noti->ShowNotification("Employee Salary Delete",'warning');
return redirect()->back()->with($data);
    }
    
    //json Method
    public function GetEmployeeSalaryJosn(Request $request){
$sal_date=date('Y-m',strtotime($request->sal_date));
if($sal_date !=''){
    $where[]=['attendence_date','like',$sal_date.'%'];

}
$data=EmployeeAttendence::select('emp_id')->groupBy('emp_id')->with(['UserName'])
->where($where)->get();
         $html['thsource']  = '<th>SL</th>';
    	 $html['thsource'] .= '<th>ID NO</th>';
    	 $html['thsource'] .= '<th>Employee Name</th>';
    	 $html['thsource'] .= '<th>Basic Salary</th>';
    	 $html['thsource'] .= '<th>Salary This Month</th>';
    	 $html['thsource'] .= '<th>Select</th>';

         foreach($data as $key => $attend){
            $account_salary=AccountEmployeeSalary::where('emp_id',$attend->emp_id)
            ->where('sal_date',$sal_date)->first();
            if($account_salary !=null){
                $checked='checked';
            }else{
                $checked='';
            }
            $totalAttenance=EmployeeAttendence::with(['UserName'])->where($where)
            ->where('emp_id',$attend->emp_id)->get();        
            $absendtCount=count($totalAttenance->where('attendence_status','Absent'));
            $html[$key]['tdsource']  = '<td>'.($key+1).'</td>';
 	$html[$key]['tdsource'] .= '<td>'.$attend['UserName']['stu_IdNumber'].'<input type="hidden" name="sal_date" value="'.$sal_date.'" >'.'</td>';

 	$html[$key]['tdsource'] .= '<td>'.$attend['UserName']['name'].'</td>';
 	$html[$key]['tdsource'] .= '<td>'.$attend['UserName']['salary'].'</td>';

    $salary=(float)$attend['UserName']['salary'];
    $salaryperday = (float)$salary/30; 
 	$totalsalaryminus = (float)$absendtCount*(float)$salaryperday;
 	$totalsalary = (float)$salary-(float)$totalsalaryminus;
     $html[$key]['tdsource'] .='<td>'.$totalsalary.'<input type="hidden" name="sal_amount[]" value="'.$totalsalary.'" >'.'</td>';

 	 
 	$html[$key]['tdsource'] .='<td>'.'<input type="hidden" name="emp_id[]" value="'.$attend->emp_id.'">'.'<input type="checkbox" name="checkmanage[]" id="'.$key.'" value="'.$key.'" '.$checked.' style="transform: scale(1.5);margin-left: 10px;"> <label for="'.$key.'"> </label> '.'</td>'; 

         }
         return response()->json(@$html);
    }
    public function EmployeeSalarySave(Request $request){
$sal_date=date('Y-m',strtotime($request->sal_date));
AccountEmployeeSalary::where('sal_date',$sal_date)->delete();
$checkdata=$request->checkmanage;
if($checkdata !=null){
    for($i=0;$i<count($checkdata);$i++){
        $data=new AccountEmployeeSalary();
        $data->sal_date=$sal_date;
        $data->emp_id=$request->emp_id[$checkdata[$i]];
        $data->sal_amount=$request->sal_amount[$checkdata[$i]];
        $data->save();
    }
}
if(!empty(@$data) || empty($checkdata)){
    $notData=$this->noti->ShowNotification('Well Done Data Successfully updated','success');
    return redirect()->route('acc.empsalary.view')->with($notData);
}else{
    $notData=$this->noti->ShowNotification('Sorry Data Can not be added due to some error','error');
    return redirect()->back()->with($notData);
}
    }
}
