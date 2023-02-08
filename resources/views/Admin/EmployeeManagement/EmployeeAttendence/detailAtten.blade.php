@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<div class="row">
    <div class="col-12 mt-1">
        <x-data-table-comp>
            <x-slot name="tableTitle">View  Employee Attendence Data</x-slot>
            <x-slot name="buttonArea">
                    <a class="btn btn-app btn-info" href="{{route('attendence.create')}}" style="float: right;">
                        <i class="fa fa-plus-square"></i> Add Attendence
                    </a>
            </x-slot> 
            <x-slot name="tableHead">
            <th>SL</th>
            <th>Attendence Date</th>
            <th>Employee Name</th>
            <th>Emp Code</th>
            <th>Attendence Status</th>
            <th width="20%">Action</th>
              
            </x-slot> 
            @foreach ($attendeceDetails as $att)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{date('d-m-y',strtotime($att->attendence_date))}}</td>
                    <td>{{$att->UserName->name}}</td>
                    <td>{{$att->UserName->stu_IdNumber}}</td>
                    <td>{{$att->attendence_status}}</td>
                    <td>
                        <a title="Edit" href="{{ route('attendence.edit',$att->attendence_date) }}" class="btn btn-info"> <i class="fa fa-edit"></i></a>
                        
                        <a title="Delete"  href="{{ route('attendence.delete',$att->id) }}" class="btn btn-danger" id="delete"><i class="mdi mdi-delete"></i></a> 
                    </td>
                </tr>
            @endforeach  
        </x-data-table-comp>
    </div>
</div>
@endsection