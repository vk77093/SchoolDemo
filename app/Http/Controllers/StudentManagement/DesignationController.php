<?php

namespace App\Http\Controllers\StudentManagement;

use App\Http\Controllers\Controller;
use App\Http\NotificationHelper;
use App\Models\StudentManagement\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected string $path="Admin.SetupManagement.Designation.";
    protected object $noti;
public function __construct(){
    $this->noti = new NotificationHelper();
}
    public function index()
    {
        $data['title_page']="View Designation";
        $data['designations']=Designation::latest()->get();
        return view($this->path.'viewDesg',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title_page']="Create Designation";
        return view($this->path.'addDesg',$data);
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
'desg_name'=>'required|unique:designations',
        ]);
        Designation::create($request->all());
        $data=$this->noti->ShowNotification('New Designation added successfully','success');
        return redirect()->route('designation.index')->with($data);
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
        $data['title_page']="Edit Designation";
        $data['desg']=Designation::findorFail($id);
        return view($this->path.'editDesg',$data);
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
'desg_name'=>'required|unique:designations,desg_name,'.$id,
        ]);
        Designation::findorFail($id)->update($request->all());
        $data=$this->noti->ShowNotification('Designation Updated Successfully','info');
        return redirect()->route('designation.index')->with($data);
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
    public function DeleteDesignation($id){
        Designation::findorFail($id)->delete();
        $data=$this->noti->ShowNotification('Designation Deleted','warning');
        return redirect()->back()->with($data);
    }
}
