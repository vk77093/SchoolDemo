<?php

namespace App\Http\Controllers\StudentManagement;
use App\Http\Controllers\Controller;
use App\Models\StudentManagement\ClassManagement;

use Illuminate\Http\Request;

class ClassManagementController extends Controller
{
    protected  string $path="Admin.SetUpManagement.Classes.";
    public function ViewClass(){
$title_page="View Class";
$classes=ClassManagement::latest()->get();
return view($this->path.'viewClass',compact('title_page','classes'));
    }
    public function EditClass($id){
$title_page="Edit Class";
$class=ClassManagement::findorfail($id);
return view($this->path.'editClass',compact('title_page','class'));
    }
    public function DeleteClass($id){
$idGet=ClassManagement::findorfail($id);
$idGet->delete();
$data=$this->ShowNotification('Class Deleted Successfully','danger');
return redirect()->back()->with($data);

    }
    public function AddClass(Request $request){
$request->validate([
    'class_name'=>'required|max:15|string|unique:class_management',
]);
ClassManagement::create([
'class_name'=>$request->class_name,
]);
$data=$this->ShowNotification('Class Added Successfully','success');
return redirect()->route('student.view.class')->with($data);
    }
    public function UpdateClass(Request $request, $id){
        $getId=ClassManagement::findorFail($id);
        $request->validate([
            'class_name'=>'required|max:15|string|unique:class_management,class_name,'.$getId->id,
        ]);
        ClassManagement::findorFail($id)->update([
            'class_name'=>$request->class_name,
        ]);
        $data=$this->ShowNotification('Class Name Changed Successfully','info');
        return redirect()->route('student.view.class')->with($data);

    }
    public function CreateClass(){
        $title_page="Create Class";
        return view($this->path.'addClass',compact('title_page'));
    }
    private function ShowNotification($message,$alertType) {
        $notifi=array('message'=>$message,'alert-type'=>$alertType);
        return $notifi;
    }
}
