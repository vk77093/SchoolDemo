<?php

namespace App\Http\Controllers\StudentManagement;
use App\Http\Controllers\Controller;
use App\Models\StudentManagement\Year;
use Illuminate\Http\Request;

class YearController extends Controller
{
    protected string $path="Admin.SetupManagement.Years.";
    public function ViewYear(){
        $title_page="Session Year";
        $years=Year::latest()->get();
        return view($this->path.'viewYear',compact('title_page','years'));
    }
    public function CreateYear(){
        $title_page="Create Year";
        return view($this->path.'addYear',compact('title_page'));

    }
    public function EditYear($id){
        $year=Year::findorfail($id);
        $title_page="Edit Year";
        return view($this->path.'editYear',compact('year','title_page'));
    }
    public function DeleteYear($id){
        Year::findorfail($id)->delete();
        $data=$this->ShowNotification('Session year is deleted successfully','danger');
        return redirect()->back()->with('data');
    }
    public function AddYear(Request $request){
        $request->validate([
            'year_name'=>'required|integer|unique:years',
        ]);
        Year::create($request->all());
        $data=$this->ShowNotification('A New Session Year is added successfully','success');
        return redirect()->route('student.view.year')->with($data);
    }
    public function UpdateYear(Request $request,$id){
        $gotId=Year::findorFail($id);
        $request->validate([
'year_name'=>'required|integer|unique:years,year_name,'.$gotId->id,
        ]);
        Year::findorFail($id)->update([
            'year_name'=>$request->year_name,
        ]);
        $data=$this->ShowNotification('Session year got updated Successfully','info');
        return redirect()->route('student.view.year')->with($data);
        
    }
    private function ShowNotification($message,$alertType) {
        $notifi=array('message'=>$message,'alertType'=>$alertType);
        return $notifi;
    }
}
