@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
    <div class="row">
        <div class="col-12">
            <x-data-table-comp>
                <x-slot name="tableTitle">View And Manage Designation</x-slot>
                <x-slot name="buttonArea">
                    <a class="btn btn-app btn-info" href="{{route('designation.create')}}" style="float: right;">
                        <i class="fa fa-plus-square"></i> Add New Designation
                    </a>
                </x-slot>
                <x-slot name="tableHead">
                    <th>Sr.No</th>
                    <th>Designation Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </x-slot>
                @foreach ($designations as $desg)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$desg->desg_name}}</td>
                        <td><a href="{{route('designation.edit',$desg->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a></td>
                        <td><a href="{{route('designation.delete',$desg->id)}}" class="btn btn-danger" id="delete"><i class="mdi mdi-delete"></i></a></td>
                    </tr>
                @endforeach
            </x-data-table-comp>
        </div>
    </div>
   
@endsection