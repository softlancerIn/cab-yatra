@extends('Admin.common.layout')
@section('content')
    @php
        $active = 'custom_cities';
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
                    <h4 class="card-title">{{$data['custom_cities']->pickup_loc}} To
                        {{$data['custom_cities']->destination_loc}} Car Price Edit
                    </h4>
                    <form
                        action="{{route('customCarCategoryPriceEdit', ['id' => $data['id'], 'customCitiesCarPriceId' => $data['CustomCitiesCarPriceData']->id])}}"
                        class="forms-sample" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Car Category</label>
                                        <select name="car_categoryId" id="car_categoryId" class="form-control">
                                            <option value="">Select Car Category</option>
                                            @foreach($data['car_category'] as $category)
                                                <option value="{{$category->id}}"
                                                    {{$data['CustomCitiesCarPriceData']->car_categoryId == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('car_categoryId'))
                                            <span
                                                class="error text-danger text-sm">{{ $errors->first('car_categoryId') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="fixed_fair">Fixed Fair</label>
                                        <input type="text" class="form-control" id="fixed_fair" placeholder="Per Km Cost"
                                            name="fixed_fair" value="{{$data['CustomCitiesCarPriceData']->fixed_fair}}">
                                        @if($errors->has('fixed_fair'))
                                            <span class="error text-danger text-sm">{{ $errors->first('fixed_fair') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="total_km">Total km</label>
                                        <input type="text" class="form-control" id="total_km"
                                            placeholder="Extra Fair Per Km" name="total_km"
                                            value="{{$data['CustomCitiesCarPriceData']->total_km}}">
                                        @if($errors->has('total_km'))
                                            <span class="error text-danger text-sm">{{ $errors->first('total_km') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="extra_fairPerHour">Extra Fair Per Hour</label>
                                        <input type="text" class="form-control" id="extra_fairPerHour"
                                            placeholder="Extra Fair Per Hour" name="extra_fair_perHour"
                                            value="{{$data['CustomCitiesCarPriceData']->extra_fair_perHour}}">
                                        @if($errors->has('extra_fair_perHour'))
                                        <span class="error text-danger text-sm">{{ $errors->first('extra_fair_perHour')
                                            }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="fuel_charge">Fuel Charge</label>
                                        <input type="text" class="form-control" id="fuel_charge" placeholder="Fuel Charge"
                                            name="fuel_charge" value="{{$data['CustomCitiesCarPriceData']->fuel_charge}}">
                                        @if($errors->has('fuel_charge'))
                                        <span class="error text-danger text-sm">{{ $errors->first('fuel_charge') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="driver_charge">Driver Charge</label>
                                        <input type="text" class="form-control" id="driver_charge"
                                            placeholder="Driver Charge" name="driver_charge"
                                            value="{{$data['CustomCitiesCarPriceData']->driver_charge}}">
                                        @if($errors->has('driver_charge'))
                                        <span class="error text-danger text-sm">{{ $errors->first('driver_charge') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="form-group">
                                        <label for="night_charge">Night Charge</label>
                                        <input type="text" class="form-control" id="night_charge" placeholder="Night Charge"
                                            name="night_charge" value="{{$data['CustomCitiesCarPriceData']->night_charge}}">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-6">
                                    <div class="form-group">
                                        <label for="off">OFF</label>
                                        <input type="text" class="form-control" id="off" placeholder="OFF" name="off"
                                            value="{{$data['CustomCitiesCarPriceData']->off}}">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-6">
                                    <div class="form-group">
                                        <label for="toll">Toll</label>
                                        <input type="text" class="form-control" id="toll" placeholder="Toll" name="toll"
                                            value="{{$data['CustomCitiesCarPriceData']->toll}}">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-6">
                                    <div class="form-group">
                                        <label for="tax">Tax</label>
                                        <input type="text" class="form-control" id="tax" placeholder="Tax" name="tax"
                                            value="{{$data['CustomCitiesCarPriceData']->tax}}">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="form-group">
                                        <label for="parking">Parking</label>
                                        <input type="text" class="form-control" id="parking" placeholder="Parking"
                                            name="parking" value="{{$data['CustomCitiesCarPriceData']->parking}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="textEditor">Other Details</label>
                                        <textarea class="form-control" id="textEditor" rows="8" name="other_details"
                                            rows="10"
                                            cols="80">{{$data['CustomCitiesCarPriceData']->other_details}}</textarea>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <button class="btn btn-secondary">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection