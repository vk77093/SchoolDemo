<?php

namespace App\Http\Controllers\StudentManagement;

use App\Http\Controllers\Controller;
use App\Http\NotificationHelper;
use App\Models\StudentManagement\ExamType;
use Illuminate\Http\Request;

class ExamTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    protected string $path="Admin.SetUpManagement.ExamTypes.";
    protected object $noti;
    public function __construct(){
        $this->noti=new NotificationHelper;
    }
    public function index()
    {
        $data['title_page']="View Exam Types";
        $data['exams']=ExamType::latest()->get();
        return view($this->path.'viewExam',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title_page']="Create Exam Types";
        return view($this->path.'addExam',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'exam_name'=>'required|unique:exam_types',
        ]);
        ExamType::create($request->all());
        $data=$this->noti->ShowNotification('exam Type Added successfully','success');
        return redirect()->route('examtype.index')->with($data);
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
    public function edit($id)
    {
         $data['exam']=ExamType::findorFail($id);
        $data['title_page']="Edit Exam Types";
        return view($this->path.'editExam',$data);
        
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
        $request->validate([
            'exam_name'=>'required|unique:exam_types,exam_name,'.$id,
        ]);
        $exam=ExamType::findorFail($id);
        $exam->update($request->all());
        $data=$this->noti->ShowNotification('Data Updated','info');
        return redirect()->route('examtype.index')->with($data);
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
    public function DeleteExamType($id){
        ExamType::findorFail($id)->delete();
        $data=$this->noti->ShowNotification('Data Deleted','warning');
        return redirect()->back()->with($data);
    }
}
