<?php

namespace App\Http\Controllers\EmployeeManagement;

use App\Http\Controllers\Controller;
use App\Http\NotificationHelper;
use App\Models\EmployeeManagement\EmployeeSalaryLog;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeSalaryController extends Controller
{
    protected string $path="Admin.EmployeeManagement.EmployeeSalary.";
    public object $noti;
    public function __construct(){
        $this->noti = new NotificationHelper();
    }
    public function ViewSalary(){
        $data['title_page']="View Employee Salary";
        $data['salaryDetails']=User::where('userType','Employee')->latest()->get();
        return view($this->path.'viewSalary',$data);
    }
    public function SalaryIncrement($id){
        $data['title_page']="Increment Salary";
        $data['editData']=User::findorFail($id);
        return view($this->path.'IncrementSalary',$data);
    }
    public function SalaryIncrementSave(Request $request,$id){
        $user=User::findorFail($id);
        $previous_salary = $user->salary;
    	$present_salary = (float)$previous_salary+(float)$request->increment_salary; 
    	$user->salary = $present_salary;
    	$user->save();
        $salaryData = new EmployeeSalaryLog();
    	$salaryData->emp_id = $id;
    	$salaryData->previous_salary = $previous_salary;
    	$salaryData->increment_salary = $request->increment_salary;
    	$salaryData->current_salary = $present_salary;
    	$salaryData->effective_date = date('Y-m-d',strtotime($request->effective_date));
    	$salaryData->save();
        $data=$this->noti->ShowNotification('Salary Data Updated Successfully','success');
        return redirect()->route('salary.view')->with($data);
    }
    public function ViewSalaryDetails($id){
        $userId=User::findOrfail($id);
        $data['title_page']="Salary Details";
        $data['SalaryData']=EmployeeSalaryLog::where('emp_id',$userId->id)->get();
        return view($this->path.'viewSalaryDetails',$data);
    }

}
