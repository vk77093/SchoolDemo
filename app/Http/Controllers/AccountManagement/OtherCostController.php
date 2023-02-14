<?php

namespace App\Http\Controllers\AccountManagement;

use App\Http\Controllers\Controller;
use App\Http\NotificationHelper;
use App\Models\AccountManagement\OtherCost;
use Illuminate\Http\Request;
use Image;

class OtherCostController extends Controller
{
    protected string $path="Admin.AccountManagement.OtherCost.";
    protected string $ImagePath="AdminAsset/OtherCostImages/";
    protected object $noti;
    public function __construct(){
        $this->noti = new NotificationHelper();
    }
    public function ViewCost(){
        $data['title_page']="View Other Cost Data";
        $data['costs']=OtherCost::latest()->get();
        return view($this->path.'costView',$data);
    }
    public function CreateCost(){
        $data['title_page']="Create Cost Data";
        return view($this->path.'costCreate',$data);
    }
    public function SaveCost(Request $request){
        $request->validate([
'pro_image_path'=>'required',
'pro_description'=>'required|min:5',
        ]);
        if($request->hasFile('pro_image_path')){
            $image=$request->file('pro_image_path');
            $imageName=uniqid().$image->getExtension();
            Image::make($image)->resize(480,480)
            ->save($this->ImagePath.$imageName);
            $saveUrl=$this->ImagePath.$imageName;
            OtherCost::create([
'cost_date'=>date('Y-m-d',strtotime($request->cost_date)),
'cost_amount'=>$request->cost_amount,
'pro_description'=>$request->pro_description,
'pro_image_path'=>$saveUrl,
            ]);
        }
        $data=$this->noti->ShowNotification("Cost Data Added successfully",'success');
        return redirect()->route('cost.view')->with($data);
    }
    public function EditCost($id){
        $data['title_page']="Edit Cost Data";
        $data['editCost']=OtherCost::findorFail($id);
        return view($this->path.'costEdit',$data);

    }
    public function DeleteCost($id){
       $costData=OtherCost::findorFail($id);
       $previousImage=$costData->pro_image_path;
       if($previousImage !=null){
        unlink($previousImage);
        OtherCost::findorFail($id)->delete();
        $data=$this->noti->ShowNotification("Cost Data Delete successfully",'warnging');
        return redirect()->back()->with($data);
       }else{
        OtherCost::findorFail($id)->delete();
        $data=$this->noti->ShowNotification("Cost Data Delete successfully",'warnging');
        return redirect()->back()->with($data);
       }
        

    }
    public function UpdateCost(Request $request,$id){
        $iddata=OtherCost::findorFail($id);

        $request->validate([
           // 'pro_image_path'=>'required',
            'pro_description'=>'required|min:5',
                    ]);
         $previousImage=$iddata->pro_image_path; 
         if($request->hasFile('pro_image_path')){
            $image=$request->file('pro_image_path');
            $imageName=uniqid().$image->getExtension();
            Image::make($image)->resize(480,480)
            ->save($this->ImagePath.$imageName);
            $saveUrl=$this->ImagePath.$imageName;
            unlink($previousImage);
            OtherCost::findOrFail($id)->update([
'cost_date'=>date('Y-m-d',strtotime($request->cost_date)),
'cost_amount'=>$request->cost_amount,
'pro_description'=>$request->pro_description,
'pro_image_path'=>$saveUrl,
            ]);
            $data=$this->noti->ShowNotification("Cost Data Updated successfully",'info');
            return redirect()->route('cost.view')->with($data);
         }else{
            OtherCost::findOrFail($id)->update([
                'cost_date'=>date('Y-m-d',strtotime($request->cost_date)),
                'cost_amount'=>$request->cost_amount,
                'pro_description'=>$request->pro_description,
            ]);
            $data=$this->noti->ShowNotification("Cost Data Updated successfully",'info');
            return redirect()->route('cost.view')->with($data);
         }
        
    }
}
