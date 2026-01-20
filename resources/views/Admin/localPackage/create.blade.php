@extends('Admin.common.layout')
@section('content')
@php
$active = 'local_package';
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
                <h4 class="card-title">Local Package Create</h4>
                {{-- @if($errors->any())
                    {{ implode('', $errors->all('<div>:message</div>')) }}
                @endif --}}

                <form action="{{route('localpackage.store')}}" class="forms-sample" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="time">Time</label>
                                <select name="time" id="time" class="form-select" required>
                                    <option value="" selected disabled>Select Time</option>
                                    @foreach($data['timeSchadule'] as $key => $value)
                                    <option value="{{$value->id}}">{{$value->time}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('time'))
                                <span class="error text-danger text-sm">{{ $errors->first('time') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select name="type" id="type" class="form-select form-control" required>
                                    <option value="" selected disabled>Select Type</option>
                                    <option value="ac">AC</option>
                                    <option value="non_ac">Non AC</option>
                                </select>
                                @if($errors->has('type'))
                                <span class="error text-danger text-sm">{{ $errors->first('type') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category" id="category" class="form-select form-control" required>
                                    <option value="" selected disabled>Select Fule Type</option>
                                    <option value="sedan">Sedan</option>
                                    <option value="hatchback">Hatchback</option>
                                    <option value="suv">SUV</option>
                                    <option value="coupe">Coupe</option>
                                    <option value="convertable">Convertable</option>
                                    <option value="crossover">Crossover</option>
                                    <option value="other">Other</option>
                                </select>
                                @if($errors->has('category'))
                                <span class="error text-danger text-sm">{{ $errors->first('category') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="fair">Fair</label>
                                <input type="text" class="form-control" id="fair" placeholder="fair" name="fair" required>
                                @if($errors->has('fair'))
                                <span class="error text-danger text-sm">{{ $errors->first('fair') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="extra_fair_perKm">Extra Fair Per Km</label>
                                    <input type="text" class="form-control" id="extra_fair_perKm" placeholder="Extra Fair Per Km" name="extra_fair_perKm" required>
                                    @if($errors->has('extra_fair_perKm'))
                                    <span class="error text-danger text-sm">{{ $errors->first('extra_fair_perKm') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="extra_fair_perHour">Extra Fair Per Hour</label>
                                    <input type="text" class="form-control" id="extra_fair_perHour" placeholder="Extra Fair Per Hour" name="extra_fair_perHour" required>
                                    @if($errors->has('extra_fair_perHour'))
                                    <span class="error text-danger text-sm">{{ $errors->first('extra_fair_perHour') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="driver_charge">Driver Charge</label>
                                    <input type="text" class="form-control" id="driver_charge" placeholder="Driver Charge" name="driver_charge" required>
                                    @if($errors->has('driver_charge'))
                                    <span class="error text-danger text-sm">{{ $errors->first('driver_charge') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="night_charge">Night Charge</label>
                                    <input type="text" class="form-control" id="night_charge" placeholder="Night Charges" name="night_charge" required>
                                    @if($errors->has('night_charge'))
                                    <span class="error text-danger text-sm">{{ $errors->first('night_charge') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="editor">Other Details</label>
                                    <textarea class="form-control" id="other_details" rows="8" name="other_details" rows="10" cols="80" required></textarea>
                                    @if($errors->has('other_details'))
                                    <span class="error text-danger text-sm">{{ $errors->first('other_details') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    {{-- <button class="btn btn-secondary">Reset</button> --}}
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
