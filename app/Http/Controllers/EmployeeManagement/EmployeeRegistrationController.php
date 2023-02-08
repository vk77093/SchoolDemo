<?php

namespace App\Http\Controllers\EmployeeManagement;

use App\Http\Controllers\Controller;
use App\Http\NotificationHelper;
use App\Models\EmployeeManagement\EmployeeSalaryLog;
use App\Models\StudentManagement\Designation;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class EmployeeRegistrationController extends Controller
{
    protected string $path="Admin.EmployeeManagement.EmployeeRegistration.";
    public object $noti;
    protected string $ImagePath="AdminAsset/EmployeeImages/";
    public function __construct(){
$this->noti =new NotificationHelper();
    }
  public function ViewEmpRegis(){
$data['title_page'] ='View Employee';
$data['employees']=User::where('userType','Employee')->orderBy('id','desc')->get();
return view($this->path.'viewEmp',$data);
  }

  public function CreateEmp(){
$data['title_page'] ="Create Employee";
$data['designations']=Designation::latest()->get();
return view($this->path.'createEmp',$data);
  }
  public function AddEmployee(Request $request){
    DB::transaction(function()use($request){
      //generate the employee code unique
      $checkYear=date('Ym',strtotime($request->join_date));
      $emp=User::where('userType','Employee')->orderBy('id','desc')->first();
      if($emp==null){
        $firstRegNum=0;
        $empId=$firstRegNum+1;
        if($emp<10){
          $idNum="000".$empId;
        }else if($emp<100){
          $idNum="00".$empId;
        }else if($empId <1000){
          $idNum="0".$empId;
        }
      }else{
        $emp=User::where('userType','Employee')->orderBy('id','desc')->first()->id;
        $empId=$emp+1;
        if($emp<10){
          $idNum="000".$empId;
        }else if($emp<100){
          $idNum="00".$empId;
        }else if($empId <1000){
          $idNum="0".$empId;
        }

      } //end of id generation
      $final_id_number=$checkYear.$idNum;
      $user=new User();
      $code=rand(0000,9999);
$user->stu_IdNumber=$final_id_number;
$user->email=$request->name.'@gmail.com';

$user->userType="Employee";
$user->code=$code;
$user->password = bcrypt($request->name.$code);
$user->name=$request->name;
$user->fname=$request->fname;
$user->mname=$request->mname;
$user->mobile=$request->mobile;
$user->gender=$request->gender;
$user->religion=$request->religion;
$user->address=$request->address;
$user->dob=date('Y-m-d',strtotime($request->dob));
$user->join_date=date('Y-m-d',strtotime($request->join_date));
$user->designation_id=$request->designation_id;
$user->salary=$request->salary;
if($request->hasFile('profile_photo_path')){
  $image=$request->file('profile_photo_path');
  $imageName=date('Y-m-d').$image->getClientOriginalName();
  Image::make($image)->resize(430,327)->save($this->ImagePath.$imageName);
  $saveUrl=$this->ImagePath.$imageName;
  $user->profile_photo_path=$saveUrl;
}
$user->save();

//now in Employee Salary Log
$empSalary=new EmployeeSalaryLog();
$empSalary->emp_id=$user->id;
$empSalary->effective_date=date('Y-m-d',strtotime($request->join_date));
$empSalary->previous_salary=$request->salary;
$empSalary->current_salary=$request->salary;
$empSalary->increment_salary=0;
 $empSalary->save();

    });
    $data=$this->noti->ShowNotification('A new Employee Record added successfully','success');
    return redirect()->route('empregistration.ViewEmpRegis')->with($data);
  }
  public function EditEmployee($id){
$data['editData']=User::findorFail($id);
$data['designations']=Designation::latest()->get();
$data['title_page']="Edit Employee Record";
return view($this->path.'editEmp',$data);
  }
  public function UpdateEmployee(Request $request,$id){
$user=User::where('id',$id)->first();
$previousImage=$user->profile_photo_path;
$user->name=$request->name;
$user->email=$request->name.'@gmail.com';
$user->fname=$request->fname;
$user->mname=$request->mname;
$user->mobile=$request->mobile;
$user->gender=$request->gender;
$user->religion=$request->religion;
$user->address=$request->address;
$user->dob=date('Y-m-d',strtotime($request->dob));
if($request->hasFile('profile_photo_path')){
  $image=$request->file('profile_photo_path');
  $imageName=date('Y-m-d').$image->getClientOriginalName();
      Image::make($image)->resize(430,327)->save($this->ImagePath.$imageName);
      $saveUrl=$this->ImagePath.$imageName;
      unlink($previousImage);
      $user->profile_photo_path=$saveUrl;
  }
  $user->save();
  $data=$this->noti->ShowNotification('Data Updated Successfully','info');
  return redirect()->route('empregistration.ViewEmpRegis')->with($data);
  }
  public function DeleteEmployee($id){
$user=User::findorFail($id);
$previousImage=$user->profile_photo_path;
if($previousImage !=null){
  unlink($previousImage);
  $salaryLog=EmployeeSalaryLog::where('emp_id',$user->id)->first();
$salaryLog->delete();
$user->delete();
$data=$this->noti->ShowNotification('Data Deleted Successfully with image','warning');
  return redirect()->back()->with($data);
}else{
  $salaryLog=EmployeeSalaryLog::where('emp_id',$user->id)->first();
$salaryLog->delete();
$user->delete();
$data=$this->noti->ShowNotification('Data Deleted Successfully without image','warning');
  return redirect()->back()->with($data);
}

  }
  public function viewPdf($id){
    $data['details']=User::where('id',$id)->where('userType','Employee')->first();
    //dd($data['details']->profile_photo_path);
    $pdf=Pdf::loadView($this->path.'viewEmpPdf',$data);
    return $pdf->setPaper('a4')->stream();
  }
  
}
