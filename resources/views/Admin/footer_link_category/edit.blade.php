@extends('Admin.common.layout')
@section('content')
    @php
        $active = 'footer_link';
    @endphp
    <script type="text/javascript">
        tinymce.init({
            selector: "#content"
        });

    </script>
    <div class="row ">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Foter Link Edit</h4>
                    <form action="{{route('footerLink-category.update', $data['footer_linkCategory']->id)}}"
                        class="forms-sample" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Name" name="name"
                                        value="{{$data['footer_linkCategory']->name}}" required>
                                    @if($errors->has('name'))
                                        <span class="error text-danger text-sm">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="status">Select Status</label>
                                    <select name="status" id="" class="form-control form-select">
                                        <option value="1" {{$data['footer_linkCategory']->status == '1' ? 'selected' : ''}}>
                                            Active
                                        </option>
                                        <option value="0" {{$data['footer_linkCategory']->status == '0' ? 'selected' : ''}}>
                                            Inactive</option>
                                    </select>
                                    @if($errors->has('status'))
                                        <div class="error">{{ $errors->first('status') }}</div>
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