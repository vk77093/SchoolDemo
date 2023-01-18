@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
    <div class="row">
        <div class="col-12">
            <x-data-table-comp>
                <x-slot name="tableTitle">View And Manage Subject</x-slot>
                <x-slot name="buttonArea">
                    <a class="btn btn-app btn-info" href="{{route('subject.create')}}" style="float: right;">
                        <i class="fa fa-plus-square"></i> Add New Subject Type
                    </a>
                </x-slot>
                <x-slot name="tableHead">
                    <th>Sr.No</th>
                    <th>Subject Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </x-slot>
                @foreach ($subjects as $sub)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$sub->subject_name}}</td>
                        <td><a href="{{route('subject.edit',$sub->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a></td>
                        <td><a href="{{route('subject.delete',$sub->id)}}" class="btn btn-danger" id="delete"><i class="mdi mdi-delete"></i></a></td>
                    </tr>
                @endforeach
            </x-data-table-comp>
        </div>
    </div>
   
@endsection