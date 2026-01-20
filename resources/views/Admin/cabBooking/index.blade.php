@extends('Admin.common.layout')
@section('content')
    @php
        $active = 'cab_booking';
    @endphp

    <div class="row">
        <div class="col-lg-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center ">
                        <h4 class="card-title mb-0">Cab Booking List</h4>
                        {{-- <a href="{{route('tourPackages.create')}}"
                            class="btn btn-sm btn-primary ms-auto align-item-right">Add</a> --}}
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
                        <table class="table table-bordered display" id="myTable">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th>Order ID</th>
                                    <th>Type</th>
                                    <th>Sub Type</th>
                                    <th>Car Category</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Pick Up Date</th>
                                    <th>Total Fair</th>
                                    <th>Is Assigned</th>
                                    <th>Is Accepted</th>
                                    <th>TimeStamp</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['list'] as $key => $value)
                                                            @if($key % 2 == '0')
                                                                <tr class="table-info">
                                                            @else
                                                                <tr class="table-warning">
                                                            @endif
                                                                <td>{{$key + 1}}</td>
                                                                <td>{{$value->orderId}}</td>
                                                                <td>{{$value->type == '1' ? 'Out Station' : 'Local'}}</td>
                                                                @php
                                                                    $subTypes = [
                                                                        '1' => 'One Way',
                                                                        '0' => 'Round Trip',
                                                                        '2' => 'Airport',
                                                                    ];

                                                                @endphp
                                                                <td>{{ $subTypes[$value->subType] ?? 'Unknown' }}</td>
                                                                <td>{{$value->carCategory->name}}</td>
                                                                <td>{{$value->name}}</td>
                                                                <td>{{$value->mobile}}</td>
                                                                <td>{{$value->pickUp_date}}</td>
                                                                <td>{{$value->total_faire}}</td>
                                                                <td>{{$value->is_assigned == '0' ? 'Not Assigned' : 'Assigned'}}</td>
                                                                <td>{{$value->is_driver_accepted == '0' ? 'Not Accepted' : 'Accepted'}}</td>
                                                                <td>{{ \Carbon\Carbon::parse($value->created_at)->addHours(5)->addMinutes(30) }}</td>
                                                                <td>
                                                                    <a href="{{route('statusUpate', ['table' => 'loaclPackage', 'id' => $value->id])}}">
                                                                        @if($value->status == '0')
                                                                            <div class="badge badge-opacity-primary text-white">
                                                                                Initiated
                                                                            </div>
                                                                        @elseif($value->status == '1')
                                                                            <div class="badge badge-opacity-secondary">
                                                                                Accepted
                                                                            </div>
                                                                        @elseif($value->status == '2')
                                                                            <div class="badge badge-opacity-success">
                                                                                Completed
                                                                            </div>
                                                                        @else
                                                                            <div class="badge badge-opacity-danger">
                                                                                Rejected
                                                                            </div>
                                                                            <span class="badge badge-pill badge-danger">Rejected</span>
                                                                        @endif
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <a href="{{route('cabBooingDetail', ['id' => $value->id])}}">
                                                                        <button type="button" class="btn btn-success">View</button>
                                                                    </a>
                                                                    <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                                        onclick="getBookingId({{$value->id}})">
                                                                        <button type="button" class="btn btn-warning">Assign</button>
                                                                    </a>
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

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Assign Booking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('assign_cab_booking')}}" method="POST">
                        @csrf
                        <input type="hidden" id="cabBooking_id" name="cabBooking_id">
                        <div class="row">
                            <div class="col-12">
                                <label for="driver_comission">Driver Comission</label>
                                <input type="text" name="driver_comission" id="driver_comission" class="form-control"
                                    required>
                            </div>
                            <div class="col-12 mt-2">
                                <label for="remark">Remark</label>
                                <textarea class="form-control" placeholder="Leave a comment here" id="remark" cols="30"
                                    rows="10" name="remark"></textarea>
                            </div>
                            <div class="col-12 mt-3 text-end">
                                <button class="btn btn-sm btn-primary">Assign</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function getBookingId(id) {
            $('#cabBooking_id').val(id);
        }

        let table = new DataTable('#myTable', {
            responsive: true
        });


        $('#byn').on("click", function () {
            var date = $('#date').val();
            var time = $('#time').val();

            if (date != '' && time != '') {
                $('#div').addClass('d-none');
                $('#div').hide();
            } else {
                alert('please select  date ans time first!')
            }
        });

    </script>
@endsection