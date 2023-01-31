<?php

namespace App\Http\Controllers\StudentReg;

use App\Http\Controllers\Controller;
use App\Models\StudentManagement\Year;
use App\Models\StudentManagement\ClassManagement;
use Illuminate\Http\Request;
use App\Http\NotificationHelper;
use App\Models\StudentReg\AssignStudent;

class RollNumberController extends Controller
{
    public  string $path="Admin.StudentRegistration.StuRoll.";
    public object $noti;
    public function __construct(){
        $this->noti=new NotificationHelper();
    }
    public function RollView(){
       
            $data['title_page']="ROll number Generate";
            $data['years']=Year::latest()->get();
            $data['classes']=ClassManagement::latest()->get();
            return view($this->path.'RollView',$data);
        
       
    }
    public function GetStudent(Request $request){
  // dd("hello done"); check in network tab
  $year_id=$request->year_id;
  $class_id=$request->class_id;
 $allData=AssignStudent::with(['UserName'])->where('year_id',$year_id)
  ->where('class_id',$class_id)->get();
  //dd($allData->toArray()); //check network preview tab
  
  return response()->json($allData);

    }
    public function StudentRoleStore(Request $request){
        $year_id=$request->year_id;
        $class_id=$request->class_id;
        if($request->stu_id !=null){
            for($i=0;$i<count($request->stu_id);$i++){
AssignStudent::where('year_id',$year_id)->where('class_id',$class_id)
->where('stu_id',$request->stu_id[$i])->update([
    'roll_number'=>$request->rollnumber[$i],
]);
            }
        }else{
            $data=$this->noti->ShowNotification('No Student is found','error');
            return redirect()->back()->with($data);
        }
        $data=$this->noti->ShowNotification('Well done roll number got assigned successfully','success');
        return redirect()->route('rollview.view')->with($data);
    }
}
