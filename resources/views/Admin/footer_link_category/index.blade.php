@extends('Admin.common.layout')
@section('content')
@php
$active = 'footer_linkCategory';
@endphp
<div class="row">
    <div class="col-lg-12 mb-3">
        <div class="col-lg-6">
            <form action="{{ route('footerLink-category.index') }}" class="d-flex">
                <input type="text" class="form-control" placeholder="Search Here" name="search">
                <button class="btn btn-primary ms-4">Search</button>
            </form>
        </div>
    </div>
    <div class="col-lg-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center ">
                    <h4 class="card-title mb-0 ">Footer Links category List</h4>
                    <a href="{{route('footerLink-category.create')}}"
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
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['footer_linkCategory'] as $key => $value)
                            @if($key % 2 == '0')
                            <tr class="table-info">
                                @else
                            <tr class="table-warning">
                                @endif
                                <td>{{$key + 1}}</td>
                                <td>{{$value->name ?? '--'}}</td>
                                <td>
                                    <a
                                        href="{{route('statusUpate', ['table' => 'footer_linkCategory', 'id' => $value->id])}}">
                                        @if($value->status == '1')
                                        <span class="badge badge-pill badge-success">Active</span>
                                        @else
                                        <span class="badge badge-pill badge-danger">InActive</span>
                                        @endif
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('footerLink-category.edit', $value->id)}}"
                                        class="btn btn-dark btn-rounded btn-icon py-1 px-3"><i
                                            class="ti-pencil"></i></a>
                                    <a href="{{route('globalDelete', ['model' => 'footer_linkCategory', 'id' => $value->id])}}"
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
            <div class="d-flex justify-content-center">
                {{ $data['footer_linkCategory']->links('Admin.common.pagination')}}
            </div>
        </div>
    </div>
</div>
@endsection