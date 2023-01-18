<?php

namespace App\Http\Controllers\StudentManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentManagement\FeeCategory;
use App\Http\NotificationHelper;

class FeeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected string $path="Admin.SetupManagement.FeeCategory.";
    public function index()
    {
    $data['title_page']="Fee Category Management";
    $data['feecategories']=FeeCategory::latest()->get();
    return view($this->path.'viewCategory',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title_page']="Create Fee Category";
        return view($this->path.'addCategory',$data);
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
'fee_cate_name'=>'required|unique:fee_categories',
        ]);
        FeeCategory::create($request->all());
        $noti=new NotificationHelper;
        $data=$noti->ShowNotification('A new Fee Category has been created','success');
        return redirect()->route('feecategory.index')->with($data);
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
        $data['title_page']="Edit Fee Category";
        $data['feecategory']=FeeCategory::findorfail($id);
        return view($this->path.'editCategory',$data);
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
            'fee_cate_name'=>'required|unique:fee_categories,fee_cate_name,'.$id,
        ]);
        FeeCategory::findOrfail($id)->update($request->all());
        $noti=new NotificationHelper;
        $data=$noti->ShowNotification('Fee Category Updated Successfully','info');
        return redirect()->route('feecategory.index')->with($data);
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
    public function DeleteFeeCategory($id){
        FeeCategory::findOrfail($id)->delete();
        $noti=new NotificationHelper;
        $data=$noti->ShowNotification('Fee Category Deleted Successfully','warning');
        return redirect()->back()->with($data);

    }
}
