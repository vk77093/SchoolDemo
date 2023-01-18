@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
    <div class="row">
        <div class="col-12">
            <x-data-table-comp>
                <x-slot name="tableTitle">View And Manage year</x-slot>
                <x-slot name="buttonArea">
                    <a class="btn btn-app btn-info" href="{{route('student.create.year')}}" style="float: right;">
                        <i class="fa fa-plus-square"></i> Add New Session Year
                    </a>
                </x-slot>
                <x-slot name="tableHead">
                    <th>Sr.No</th>
                    <th>Year</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </x-slot>
                @foreach ($years as $yl)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$yl->year_name}}</td>
                        <td><a href="{{route('student.edit.year',$yl->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a></td>
                        <td><a href="{{route('student.delete.year',$yl->id)}}" class="btn btn-danger" id="delete"><i class="mdi mdi-delete"></i></a></td>
                    </tr>
                @endforeach
            </x-data-table-comp>
        </div>
    </div>
   
@endsection