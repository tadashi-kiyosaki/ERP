@extends('layouts.app')
@section('title')
    <title>Rent Property </title>
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
                                        <strong>Rent Property</strong>
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="{{route('rentProperty')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                            @csrf
                                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-details" role="tab" aria-controls="pills-details"
                                                       aria-selected="true">Details</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                                <div class="tab-pane fade active show" id="pills-details" role="tabpanel" aria-labelledby="pills-details-tab">
                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label class=" form-control-label">Landlord</label>
                                                            <input name="tenantId" type="hidden" value="{{$tenant->id}}">
                                                        </div>
                                                        <div class="col col-md-3">
                                                            <select name="landlord" placeholder="Landlord" class="form-control" value="{{old('landlord')}}">
                                                                <option value="">- Select landlord -</option>
                                                                @foreach ($landlords as $landlord)
                                                                    <option value="{{ $landlord->id }}">{{ $landlord->title.' '.$landlord->first_name.' '.$landlord->middle_name.' '.$landlord->sur_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label class=" form-control-label">Select Property</label>
                                                        </div>
                                                        <div class="col col-md-3">
                                                            <select name="propertyType" placeholder="Type" class="form-control" value="{{old('propertyType')}}">
                                                            </select>
                                                        </div>
                                                        <div class="col col-md-3">
                                                            <label class=" form-control-label">Property Size</label>
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label class="form-control-label">Unit Rent</label>
                                                        </div>
                                                        <div class="col col-md-3">
                                                            <input type="text" id="unit" class="form-control" name="propertyUnit" disabled placeholder="Unit Rent"/>
                                                        </div>
                                                        <div class="col col-md-3">
                                                            <input type="text" id="size" class="form-control" name="propertySize" disabled placeholder="Size"/>
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label class="form-control-label">Deposit</label>
                                                        </div>
                                                        <div class="col col-md-3">
                                                            <input type="number" id="deposit" class="form-control" name="deposit" placeholder="Deposit"/>
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label class=" form-control-label">Contract Date</label>
                                                        </div>
                                                        <div class="col col-md-3">
                                                            <input type="text" name="startDate" id="datepickerStart" class="form-control"/>
                                                        </div>
                                                        <div class="col col-md-3">
                                                            <input type="text" name="endDate" id="datepickerEnd" class="form-control"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-dot-circle-o"></i> Rent
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
    <script src="/js/rentProperty.js"></script>
@endsection


