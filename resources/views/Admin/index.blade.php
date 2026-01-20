@extends('Admin.common.layout')
@section('content')
    @php
        $active = 'dashboard';
    @endphp
    <div class="row">
        <div class="col-sm-12">
            <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab"
                                aria-controls="overview" aria-selected="true">Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#tourPackage_booking" role="tab"
                                aria-selected="false">Tour Package Booking</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#cab_booking" role="tab"
                                aria-selected="false">Cab Booking</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content tab-content-basic">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                        <div class="row">
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <div class="p-4 flex-grow-1 bg-white shadow-sm me-1">
                                    <p class="statistics-title">Total Driver</p>
                                    <h3 class="rate-percentage">{{$data['total_driver']}}</h3>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <div class="p-4 flex-grow-1 bg-white shadow-sm me-1">
                                    <p class="statistics-title">Total Cars</p>
                                    <h3 class="rate-percentage">{{$data['total_car']}}</h3>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <div class="p-4 flex-grow-1 bg-white shadow-sm me-1">
                                    <p class="statistics-title">Total Cab Booking</p>
                                    <h3 class="rate-percentage">{{$data['total_cabBooking']}}</h3>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <div class="p-4 flex-grow-1 bg-white shadow-sm me-1">
                                    <p class="statistics-title">Total Packages</p>
                                    <h3 class="rate-percentage">{{$data['total_packages']}}</h3>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <div class="p-4 flex-grow-1 bg-white shadow-sm me-1">
                                    <p class="statistics-title">Total Packages</p>
                                    <h3 class="rate-percentage">{{$data['total_packages']}}</h3>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <div class="p-4 flex-grow-1 bg-white shadow-sm me-1">
                                    <p class="statistics-title">Total Loacl Packages</p>
                                    <h3 class="rate-percentage">{{$data['total_packages']}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="tourPackage_booking" role="tabpanel" aria-labelledby="overview">
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="p-4 flex-grow-1 bg-white shadow-sm me-1">
                                    <p class="statistics-title">New Booking</p>
                                    <h3 class="rate-percentage">{{$data['pending']}}</h3>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="p-4 flex-grow-1 bg-white shadow-sm me-1">
                                    <p class="statistics-title">Accepted Booking</p>
                                    <h3 class="rate-percentage">{{$data['accepted']}}</h3>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="p-4 flex-grow-1 bg-white shadow-sm me-1">
                                    <p class="statistics-title">Completed Booking</p>
                                    <h3 class="rate-percentage">{{$data['completed']}}</h3>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="p-4 flex-grow-1 bg-white shadow-sm me-1">
                                    <p class="statistics-title">Reject Booking</p>
                                    <h3 class="rate-percentage">{{$data['reject']}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="cab_booking" role="tabpanel" aria-labelledby="overview">
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="p-4 flex-grow-1 bg-white shadow-sm me-1">
                                    <p class="statistics-title">New Booking</p>
                                    <h3 class="rate-percentage">{{$data['cab_pending']}}</h3>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="p-4 flex-grow-1 bg-white shadow-sm me-1">
                                    <p class="statistics-title">Accepted Booking</p>
                                    <h3 class="rate-percentage">{{$data['cab_accepted']}}</h3>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="p-4 flex-grow-1 bg-white shadow-sm me-1">
                                    <p class="statistics-title">Completed Booking</p>
                                    <h3 class="rate-percentage">{{$data['cab_completed']}}</h3>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="p-4 flex-grow-1 bg-white shadow-sm me-1">
                                    <p class="statistics-title">Reject Booking</p>
                                    <h3 class="rate-percentage">{{$data['cab_reject']}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                                    <th>Type/Sub Type</th>
                                    <th>Car Category</th>
                                    <th>Name/Mobile</th>
                                    <th>Pick Up Date</th>
                                    <th>Total Fair</th>
                                    <th>Is Assigned / Is Accepted</th>
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
                                                                @php
                                                                    $subTypes = [
                                                                        '1' => 'One Way',
                                                                        '0' => 'Round Trip',
                                                                        '2' => 'Airport',
                                                                    ];

                                                                @endphp
                                                                <td>
                                                                    <ul>
                                                                        <li>{{$value->type == '1' ? 'Out Station' : 'Local'}}</li>
                                                                        <li>{{ $subTypes[$value->subType] ?? 'Unknown' }}</li>
                                                                    </ul>
                                                                    {{-- {{$value->type == '1' ? 'Out Station' : 'Local'}} --}}
                                                                </td>
                                                                {{-- <td>{{ $subTypes[$value->subType] ?? 'Unknown' }}</td> --}}
                                                                <td>{{$value->carCategory->name}}</td>
                                                                <td>
                                                                    <ul>
                                                                        <li>{{$value->name}}</li>
                                                                        <li>{{$value->mobile}}</li>
                                                                    </ul>
                                                                    {{-- {{$value->name}}/{{$value->mobile}} --}}
                                                                </td>
                                                                <td>{{$value->pickUp_date}}</td>
                                                                <td>{{$value->total_faire}}</td>
                                                                <td>
                                                                    <ul>
                                                                        <li> {{$value->is_assigned == '0' ? 'Not Assigned' : 'Assigned'}}</li>
                                                                        <li>{{$value->is_driver_accepted == '0' ? 'Not Accepted' : 'Accepted'}}</li>
                                                                    </ul>
                                                                    {{-- {{$value->is_assigned == '0' ? 'Not Assigned' : 'Assigned'}} --}}
                                                                </td>
                                                                {{-- <td>{{$value->is_driver_accepted == '0' ? 'Not Accepted' : 'Accepted'}}</td> --}}
                                                                <td>{{$value->created_at}}</td>
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
                {{-- <div class="d-flex justify-content-center">
                    {{ $data['list']->links('Admin.common.pagination')}}
                </div> --}}
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