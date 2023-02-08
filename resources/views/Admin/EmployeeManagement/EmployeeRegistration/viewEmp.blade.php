@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<div class="row">
    <div class="col-12 mt-1">
        <x-data-table-comp>
            <x-slot name="tableTitle">View Registered Employee</x-slot>
            <x-slot name="buttonArea">
                    <a class="btn btn-app btn-info" href="{{route('empregistration.create')}}" style="float: right;">
                        <i class="fa fa-plus-square"></i> Add New Employee
                    </a>
            </x-slot>  
            <x-slot name="tableHead">
                <th>Sr.No.</th>
                <th>Name</th>
                <th>ID No.</th>
                <th>Mobile</th>
                <th>Gender</th>
                <th>Join Date</th>
                <th>Salary</th>
                <th>Code</th>
                <th>Profile Image</th>
                <th>Edit</th>
                <th>View Details</th>
                <th>Delete</th>
            </x-slot>
            @foreach ($employees as $emp)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$emp->name}}</td>
                <td>{{$emp->stu_IdNumber}}</td>
                <td>{{$emp->mobile}}</td>
                <td>{{$emp->gender}}</td>
                <td>{{$emp->join_date}}</td>
                <td>{{$emp->salary}}</td>
                <td>
                    @if (Auth::user()->userType=='Admin')
                    {{$emp->code}}
                    @endif
                </td>
                <td><img src="{{(!empty($emp->profile_photo_path)? url($emp->profile_photo_path) :url('AdminAsset/UserProfileImage/no_image.jpg'))}}" width="30" height="30"></td>
                <td>
                    <a title="Edit Employee" href="{{route('empregistration.edit',$emp->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                    
                </td>
                <td><a title="View PDF" href="{{route('empregistration.viewPdf',$emp->id)}}" class="btn btn-danger"><i class="fa fa-eye"></i></a>
                    </td>
                    <td><a title="Delete Employee" href="{{route('empregistration.delete',$emp->id)}}" class="btn btn-danger" id="delete"><i class="mdi mdi-delete"></i></a></td>
                </tr>
            @endforeach
        </x-data-table-comp>
    </div>
</div>
@endsection