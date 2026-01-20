@extends('Admin.common.layout')
@section('content')
@php
$active = 'cars';
@endphp
<script src="https://cdn.ckeditor.com/4.25.0/standard/ckeditor.js"></script>
<div class="row ">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Car Create</h4>
                <!-- <p class="card-description"> Basic form layout </p> -->
                <form action="{{route('car_create')}}" class="forms-sample" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Name</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Car Name" name="name">
                                @if($errors->has('name'))
                                <span class="error text-danger text-sm">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select name="type" id="type" class="form-select form-control">
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
                                <label for="fuel_type">Fule Type</label>
                                <select id="fuel_type" class="form-select form-control" name="fuel_type">
                                    <option value="" selected disabled>Select Fule Type</option>
                                    <option value="petrol">Petrol</option>
                                    <option value="diesel">Diesel</option>
                                    <option value="electric">Electric</option>
                                    <option value="hybrid">Hybrid</option>
                                    <option value="cng">CNG</option>
                                    <option value="lpg">LPG</option>
                                    <option value="other">Other</option>
                                </select>
                                @if($errors->has('fuel_type'))
                                <span class="error text-danger text-sm">{{ $errors->first('fuel_type') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category" id="category" class="form-select form-control">
                                    <option value="" selected disabled>Select Fule Type</option>
                                    @foreach($data['category'] as $key => $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                    {{-- <option value="sedan">Sedan</option>
                                    <option value="hatchback">Hatchback</option>
                                    <option value="suv">SUV</option>
                                    <option value="coupe">Coupe</option>
                                    <option value="convertable">Convertable</option>
                                    <option value="crossover">Crossover</option>
                                    <option value="crysta">Crysta</option>
                                    <option value="muv">MUV</option>
                                    <option value="other">Other</option> --}}
                                </select>
                                @if($errors->has('category'))
                                <span class="error text-danger text-sm">{{ $errors->first('category') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control" id="image" placeholder="Image" name="image">
                                    @if($errors->has('image'))
                                    <span class="error text-danger text-sm">{{ $errors->first('image') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="min_cahrge">min_charge</label>
                                    <input type="text" class="form-control" id="min_cahrge" placeholder="Min charge" name="min_charge">
                                    @if($errors->has('min_charge'))
                                    <span class="error text-danger text-sm">{{ $errors->first('min_charge') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="car_number">Car Number</label>
                                    <input type="text" class="form-control" id="car_number" placeholder="car_number" name="car_number">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="editor">Other Details</label>
                                    <textarea class="form-control" id="editor" rows="8" name="other_details" rows="10" cols="80"></textarea>
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
{{-- <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script> --}}


<script>
    CKEDITOR.replace('editor');

</script>
@endsection
