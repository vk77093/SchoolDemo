@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<div class="row">
    <div class="col-12">
        <x-data-table-comp>
            <x-slot name="tableTitle">Detail View Of Fee Category</x-slot>
            <x-slot name="buttonArea">
                    <a class="btn btn-app btn-info" href="{{route('feecateamount.create')}}" style="float: right;">
                        <i class="fa fa-plus-square"></i> Add New Fee Category Amount
                    </a>
            </x-slot>
            <h4 class="text-center"><strong>Fee Category is : {{$details[0]->Category->fee_cate_name}}</strong></h4>
            <x-slot name="tableHead">
                <th>Sr.No.</th>
                <th>Class Name</th>
                <th>Amount</th>
               
            </x-slot>
            @foreach ($details as $fee)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$fee->ClassName->class_name}}</td>
                    <td>{{$fee->cate_amount}}</td>
                   
                </tr>
            @endforeach
        </x-data-table-comp>
    </div>
</div>
@endsection