<?php

namespace App\Http\Controllers\StudentManagement;

use App\Http\Controllers\Controller;
use App\Models\StudentManagement\StudentGroup;
use Illuminate\Http\Request;
use App\Http\NotificationHelper;


class StudentGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected string $path="Admin.SetupManagement.Groups.";
   
 
    public function index()
    {
        $title_page="Student Groups";
      $groups =StudentGroup ::latest()->get();
      return view($this->path.'viewGroup',compact('title_page', 'groups'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title_page']="Create Student group";
        return view($this->path.'addGroup',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,NotificationHelper $notification)
    {
    $request->validate([
        'group_name'=>'required|unique:student_groups',
    ]);
    StudentGroup::create($request->all());
    //$notification = new NotificationHelper;
  $data= $notification->ShowNotification('A Student New Group Data Added Successfully','success');
    return redirect()->route('studentgroup.index')->with($data);

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
        $data['title_page']="Edit Student group";
        $data['student']=StudentGroup::findorfail($id);
        return view($this->path.'editGroup',$data);
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
'group_name'=>'required|unique:student_groups,group_name,'.$id,
        ]);
    StudentGroup::findOrfail($id)->update($request->all());
$noti=new NotificationHelper;
$data=$noti->ShowNotification('Student group updated successfully','info');
return redirect()->route('studentgroup.index')->with($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function DeleteGroup($id)
    {
        StudentGroup::findorfail($id)->delete();
        $noti=new NotificationHelper;
        $data=$noti->ShowNotification('Student group deleted successfully','warning');
        return redirect()->back()->with($data);
    }
}
