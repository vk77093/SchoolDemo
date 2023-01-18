@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<div class="row">
    <div class="col-12">
        <x-data-table-comp>
            <x-slot name="tableTitle">Detail View Of All The Assigned Subject</x-slot>
            <x-slot name="buttonArea">
                    <a class="btn btn-app btn-info" href="{{route('assignsubject.create')}}" style="float: right;">
                        <i class="fa fa-plus-square"></i> Assign Subject To Class
                    </a>
            </x-slot>
            <h4 class="text-center"><strong>Class is : {{$details[0]->ClassName->class_name}}</strong></h4>
            <x-slot name="tableHead">
                <th>Sr.No.</th>
                <th>Subject</th>
                <th>Full Mark</th>
                <th>Passing Mark</th>
                <th>Subjective Mark</th>
               
            </x-slot>
            @foreach ($details as $sub)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$sub->SubjectName->subject_name}}</td>
                    <td>{{$sub->full_mark}}</td>
                    <td>{{$sub->pass_mark}}</td>
                    <td>{{$sub->subjective_mark}}</td>
                   
                </tr>
            @endforeach
        </x-data-table-comp>
    </div>
</div>
@endsection