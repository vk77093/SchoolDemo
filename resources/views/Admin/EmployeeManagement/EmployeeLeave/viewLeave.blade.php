@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<div class="row">
    <div class="col-12 mt-1">
        <x-data-table-comp>
            <x-slot name="tableTitle">View  Employee Leave</x-slot>
            <x-slot name="buttonArea">
                    <a class="btn btn-app btn-info" href="{{route('leave.create')}}" style="float: right;">
                        <i class="fa fa-plus-square"></i> Add Employee Leave
                    </a>
            </x-slot>  
            <x-slot name="tableHead">
                <th>SL</th>
                <th>Employee Name</th>
                <th>Id Number</th>
                <th>Leave Purpose</th>
                <th>From Date</th>
                <th>To Date</th>
                <th width="20%">Action</th>
            </x-slot>
            @foreach ($leaves as $leave)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$leave->EmployeeName->name}}</td>
                    <td>{{$leave->EmployeeName->stu_IdNumber}}</td>
                    <td>{{$leave->PurposeName->purpose_name}}</td>
                    <td>{{date('d-m-y',strtotime($leave->start_date))}}</td>
                    <td>{{date('d-m-y',strtotime($leave->end_date))}}</td>
                    <td>
                        <a title="Edit" href="{{ route('leave.edit',$leave->id) }}" class="btn btn-info"> <i class="fa fa-edit"></i></a>
                    
                        <a title="Delete"  href="{{ route('leave.delete',$leave->id) }}" class="btn btn-danger" id="delete"><i class="mdi mdi-delete"></i></a> 
                    </td>
                </tr>
            @endforeach
        </x-data-table-comp>
    </div>
</div>
@endsection