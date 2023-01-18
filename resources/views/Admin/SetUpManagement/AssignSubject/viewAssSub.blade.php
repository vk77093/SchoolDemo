@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<div class="row">
    <div class="col-12">
        <x-data-table-comp>
            <x-slot name="tableTitle">View And Manage Assigned Subjects</x-slot>
            <x-slot name="buttonArea">
                    <a class="btn btn-app btn-info" href="{{route('assignsubject.create')}}" style="float: right;">
                        <i class="fa fa-plus-square"></i> Add New Fee Assigned Subject
                    </a>
            </x-slot>
            <x-slot name="tableHead">
                <th>Sr.No.</th>
                <th>Class Name</th>
                <th>Edit</th>
                <th>Details</th>
                <th>Delete</th>
            </x-slot>
            @foreach ($assignSubjects as $sub)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$sub->ClassName->class_name}}</td>
                    <td><a href="{{route('assignsubject.edit',$sub->class_id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a></td>
                    <td><a href="{{route('assignsubject.show',$sub->class_id)}}" class="btn btn-primary"><i class="fa fa-eye"></i></a></td>
                    <td><a href="{{route('assignsubject.delete',$sub->class_id)}}" class="btn btn-danger" id="delete"><i class="mdi mdi-delete"></i></a></td>
                </tr>
            @endforeach
        </x-data-table-comp>
    </div>
</div>
@endsection