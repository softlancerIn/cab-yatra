@extends('Admin.common.layout')
@section('content')
@php
$active = 'time_schadule';
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
                <h4 class="card-title">Time Schadule Create</h4>
                <form action="{{route('timeschadule.update',$data['edit']->id)}}" class="forms-sample" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="time">Car Category</label>
                                <select name="car_category" id="car_category" class="form-control form-select">
                                    <option value="" selected disabled>Select Car Category</option>
                                    @foreach($data['carCategory'] as $item)
                                        <option value="{{$item->id}}" {{$data['edit']->car_category == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="time_id">Time</label>
                                <select name="time_id" id="time_id" class="form-control form-select">
                                    <option value="" selected disabled>Select Time</option>
                                    @foreach($data['time'] as $item)
                                        <option value="{{$item->id}}" {{$data['edit']->time_id == $item->id ? 'selected' : ''}}>{{$item->time}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="time">Fair</label>
                                <input type="text" class="form-control" id="time" placeholder="Enter Fair" name="fair" required value="{{$data['edit']->fair}}">
                                @if($errors->has('fair'))
                                <span class="error text-danger text-sm">{{ $errors->first('fair') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="time">Extra Fair Per Hour</label>
                                <input type="text" class="form-control" id="time" placeholder="Extra Fair Per Hour" name="extra_fair_perHour" required value="{{$data['edit']->extra_fair_perHour}}">
                                @if($errors->has('extra_fair_perHour'))
                                <span class="error text-danger text-sm">{{ $errors->first('extra_fair_perHour') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="time">Extra Fair Per Km</label>
                                <input type="text" class="form-control" id="time" placeholder="Extra Fair Per Km" name="extra_fair_perKm" required value="{{$data['edit']->extra_fair_perKm}}">
                                @if($errors->has('extra_fair_perKm'))
                                <span class="error text-danger text-sm">{{ $errors->first('extra_fair_perKm') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="off">OFF</label>
                                <input type="text" class="form-control" id="time" placeholder="Off" name="off" required value="{{$data['edit']->off}}">
                                @if($errors->has('off'))
                                <span class="error text-danger text-sm">{{ $errors->first('off') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="time">Status</label>
                                <select name="status" id="status" class="form-select form-control">
                                    <option value="" disabled>Select Status</option>
                                    <option value="1" {{$data['edit']->status == '1' ? 'selected' : ''}}>Active</option>
                                    <option value="0" {{$data['edit']->status == '0' ? 'selected' : ''}}>InActive</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="textEditor">Other Details</label>
                                    <textarea class="form-control" id="textEditor" rows="8" name="other_details" rows="10" cols="80">{{$data['edit']->other_details}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary mt-4">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
