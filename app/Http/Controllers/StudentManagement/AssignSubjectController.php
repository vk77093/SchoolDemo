<?php

namespace App\Http\Controllers\StudentManagement;

use App\Http\Controllers\Controller;
use App\Http\NotificationHelper;
use App\Models\StudentManagement\AssignSubject;
use App\Models\StudentManagement\ClassManagement;
use App\Models\StudentManagement\SubjectType;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;

class AssignSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected string $path="Admin.SetUpManagement.AssignSubject.";
    protected object $noti;
    public function __construct(){
        $this->noti = new NotificationHelper;
    }
    public function index()
    {
        $data['title_page']="Assigned Subject";
        $data['assignSubjects']=AssignSubject::select('class_id')->
        groupBy('class_id')->get();
        return view($this->path.'viewAssSub',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title_page']="Assign Subject";
        $data['classes']=ClassManagement::latest()->get();
        $data['subjects']=SubjectType::latest()->get();
        return view($this->path.'addAssSub',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $countSubject=Count($request->subject_id);
        if($countSubject != null){
for($i=0;$i<$countSubject;$i++){
    AssignSubject::create([
'class_id'=>$request->class_id,
'subject_id'=>$request->subject_id[$i],
'pass_mark'=>$request->pass_mark[$i],
'full_mark'=>$request->full_mark[$i],
'subjective_mark'=>$request->subjective_mark[$i],
    ]);
    
}
$data=$this->noti->ShowNotification('Subject Assigned to Class Successfully','success');
    return redirect()->route('assignsubject.index')->with($data);
        }else{
            $data=$this->noti->ShowNotification('Subject Assigned to Class Failure','error');
            return redirect()->route('assignsubject.create')->with($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['title_page']="Details of All The Subject";
        $data['details']=AssignSubject::where('class_id',$id)->
        orderBy('subject_id','asc')->get();
        return view($this->path.'showAssSub',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title_page']="Edit The Assign Subject";
        $data['assSub']=AssignSubject::where('class_id',$id)->orderBy('subject_id','asc')
        ->get();
        $data['classes']=ClassManagement::latest()->get();
        $data['subjects']=SubjectType::latest()->get();
        return view($this->path.'editAssSub',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->subject_id == null){
            $data=$this->noti->ShowNotification('It Can not be blank','error');
            return redirect()->back()->with($data);
        }else{
            $countSubject=Count($request->subject_id);
            $gettedclass=AssignSubject::where('class_id',$id)->delete();
          
         
            for($i=0;$i<$countSubject;$i++){

                AssignSubject::create([
        'class_id'=>$request->class_id,
        'subject_id'=>$request->subject_id[$i],
        'pass_mark'=>$request->pass_mark[$i],
        'full_mark'=>$request->full_mark[$i],
        'subjective_mark'=>$request->subjective_mark[$i],
    ]);

}
            $data=$this->noti->ShowNotification('Assigned Subject updated successfully','info');
            return redirect()->route('assignsubject.index')->with($data);
        }
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
    public function DeleteAssignedSubject($id){
        AssignSubject::where('class_id',$id)->delete();
        $data=$this->noti->ShowNotification('Assigned Subject Class Deleted Successfully','warning');
        return redirect()->back()->with($data);
    }
}
