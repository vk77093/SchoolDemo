@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<div class="row">
    <div class="col-12">
        <x-data-table-comp>
            <x-slot name="tableTitle">View And Manage Fee Category Amount</x-slot>
            <x-slot name="buttonArea">
                    <a class="btn btn-app btn-info" href="{{route('feecateamount.create')}}" style="float: right;">
                        <i class="fa fa-plus-square"></i> Add New Fee Category Amount
                    </a>
            </x-slot>
            <x-slot name="tableHead">
                <th>Sr.No.</th>
                <th>Fee Category</th>
                <th>Edit</th>
                <th>Details</th>
                <th>Delete</th>
            </x-slot>
            @foreach ($feeCateAmount as $fee)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$fee->Category->fee_cate_name}}</td>
                    <td><a href="{{route('feecateamount.edit',$fee->fee_cate_id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a></td>
                    <td><a href="{{route('feecateamount.show',$fee->fee_cate_id)}}" class="btn btn-primary"><i class="fa fa-eye"></i></a></td>
                    <td><a href="{{route('feecateamount.delete',$fee->fee_cate_id)}}" class="btn btn-danger" id="delete"><i class="mdi mdi-delete"></i></a></td>
                </tr>
            @endforeach
        </x-data-table-comp>
    </div>
</div>
@endsection