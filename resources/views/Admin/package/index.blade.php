@extends('Admin.common.layout')
@section('content')
@php
$active = 'package';
@endphp
<div class="row">
    <div class="col-lg-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center ">
                    <h4 class="card-title mb-0">Package Master List</h4>
                    <a href="{{route('package_create')}}" class="btn btn-sm btn-primary ms-auto align-item-right mb-3">Add Package</a>
                </div>

                @if(Session::has('success'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{Session::get('success')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Distance</th>
                                <th>Per Km Cost</th>
                                <th>Total Fair</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['package'] as $key => $value)
                            @if($key%2 == '0')
                            <tr class="table-info">
                                @else
                            <tr class="table-warning">
                                @endif
                                <td>{{$key+1}}</td>
                                <td>
                                    <img src="{{$value->image}}" style="height:100px;width:200px">
                                </td>
                                <td>{{$value->name}}</td>
                                <td>{{$value->from}}</td>
                                <td>{{$value->to}}</td>
                                <td>{{$value->distance}}</td>
                                <td>{{$value->per_km_cost}}</td>
                                <td>{{$value->total_price}}</td>
                                <td>
                                    @if($value->status == '1')
                                    <span class="badge badge-pill badge-success">Active</span>
                                    @else
                                    <span class="badge badge-pill badge-danger">InActive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('assign_carTo_package',['packageId'=>$value->id])}}" class="btn btn-primary btn-rounded btn-icon py-1 px-3 btn-sm"><i class="fa fa-plus"></i></a>
                                    <a href="{{route('car_edit',['id'=>$value->id])}}" class="btn btn-dark btn-rounded btn-icon py-1 px-3 btn-sm"><i class="ti-pencil"></i></a>
                                    <a href="{{route('globalDelete',['model'=> 'car','id'=>$value->id])}}" class="btn btn-danger btn-rounded btn-icon py-1 px-3 btn-sm"><i class="ti-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
