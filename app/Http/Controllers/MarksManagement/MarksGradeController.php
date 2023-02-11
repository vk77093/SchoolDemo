<?php

namespace App\Http\Controllers\MarksManagement;

use App\Http\Controllers\Controller;
use App\Http\NotificationHelper;
use App\Models\MarksManagement\MarksGrade;
use Illuminate\Http\Request;

class MarksGradeController extends Controller
{
    protected string $path="Admin.MarksManagement.Grade.";
    public object $noti;
    public function __construct(){
        $this->noti =new NotificationHelper();
    }
    public function ViewGrade(){
        $data['title_page']="List Of Grades";
        $data['gardes']=MarksGrade::latest()->get();
        return view($this->path.'viewGrade',$data);
    }
    public function CreateGrade(){
        $data['title_page']="Create Grades";
        return view($this->path.'createGrade',$data);
    }
    public function EditGrade($id){
        $data['title_page']="Edit Grades";
        $data['grade']=MarksGrade::findorFail($id);
        return view($this->path.'editGrade',$data);
    }
    public function SaveGrade(Request $request) {
        $request->validate([
'grade_name'=>'required|unique:marks_grades',
'grade_point'=>'required|unique:marks_grades|integer',
        ]);
        MarksGrade::create($request->all());
        $data=$this->noti->ShowNotification("Grade Data Added successfully",'success');
return redirect()->route('grade.view')->with($data);
    }
    public function UpdateGrade(Request $request,$id){
        $getId=MarksGrade::findorFail($id);
        $request->validate([
            'grade_name'=>'required|unique:marks_grades,id,'.$getId->id,
            'grade_point'=>'required|integer|unique:marks_grades,id,'.$getId->id,
                    ]);
        MarksGrade::findOrfail($id)->update($request->all());
        $data=$this->noti->ShowNotification("Grade Data Updated successfully",'info');
        return redirect()->route('grade.view')->with($data);
    }
    public function DeleteGrade($id){
MarksGrade::findOrFail($id)->delete();
$data=$this->noti->ShowNotification("Grade Data Deleted successfully",'warning');
return redirect()->back()->with($data);
    }
}
