@extends('Admin.common.layout')
@section('content')
    @php
        $active = 'app_banner';
    @endphp
    <div class="row">
        <div class="col-lg-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title mb-0">Car Master List</h4>
                        <a class="btn btn-sm btn-primary ms-auto align-item-right" data-bs-toggle="modal"
                            data-bs-target="#addBannerModal">Add Car</a>
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
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['app_banner'] as $key => $value)
                                    @if($key % 2 == '0')
                                        <tr class="table-info">
                                    @else
                                        <tr class="table-warning">
                                    @endif
                                        <td>{{$key + 1}}</td>
                                        <td>{{$value->name}}</td>
                                        <td>
                                            <a href="{{$value->url}}" target="_blank"><img src='{{$value->image}}'
                                                    style="height:100px;width:200px ;border-radius:0px;"></a>
                                        </td>
                                        <td>
                                            @if($value->status == '1')
                                                <span class="badge badge-pill badge-success">Active</span>
                                            @else
                                                <span class="badge badge-pill badge-danger">InActive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-dark btn-rounded btn-icon py-1 px-3" data-bs-toggle="modal"
                                                data-bs-target="#editBannerModal" onclick="getBannerData({{$value->id}})"><i
                                                    class="ti-pencil"></i></a>
                                            <a href="{{route('globalDelete', ['model' => 'app_banner', 'id' => $value->id])}}"
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
    <div class="modal fade" id="addBannerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Banner</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('banner_create')}}" class="needs-validation" method="POST"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="col-12">
                                <label for="url">Banner Url</label>
                                <input type="text" class="form-control" name="url" id="url">
                            </div>
                            <div class="col-12">
                                <label for="image">Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                            <div class="col-12">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-select form-control">
                                    <option value="" selected disabled>Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="col-12 text-end mt-4">
                                <button class="btn btn-sm btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editBannerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Banner</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('banner_update')}}" class="needs-validation" method="POST"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-12">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="edit_name">
                            </div>
                            <div class="col-12">
                                <label for="image">Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                            <div class="col-12">
                                <label for="url">Banner Url</label>
                                <input type="text" class="form-control" name="url" id="edit_url">
                                <div class="col-12">
                                    <label for="status">Status</label>
                                    <select name="status" id="edit_status" class="form-select form-control">
                                        <option value="" selected disabled>Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="col-12 text-end mt-4">
                                    <button class="btn btn-sm btn-primary">Update</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function getBannerData(id) {
            $.ajax({
                url: "{{route('banner_edit')}}",
                method: "POST",
                headers: {
                    "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content")
                },
                data: {
                    id: id,
                },
                success: function (res) {
                    console.log(res.data);
                    $('#id').val(res.data.id);
                    $('#edit_name').val(res.data.name);
                    $('#edit_url').val(res.data.url);
                    $('#edit_status').val(res.data.status);
                },
                error: function (err) {
                    console.error("Error in AJAX request", err);
                },
            });
        }
    </script>
@endsection