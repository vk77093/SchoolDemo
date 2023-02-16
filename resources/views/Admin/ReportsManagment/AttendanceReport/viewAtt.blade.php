@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<x-box-comp>
    <x-slot name="boxTitle">View Employee Attendance and Generate</x-slot>
    <x-slot name="buttonArea">
        <a class="btn btn-app btn-info" href="{{route('student.view.class')}}" style="float: right;">
            <i class="fa fa-eye"></i> View Classes
        </a>
    </x-slot>
    <form action="{{ route('att.getpdf') }}" method="get" target="_blank">
        @csrf
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <h5>Select Employee <x-required-sign/></h5>
                    <div class="input-group">
                        <select name="emp_id" id="emp_id" class="form-control" required>
<option selected value disabled>---Select Employee---</option>
@foreach ($employees as $emp)
    <option value="{{ $emp->id}}">{{$emp->name}}</option>
@endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <h5>Select Data <x-required-sign/></h5>
                    <div class="input-group">
<input type="date" class="form-control" name="date" id="date" required/>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 pt-3">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>
</x-box-comp>
@endsection