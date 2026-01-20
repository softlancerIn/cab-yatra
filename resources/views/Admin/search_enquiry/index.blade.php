@extends('Admin.common.layout')
@section('content')
    @php
        $active = 'search_enquiry';
    @endphp
    <div class="row">
        <div class="col-lg-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center ">
                        <h4 class="card-title mb-0 ">Search Enquiry List</h4>
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
                                    <th>PickUp Location</th>
                                    <th>Destination</th>
                                    <th>Mobile</th>
                                    <th>Is Read</th>
                                    <th>DateTime</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['searchEnquiry'] as $key => $value)
                                    @if($key % 2 == '0')
                                        <tr class="table-info">
                                    @else
                                            <tr class="table-warning">
                                        @endif
                                        <td>{{$key + 1}}</td>
                                        <td>
                                            <ul>
                                                @foreach (json_decode($value->pickUp_loc) as $value1)
                                                    <li>{{$value1}}</li>

                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                @foreach (json_decode($value->destination_loc) as $value2)
                                                    <li class="text-break">{{$value2}}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>{{$value->phone}}</td>
                                        <td>
                                            <div class="form-switch">
                                                <input class="form-check-input is_read" type="checkbox" role="switch" data-id="{{$value->id}}"
                                                    id="flexSwitchCheckChecked" {{$value->is_read == '1' ? 'checked' : ''}}>
                                            </div>
                                        </td>
                                        <td>{{$value->created_at ?? '--'}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $data['searchEnquiry']->links('Admin.common.pagination')}}
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $(".is_read").on('change', function () {
                console.log('is_read');
                var switchStatus = false;
                var is_read = '0';
                var id = $(this).data("id");
                switchStatus = $(this).is(':checked');

                if (switchStatus == true) {
                    is_read = '1';
                }
                console.log(id, is_read);

                // Construct the URL dynamically
                var baseUrl = "{{ route('statusUpate', [ 'table' => 'search_enquiry','id' => ':id']) }}";
                var finalUrl = baseUrl.replace(':id', id); // replace placeholder with actual id

                console.log(finalUrl);
                $.ajax({
                    url: finalUrl,
                    method: "POST",
                    headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
                    success: function (res) {
                        if (res.status == "true") {
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
        });
    </script>
@endsection