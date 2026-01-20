@extends('Admin.common.layout')
@section('content')
@php
$active = 'time_schadule';
@endphp
<div class="row">
    <div class="col-lg-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h4 class="card-title mb-0">Car Category List</h4>
                    <a href="{{route('carCategory.create')}}" class="btn btn-sm btn-primary ms-auto align-item-right">Add</a>
                </div>

                @if(Session::has('success'))
                <div class=" alert alert-warning alert-dismissible fade show" role="alert">
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
                                <th>Name</th>
                                <th>Per Km Cost</th>
                                <th>Extra Fair Per Km</th>
                                <th>Extra Fair Per Hour</th>
                                <th>Fuel Charge</th>
                                <th>Driver Charge</th>
                                <th>Night Charge</th>
                                <th>% OFF</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['carCategory'] as $key => $value)
                            @if($key%2 == '0')
                            <tr class="table-info">
                                @else
                            <tr class="table-warning">
                                @endif
                                <td>{{$key+1}}</td>
                                <td>{{$value->name}}</td>
                                <td>{{$value->per_km_cost ?? '--'}}</td>
                                <td>{{$value->extra_fair_perKm ?? '--'}}</td>
                                <td>{{$value->extra_fair_perHour ?? '--'}}</td>
                                <td>{{$value->fuel_charge ?? '--'}}</td>
                                <td>{{$value->driver_charge ?? '--'}}</td>
                                <td>{{$value->night_charge ?? '--'}}</td>
                                <td>{{$value->off}}</td>
                                <td>
                                    <a href="{{route('statusUpate',['table'=>'carCategory','id'=>$value->id])}}">
                                        @if($value->status == '1')
                                        <span class="badge badge-pill badge-success">Active</span>
                                        @else
                                        <span class="badge badge-pill badge-danger">InActive</span>
                                        @endif
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('carCategory.edit',$value->id)}}" class="btn btn-dark btn-rounded btn-icon py-1 px-3"><i class="ti-pencil"></i></a>
                                    <a href="{{route('globalDelete',['model'=> 'carCategory','id'=>$value->id])}}" class="btn btn-danger py-1 px-3 btn-rounded btn-icon" onclick="return confirm('Are you sure to wan to delete this data!')"><i class="ti-trash"></i></a>
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
