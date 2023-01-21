@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<div class="row">
    <div class="col-12">
        <div class="box bb-3 border-warning">
            <div class="box-header">
              <h4 class="box-title">Fileter Student <strong>Bottom</strong></h4>
            </div>

            <div class="box-body">
              <form method="get" method="{{ route('registration.index') }}">
                <div class="row">
                    <div class="col-sm-4 col-md-4">
                        <div class="form-group">
                            <h4>Year</h4>
                            <div class="input-group">
                                <select class="form-control" name="year_id" value="{{old('year_id')}}">
                                    @foreach ($years as $item)
                                        <option value="{{$item->id}}" {{(@$year == $item->id) ? 'Selected' : ''}}>{{$item->year_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <h4>Select Class</h4>
                        <div class="input-group">
                            <select name="class_id" class="form-select form-control">
                                @foreach ($classes as $item)
                                    <option value="{{$item->id}}" {{(@$class_id == $item->id) ? ' selected="selected"' : ''}}>{{$item->class_name}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <h4></h4>
                        <div class="input-group mt-2">
                            <input type="submit" class="btn btn-info" value="Fetch"/>
                        </div>
                    </div>
                  </div>
              </form>
            </div>
          </div>
    </div>
    <div class="col-12 mt-1">
        <x-data-table-comp>
            <x-slot name="tableTitle">View Registered Students</x-slot>
            <x-slot name="buttonArea">
                    <a class="btn btn-app btn-info" href="{{route('registration.create')}}" style="float: right;">
                        <i class="fa fa-plus-square"></i> Add New Registration
                    </a>
            </x-slot>
            <x-slot name="tableHead">
                <th>Sr.</th>
                <th>Name</th>
                <th>ID Number</th>
                <th>Email</th>
                <th>Year</th>
                <th>Class</th>
                <th>Code</th>
                <th>Image</th>
                <th>Edit</th>
                <th>Promote</th>
            </x-slot>
            @foreach ($assignedStudents as $item)
                <td>{{$loop->iteration}}</td>
                <td>{{$item->UserName->name}}</td>
                <td>{{$item->UserName->stu_IdNumber}}</td>
                <td>{{$item->UserName->email}}</td>
                <td>{{$item->YearName->year_name}}</td>
                <td>{{$item->ClassName->class_name}}</td>
                <td>
                    @if (Auth::user()->userType=='Admin')
                    {{$item->code}}
                    @endif
                </td>
                <td><img src="{{(!empty($item->UserName->profile_photo_path)? url($item->UserName->profile_photo_path) : url('AdminAsset/UserProfileImage/no_image.jpg'))}}" width="30" height="20"></td>
                <td><a href="{{route('registration.edit',$item->stu_id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a></td>
               <td> <a href="{{route('registration.promote',$item->stu_id)}}" class="btn btn-danger"><i class="mdi mdi-apple-finder"></i></a></td>
            @endforeach
        </x-data-table-comp>
    </div>
</div>
@endsection