@extends('layouts.app')
@section('title')
    <title>Create Property </title>
@endsection
@section('content')
    <div class="page-container">
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="container">
                        <div class="row justify-content-center animsition">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Create Property</strong>
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="{{route('saveProperty')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                            @csrf
                                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-details" role="tab" aria-controls="pills-details"
                                                       aria-selected="true">Property Details</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                                <div class="tab-pane fade active show" id="pills-details" role="tabpanel" aria-labelledby="pills-details-tab">
                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label class=" form-control-label">Landlord</label>
                                                        </div>
                                                        <div class="col col-md-3">
                                                            <select name="landlord" placeholder="Landlord" class="form-control" value="{{old('landlord')}}">
                                                                @foreach ($landlords as $landlord)
                                                                    <option value="{{ $landlord->id }}">{{ $landlord->title.' '.$landlord->first_name.' '.$landlord->middle_name.' '.$landlord->sur_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label class=" form-control-label">Type</label>
                                                        </div>
                                                        <div class="col col-md-3">
                                                            <select name="propertyType" placeholder="Type" class="form-control" value="{{old('propertyType')}}">
                                                                @foreach ($types as $type)
                                                                    <option value="{{ $type->id }}">{{ $type->property_type }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col col-md-3">
                                                            <input type="number" id="text-input-size" name="size" placeholder="Size" class="form-control{{ $errors->has('size') ? ' is-invalid' : '' }}"  value="{{old('size')}}">
                                                            @if ($errors->has('size'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('size') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label class=" form-control-label">Mgt</label>
                                                        </div>
                                                        <div class="col col-md-3">
                                                            <select name="mgt" placeholder="mgt" class="form-control" value="{{old('mgt')}}">
                                                                <option value="yes">Yes</option>
                                                                <option value="no">No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label class=" form-control-label">Unit Rent</label>
                                                        </div>
                                                        <div class="col col-md-3">
                                                            <input type="number" id="text-input-rent" name="unitRent" placeholder="3000" class="form-control{{ $errors->has('unitRent') ? ' is-invalid' : '' }}"  value="{{old('unitRent')}}">
                                                            @if ($errors->has('unitRent'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('unitRent') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label class=" form-control-label">Service Charges</label>
                                                        </div>
                                                        <div class="col col-md-3">
                                                            <input type="number" id="text-input-charge" name="serviceCharges" placeholder="0.00" class="form-control{{ $errors->has('serviceCharges') ? ' is-invalid' : '' }}"  value="{{old('serviceCharges')}}">
                                                            @if ($errors->has('serviceCharges'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('serviceCharges') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-dot-circle-o"></i> Save
                                                </button>
                                                <button type="reset" class="btn btn-info btn-sm">
                                                    <i class="fa fa-ban"></i> Cancel
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="/theme/vendor/jquery-3.2.1.min.js"></script>
    <script src="/intl-tel-input-master/build/js/intlTelInput.js"></script>
@endsection


