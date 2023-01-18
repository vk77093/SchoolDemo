<?php

namespace App\Http\Controllers\StudentManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentManagement\FeeCategoryAmount;
use App\Http\NotificationHelper;
use App\Models\StudentManagement\ClassManagement;
use App\Models\StudentManagement\FeeCategory;
use PHPUnit\Framework\Constraint\Count;

class FeeCategoryAmountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected string $path="Admin.SetUpManagement.FeeCategoryAmount.";
    public function index()
    {
        $data['title_page']="View Fee Category wise Amount";
       // $data['feeCateAmount']=FeeCategoryAmount::latest()->get();
       $data['feeCateAmount']=FeeCategoryAmount::Select('fee_cate_id')->groupBy('fee_cate_id')->get();
        return view($this->path.'viewFeeAmt',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title_page']="Create Fee Category Amount";
        $data['categories']=FeeCategory::latest()->get();
        $data['classes']=ClassManagement::latest()->get();
        return view($this->path.'addFeeAmt',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'fee_cate_id'=>'required|integer',
        //     'class_id'=>'required|integer',
        //     'cate_amount'=>'required',
        // ]);
        $countClass=Count($request->class_id);
        if($countClass !=null){
            for($i=0;$i<$countClass;$i++){
            $feeAmount=new FeeCategoryAmount();
            $feeAmount->fee_cate_id=$request->fee_cate_id;
            $feeAmount->class_id=$request->class_id[$i];
            $feeAmount->cate_amount=$request->cate_amount[$i];
            $feeAmount->save();
            }
            $noti=new NotificationHelper;
            $data=$noti->ShowNotification('Your Fees Category Amount has been Added successfully','success');
            return redirect()->route('feecateamount.index')->with($data);
        }else{
            $noti=new NotificationHelper;
            $data=$noti->ShowNotification('some error occuured','warnging');
            return redirect()->route('feecateamount.index')->with($data);
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
        $data['title_page']="Details of Fee Category";
        $data['details']=FeeCategoryAmount::where('fee_cate_id',$id)
        ->orderBy('class_id','asc')->get();
        return view($this->path.'showFeeCateAmount',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['feecateamt']=FeeCategoryAmount::where('fee_cate_id',$id)
        ->orderBy('class_id','asc')->get();
        $data['categories']=FeeCategory::latest()->get();
        $data['classes']=ClassManagement::latest()->get();
        $data['title_page']='Edit fee Category Amount';
        return view($this->path.'editFeeAmt',$data);
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
        $noti=new NotificationHelper;
        if($request->class_id==null){
            $data=$noti->ShowNotification('You Need to Have Atleast One entry','info');
            return redirect()->back()->with($data);
        }else{
            $countClass=Count($request->class_id);
            FeeCategoryAmount::where('fee_cate_id',$id)->delete();
            for($i=0;$i<$countClass;$i++){
                $feeAmount=new FeeCategoryAmount();
                $feeAmount->fee_cate_id=$request->fee_cate_id;
                $feeAmount->class_id=$request->class_id[$i];
                $feeAmount->cate_amount=$request->cate_amount[$i];
                $feeAmount->save();
            }
  
            $data=$noti->ShowNotification('Fee Category with amount got updated Successfully','success');
            return redirect()->route('feecateamount.index')->with($data);
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
        

    }
    public function DeleteFeeCategoryAmount($id){
        FeeCategoryAmount::where('fee_cate_id',$id)->delete();
        $noti=new NotificationHelper;
        $data=$noti->ShowNotification('Data Deleted Successfully','warning');
        return redirect()->back()->with($data);
    }
}
