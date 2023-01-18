@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
    <div class="row">
        <div class="col-12">
            <x-data-table-comp>
                <x-slot name="tableTitle">View And Manage Fee Category</x-slot>
                <x-slot name="buttonArea">
                    <a class="btn btn-app btn-info" href="{{route('feecategory.create')}}" style="float: right;">
                        <i class="fa fa-plus-square"></i> Add New Fee Category
                    </a>
                </x-slot>
                <x-slot name="tableHead">
                    <th>Sr.No</th>
                    <th>Fee Category Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </x-slot>
                @foreach ($feecategories as $cate)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$cate->fee_cate_name}}</td>
                        <td><a href="{{route('feecategory.edit',$cate->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a></td>
                        <td><a href="{{route('feecategory.delete',$cate->id)}}" class="btn btn-danger" id="delete"><i class="mdi mdi-delete"></i></a></td>
                    </tr>
                @endforeach
            </x-data-table-comp>
        </div>
    </div>
   
@endsection