@extends('Admin.common.layout')
@section('content')
@php
$active = 'seo';
@endphp
<div class="row">
    <div class="col-lg-12 mb-3">
        <div class="col-lg-6">
            <form action="{{ route('seoData.index') }}" class="d-flex">
                <input type="text" class="form-control" placeholder="Search Here" name="search">
                <button class="btn btn-primary ms-4">Search</button>
            </form>
        </div>
    </div>
    <div class="col-lg-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center ">
                    <h4 class="card-title mb-0 ">Seo List</h4>
                    <a href="{{route('seoData.create')}}"
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
                                <th>Page Url</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['seo'] as $key => $value)
                            @if($key % 2 == '0')
                            <tr class="table-info">
                                @else
                            <tr class="table-warning">
                                @endif
                                <td>{{$key + 1}}</td>
                                <td>{{$value->page_url ?? '--'}}</td>
                                <td>{{$value->title ?? '--'}}</td>
                                <td>{{Illuminate\Support\Str::limit(($value->description ?? '--'), 50)}}</td>
                                <td>
                                    <a href="{{route('statusUpate', ['table' => 'seo', 'id' => $value->id])}}">
                                        @if($value->status == '1')
                                        <span class="badge badge-pill badge-success">Active</span>
                                        @else
                                        <span class="badge badge-pill badge-danger">InActive</span>
                                        @endif
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('seoData.edit', $value->id)}}"
                                        class="btn btn-dark btn-rounded btn-icon py-1 px-3"><i
                                            class="ti-pencil"></i></a>
                                    <a href="{{route('globalDelete', ['model' => 'seo', 'id' => $value->id])}}"
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
                {{ $data['seo']->links('Admin.common.pagination')}}
            </div>
        </div>
    </div>
</div>
@endsection