@extends('Admin.common.layout')
@section('content')
    @php
        $active = 'cms_page';
    @endphp

    <script type="text/javascript">
        tinymce.init({
            selector: "#privacy_policy"
        });
        tinymce.init({
            selector: "#term_condition"
        });
        tinymce.init({
            selector: "#about_us"
        });
        tinymce.init({
            selector: "#refund_policy"
        });
        tinymce.init({
            selector: "#sla_agreements"
        });
        tinymce.init({
            selector: "#penalty"
        });
    </script>
    <div class="row ">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Additional Information</h4>
                    <form action="{{route('cms_pages')}}" class="forms-sample" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="mobile">mobile</label>
                                    <input type="text" class="form-control" id="mobile" placeholder="Mobile" name="mobile"
                                        value="{{$data['settings']->mobile ?? ''}}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" placeholder="Email" name="email"
                                        value="{{$data['settings']->email ?? ''}}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" placeholder="Address"
                                        name="address" value="{{$data['settings']->address ?? ''}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="privacy_policy">Privacy Policy :-</label>
                                    <textarea name="privacy_policy"
                                        id="privacy_policy">{{$data['settings']->privacy_policy ?? ''}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="term_condition">Term and Condition :-</label>
                                    <textarea name="term_condition"
                                        id="term_condition">{{$data['settings']->term_condition ?? ''}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="about_us">About Us :-</label>
                                    <textarea name="about_us" id="about_us">{{$data['settings']->about_us ?? ''}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="penalty">Penalty :-</label>
                                    <textarea name="penalty" id="penalty">{{$data['settings']->penalty ?? ''}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="sla_agreements">SLA Agreement :-</label>
                                    <textarea name="sla_agreements"
                                        id="sla_agreements">{{$data['settings']->sla_agreements ?? ''}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="refund_policy">Refund Agreement :-</label>
                                    <textarea name="refund_policy"
                                        id="refund_policy">{{$data['settings']->refund_policy ?? ''}}</textarea>
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