@extends('Admin.common.layout')
@section('content')
    @php
        $active = 'custom_cities';
    @endphp
    <div class="row ">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Custom Cities Create</h4>
                    <form action="{{route('customCities_edit', ['id' => $data['edit']->id])}}" class="forms-sample"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="row">
                                <div class="col-lg-6 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <select name="type" id="type" class="form-control">
                                            <option value="" selected disabled>Select Type</option>
                                            <option value="0" {{$data['edit']->type == '0' ? 'selected' : ''}}>Oneway</option>
                                            {{-- <option value="1">Round Trip</option>
                                            <option value="2">Local</option>
                                            <option value="3">Airport</option> --}}
                                        </select>
                                        @if($errors->has('type'))
                                            <span class="error text-danger text-sm">{{ $errors->first('type') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="from_location">From Location</label>
                                        <input type="text" class="form-control" id="from_location"
                                            placeholder="From Location" name="pickup_loc"
                                            value="{{$data['edit']->pickup_loc ?? ''}}">
                                        @if($errors->has('pickup_loc'))
                                            <span class="error text-danger text-sm">{{ $errors->first('pickup_loc') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="to_location">To Location</label>
                                        <input type="text" class="form-control" id="to_location" placeholder="To location"
                                            name="destination_loc" value="{{$data['edit']->destination_loc ?? ''}}">
                                        @if($errors->has('destination_loc'))
                                            <span
                                                class="error text-danger text-sm">{{ $errors->first('destination_loc') }}</span>
                                        @endif
                                    </div>
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