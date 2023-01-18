<?php

namespace App\Http\Controllers\StudentManagement;

use App\Http\Controllers\Controller;
use App\Http\NotificationHelper;
use Illuminate\Http\Request;
use App\Models\StudentManagement\ShiftManagement;

class ShiftManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected string $path="Admin.SetupManagement.Shift.";
    public function index()
    {
        $data['title_page']="Shift Management";
        $data['shifts']=ShiftManagement::latest()->get();
        return view($this->path.'viewShift',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title_page']="Create Shift";
        return view($this->path.'addShift',$data);
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
            'shift_name'=>'required|unique:shift_management',
        ]);
        ShiftManagement::create($request->all());
       $noti=new NotificationHelper;
       $data=$noti->ShowNotification('A new shift has been created','success');
       return redirect()->route('shift.index')->with($data);
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
        $data['title_page']="Edit Shift";
        $data['shift']=ShiftManagement::findorfail($id);
        return view($this->path.'editShift',$data);
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
            'shift_name'=>'required|unique:shift_management,shift_name,'.$id,
                    ]);
          ShiftManagement::findorFail($id)->update($request->all());
          $noti=new NotificationHelper;
          $data=$noti->ShowNotification('Student shift updated successfully','info');
          return redirect()->route('shift.index')->with($data);         
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
    public function DeleteShift($id){
ShiftManagement::findorFail($id)->delete();
$noti=new NotificationHelper;
        $data=$noti->ShowNotification('Student Shift deleted successfully','warning');
        return redirect()->back()->with($data);
    }
}
