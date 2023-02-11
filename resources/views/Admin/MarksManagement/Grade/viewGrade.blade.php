@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<div class="row">
    <div class="col-md-12">
        <x-data-table-comp>
            <x-slot name="tableTitle">View And Manage Grades</x-slot>
            <x-slot name="buttonArea">
                <a class="btn btn-app btn-info" href="{{route('grade.create')}}" style="float: right;">
                    <i class="fa fa-plus-square"></i> Add New Grade
                </a>
            </x-slot>
            <x-slot name="tableHead">
                <th>Sr.No</th>
                <th>Grade Name</th>
                <th>Grade Point</th>
                <th>Start Marks</th>
                <th>End Marks</th>
                <th>Range Of Point</th>
                <th>Remarks</th>
                <th>Edit</th>
                <th>Delete</th>
            </x-slot>
            @foreach ($gardes as $grade)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$grade->grade_name}}</td>
                    <td>{{$grade->grade_point}}</td>
                     <td>{{$grade->start_marks}}</td>
                     <td>{{$grade->end_marks}}</td>
                     <td>{{$grade->start_point}} - {{$grade->end_point}}</td>
                     <td>{{$grade->remarks}}</td>
                     <td><a href="{{route('grade.edit',$grade->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a></td>
                     <td><a href="{{route('grade.delete',$grade->id)}}" class="btn btn-danger" id="delete"><i class="mdi mdi-delete"></i></a></td>
                </tr>
            @endforeach
        </x-data-table-comp>
    </div>
</div>
@endsection