@extends('Admin.common.layout')
@section('content')
@php
$active = 'car_category';
@endphp
<script type="text/javascript">
    tinymce.init({
        selector: "#textEditor"
    });

</script>
<div class="row ">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Car Category Create</h4>
                <form action="{{route('carCategory.store')}}" class="forms-sample" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Name</label>
                                    <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Name" name="name">
                                    @if($errors->has('name'))
                                    <span class="error text-danger text-sm">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="per_kmCost">Per Km Cost</label>
                                    <input type="text" class="form-control" id="per_kmCost" placeholder="Per Km Cost" name="per_km_cost">
                                    @if($errors->has('per_km_cost'))
                                    <span class="error text-danger text-sm">{{ $errors->first('per_km_cost') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="extra_fair_perKm">Extra Fair Per Km</label>
                                    <input type="text" class="form-control" id="extra_fair_perKm" placeholder="Extra Fair Per Km" name="extra_fair_perKm">
                                    @if($errors->has('extra_fair_perKm'))
                                    <span class="error text-danger text-sm">{{ $errors->first('extra_fair_perKm') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="extra_fairPerHour">Extra Fair Per Hour</label>
                                    <input type="text" class="form-control" id="extra_fairPerHour" placeholder="Extra Fair Per Hour" name="extra_fair_perHour">
                                    @if($errors->has('extra_fair_perHour'))
                                    <span class="error text-danger text-sm">{{ $errors->first('extra_fair_perHour') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="fuel_charge">Fuel Charge</label>
                                    <input type="text" class="form-control" id="fuel_charge" placeholder="Fuel Charge" name="fuel_charge">
                                    @if($errors->has('fuel_charge'))
                                    <span class="error text-danger text-sm">{{ $errors->first('fuel_charge') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="driver_charge">Driver Charge</label>
                                    <input type="text" class="form-control" id="driver_charge" placeholder="Driver Charge" name="driver_charge">
                                    @if($errors->has('driver_charge'))
                                    <span class="error text-danger text-sm">{{ $errors->first('driver_charge') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="night_charge">Night Charge</label>
                                    <input type="text" class="form-control" id="night_charge" placeholder="Night Charge" name="night_charge">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="off">OFF</label>
                                    <input type="text" class="form-control" id="off" placeholder="OFF" name="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="toll">Toll</label>
                                    <input type="text" class="form-control" id="toll" placeholder="Toll" name="toll">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="tax">Tax</label>
                                    <input type="text" class="form-control" id="tax" placeholder="Tax" name="tax">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="parking">Parking</label>
                                    <input type="text" class="form-control" id="parking" placeholder="Parking" name="parking">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="textEditor">Other Details</label>
                                    <textarea class="form-control" id="textEditor" rows="8" name="other_details" rows="10" cols="80"></textarea>
                                </div>
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
