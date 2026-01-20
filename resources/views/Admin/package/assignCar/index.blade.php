@extends('Admin.common.layout')
@section('content')
@php
$active = 'package';
@endphp
<!---------------------- Include Modal --------------------------------->
@include('Admin.modal.modal')
<!---------------------- Include Modal --------------------------------->

<div class="row">
    <div class="col-lg-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h4 class="card-title mb-0">Assign Car to {{$data['package_data']->name}} package</h4>
                    <button type="button" class="btn btn-sm btn-primary ms-auto align-item-right mb-3" data-toggle="modal" data-target="#exampleModal">
                        Add Car
                    </button>
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
                                <th>Car Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['car_list'] as $key => $value)
                            @if($key%2 == '0')
                            <tr class="table-info">
                                @else
                            <tr class="table-warning">
                                @endif
                                <td>{{$key+1}}</td>
                                <td>{{$value->carData->name}}</td>
                                <td>
                                    @if($value->status == '1')
                                    <span class="badge badge-pill badge-success">Active</span>
                                    @else
                                    <span class="badge badge-pill badge-danger">InActive</span>
                                    @endif
                                </td>
                                <td>
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
<script>
    $(document).ready(function() {
        var id = "{{$data['package_data']->id}}";
        $('#package_id').val(id);
    });
</script>
@endsection
