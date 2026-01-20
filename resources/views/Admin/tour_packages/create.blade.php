@extends('Admin.common.layout')
@section('content')
@php
$active = 'tourPackage';
@endphp
<script type="text/javascript">
    tinymce.init({
        selector: "#term_condition"
    });
    tinymce.init({
        selector: "#excluded_detail"
    });
    tinymce.init({
        selector: "#include_detail"
    });
    tinymce.init({
        selector: "#tour_details"
    });

</script>
<div class="row ">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tour Package Create</h4>
                <form action="{{route('tourPackages.store')}}" class="forms-sample" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="fair">Name</label>
                                <input type="text" class="form-control" id="fair" placeholder="Name" name="name" required>
                                @if($errors->has('name'))
                                <span class="error text-danger text-sm">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control" id="image" placeholder="Image" name="image" required>
                                    @if($errors->has('image'))
                                    <span class="error text-danger text-sm">{{ $errors->first('image') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="duration">Duration</label>
                                    <input type="text" class="form-control" id="duration" placeholder="Duration" name="duration" required>
                                    @if($errors->has('duration'))
                                    <span class="error text-danger text-sm">{{ $errors->first('duration') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="address">City</label>
                                    <select class="form-control form-select" name="city_id">
                                        <option selected value="" disabled>Select City</option>
                                        @foreach($data['city'] as $key => $value)
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('driver_charge'))
                                    <span class="error text-danger text-sm">{{ $errors->first('driver_charge') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="price">Fair</label>
                                    <input type="text" class="form-control" id="price" placeholder="Fair" name="price" required>
                                    @if($errors->has('price'))
                                    <span class="error text-danger text-sm">{{ $errors->first('price') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="editor">Tour Details</label>
                                    <textarea class="form-control" id="tour_details" rows="8" name="tour_details" rows="10" cols="80"></textarea>
                                    @if($errors->has('tour_details'))
                                    <span class="error text-danger text-sm">{{ $errors->first('tour_details') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="editor">Included Details</label>
                                    <textarea class="form-control" id="include_detail" rows="8" name="include_detail" rows="10" cols="80"></textarea>
                                    @if($errors->has('include_detail'))
                                    <span class="error text-danger text-sm">{{ $errors->first('include_detail') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="editor">Excluded Details</label>
                                    <textarea class="form-control" id="excluded_detail" rows="8" name="excluded_detail" rows="10" cols="80"></textarea>
                                    @if($errors->has('excluded_detail'))
                                    <span class="error text-danger text-sm">{{ $errors->first('excluded_detail') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="editor">Term Condition</label>
                                    <textarea class="form-control" id="term_condition" rows="8" name="term_condition" rows="10" cols="80"></textarea>
                                    @if($errors->has('term_condition'))
                                    <span class="error text-danger text-sm">{{ $errors->first('term_condition') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
