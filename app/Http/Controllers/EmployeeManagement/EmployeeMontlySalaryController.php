<?php

namespace App\Http\Controllers\EmployeeManagement;

use App\Http\Controllers\Controller;
use App\Http\NotificationHelper;
use App\Models\EmployeeManagement\EmployeeAttendence;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class EmployeeMontlySalaryController extends Controller
{
    protected string $path="Admin.EmployeeManagement.EmployeeMonthlySalary.";
    public object $noti;
    public function __construct(){
        $this->noti =new NotificationHelper();
    }
    public function ViewMonthlySalary(){
        $data['title_page']="Montly Salary View";
        return view($this->path.'empSalMonView',$data);
    }
    //json 
    public function MonthlySalaryGet(Request $request){
        $attendenceDate=date('Y-m',strtotime($request->attendence_date));
        //dd($attendenceDate);
        if($attendenceDate !=''){
            $whereDate[]=['attendence_date','like',$attendenceDate.'%'];
        }
        $data=EmployeeAttendence::select('emp_id')->groupBy('emp_id')->with(['UserName'])
        ->where($whereDate)->get();
        //dd($data);
        $html['thsource']  = '<th>SL</th>';
    	 $html['thsource'] .= '<th>Employee Name</th>';
    	 $html['thsource'] .= '<th>Basic Salary</th>';
    	 $html['thsource'] .= '<th>Salary This Month</th>';
    	 $html['thsource'] .= '<th>Action</th>';

         foreach($data as $key=> $sal){
            $totalAttendence=EmployeeAttendence::with(['UserName'])->where($whereDate)->
            where('emp_id',$sal->emp_id)->get();
            $absentCount=count($totalAttendence->where('attendence_status','Absent'));

            $color='success';
            $html[$key]['tdsource']='<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$sal['UserName']['name'].'</td>';
    	 	$html[$key]['tdsource'] .= '<td>'.$sal['UserName']['salary'].'</td>';

            $salary=(float)$sal['UserName']['salary'];
            $salaryPerDay=(float)$salary/30;
            $totalSalaryMinus=(float)$absentCount*(float)$salaryPerDay;
            $totalSalary=(float)$salary-(float)$totalSalaryMinus;

            $html[$key]['tdsource'] .='<td>'.round($totalSalary).'$'.'</td>';
    	 	$html[$key]['tdsource'] .='<td>';
    	 	$html[$key]['tdsource'] .='<a class="btn btn-sm btn-'.$color.'" title="PaySlip" target="_blanks" href="'.route("monthlysalary.payslip",$sal->emp_id).'">Fee Slip</a>';
    	 	$html[$key]['tdsource'] .= '</td>';

         }
         return response()->json(@$html);
    }
    public function MonthlySalaryPayslip(Request $request,$empId){
$id=EmployeeAttendence::where('emp_id',$empId)->first();
$dateGot=date('Y-m',strtotime($id->attendence_date));
if($dateGot !=null){
    $whereDate[]=['attendence_date','like',$dateGot.'%'];
}
$data['details']=EmployeeAttendence::with(['UserName'])->where($whereDate)
->where('emp_id',$id->emp_id)->get();
$pdf=Pdf::loadView($this->path.'monthlySalaryPdf',$data);
return $pdf->setPaper('a4')->stream();
    }
}
