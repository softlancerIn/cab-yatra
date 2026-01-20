@extends('Admin.common.layout')
@section('content')
@php
$active = 'custom_cities';
@endphp
<div class="row">
    <div class="col-lg-12 mb-3">
        <div class="col-lg-6">
            <form action="{{ route('customCities_list') }}" class="d-flex">
                <input type="text" class="form-control" placeholder="Search Here" name="pickup_loc">
                <button class="btn btn-primary ms-4">Search</button>
            </form>
        </div>
    </div>
    <div class="col-lg-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h4 class="card-title mb-0">Custom Cities List</h4>
                    <a href="{{route('customCities_create')}}"
                        class="btn btn-sm btn-primary ms-auto align-item-right">Add</a>
                </div>

                @if(Session::has('success'))
                <div class=" alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{Session::get('success')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if(Session::has('error'))
                <div class=" alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{Session::get('error')}}</strong>
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
                                <th>Type</th>
                                {{-- <th>Car Category</th> --}}
                                <th>From Location</th>
                                <th>To Location</th>
                                {{-- <th>Fair</th> --}}
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['custom_cities'] as $key => $value)
                            @php
                            switch ($value->type) {
                            case '0':
                            $type = 'One Way';
                            break;
                            case '1':
                            $type = 'Round Trip';
                            break;
                            case '2':
                            $type = 'Local';
                            break;
                            case '3':
                            $type = 'Airport';
                            break;

                            default:
                            # code...
                            break;
                            }
                            @endphp
                            @if($key % 2 == '0')
                            <tr class="table-info">
                                @else
                            <tr class="table-warning">
                                @endif

                                <td>{{$key + 1}}</td>
                                <td>{{$type}}</td>
                                {{-- <td>{{$value->carCategory->name}}</td> --}}
                                <td>{{$value->pickup_loc}}</td>
                                <td>{{$value->destination_loc ?? '--'}}</td>
                                {{-- <td>{{$value->fair}}</td> --}}
                                <td>
                                    <a href="{{route('statusUpate', ['table' => 'customCities', 'id' => $value->id])}}">
                                        @if($value->status == '1')
                                        <span class="badge badge-pill badge-success">Active</span>
                                        @else
                                        <span class="badge badge-pill badge-danger">InActive</span>
                                        @endif
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('customCarCategoryPriceList', ['id' => $value->id])}}"
                                        class="btn btn-dark btn-rounded btn-icon py-1 px-3"><i class="ti-eye"></i><span
                                            class="counter ms-1">{{$value->custom_carPriceCount ?? '0'}}</span></a>
                                    <a href="{{route('customCities_edit', $value->id)}}"
                                        class="btn btn-dark btn-rounded btn-icon py-1 px-3"><i
                                            class="ti-pencil"></i></a>
                                    <a href="{{route('globalDelete', ['model' => 'custom_cities_price', 'id' => $value->id])}}"
                                        class="btn btn-danger py-1 px-3 btn-rounded btn-icon"
                                        onclick="return confirm('Are you sure to wan to delete this data!')"><i
                                            class="ti-trash"></i></a>
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