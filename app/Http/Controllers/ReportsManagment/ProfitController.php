<?php

namespace App\Http\Controllers\ReportsManagment;

use App\Http\Controllers\Controller;
use App\Models\AccountManagement\AccountEmployeeSalary;
use App\Models\AccountManagement\OtherCost;
use App\Models\AccountManagement\StudentFee;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ProfitController extends Controller
{
    protected string $path="Admin.ReportsManagment.MontlyYearlyProfit.";
    public function ViewmontlyYearlyProfit(){
        $data['title_page']="Monthly Yearly Profit";
      return view($this->path.'viewProfit',$data);
    }

    //json Fetch
    public function GetProfitDataDateWise(Request $request){
        $start_date = date('Y-m',strtotime($request->start_date));
		$end_date = date('Y-m',strtotime($request->end_date));
    	$sdate = date('Y-m-d',strtotime($request->start_date));
    	$edate = date('Y-m-d',strtotime($request->end_date));

        $studentFee=StudentFee::whereBetween('fee_date',[$start_date,$end_date])->sum('fee_amount');
        $otherCost=OtherCost::whereBetween('cost_date',[$sdate,$edate])->sum('cost_amount');
        $empSalary=AccountEmployeeSalary::whereBetween('sal_date',[$start_date,$end_date])->sum('sal_amount');

        $totalCost=$otherCost+$empSalary;
        $profit=$studentFee-$totalCost;
        $html['thsource']  = '<th>Student Fee</th>';
    	 $html['thsource'] .= '<th>Other Cost</th>';
    	 $html['thsource'] .= '<th>Employee Salary</th>';
    	 $html['thsource'] .= '<th>Total Cost</th>';
    	 $html['thsource'] .= '<th>Profit </th>';
    	 $html['thsource'] .= '<th>Action</th>';

         $color = 'success';
    	 $html['tdsource']  = '<td>'.$studentFee.'</td>';
    	 $html['tdsource']  .= '<td>'.$otherCost.'</td>';
    	 $html['tdsource']  .= '<td>'.$empSalary.'</td>';
    	 $html['tdsource']  .= '<td>'.$totalCost.'</td>';
    	 $html['tdsource']  .= '<td>'.$profit.'</td>';
    	 $html['tdsource'] .='<td>';
    	 $html['tdsource'] .='<a class="btn btn-sm btn-'.$color.'" title="PDF" target="_blanks" href="'.route("report.profit.pdf").'?start_date='.$sdate.'&end_date='.$edate.'">View PDF</a>';
    	 $html['tdsource'] .= '</td>';
    	
    	return response()->json(@$html); 
    }
    public function ViewPdfReport(Request $request){
        $data['start_date'] = date('Y-m',strtotime($request->start_date));
		$data['end_date'] = date('Y-m',strtotime($request->end_date));
    	$data['sdate'] = date('Y-m-d',strtotime($request->start_date));
    	$data['edate'] = date('Y-m-d',strtotime($request->end_date));
        $data['studentFee']=StudentFee::whereBetween('fee_date',[$data['start_date'],$data['end_date']])->sum('fee_amount');
        $data['otherCost']=OtherCost::whereBetween('cost_date',[$data['sdate'],$data['edate']])->sum('cost_amount');
        $data['empSalary']=AccountEmployeeSalary::whereBetween('sal_date',[$data['start_date'],$data['end_date']])->sum('sal_amount');

        $data['totalCost']=$data['otherCost']+$data['empSalary'];
        $data['profit']= $data['studentFee']- $data['totalCost'];
//dd($data['studentFee']);
        $pdf=Pdf::loadView($this->path.'pdfProfit',$data);
        return $pdf->setPaper('a4')->stream('ProfitReport.pdf');
    }
}
