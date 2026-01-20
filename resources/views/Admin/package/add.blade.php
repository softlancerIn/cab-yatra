@extends('Admin.common.layout')
@section('content')
@php
$active = 'package';
@endphp
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.3.0/tinymce.min.js" integrity="sha512-RUZ2d69UiTI+LdjfDCxqJh5HfjmOcouct56utQNVRjr90Ea8uHQa+gCxvxDTC9fFvIGP+t4TDDJWNTRV48tBpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    tinymce.init({
        selector: "#mytextarea"
    });
</script>
<div class="row ">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Package Create</h4>
                <form action="{{route('package_create')}}" class="forms-sample" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="package_name">Package Name</label>
                                <input type="text" class="form-control" id="package_name" placeholder="Package Name" name="name">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control" id="image" placeholder="Package Image" name="image">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="category_id">Select Category</label>
                                <select name="category_id" id="category_id" class="form-control form-select">
                                    <option value="" selected disabled>Select car category </option>
                                    @foreach ($data['carCategory'] as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="to">To</label>
                                <input type="text" class="form-control" id="to" placeholder="to" name="to">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="from">From</label>
                                <input type="text" class="form-control" id="from" placeholder="From" name="from">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="per_km_cost">Per Km Cost</label>
                                <input type="text" class="form-control" id="per_km_cost" placeholder="Per Km Price" name="per_km_cost">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="total_price">Total Price</label>
                                <input type="text" class="form-control" id="total_price" placeholder="Total Price" name="total_price">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="discount">Distance</label>
                                <input type="text" class="form-control" id="discount" placeholder="Distance" name="distance">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="night_charge">Night Charge</label>
                                <input type="text" class="form-control" id="night_charge" placeholder="Night charge" name="night_charge">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="air_type">Air Type</label>
                                <select name="air_type" id="air_type" class="form-select form-control">
                                    <option value="" selected disabled>Select Air Type</option>
                                    <option value="1">Ac</option>
                                    <option value="0">Non Ac</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="extra_fair_perKm">Extra Fair Per Km</label>
                                <input type="text" class="form-control" id="extra_fair_perKm" placeholder="Extra Fair Per Km" name="extra_fair_perKm">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="driver_charge">Driver charge</label>
                                <input type="text" class="form-control" id="driver_charge" placeholder="Driver Charge" name="driver_charge">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="total_price">Other Details</label>
                                <textarea name="other_details" id="mytextarea"></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button class="btn btn-secondary">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection