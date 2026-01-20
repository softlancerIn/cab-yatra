@extends('Admin.common.layout')
@section('content')
@php
    $active = 'local_airport_fair';
    $minDistance = json_decode($data['CabAirportFair']->min_distance);
    $minFair = json_decode($data['CabAirportFair']->min_fair);
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
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h4 class="card-title">One way and Airport Fair Edit</h4>
                <form action="{{route('onewayAirportFairList')}}" class="forms-sample" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{$data['CabAirportFair']->id}}">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="car_category">Car Category</label>
                                <select id="car_category" class="form-select form-control" name="car_category">
                                    <option value="" selected disabled>Select car category</option>
                                    @foreach ($data['CarCategory'] as $item)
                                        <option value="{{$item->id}}" {{$data['CabAirportFair']->car_category == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('car_category'))
                                    <span class="error text-danger text-sm">{{ $errors->first('car_category') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select id="type" class="form-select form-control" name="type">
                                    <option value="" selected disabled>Select Type</option>
                                    <option value="1" {{$data['CabAirportFair']->type == '1' ? 'selected' : ''}}>One Way
                                    </option>
                                    <option value="0" {{$data['CabAirportFair']->type == '0' ? 'selected' : ''}}>Airport
                                    </option>
                                </select>
                                @if($errors->has('type'))
                                    <span class="error text-danger text-sm">{{ $errors->first('type') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="extra_fair_perKm">Fair perKm</label>
                                <input type="text" class="form-control" id="extra_fair_perKm"
                                    placeholder="Extra Fair PerKm" name="extra_fair_perKm"
                                    value="{{$data['CabAirportFair']->extra_fair_perKm}}">
                                @if($errors->has('extra_fair_perKm'))
                                    <span class="error text-danger text-sm">{{ $errors->first('extra_fair_perKm') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="extra_fair_for_showing">Extra Fair perKm</label>
                                <input type="text" class="form-control" id="extra_fair_for_showing"
                                    placeholder="Extra Fair PerKm" name="extra_fair_for_showing"
                                    value="{{$data['CabAirportFair']->extra_fair_for_showing}}">
                                @if($errors->has('extra_fair_for_showing'))
                                    <span
                                        class="error text-danger text-sm">{{ $errors->first('extra_fair_for_showing') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="off">OFF</label>
                                <input type="text" class="form-control" id="off" placeholder="Min Fair" name="off"
                                    value="{{$data['CabAirportFair']->off}}">
                                @if($errors->has('off'))
                                    <span class="error text-danger text-sm">{{ $errors->first('off') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="min_distance">Min Distance</label>
                                <input type="text" class="form-control" id="min_distance" placeholder="Min Distance"
                                    value="{{$minDistance[0] ?? ''}}" name="min_distance[]">
                                @if($errors->has('min_distance'))
                                    <span class="error text-danger text-sm">{{ $errors->first('min_distance') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="min_fair">Min Fair</label>
                                <input type="text" class="form-control" id="min_fair" placeholder="Min Fair" value="{{$minFair[0] ?? ''}}"
                                    name="min_fair[]">
                                @if($errors->has('min_fair'))
                                    <span class="error text-danger text-sm">{{ $errors->first('min_fair') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="min_distance">Min Distance</label>
                                <input type="text" class="form-control" id="min_distance" placeholder="Min Distance" value="{{$minDistance[1] ?? ''}}"
                                    name="min_distance[]">
                                @if($errors->has('min_distance'))
                                    <span class="error text-danger text-sm">{{ $errors->first('min_distance') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="min_fair">Min Fair</label>
                                <input type="text" class="form-control" id="min_fair" placeholder="Min Fair" value="{{$minFair[1] ?? ''}}"
                                    name="min_fair[]">
                                @if($errors->has('min_fair'))
                                    <span class="error text-danger text-sm">{{ $errors->first('min_fair') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="min_distance">Min Distance</label>
                                <input type="text" class="form-control" id="min_distance" placeholder="Min Distance" value="{{$minDistance[2] ?? ''}}"
                                    name="min_distance[]">
                                @if($errors->has('min_distance'))
                                    <span class="error text-danger text-sm">{{ $errors->first('min_distance') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="min_fair">Min Fair</label>
                                <input type="text" class="form-control" id="min_fair" placeholder="Min Fair" value="{{$minFair[2] ?? ''}}"
                                    name="min_fair[]">
                                @if($errors->has('min_fair'))
                                    <span class="error text-danger text-sm">{{ $errors->first('min_fair') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="min_distance">Min Distance</label>
                                <input type="text" class="form-control" id="min_distance" placeholder="Min Distance" value="{{$minDistance[3] ?? ''}}"
                                    name="min_distance[]">
                                @if($errors->has('min_distance'))
                                    <span class="error text-danger text-sm">{{ $errors->first('min_distance') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="min_fair">Min Fair</label>
                                <input type="text" class="form-control" id="min_fair" placeholder="Min Fair" value="{{$minFair[3] ?? ''}}"
                                    name="min_fair[]">
                                @if($errors->has('min_fair'))
                                    <span class="error text-danger text-sm">{{ $errors->first('min_fair') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="min_distance">Min Distance</label>
                                <input type="text" class="form-control" id="min_distance" placeholder="Min Distance" value="{{$minDistance[4] ?? ''}}"
                                    name="min_distance[]">
                                @if($errors->has('min_distance'))
                                    <span class="error text-danger text-sm">{{ $errors->first('min_distance') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="min_fair">Min Fair</label>
                                <input type="text" class="form-control" id="min_fair" placeholder="Min Fair" value="{{$minFair[4] ?? ''}}"
                                    name="min_fair[]">
                                @if($errors->has('min_fair'))
                                    <span class="error text-danger text-sm">{{ $errors->first('min_fair') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="min_distance">Min Distance</label>
                                <input type="text" class="form-control" id="min_distance" placeholder="Min Distance" value="{{$minDistance[5] ?? ''}}"
                                    name="min_distance[]">
                                @if($errors->has('min_distance'))
                                    <span class="error text-danger text-sm">{{ $errors->first('min_distance') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="min_fair">Min Fair</label>
                                <input type="text" class="form-control" id="min_fair" placeholder="Min Fair" value="{{$minFair[5] ?? ''}}"
                                    name="min_fair[]">
                                @if($errors->has('min_fair'))
                                    <span class="error text-danger text-sm">{{ $errors->first('min_fair') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="min_distance">Min Distance</label>
                                <input type="text" class="form-control" id="min_distance" placeholder="Min Distance" value="{{$minDistance[6] ?? ''}}"
                                    name="min_distance[]">
                                @if($errors->has('min_distance'))
                                    <span class="error text-danger text-sm">{{ $errors->first('min_distance') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="min_fair">Min Fair</label>
                                <input type="text" class="form-control" id="min_fair" placeholder="Min Fair" value="{{$minFair[6] ?? ''}}"
                                    name="min_fair[]">
                                @if($errors->has('min_fair'))
                                    <span class="error text-danger text-sm">{{ $errors->first('min_fair') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="min_distance">Min Distance</label>
                                <input type="text" class="form-control" id="min_distance" placeholder="Min Distance" value="{{$minDistance[7] ?? ''}}"
                                    name="min_distance[]">
                                @if($errors->has('min_distance'))
                                    <span class="error text-danger text-sm">{{ $errors->first('min_distance') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="min_fair">Min Fair</label>
                                <input type="text" class="form-control" id="min_fair" placeholder="Min Fair" value="{{$minFair[7] ?? ''}}"
                                    name="min_fair[]">
                                @if($errors->has('min_fair'))
                                    <span class="error text-danger text-sm">{{ $errors->first('min_fair') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="min_distance">Min Distance</label>
                                <input type="text" class="form-control" id="min_distance" placeholder="Min Distance" value="{{$minDistance[8] ?? ''}}"
                                    name="min_distance[]">
                                @if($errors->has('min_distance'))
                                    <span class="error text-danger text-sm">{{ $errors->first('min_distance') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="min_fair">Min Fair</label>
                                <input type="text" class="form-control" id="min_fair" placeholder="Min Fair" value="{{$minFair[8] ?? ''}}"
                                    name="min_fair[]">
                                @if($errors->has('min_fair'))
                                    <span class="error text-danger text-sm">{{ $errors->first('min_fair') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!---------------------------------- Add Field -------------------------------------->
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="min_distance">Min Distance</label>
                                <input type="text" class="form-control" id="min_distance" placeholder="Min Distance" value="{{$minDistance[9] ?? ''}}"
                                    name="min_distance[]">
                                @if($errors->has('min_distance'))
                                    <span class="error text-danger text-sm">{{ $errors->first('min_distance') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="min_fair">Min Fair</label>
                                <input type="text" class="form-control" id="min_fair" placeholder="Min Fair" value="{{$minFair[9] ?? ''}}"
                                    name="min_fair[]">
                                @if($errors->has('min_fair'))
                                    <span class="error text-danger text-sm">{{ $errors->first('min_fair') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="min_distance">Min Distance</label>
                                <input type="text" class="form-control" id="min_distance" placeholder="Min Distance" value="{{$minDistance[10] ?? ''}}"
                                    name="min_distance[]">
                                @if($errors->has('min_distance'))
                                    <span class="error text-danger text-sm">{{ $errors->first('min_distance') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="min_fair">Min Fair</label>
                                <input type="text" class="form-control" id="min_fair" placeholder="Min Fair" value="{{$minFair[10] ?? ''}}"
                                    name="min_fair[]">
                                @if($errors->has('min_fair'))
                                    <span class="error text-danger text-sm">{{ $errors->first('min_fair') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="min_distance">Min Distance</label>
                                <input type="text" class="form-control" id="min_distance" placeholder="Min Distance" value="{{$minDistance[11] ?? ''}}"
                                    name="min_distance[]">
                                @if($errors->has('min_distance'))
                                    <span class="error text-danger text-sm">{{ $errors->first('min_distance') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="min_fair">Min Fair</label>
                                <input type="text" class="form-control" id="min_fair" placeholder="Min Fair" value="{{$minFair[11] ?? ''}}"
                                    name="min_fair[]">
                                @if($errors->has('min_fair'))
                                    <span class="error text-danger text-sm">{{ $errors->first('min_fair') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="min_distance">Min Distance</label>
                                <input type="text" class="form-control" id="min_distance" placeholder="Min Distance" value="{{$minDistance[12] ?? ''}}"
                                    name="min_distance[]">
                                @if($errors->has('min_distance'))
                                    <span class="error text-danger text-sm">{{ $errors->first('min_distance') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="min_fair">Min Fair</label>
                                <input type="text" class="form-control" id="min_fair" placeholder="Min Fair" value="{{$minFair[12] ?? ''}}"
                                    name="min_fair[]">
                                @if($errors->has('min_fair'))
                                    <span class="error text-danger text-sm">{{ $errors->first('min_fair') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="min_distance">Min Distance</label>
                                <input type="text" class="form-control" id="min_distance" placeholder="Min Distance" value="{{$minDistance[13] ?? ''}}"
                                    name="min_distance[]">
                                @if($errors->has('min_distance'))
                                    <span class="error text-danger text-sm">{{ $errors->first('min_distance') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="min_fair">Min Fair</label>
                                <input type="text" class="form-control" id="min_fair" placeholder="Min Fair" value="{{$minFair[13] ?? ''}}"
                                    name="min_fair[]">
                                @if($errors->has('min_fair'))
                                    <span class="error text-danger text-sm">{{ $errors->first('min_fair') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="min_distance">Min Distance</label>
                                <input type="text" class="form-control" id="min_distance" placeholder="Min Distance" value="{{$minDistance[14] ?? ''}}"
                                    name="min_distance[]">
                                @if($errors->has('min_distance'))
                                    <span class="error text-danger text-sm">{{ $errors->first('min_distance') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="min_fair">Min Fair</label>
                                <input type="text" class="form-control" id="min_fair" placeholder="Min Fair" value="{{$minFair[14] ?? ''}}"
                                    name="min_fair[]">
                                @if($errors->has('min_fair'))
                                    <span class="error text-danger text-sm">{{ $errors->first('min_fair') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!---------------------------------- Add Field -------------------------------------->
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="textEditor">Other Details</label>
                                <textarea class="form-control" id="textEditor" rows="8" name="other_details" rows="10"
                                    cols="80">{{$data['CabAirportFair']->other_details}}</textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection