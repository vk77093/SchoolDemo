<?php

namespace App\Http\Controllers\StudentManagement;

use App\Http\Controllers\Controller;
use App\Http\NotificationHelper;
use App\Models\StudentManagement\SubjectType;
use Illuminate\Http\Request;

class SubjectTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected string $path="Admin.SetUpManagement.SubjectTypes.";
    protected object $noti;
    public function __construct(){
        $this->noti=new NotificationHelper;
    }
    public function index()
    {
        $data['title_page']='View Subject';
        $data['subjects']=SubjectType::latest()->get();
        return view($this->path.'viewSubject',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title_page']='Create Subject';
        return view($this->path.'addSubject',$data);
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
'subject_name'=>'required|unique:subject_types',
        ]);
        SubjectType::create($request->all());
        $data=$this->noti->ShowNotification('Subject Added Successfully','success');
        return redirect()->route('subject.index')->with($data);
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
        $data['subject']=SubjectType::findOrFail($id);
        $data['title_page']="Edit Subject";
        return view($this->path.'editSubject',$data);
        
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
'subject_name'=>'required|unique:subject_types,subject_name,'.$id,
        ]);
        SubjectType::findOrFail($id)->update($request->all());
        $data=$this->noti->ShowNotification('Data Updated','info');
        return redirect()->route('subject.index')->with($data);
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
    public function DeleteSubject($id){
        SubjectType::findorFail($id)->delete();
        $data=$this->noti->ShowNotification('Data Deleted','warning');
        return redirect()->back()->with($data);
    }
}
