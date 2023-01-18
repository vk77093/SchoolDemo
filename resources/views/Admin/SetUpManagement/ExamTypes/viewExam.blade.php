@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
    <div class="row">
        <div class="col-12">
            <x-data-table-comp>
                <x-slot name="tableTitle">View And Manage Exam Types</x-slot>
                <x-slot name="buttonArea">
                    <a class="btn btn-app btn-info" href="{{route('examtype.create')}}" style="float: right;">
                        <i class="fa fa-plus-square"></i> Add New Exam Type
                    </a>
                </x-slot>
                <x-slot name="tableHead">
                    <th>Sr.No</th>
                    <th>Exam Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </x-slot>
                @foreach ($exams as $exam)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$exam->exam_name}}</td>
                        <td><a href="{{route('examtype.edit',$exam->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a></td>
                        <td><a href="{{route('examtype.delete',$exam->id)}}" class="btn btn-danger" id="delete"><i class="mdi mdi-delete"></i></a></td>
                    </tr>
                @endforeach
            </x-data-table-comp>
        </div>
    </div>
   
@endsection