@extends('layouts.app')
@section('title')
    <title>Show Tenants </title>
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
                                                <th>Tenant Name</th>
                                                <th>ID/Reg PIN</th>
                                                <th>Postal Address</th>
                                                <th class="text-right">Email Address</th>
                                                <th class="text-right">Phone Numbers</th>
                                                <th width="100px">Action</th>
                                                <th width="100px">Delete</th>
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
                ajax: "{{ route('show_tenants') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', className: "text-right", sortable:true},
                    {data: 'tenant_name', name: 'tenant_name', className: "text-right", sortable: false},
                    {data: 'id_number', name: 'id_number', className: "text-right", sortable: false},
                    {data: 'postal_code', name: 'postal_code', className: "text-right", sortable: false},
                    {data: 'email', name: 'email', className: "text-right", sortable: false},
                    {data: 'phone_number', name: 'phone_number', sortable: false, className: "text-right"},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    {data: 'delete', name: 'delete', orderable: false, searchable: false},
                ]
            });

        });
    </script>
@endsection