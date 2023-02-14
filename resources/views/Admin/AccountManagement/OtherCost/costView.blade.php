@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<div class="row">
    <div class="col-sm-12">
        <x-data-table-comp>
            <x-slot name="tableTitle">View And Manage Other Cost</x-slot>
                <x-slot name="buttonArea">
                    <a class="btn btn-app btn-info" href="{{route('cost.create')}}" style="float: right;">
                        <i class="fa fa-plus-square"></i> Add Other Cost
                    </a>
                </x-slot>
                <x-slot name="tableHead">
                    <th>Sr.No</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </x-slot>
                @foreach ($costs as $co)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{date('d-m-y',strtotime($co->cost_date))}}</td>
                        <td>{{$co->cost_amount}}</td>
                        <td>{{$co->pro_description}}</td>
                        <td>
                            <img src="{{(!empty($co->pro_image_path) ? url($co->pro_image_path) : url('AdminAsset/UserProfileImage/no_image.jpg'))}}" width="40" height="30" class="img-responsive">
                        </td>
                        <td><a href="{{route('cost.edit',$co->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a></td>
                        <td><a href="{{route('cost.delete',$co->id)}}" class="btn btn-danger" id="delete"><i class="mdi mdi-delete"></i></a></td>
                    </tr>
                @endforeach
        </x-data-table-comp>
    </div>
</div>
@endsection