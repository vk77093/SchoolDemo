<?php

namespace App\Http\Controllers\ReportsManagment;

use App\Http\Controllers\Controller;
use App\Http\NotificationHelper;
use App\Models\EmployeeManagement\EmployeeAttendence;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AttendanceReportController extends Controller
{
    protected string $path="Admin.ReportsManagment.AttendanceReport.";
protected object $noti;
public function __construct(){
    $this->noti = new NotificationHelper();
}
    public function ViewAttendanceReport(){
        $data['title_page']="Attendance Report";
$data['employees']=User::where('userType','Employee')->latest()->get();
        return view($this->path.'viewAtt',$data);
    }
    public function GetAttendanceReportPDF(Request $request){
        $empId=$request->emp_id;
       
        if($empId != ''){
            $where[]=['emp_id',$empId];
        }
        $date=date('Y-m',strtotime($request->date));
        if($date != ''){
            $where[]=['attendence_date','like',$date.'%'];
        }
        $singleAttendance=EmployeeAttendence::with(['UserName'])->where($where)->get();
       // dd($singleAttendance);
        if($singleAttendance !=null){
            $data['allData']=EmployeeAttendence::with(['UserName'])->where($where)->get();
            $data['absents'] = EmployeeAttendence::with(['UserName'])->where($where)->where('attendence_status','Absent')->get()->count();

    	$data['leaves'] = EmployeeAttendence::with(['UserName'])->where($where)->where('attendence_status','Leave')->get()->count();

    	$data['month'] = date('m-Y', strtotime($request->date));

        $pdfdata=Pdf::loadView($this->path.'AttPdf',$data);
       return $pdfdata->setPaper('a4')->stream('EmployeeAttendanceReport.pdf');
        }else{
$dataNoti=$this->noti->ShowNotification('Sorry No Data Is Found','error');
return redirect()->back()->with($dataNoti);
        }
    }
}
