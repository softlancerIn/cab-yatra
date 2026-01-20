@extends('Admin.common.layout')
@section('content')
@php
    $active = 'driver';
@endphp
<script src="https://cdn.ckeditor.com/4.25.0/standard/ckeditor.js"></script>
<div class="row ">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Driver Create</h4>
                <hr>
                <form action="{{route('driverupdate')}}" class="forms-sample" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$data['edit']->id}}">
                    <div class="row  bg-light mb-2 text-center">
                        <h6 class="my-2">Driver Details</h6>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Driver Name" name="name"
                                    value="{{$data['edit']->name}}">
                                @if($errors->has('name'))
                                    <span class="error text-danger text-sm">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Driver Email"
                                    name="email" value="{{$data['edit']->email}}">
                                @if($errors->has('email'))
                                    <span class="error text-danger text-sm">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" placeholder="Driver Phone"
                                    name="phone" value="{{$data['edit']->phone}}">
                                @if($errors->has('phone'))
                                    <span class="error text-danger text-sm">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="aadhar_no">Aadhar Car Number</label>
                                <input type="text" class="form-control" id="aadhar_no" placeholder="Aadhar Card Number"
                                    name="aadhar_no" value="{{$data['edit']->aadhar_no}}">
                                @if($errors->has('aadhar_no'))
                                    <span class="error text-danger text-sm">{{ $errors->first('aadhar_no') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="pan_no">Pan Card Number</label>
                                <input type="text" class="form-control" id="pan_no" placeholder="Pan Card Number"
                                    name="pan_no" value="{{$data['edit']->pan_no}}">
                                @if($errors->has('pan_no'))
                                    <span class="error text-danger text-sm">{{ $errors->first('pan_no') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="dl_no">DL Number</label>
                                <input type="text" class="form-control" id="dl_no" placeholder="DL Number" name="dl_no"
                                    value="{{$data['edit']->dl_no}}">
                                @if($errors->has('dl_no'))
                                    <span class="error text-danger text-sm">{{ $errors->first('dl_no') }}</span>
                                @endif
                            </div>
                        </div>

                        <!--------------- Image Upload Here ----------------------------->
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="driver_photo">Driver Photo</label>
                                <input type="file" class="form-control" id="driver_photo" name="driver_photo">
                                @if($errors->has('driver_photo'))
                                <span class="error text-danger text-sm">{{ $errors->first('driver_photo') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="aadhar_front_image">Aadhar Front Photo</label>
                                <input type="file" class="form-control" id="aadhar_front_image"
                                    name="aadhar_front_image">
                                @if($errors->has('aadhar_front_image'))
                                <span class="error text-danger text-sm">{{ $errors->first('aadhar_front_image')
                                    }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="aadhar_back_image">Aadhar Back Photo</label>
                                <input type="file" class="form-control" id="aadhar_back_image" name="aadhar_back_image">
                                @if($errors->has('aadhar_back_image'))
                                <span class="error text-danger text-sm">{{ $errors->first('aadhar_back_image') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="dl_image">DL Photo</label>
                                <input type="file" class="form-control" id="dl_image" name="dl_image">
                                @if($errors->has('dl_image'))
                                <span class="error text-danger text-sm">{{ $errors->first('dl_image') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="row my-2">
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <label for="driver_image">Driver Image</label>
                            {{-- <a href="{{$data['edit']->driver_image_url}}" target="_blank">
                            </a> --}}
                            <img src="{{$data['edit']->driver_image_url}}" alt="driver_image" id="driver_image" class=""
                                style="height: 100px;width:100px;">
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <label for="driver_image">Aadhar Front Image</label>
                            <img src="{{$data['edit']->aadhar_frontImage_url}}" alt="aadhar front image"
                                id="driver_image" class="" style="height: 100px;width:100px;">
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <label for="driver_image">Aadhar Back Image</label>
                            <img src="{{$data['edit']->aadhar_backImage_url}}" alt="aadhar back image" id="driver_image"
                                class="" style="height: 100px;width:100px;">
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <label for="driver_image">DL Image</label>
                            <img src="{{$data['edit']->dl_image_url}}" alt="dl image" id="driver_image" class=""
                                style="height: 100px;width:100px;">
                        </div>
                    </div>


                    <div class="row bg-light mb-3 text-center">
                        <h6 class="my-2">Car Details <button type="button addMore"><i
                                    class="bi bi-plus-square-fill"></i></button></h6>

                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="car_name">Car Name</label>
                                <input type="text" class="form-control" id="car_name" placeholder="Car Name"
                                    name="car_name" value="{{$data['edit']->DriverCarDetails->car_name ?? '--'}}">
                                @if($errors->has('car_name'))
                                <span class="error text-danger text-sm">{{ $errors->first('car_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="car_brand">Car Brand</label>
                                <input type="text" class="form-control" id="car_brand" placeholder="Car Brand"
                                    name="car_brand" value="{{$data['edit']->DriverCarDetails->car_brand ?? ''}}">
                                @if($errors->has('car_brand'))
                                <span class="error text-danger text-sm">{{ $errors->first('car_brand') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="car_image">Car Image</label>
                                <input type="file" class="form-control" id="car_image" placeholder="Car Brand"
                                    name="car_image" value="{{$data['edit']->car_image ?? ''}}">
                                @if($errors->has('car_image'))
                                <span class="error text-danger text-sm">{{ $errors->first('car_image') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="car_no">Car Number</label>
                                <input type="text" class="form-control" id="car_no" placeholder="Car Number"
                                    name="car_no" value="{{$data['edit']->DriverCarDetails->car_no ?? ''}}">
                                @if($errors->has('car_no'))
                                <span class="error text-danger text-sm">{{ $errors->first('car_no') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="fuel_type">Fuel Type</label>
                                <select name="fuel_type" id="fuel_type" class="form-control form-select">
                                    <option value="" selected disabled>Select Fuel Type</option>
                                    @if($data['edit']->DriverCarDetails)
                                    <option value="0" {{$data['edit']->DriverCarDetails->fuel_type == '0' ? 'selected'
                                        :''}}>Petol</option>
                                    <option value="1" {{$data['edit']->DriverCarDetails->fuel_type == '1' ? 'selected'
                                        :''}}>Diesel</option>
                                    <option value="2" {{$data['edit']->DriverCarDetails->fuel_type == '2' ? 'selected'
                                        :''}}>CNG</option>
                                    <option value="3" {{$data['edit']->DriverCarDetails->fuel_type == '3' ? 'selected'
                                        :''}}>Electric</option>
                                    <option value="4" {{$data['edit']->DriverCarDetails->fuel_type == '4' ? 'selected'
                                        :''}}>Other</option>
                                    @else
                                    <option value="0">Petol</option>
                                    <option value="1">Diesel</option>
                                    <option value="2">CNG</option>
                                    <option value="3">Electric</option>
                                    <option value="4">Other</option>
                                    @endif
                                </select>
                                @if($errors->has('fuel_type'))
                                <span class="error text-danger text-sm">{{ $errors->first('fuel_type') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="no_ofSeat">Number of Seats</label>
                                <input type="text" class="form-control" id="no_ofSeat" placeholder="Number Of Seat"
                                    name="no_ofSeat" value="{{$data['edit']->DriverCarDetails->no_seat ?? ''}}">
                                @if($errors->has('no_ofSeat'))
                                <span class="error text-danger text-sm">{{ $errors->first('no_ofSeat') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="expiry_date">Expiry Date</label>
                                <input type="text" class="form-control" id="expiry_date" placeholder="Expiry Date"
                                    name="expiry_date"
                                    value="{{$data['edit']->DriverCarDetails->insurence_expiry ?? ''}}">
                                @if($errors->has('expiry_date'))
                                <span class="error text-danger text-sm">{{ $errors->first('expiry_date') }}</span>
                                @endif
                            </div>
                        </div>

                        <!--------------- Image Upload Here ----------------------------->
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="insurence_photo">Insurence Photo</label>
                                <input type="file" class="form-control" id="insurence_photo" name="insurence_photo">
                                @if($errors->has('insurence_photo'))
                                <span class="error text-danger text-sm">{{ $errors->first('insurence_photo') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="carRc_front_image">Car RC Front Photo</label>
                                <input type="file" class="form-control" id="carRc_front_image" name="carRc_front_image">
                                @if($errors->has('carRc_front_image'))
                                <span class="error text-danger text-sm">{{ $errors->first('carRc_front_image') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="carRc_back_image">Car RC Back Photo</label>
                                <input type="file" class="form-control" id="carRc_back_image" name="carRc_back_image">
                                @if($errors->has('carRc_back_image'))
                                <span class="error text-danger text-sm">{{ $errors->first('carRc_back_image') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- @dd($data['edit']->DriverCarDetails->car_image); --}}
                    <div class="row my-2">
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <label for="isurence_image">Car Photo</label>
                            <img src="{{$data['edit']->DriverCarDetails->car_image ?? ''}}" alt="isurence_image"
                                id="driver_image" class="" style="height: 100px;width:100px;">
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <label for="isurence_image">Insurence Photo</label>
                            <img src="{{$data['edit']->DriverCarDetails->insurence_image_url ?? ''}}"
                                alt="isurence_image" id="driver_image" class="" style="height: 100px;width:100px;">
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <label for="car_rc_front_image">Car RC Front Image</label>
                            <img src="{{$data['edit']->DriverCarDetails->car_rc_frontImage_url ?? ''}}"
                                alt="car_rc_front_image" id="driver_image" class="" style="height: 100px;width:100px;">
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <label for="car_rc_back_image">Car Rc Back Image</label>
                            <img src="{{$data['edit']->DriverCarDetails->car_rc_backImage_url ?? ''}}"
                                alt="car_rc_back_image" id="driver_image" class="" style="height: 100px;width:100px;">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace('editor');

</script>
@endsection