@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<div class="row">
    <div class="col-12">
        <x-data-table-comp>
            <x-slot name="tableTitle">View And Manage User</x-slot>
            <x-slot name="buttonArea">
                <a class="btn btn-app btn-info" href="{{route('user.create')}}" style="float: right;">
                    <i class="fa fa-plus-square"></i> Add New User
                </a>
            </x-slot>
            <x-slot name="tableHead">
                <th>Sr.No</th>
                <th>User Name</th>
                <th>Email</th>
                <th>User Type</th>
                <th>Photos</th>
                <th>Edit</th>
                <th>Delete</th>
            </x-slot>
            @foreach ($users as $user)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{!empty($user->userType) ? $user->userType : 'No Role Assigned'}}</td>
                    <td><img src="{{(!empty($user->profile_photo_path)? url($user->profile_photo_path) : url('AdminAsset/UserProfileImage/no_image.jpg'))}}" width="50" height="30"></td>
                    <td><a href="{{route('user.edit',$user->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a></td>
                    <td><a href="{{route('user.delete',$user->id)}}" class="btn btn-danger" id="delete"><i class="mdi mdi-delete"></i></a></td>
                </tr>
            @endforeach
        </x-data-table-comp>
    </div>
</div>
   
@endsection