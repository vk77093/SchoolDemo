@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<div class="row">
   <div class="col-12 mt-1">
    <x-data-table-comp>
        <x-slot name="tableTitle">View  Employee Salary</x-slot>
        <x-slot name="buttonArea">
                <a class="btn btn-app btn-info" href="{{route('empregistration.create')}}" style="float: right;">
                    <i class="fa fa-plus-square"></i> Add Employee Salary
                </a>
        </x-slot> 
        <x-slot name="tableHead">
            <th width="5%">SL</th>  
				<th>Name</th> 
				<th>ID NO</th>
				<th>Mobile</th>
				<th>Gender</th>
				<th>Join Date</th>
				<th>Salary</th>
				 
				<th width="20%">Action</th>
        </x-slot> 
        @foreach ($salaryDetails as $value)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td> {{ $value->name }}</td>	
				<td> {{ $value->stu_IdNumber }}</td>	
				<td> {{ $value->mobile }}</td>	
				<td> {{ $value->gender }}</td>	
				<td> {{ date('d-m-Y',strtotime($value->join_date))  }}</td>	
				<td> {{ $value->salary }}</td>
                <td>
                    <a title="Increment" href="{{ route('salary.increment',$value->id) }}" class="btn btn-info"> <i class="fa fa-plus-circle"></i></a>
                    
                    <a title="Details" target="_blank" href="{{ route('salary.viewdetails',$value->id) }}" class="btn btn-danger"><i class="fa fa-eye"></i></a>
                </td>
                </tr>
        @endforeach
    </x-data-table-comp>
    </div> 
</div>
@endsection