@php
    $car = App\Models\Cars::where('status','1')->get(['id','name']);
@endphp
<!-- Assign Car to package Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Assign Car</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('add_assign_carTo_package')}}" class="forms-sample" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="package_id" id="package_id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Choose Car</label>
                                <select name="car_id" id="type" class="form-select form-control">
                                    <option value="" selected disabled>Select Car</option>
                                    @foreach($car as $key => $value)
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2 btn-sm">Submit</button>
                    <button class="btn btn-secondary btn-sm">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Assign Car to package Modal -->
