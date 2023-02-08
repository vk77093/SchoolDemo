<?php

namespace App\Http\Controllers\EmployeeManagement;

use App\Http\Controllers\Controller;
use App\Http\NotificationHelper;
use App\Models\EmployeeManagement\EmployeeLeave;
use App\Models\EmployeeManagement\LeavePurpose;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeLeaveController extends Controller
{
    protected string $path="Admin.EmployeeManagement.EmployeeLeave.";
    public object $noti;
    public function __construct(){
        $this->noti =new NotificationHelper();
    }
    public function LeaveView(){
        $data['title_page']="All Leave Data";
        $data['leaves']=EmployeeLeave::latest()->get();
        return view($this->path.'viewLeave',$data);
    }
    public function CreateLeave(){
        $data['title_page']="Create Leave Data";
        $data['leavesPurpose']=LeavePurpose::latest()->get();
        $data['employees']=User::where('userType','Employee')->get();
        return view($this->path.'createLeave',$data);
    }
    public function SaveLeave(Request $request){
        if($request->leave_purpose_id==="0"){
            $leavesPurpose=new LeavePurpose();
            $leavesPurpose->purpose_name=$request->purpose_name;
            $leavesPurpose->save();
            $leavesPurposeId=$leavesPurpose->id;
            

            $empLeave=new EmployeeLeave();
            $empLeave->emp_id=$request->emp_id;
            $empLeave->leave_purpose_id=$leavesPurposeId;
            $empLeave->start_date=date('d-m-y',strtotime($request->start_date));
            $empLeave->end_date=date('d-m-y',strtotime($request->end_date));
            $empLeave->save();
            $data=$this->noti->ShowNotification("Employee Leave and new Reason added successfully",'success');
            return redirect()->route('leave.view')->with($data);
        }else{
            $leavesPurposeId=$request->leave_purpose_id;

            $empLeave=new EmployeeLeave();
            $empLeave->emp_id=$request->emp_id;
            $empLeave->leave_purpose_id=$leavesPurposeId;
            $empLeave->start_date=date('d-m-y',strtotime($request->start_date));
            $empLeave->end_date=date('d-m-y',strtotime($request->end_date));
            $empLeave->save();
            $data=$this->noti->ShowNotification("Employee Leave added successfully",'success');
            return redirect()->route('leave.view')->with($data);
        }
    }
    public function EditLeave($id){
        $data['title_page']="Edit leave";
        $data['editData']=EmployeeLeave::findorFail($id);
        $data['employees']=User::where('userType','Employee')->latest()->get();
        $data['leavesPurpose']=LeavePurpose::latest()->get();
        return view($this->path.'editLeave',$data);

    }
    public function UpdateLeave(Request $request,$id){
        $leaveId=EmployeeLeave::findorFail($id);
        if($request->leave_purpose_id==0){
            $leavesPurpose=new LeavePurpose();
            $leavesPurpose->purpose_name=$request->purpose_name;
            $leavesPurpose->save();
            $leavesPurposeId=$leavesPurpose->id;

            $leaveId->emp_id=$request->emp_id;
            $leaveId->leave_purpose_id=$leavesPurposeId;
            $leaveId->start_date=date('d-m-y',strtotime($request->start_date));
            $leaveId->end_date=date('d-m-y',strtotime($request->end_date));
            $leaveId->save();
            $data=$this->noti->ShowNotification("Leave Data And Reason Updated successfully",'info');
            return redirect()->route('leave.view')->with($data);
        }else{
            $leaveId->emp_id=$request->emp_id;
            $leaveId->leave_purpose_id=$request->leave_purpose_id;
            $leaveId->start_date=date('d-m-y',strtotime($request->start_date));
            $leaveId->end_date=date('d-m-y',strtotime($request->end_date));
            $leaveId->save();
            $data=$this->noti->ShowNotification("Leave Data Updated successfully",'info');
            return redirect()->route('leave.view')->with($data);
        }
       
        
    }
    public function DeleteLeave($id){
        EmployeeLeave::findorFail($id)->delete();
        $data=$this->noti->ShowNotification("Leave Data Deleted",'warning');
        return redirect()->back()->with($data);

    }
}
