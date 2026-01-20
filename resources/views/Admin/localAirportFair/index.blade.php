@extends('Admin.common.layout')
@section('content')
@php
    $active = 'local_airport_fair';
@endphp

<div class="row">
    <div class="col-lg-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center ">
                    <h4 class="card-title mb-0">Oneway and Airport Fair List</h4>
                    <a href="{{route('onewayAirportFairCreate', ['id' => 0])}}"
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
                    <table class="table table-bordered display" id="myTable1">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th>Car Category</th>
                                <th>Type</th>
                                <th>Min Distance</th>
                                <th>Min Fair</th>
                                <th>Per km Fair</th>
                                <th>Extra Fair per km</th>
                                <th>off</th>
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
                                    <td>{{$value->cabCategory->name ?? ''}}</td>
                                    <td>{{$value->type ?? ''}}</td>
                                    <td>{{$value->min_distance}}</td>
                                    <td>{{$value->min_fair}}</td>
                                    <td>{{$value->extra_fair_perKm}}</td>
                                    <td>{{$value->extra_fair_for_showing ?? '--'}}</td>
                                    <td>{{$value->off}}</td>
                                    <td>
                                        <a href="{{route('onewayAirportFairCreate', ['id' => $value->id])}}">
                                            <button type="button" class="btn btn-sm btn-success">Edit</button>
                                        </a>
                                        <a href="{{route('globalDelete', ['model' => 'onewayAirportFair', 'id' => $value->id])}}">
                                            <button type="button" class="btn btn-sm btn-warning">Delete</button>
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