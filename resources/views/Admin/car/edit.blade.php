@extends('Admin.common.layout')
@section('content')
@php
$active = 'cars';
@endphp
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<div class="row ">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Car Create</h4>
                <!-- <p class="card-description"> Basic form layout </p> -->
                <form action="{{route('car_create')}}" class="forms-sample" method="POST" enctype="multipart/form-data">
                    <input type="hidden" value="{{$data['edit']->id}}" name="id">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Name</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Car Name" name="name" value="{{$data['edit']->name}}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select name="type" id="type" class="form-select form-control">
                                    <option value="" selected disabled>Select Type</option>
                                    <option value="ac" {{$data['edit']->type == 'ac' ? 'selected' : ''}}>AC</option>
                                    <option value="non_ac" {{$data['edit']->type == 'non_ac' ? 'selected' : ''}}>Non AC</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="fuel_type">Fule Type</label>
                                <select id="fuel_type" class="form-select form-control" name="fuel_type">
                                    <option value="" selected disabled>Select Fule Type</option>
                                    <option value="petrol" {{$data['edit']->fuel_type == 'petrol' ? 'selected' : ''}}>Petrol</option>
                                    <option value="diesel" {{$data['edit']->fuel_type == 'diesel' ? 'selected' : ''}}>Diesel</option>
                                    <option value="electric" {{$data['edit']->fuel_type == 'electric' ? 'selected' : ''}}>Electric</option>
                                    <option value="hybrid" {{$data['edit']->fuel_type == 'hybrid' ? 'selected' : ''}}>Hybrid</option>
                                    <option value="cng" {{$data['edit']->fuel_type == 'cng' ? 'selected' : ''}}>CNG</option>
                                    <option value="lpg" {{$data['edit']->fuel_type == 'lpg' ? 'selected' : ''}}>LPG</option>
                                    <option value="other" {{$data['edit']->fuel_type == 'other' ? 'selected' : ''}}>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category" id="category" class="form-select form-control">
                                    <option value="" selected disabled>Select Category</option>
                                    @foreach($data['category'] as $key => $value)
                                    <option value="{{$value->id}}" {{$data['edit']->category == $value->id ? 'selected' : ''}}>{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control" id="image" placeholder="Image" name="image">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="min_cahrge">min_charge</label>
                                    <input type="text" class="form-control" id="min_cahrge" placeholder="Min charge" name="min_charge" value="{{$data['edit']->min_charge}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="car_number">Car Number</label>
                                    <input type="text" class="form-control" id="car_number" placeholder="car_number" name="car_number" value="{{$data['edit']->car_number}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="editor">Other Details</label>
                                    <textarea class="form-control" id="editor" rows="8" name="other_details" rows="10" cols="80">{{$data['edit']->other_details}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Update</button>
                    <button class="btn btn-secondary">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    CKEDITOR.replace('editor');

</script>
@endsection
