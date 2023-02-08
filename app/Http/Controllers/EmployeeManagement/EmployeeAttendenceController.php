<?php

namespace App\Http\Controllers\EmployeeManagement;

use App\Http\Controllers\Controller;
use App\Http\NotificationHelper;
use App\Models\EmployeeManagement\EmployeeAttendence;
use App\Models\User;
use Illuminate\Http\Request;


class EmployeeAttendenceController extends Controller
{
    protected string $path="Admin.EmployeeManagement.EmployeeAttendence.";
    public object $noti;
    public function __construct(){
        $this->noti =new NotificationHelper();
    }
    public function AttendenceView(){
$data['title_page']="Employee Attendence";
//$data['attendenceData']=EmployeeAttendence::latest()->get();
$data['attendenceData']=EmployeeAttendence::select('attendence_date')->groupBy('attendence_date')
->orderBy('attendence_date')->get();
return view($this->path.'viewAtten',$data);
    }

    public function AttendenceCreate(){
$data['title_page']="Add Employee Attendence";
$data['employees']=User::where('userType','Employee')->latest()->get();
return view($this->path.'markAtten',$data);
    }
    public function AttendenceSave(Request $request){
        $countEmployee=Count($request->emp_id);
        for($i=0;$i<$countEmployee;$i++){
            $attendence_status='attendence_status'.$i;
            $att=new EmployeeAttendence();
            $att->attendence_date=date('y-m-d',strtotime($request->attendence_date));
            $att->emp_id=$request->emp_id[$i];
            $att->attendence_status= $request->$attendence_status;
            $att->save();
        }
        $data=$this->noti->ShowNotification("Employee Attendence Added Successfully",'success');
        return redirect()->route('attendence.view')->with($data);
    }
    public function AttendenceEdit($date){
        $data['editData']=EmployeeAttendence::where('attendence_date',$date)->latest()->get();
        $data['title_page']="Edit Attendence Details";
        $data['employees']=User::where('userType','Employee')->latest()->get();
        return view($this->path.'editAtten',$data);
    }
    public function AttendenceDetails($date){
$data['attendeceDetails']=EmployeeAttendence::where('attendence_date',$date)->latest()->get();
$data['title_page']="View Attendence Details";
return view($this->path.'detailAtten',$data);
    }
    public function AttendenceDelete($date){
EmployeeAttendence::Where('attendence_date',$date)->delete();
$data=$this->noti->ShowNotification('Attendence for that date is Deleted Successfully','warning');
return redirect()->back()->with($data);
    }
    public function AttendenceUpdate(Request $request, $date){
        EmployeeAttendence::where('attendence_date', date('Y-m-d', strtotime($date)))->delete();
        $countEmployee=Count($request->emp_id);
        for($i=0;$i<$countEmployee;$i++){
            $attendence_status='attendence_status'.$i;
            $att=new EmployeeAttendence();
            $att->attendence_date=date('y-m-d',strtotime($request->attendence_date));
            $att->emp_id=$request->emp_id[$i];
            $att->attendence_status= $request->$attendence_status;
            $att->save();
        }
        $data=$this->noti->ShowNotification("Employee Attendence Updated Successfully",'info');
        return redirect()->route('attendence.view')->with($data);
    }
}
