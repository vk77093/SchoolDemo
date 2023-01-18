@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
    <div class="row">
        <div class="col-12">
            <x-data-table-comp>
                <x-slot name="tableTitle">View And Manage Class</x-slot>
                <x-slot name="buttonArea">
                    <a class="btn btn-app btn-info" href="{{route('student.create.class')}}" style="float: right;">
                        <i class="fa fa-plus-square"></i> Add New Class
                    </a>
                </x-slot>
                <x-slot name="tableHead">
                    <th>Sr.No</th>
                    <th>Class</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </x-slot>
                @foreach ($classes as $cl)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$cl->class_name}}</td>
                        <td><a href="{{route('student.edit.class',$cl->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a></td>
                        <td><a href="{{route('student.delete.class',$cl->id)}}" class="btn btn-danger" id="delete"><i class="mdi mdi-delete"></i></a></td>
                    </tr>
                @endforeach
            </x-data-table-comp>
        </div>
    </div>
   
@endsection