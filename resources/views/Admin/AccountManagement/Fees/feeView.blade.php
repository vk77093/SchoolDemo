@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<div class="row">
    <div class="col-md-12">
        <x-data-table-comp>
            <x-slot name="tableTitle">View Student fees</x-slot>
            <x-slot name="buttonArea">
                    <a class="btn btn-app btn-info" href="{{route('fees.create')}}" style="float: right;">
                        <i class="fa fa-plus-square"></i> Add Student Fees
                    </a>
            </x-slot> 
            <x-slot name="tableHead">
                <th>SL</th>
                <th>Year</th>
                <th>Class</th>
                <th>Student</th>
                <th>Student id</th>
                <th>Fees Category</th>
                <th>Fees Date</th>
                <th>Amount</th>
                <th>Edit</th>
                <th>Delete</th>
            </x-slot>
            @foreach ($fees as $fee)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$fee->YearName->year_name}}</td>
                    <td>{{$fee->ClassName->class_name}}</td>
                    <td>{{$fee->UserName->name}}</td>
                    <td>{{$fee->UserName->stu_IdNumber}}</td>
                    <td>{{$fee->FeeCategoryName->fee_cate_name}}</td>
                    <td>{{$fee->fee_date}}</td>
                    <td>{{$fee->fee_amount}}</td>
                    <td><a title="Edit" href="{{ route('fees.edit',$fee->id) }}" class="btn btn-info"> <i class="fa fa-edit"></i></a></td>
                    <td><a title="Delete"  href="{{ route('fees.delete',$fee->id) }}" class="btn btn-danger" id="delete"><i class="mdi mdi-delete"></i></a> </td>
                </tr>
            @endforeach
        </x-data-table-comp>
    </div>
</div>
@endsection