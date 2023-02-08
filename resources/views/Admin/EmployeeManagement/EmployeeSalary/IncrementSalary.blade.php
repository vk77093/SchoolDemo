
@extends('Admin.Backend.Layouts.adminMaster')
@section('main')
<x-box-comp>
    <x-slot name="boxTitle">Incremnet The Employee Salary</x-slot>
    <x-slot name="buttonArea">
        <a class="btn btn-app btn-info" href="{{route('salary.view')}}" style="float: right;">
            <i class="fa fa-eye"></i> View Salary Data
        </a>
    </x-slot> 
    <form method="post" action="{{route('salary.incrementpost',$editData->id)}}">
        @csrf
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <h5>Salary Amount<x-required-sign/></h5>
                <div class="input-group">
                    <input type="number" class="form-control" name="increment_salary" id="increment_salary" required value="{{old('increment_salary')}}"/>
                </div>
            </div>
            <div class="col-sm-6 col-md-6">
                <h5>Effect From Date <x-required-sign/></h5>
                <div class="input-group">
                    <input type="date" class="form-control" name="effective_date" id="effective_date" required value="{{old('effective_date')}}"/>
                </div>
            </div>
        </div>
        <div class="mt-2">
            <x-submit-button-comp/>
        </div>
    </form>
</x-box-comp>
@endsection
