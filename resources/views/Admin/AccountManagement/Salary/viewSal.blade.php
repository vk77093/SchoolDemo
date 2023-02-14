@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<div class="row"></div>
    <div class="col-sm-12 col-md-12">
<x-data-table-comp>
    <x-slot name="tableTitle">View Employee Salary</x-slot>
            <x-slot name="buttonArea">
                    <a class="btn btn-app btn-info" href="{{route('acc.empsalary.addedit')}}" style="float: right;">
                        <i class="fa fa-plus-square"></i> Add/Edit Employee Salary
                    </a>
            </x-slot> 
            <x-slot name="tableHead">
                <th>SL</th>
                <th>Name</th>
                <th>Emp Id Number</th>
                <th>Salary Amount</th>
                <th>Date</th>
                <th>Delete</th>
            </x-slot>
            @foreach ($employeeSalaries as $sal)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$sal->EmployeeName->name}}</td>
                    <td>{{$sal->EmployeeName->stu_IdNumber}}</td>
                    <td>{{$sal->sal_amount}}</td>
                    <td>{{$sal->sal_date}}</td>
                    <td><a title="Delete"  href="{{ route('acc.empsalary.delete',$sal->id) }}" class="btn btn-danger" id="delete"><i class="mdi mdi-delete"></i></a> </td>
                </tr>
            @endforeach
</x-data-table-comp>
    </div>
</div>
@endsection