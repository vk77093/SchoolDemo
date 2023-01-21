<?php

namespace App\Http\Controllers\StudentReg;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\NotificationHelper;
use App\Models\StudentManagement\Year;
use App\Models\StudentManagement\ClassManagement;
use App\Models\StudentManagement\ShiftManagement;
use App\Models\StudentManagement\StudentGroup;
use App\Models\StudentReg\AssignStudent;
use App\Models\StudentReg\Discount;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Image;

class AssignStudentRegController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected string $path="Admin.StudentRegistration.StuReg.";
    public object $noti;
    protected string $ImagePath="AdminAsset/StudentImages/";
    public function __construct(){
        $this->noti=new NotificationHelper();
    }
    public function index(Request $request)
    {
        if($request->year_id !=null || $request->class_id != null){
            $data['title_page']="View Student Data";
            $data['years']=Year::latest()->get();
            $data['classes']=ClassManagement::latest()->get();
            $data['year']=Year::orderBy('id','desc')->first()->id;
            $data['class_id']=ClassManagement::orderBy('id','desc')->first()->id;
            $data['assignedStudents']=AssignStudent::where('year_id',$request->year_id)->
            where('class_id',$request->class_id)->get();
            return view($this->path.'viewStu',$data);
        }else{
            $data['title_page']="View Student Data";
            $data['years']=Year::latest()->get();
            $data['classes']=ClassManagement::latest()->get();
            $data['year']=Year::orderBy('id','desc')->first()->id;
            $data['class_id']=ClassManagement::orderBy('id','desc')->first()->id;
            $data['assignedStudents']=AssignStudent::where('year_id',$data['year'])->
            where('class_id',$data['class_id'])->get();
            return view($this->path.'viewStu',$data);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title_page']="Register New Student";
        $data['years']=Year::latest()->get();
        $data['classes']=ClassManagement::latest()->get();
        $data['shifts']=ShiftManagement::latest()->get();
        $data['groups']=StudentGroup::latest()->get();
        return view($this->path.'createStu',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    DB::transaction(function()use($request){
//Generate unique code
$checkYear=Year::find($request->year_id)->year_name;
$student=User::where('userType','Student')->orderBy('id','desc')->first();
if($student==null){
    $firstRegNumber=0;
    $studentId=$firstRegNumber+1;
    if($studentId <10){
        $IdNumber='000'.$studentId;
    }else if($studentId <100){
        $IdNumber="00".$studentId;
    }else if($studentId <1000){
        $IdNumber="0".$studentId;
    }
}else{
    $student=User::where('userType','Student')->orderBy('id','desc')->first()->id;
    $studentId=$student+1;
    if($studentId <10){
        $IdNumber='000'.$studentId;
    }else if($studentId <100){
        $IdNumber="00".$studentId;
    }else if($studentId <1000){
        $IdNumber="0".$studentId;
    }
}

//endof generation
$final_id_number=$checkYear.$IdNumber;
$user=new User();
$code=rand(0000,9999);
$user->stu_IdNumber=$final_id_number;
$user->email=$request->name.'@gmail.com';

$user->userType="Student";
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
if($request->hasFile('profile_photo_path')){
    $image=$request->file('profile_photo_path');
    $imageName=date('Y-m-d').$image->getClientOriginalName();
    Image::make($image)->resize(430,327)->save($this->ImagePath.$imageName);
    $saveUrl=$this->ImagePath.$imageName;
    $user->profile_photo_path=$saveUrl;
}
$user->save();

//Now in Assigned User Table
$assign=new AssignStudent();

$assign->stu_id=$user->id;
$assign->class_id=$request->class_id;
$assign->year_id=$request->year_id;
$assign->group_id=$request->group_id;
$assign->shift_id=$request->shift_id;
$assign->save();

//Now In Discount Table
$dis=new Discount();
$dis->ass_stu_id=$assign->id;
$dis->fee_cate_id=1;
$dis->discount=$request->discount;
$dis->save();
    });
    $data=$this->noti->ShowNotification('User Registration To Multiple table successfully','success');
    return redirect()->route('registration.index')->with($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($Stu_id)
    {
    
        $data['title_page']="Register New Student";
        $data['years']=Year::latest()->get();
        $data['classes']=ClassManagement::latest()->get();
        $data['shifts']=ShiftManagement::latest()->get();
        $data['groups']=StudentGroup::latest()->get();
        $data['editData']=AssignStudent::with(['UserName','discount'])->where('stu_id',$Stu_id)->first();
        //dd($data['editData']->toArray());
        return view($this->path.'editStu',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $stu_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $stu_id)
    {
        DB::transaction(function()use($request, $stu_id){
$user=User::where('id',$stu_id)->first();

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
//Now For Assign Student
$assign=AssignStudent::where('id',$request->id)->where('stu_id',$stu_id)->first();
//need to send the hidden value of id from form
//$assign->stu_id=$user->id;
$assign->class_id=$request->class_id;
$assign->year_id=$request->year_id;
$assign->group_id=$request->group_id;
$assign->shift_id=$request->shift_id;
$assign->save();
$discount=Discount::where('ass_stu_id',$request->id)->first();
$discount->discount=$request->discount;
$discount->save();


        });
        $data=$this->noti->ShowNotification('Data Updated Successfully','info');
        return redirect()->route('registration.index')->with($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
