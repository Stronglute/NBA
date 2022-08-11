@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Vendors</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Vendors LIST</h6>
            <button style="float: right" id="CreateNewProduct" class="edit btn btn-info btn-sm">CREATE</button>
        </div>

        <!-- TABLE SHOWING INFORMATION DIFFERNT CLIENT PARTY -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="VendorMainTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>CNIC</th>
                            <th>Email</th>
                            <th>NTN</th>
                            <th>Contract Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>CNIC</th>
                            <th>Email</th>
                            <th>NTN</th>
                            <th>Contract Image</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    </tbody>
                </table>

                <!-- MODEL FOR CREATING NEW RECORD OR EDITING THE EXISTED ONE -->
                <div class="modal fade" id="ajaxModel" aria-hidden="true">

                    <div class="modal-dialog">

                        <div class="modal-content">

                            <div class="modal-header">

                                <h4 class="modal-title" id="modelHeading"></h4>

                            </div>

                            <div class="modal-body">

                                <form id="VendorForm" name="vendorForm" class="form-horizontal"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" id="id" />

                                    <div class="form-group">

                                        <label for="Name" class="col-sm-2 control-label">Name</label>

                                        <div class="col-sm-12">

                                            <input type="text" class="form-control" id="Name" name="name"
                                                placeholder="Enter Name of party" value="" maxlength="50" required />

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label for="Address" class="col-sm-3 control-label">Address</label>

                                        <div class="col-sm-12">

                                            <input type="text" class="form-control" id="Address" name="address"
                                                placeholder="Enter Address" value="" maxlength="50" required="">

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label for="Contact" class="col-sm-3 control-label">Contact</label>

                                        <div class="col-sm-12">

                                            <input type="text" class="form-control" id="Contact" name="contact"
                                                placeholder="Enter Contact" value="" maxlength="50" required="">

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label for="CNIC" class="col-sm-3 control-label">CNIC</label>

                                        <div class="col-sm-12">

                                            <input type="text" class="form-control" id="CNIC" name="cnic"
                                                placeholder="Enter CNIC" value="" maxlength="50" required="">

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label for="Email" class="col-sm-3 control-label">Email</label>

                                        <div class="col-sm-12">

                                            <input type="text" class="form-control" id="Email" name="email"
                                                placeholder="Enter Email" value="" maxlength="50">

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label for="NTN" class="col-sm-3 control-label">NTN</label>

                                        <div class="col-sm-12">

                                            <input type="text" class="form-control" id="NTN" name="ntn"
                                                placeholder="Enter NTN" value="" maxlength="50">

                                        </div>

                                    </div>


                                    <div class="form-group">

                                        <label for="Contract" class="col-sm-3 control-label">Contract</label>

                                        <div class="col-sm-12">

                                            <input data-preview="#preview" type="file" class="form-control"
                                                id="Contract" name="contract">

                                        </div>

                                    </div>

                                    <div class="col-sm-offset-2 col-sm-10">

                                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save
                                            changes

                                        </button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>




                @endsection


                @section('script')
                <script>
                $(document).ready(function() {
                    $('#VendorMainTable').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '/vendormaininfo',
                        columns: [{
                                data: 'id'
                            },
                            {
                                data: 'VendorName'
                            },
                            {
                                data: 'Address'
                            },
                            {
                                data: 'Contact'
                            },
                            {
                                data: 'CNIC'
                            },
                            {
                                data: 'Email'
                            },
                            {
                                data: 'NTN'
                            },
                            {
                                data: 'contractimage',
                                name: 'contractimage',
                                orderable: false,
                                searchable: false
                            },
                            {
                                data: 'action',
                                name: 'action',
                                orderable: false,
                                searchable: false
                            },
                        ],
                    });
                });

                $('#CreateNewProduct').click(function() {

                    $('#saveBtn').val("create-product");

                    $('#id').val('');

                    $('#vendorForm').trigger("reset");

                    $('#modelHeading').html("Create New Product");

                    $('#ajaxModel').modal('show');

                });

                $('#saveBtn').click(function(e) {
                    $('#VendorForm').validate();
                    if (!$('#VendorForm').valid()) {
                        return false;
                    }
                    e.preventDefault();
                    $(this).html('Sending..');
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: new FormData($('#VendorForm')[0]),

                        url: '/vendormainstore',

                        type: "POST",

                        dataType: 'json',
                        contentType: false,
                        cache: false,
                        processData: false,

                        success: function(data) {

                            $('#VendorForm').trigger("reset");

                            $('#ajaxModel').modal('hide');
                            $('#VendorMainTable').DataTable().ajax.reload();

                        },

                        error: function(data) {

                            console.log('Error:', data);

                            $('#saveBtn').html('Save Changes');

                        }

                    });

                });

                function remove(id) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "DELETE",
                        url: '/vendormaindelete/' + id,
                        success: function(data) {
                            $('#VendorMainTable').DataTable().ajax.reload();
                        },
                    });
                }

                function edit(id) {
                    $.get('/vendormainedit/' + id, function(data) {
                        $('#modelHeading').html("Edit Product");
                        $('#saveBtn').val("edit-user");
                        $('#ajaxModel').modal('show');
                        $('#id').val(data.id);
                        $('#Name').val(data.VendorName);
                        $('#Address').val(data.Address);
                        $('#Contact').val(data.Contact);
                        $('#CNIC').val(data.CNIC);
                        $('#Email').val(data.Email);
                        $('#NTN').val(data.NTN);
                        $('#Contract').val(data.Contract);
                    });
                }
                </script>
                @endsection
