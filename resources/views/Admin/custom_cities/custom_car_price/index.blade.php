@extends('Admin.common.layout')
@section('content')
    @php
        $active = 'custom_cities';
    @endphp
    <div class="row">
        <div class="col-lg-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title mb-0">{{$data['custom_cities']->pickup_loc}} To
                            {{$data['custom_cities']->destination_loc}} Car Price List
                        </h4>
                        <a href="{{route('customCarCategoryPricecreate', ['id' => $data['id']])}}"
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

                    <div class="table-responsive pt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th>Name</th>
                                    <th>Fixed Fair</th>
                                    <th>Total km</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['custom_carPrice'] as $key => $value)
                                    @if($key % 2 == '0')
                                        <tr class="table-info">
                                    @else
                                            <tr class="table-warning">
                                        @endif
                                        <td>{{$key + 1}}</td>
                                        <td>{{$value->carCategory->name}}</td>
                                        <td>{{$value->fixed_fair ?? '--'}}</td>
                                        <td>{{$value->total_km ?? '--'}}</td>
                                        <td>
                                            <a href="{{route('customCarCategoryPriceEdit', ['id' => $data['id'], 'customCitiesCarPriceId' => $value->id])}}"
                                                class="btn btn-dark btn-rounded btn-icon py-1 px-3"><i
                                                    class="ti-pencil"></i></a>
                                            <a href="{{route('globalDelete', ['model' => 'custom_carPrice', 'id' => $value->id])}}"
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