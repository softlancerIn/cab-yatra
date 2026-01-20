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
                    <h4 class="card-title">Foter Link Create</h4>
                    <form action="{{route('footerLinks.store')}}" class="forms-sample" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <label for=""></label>
                                <select name="footlnk_catId" id="footlnk_catId" class="form-control form-select">
                                    <option value="" selected disabled>Select Category</option>
                                    @foreach ($data['category'] as $cat)
                                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="pickup">Pickup</label>
                                    <input type="text" class="form-control" id="pickup" placeholder="Pickup" name="pickup"
                                        required>
                                    @if($errors->has('pickup'))
                                        <span class="error text-danger text-sm">{{ $errors->first('pickup') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="destination">Destination</label>
                                    <input type="text" class="form-control" id="destination" placeholder="Destination"
                                        name="destination" required>
                                    @if($errors->has('destination'))
                                        <span class="error text-danger text-sm">{{ $errors->first('destination') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" placeholder="Title" name="title"
                                        required>
                                    @if($errors->has('title'))
                                        <span class="error text-danger text-sm">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control" id="image" placeholder="Image" name="image"
                                        required>
                                    @if($errors->has('image'))
                                        <span class="error text-danger text-sm">{{ $errors->first('image') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="status">Select Status</label>
                                    <select name="status" id="" class="form-control form-select">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    @if($errors->has('status'))
                                        <div class="error">{{ $errors->first('status') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="content">Page Content</label>
                                <textarea name="content" id="content" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary mt-4">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection