@extends('Admin.common.layout')
@section('content')
@php
$active = 'driver';
@endphp
<div class="row">
    <div class="col-lg-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h4 class="card-title mb-0">Driver Booking List</h4>
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
                                <th>Order ID</th>
                                <th>Type</th>
                                <th>Sub Type</th>
                                <th>Total Fair</th>
                                <th>Driver Commision</th>
                                <th>Assign Date</th>
                                <th>Booking Date</th>
                                <th>Fair Setteled</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['orders'] as $key => $value)
                            @php
                            $subTypes = [
                            '1' => 'One Way',
                            '0' => 'Round Trip',
                            '2' => 'Airport',
                            ];

                            switch ($value->status) {
                            case 0:
                            $status = 'Accepted';
                            $class = 'primary';
                            break;
                            case 1:
                            $status = 'Started';
                            $class = 'secondary';
                            break;
                            case 2:
                            $status = 'Completed';
                            $class = 'success';
                            break;
                            case 3:
                            $status = 'Rejected';
                            $class = 'danger';
                            break;
                            }

                            @endphp
                            @if($key % 2 == '0')
                            <tr class="table-info">
                                @else
                            <tr class="table-warning">
                                @endif
                                <td>{{$key + 1}}</td>
                                <td>{{$value->bookingData->orderId}}</td>
                                <td>{{$value->bookingData->type == '1' ? 'Out Station' : 'Local'}}</td>
                                <td>{{$value->bookingData->pickUp_date}}</td>
                                <td>{{$value->bookingData->total_faire}}</td>
                                </td>
                                <td>{{$value->bookingData->driver_comission ?? ''}}</td>
                                <td>{{$value->created_at}}</td>
                                <td>{{$value->bookingData->created_at}}</td>
                                <td>{{$value->fair_setteled == '1' ? 'Setteled' : 'Not Setteled'}}</td>
                                <td>
                                    <a>
                                        <div class="badge badge-opacity-{{$class}} text-white">
                                            {{$status}}
                                        </div>
                                    </a>
                                </td>
                                <td>
                                    @if($value->fair_setteled == '0')
                                    <a href="{{route('cabBooingDetail', ['id' => $value->id])}}">
                                        <button type="button" class="btn btn-success">Fair Amount</button>
                                    </a>
                                    @else
                                    <a>
                                        <button type="button" class="btn btn-warning disabled">Setteled</button>
                                    </a>
                                    @endif
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
    $("#is_verified").on('change', function() {
        var switchStatus = false;
        var is_verified = '0';
        var id = $(this).data("id");
        switchStatus = $(this).is(':checked');

        if (switchStatus == true) {
            is_verified = '1';
        }

        $.ajax({
            url: "{{route('changeStatus', ['type' => 'is_verified'])}}",
            method: "POST",
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'id': id,
                'is_verified': is_verified
            },
            success: function(res) {
                console.log(res);
                if (res.status == true) {
                    Swal.fire({
                        title: "Success",
                        text: "Data Updated Successfully!",
                        icon: "success"
                    });

                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }
            }
        });
    });

    $("#is_registered").on('change', function() {
        var switchStatus = false;
        var is_registered = '0';
        var id = $(this).data("id");
        switchStatus = $(this).is(':checked');

        if (switchStatus == true) {
            is_registered = '1';
        }

        $.ajax({
            url: "{{route('changeStatus', ['type' => 'is_registered'])}}",
            method: "POST",
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'id': id,
                'is_registered': is_registered
            },
            success: function(res) {
                console.log(res);
                if (res.status == true) {
                    Swal.fire({
                        title: "Success",
                        text: "Data Updated Successfully!",
                        icon: "success"
                    });

                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }
            }
        });
    });

    $("#status").on('change', function() {
        var switchStatus = false;
        var status = '0';
        var id = $(this).data("id");
        switchStatus = $(this).is(':checked');

        if (switchStatus == true) {
            status = '1';
        }

        $.ajax({
            url: "{{route('changeStatus', ['type' => 'status'])}}",
            method: "POST",
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'id': id,
                'status': status
            },
            success: function(res) {
                console.log(res);
                if (res.status == true) {
                    Swal.fire({
                        title: "Success",
                        text: "Data Updated Successfully!",
                        icon: "success"
                    });

                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }
            }
        });
    });
</script>
@endsection