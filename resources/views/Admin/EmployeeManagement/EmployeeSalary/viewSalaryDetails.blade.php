@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<div class="row">
   <div class="col-12 mt-1">
    <x-data-table-comp>
        <x-slot name="tableTitle">View  Employee Salary Details</x-slot>
        <x-slot name="buttonArea">
                <a class="btn btn-app btn-info" href="{{route('salary.view')}}" style="float: right;">
                    <i class="fa fa-plus-square"></i> View Employee Salary
                </a>
        </x-slot> 
        <x-slot name="tableHead">
            <<th width="5%">SL</th>  
            <th>Previous Salary</th> 
            <th>Increment Salary</th>
            <th>Present Salary</th>
            <th>Effected Date</th>
        </x-slot> 
        @foreach ($SalaryData as $value)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td> {{ $value->previous_salary }}</td>	
				<td> {{ $value->increment_salary }}</td>	
				<td> {{ $value->current_salary }}</td>	
				
				<td> {{ date('d-m-Y',strtotime($value->effective_date))  }}</td>	
				
                </tr>
        @endforeach
    </x-data-table-comp>
    </div> 
</div>
@endsection