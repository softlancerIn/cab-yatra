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
                        <h4 class="card-title mb-0">Driver List</h4>
                        <a href="{{route('drivercreate')}}" class="btn btn-sm btn-primary ms-auto align-item-right">Add
                            Driver</a>
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
                                    <th>Email</th>
                                    <th>Aadhar No</th>
                                    <th>Pan Number</th>
                                    <th>DL Number</th>
                                    <th>Wallet</th>
                                    <th>Is Registered</th>
                                    <th>Is Verified</th>
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
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->email}}</td>
                                        <td>{{$value->aadhar_no}}</td>
                                        <td>{{$value->pan_no}}</td>
                                        <td>{{$value->dl_no}}</td>
                                        <td>{{$value->wallet ?? '0'}}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input is_registered" type="checkbox" role="switch"
                                                    data-id="{{$value->id}}" id="" {{($value->is_registered == '1') ? 'checked' : ''}} style="position: absolute; margin-left: 40%;">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input is_verified" type="checkbox" role="switch"
                                                    data-id="{{$value->id}}" id="" {{($value->is_verified == '1') ? 'checked' : ''}} style="position: absolute; margin-left: 40%;">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    data-id="{{$value->id}}" id="status" {{($value->status == '1') ? 'checked' : ''}} style="position: absolute; margin-left: 40%;">
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{route('driverOrders', ['driver_id' => $value->id])}}"
                                                class="btn btn-dark btn-rounded btn-icon py-1 px-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                                    <path fill-rule="evenodd"
                                                        d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                                                </svg></a>
                                            <a href="{{route('edit', ['id' => $value->id])}}"
                                                class="btn btn-dark btn-rounded btn-icon py-1 px-3"><i
                                                    class="ti-pencil"></i></a>
                                            <a href="{{route('globalDelete', ['model' => 'driver', 'id' => $value->id])}}"
                                                class="btn btn-danger py-1 px-3 btn-rounded btn-icon"><i
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


    <script>
        // $('.is_registered').on('change', function () {
        //     let isChecked = $(this).is(':checked'); // true if ON
        //     console.log("Switch toggled. Checked?", isChecked);
        // });



        $(".is_registered").on('change', function () {
            console.log('is_registered');
            var switchStatus = false;
            var is_registered = '0';
            var id = $(this).data("id");
            switchStatus = $(this).is(':checked');

            if (switchStatus == true) {
                is_registered = '1';
            }
            console.log(id, is_registered);
            $.ajax({
                url: "{{route('changeStatus', ['type' => 'is_registered'])}}",
                method: "POST",
                headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
                data: {
                    'id': id,
                    'is_registered': is_registered
                },
                success: function (res) {
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

        $(".is_verified").on('change', function () {
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
                headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
                data: {
                    'id': id,
                    'is_verified': is_verified
                },
                success: function (res) {
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



        $("#status").on('change', function () {
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
                headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
                data: {
                    'id': id,
                    'status': status
                },
                success: function (res) {
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