@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
    <div class="row">
        <div class="col-12">
            <x-data-table-comp>
                <x-slot name="tableTitle">View And Manage Shifts</x-slot>
                <x-slot name="buttonArea">
                    <a class="btn btn-app btn-info" href="{{route('shift.create')}}" style="float: right;">
                        <i class="fa fa-plus-square"></i> Add New Shift
                    </a>
                </x-slot>
                <x-slot name="tableHead">
                    <th>Sr.No</th>
                    <th>Shift Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </x-slot>
                @foreach ($shifts as $shift)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$shift->shift_name}}</td>
                        <td><a href="{{route('shift.edit',$shift->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a></td>
                        <td><a href="{{route('shift.delete',$shift->id)}}" class="btn btn-danger" id="delete"><i class="mdi mdi-delete"></i></a></td>
                    </tr>
                @endforeach
            </x-data-table-comp>
        </div>
    </div>
   
@endsection