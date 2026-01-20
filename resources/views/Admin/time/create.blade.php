@extends('Admin.common.layout')
@section('content')
@php
$active = 'time_schadule';
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
                <h4 class="card-title">Time Create</h4>
                <form action="{{route('time.store')}}" class="forms-sample" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="time">Time</label>
                                <input type="text" class="form-control" id="time" placeholder="Time" name="time" required>
                                @if($errors->has('time'))
                                <span class="error text-danger text-sm">{{ $errors->first('time') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="status">Select Status</label>
                                <select name="status" id="" class="form-control form-select">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                @if($errors->has('status'))
                                    <div class="error">{{ $errors->first('status') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
