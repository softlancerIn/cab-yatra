@extends('Admin.common.layout')
@section('content')
    @php
        $active = 'time_schadule';
    @endphp
    <script type="text/javascript">
        tinymce.init({
            selector: "#other_details"
        });

    </script>
    <div class="row ">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Seo Data edit</h4>
                    <form action="{{route('seoData.update', $data['edit']->id)}}" class="forms-sample" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="page_url">Page Url</label>
                                    <input type="text" class="form-control" id="page_url" placeholder="Page Url" value="{{$data['edit']->page_url}}"
                                        name="page_url" required>
                                    @if($errors->has('page_url'))
                                        <span class="error text-danger text-sm">{{ $errors->first('page_url') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" placeholder="Title" name="title" value="{{$data['edit']->title}}"
                                        required>
                                    @if($errors->has('title'))
                                        <span class="error text-danger text-sm">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="keyword">Keyword</label>
                                    <input type="text" class="form-control" id="keyword" placeholder="Keyword" value="{{$data['edit']->keyword}}"
                                        name="keyword" required>

                                    @if($errors->has('keyword'))
                                        <span class="error text-danger text-sm">{{ $errors->first('keyword') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="status">Select Status</label>
                                    <select name="status" id="" class="form-control form-select">
                                        <option value="1" {{$data['edit']->status == '1' ? 'selected' :''}}">Active</option>
                                        <option value="0" {{$data['edit']->status == '0' ? 'selected' :''}}">Inactive</option>
                                    </select>
                                    @if($errors->has('status'))
                                        <div class="error">{{ $errors->first('status') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control" rows="10"
                                        style="height: auto;" required>{{$data['edit']->description}}</textarea>
                                    @if($errors->has('description'))
                                        <span class="error text-danger text-sm">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="script">Script</label>
                                    <textarea name="script" id="script" class="form-control" rows="10" style="height: auto;"
                                        required>{{$data['edit']->script}}</textarea>
                                    @if($errors->has('script'))
                                        <span class="error text-danger text-sm">{{ $errors->first('script') }}</span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary mt-4">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection