@extends('layouts.app')
@section('title')
    <title>Show Properties </title>
@endsection
@section('content')
    <div class="page-container">
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-12">
                                    <div class="table-responsive table--no-card m-b-30">
                                        <table class="table table-borderless table-striped table-earning">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Unit Type</th>
                                                <th>Size</th>
                                                <th>Mgt</th>
                                                <th class="text-right">Current Occupancy Status</th>
                                                <th class="text-right">Unit Rent</th>
                                                <th class="text-right">Start Date</th>
                                                <th class="text-right">End Date</th>
                                                <th class="text-right">Service Chrgs</th>
                                                <th class="text-right">Deposits</th>
                                                {{--<th width="100px">Action</th>--}}
                                                {{--<th width="100px">Delete</th>--}}
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Copyright © 2019 Enterprise Resource Planning. All rights reserved.  Designed by E & E Co.Ltd</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/theme/vendor/jquery-3.2.1.min.js"></script>
    <script type="text/javascript">
        $(function () {
            var table = $('.table-earning').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('property_details') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', className: "text-right", sortable:true},
                    {data: 'unit_type', name: 'unit_type', className: "text-right", sortable: false},
                    {data: 'size', name: 'size', className: "text-right", sortable: false},
                    {data: 'mgt', name: 'mgt', className: "text-right", sortable: false},
                    {data: 'tenant_name', name: 'tenant_name', className: "text-right", sortable: false},
                    {data: 'unit_rent', name: 'unit_rent', className: "text-right", sortable: false},
                    {data: 'start_date', name: 'start_date', className: "text-right", sortable: false},
                    {data: 'end_date', name: 'end_date', className: "text-right", sortable: false},
                    {data: 'service_charges', name: 'service_charges', className: "text-right", sortable: false},
                    {data: 'deposit', name: 'deposit', sortable: false, className: "text-right"},
                ]
            });

        });
    </script>
@endsection