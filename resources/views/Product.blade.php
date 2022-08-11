@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Product</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Product LIST</h6>
            <button style="float: right" id="CreateNewProduct" class="edit btn btn-info btn-sm">CREATE PRODUCT</button>
            <a href="/catgorypage" style="float: right" id="CreateNewProduct" class="edit btn btn-info btn-sm">View Catgory</a>
        </div>

        <!-- TABLE SHOWING INFORMATION DIFFERNT CLIENT PARTY -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="ProductTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Unit(per)</th>
                            <th>Description</th>
                            <th>Catgory</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Unit</th>
                            <th>Description</th>
                            <th>Catgory</th>
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

                                <form id="productForm" name="productForm" class="form-horizontal">
                                    @csrf
                                    <input type="hidden" name="id" id="id">

                                    <div class="form-group">

                                        <label for="name" class="col-sm-2 control-label">Name</label>

                                        <div class="col-sm-12">

                                            <input type="text" class="form-control" id="Name" name="name"
                                                placeholder="Enter Name of product" value="" maxlength="50" required="">

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label for="Unit" class="col-sm-2 control-label">Unit</label>

                                        <div class="col-sm-12">

                                            <input type="text" class="form-control" id="Unit" name="unit"
                                                placeholder="Enter Unit" value="" maxlength="50" required="">

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label for="Description" class="col-sm-4 control-label">Descripton</label>

                                        <div class="col-sm-12">

                                            <textarea type="text" class="form-control" id="Description" name="description"
                                                placeholder="Enter Description" value=""  ></textarea>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label for="Catgory" class="col-sm-2 control-label">Catgory</label>

                                        <div class="col-sm-12">

                                            <select class="form-control" id="Catgory" name="Catgory"
                                                placeholder="Enter Catgory" value=""  >
                                                @foreach ($catgory as $catgory)
                                                    <option>{{$catgory['Name']}}</option>
                                                @endforeach
                                            </select>

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
                    $('#ProductTable').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '/productinfo',
                        columns: [{
                                data: 'id'
                            },
                            {
                                data: 'Name'
                            },
                            {
                                data: 'Unit'
                            },
                            {
                                data: 'Description'
                            },
                            {
                                data: 'Catgory'
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

                    $('#productForm').trigger("reset");

                    $('#modelHeading').html("Create New Product");

                    $('#ajaxModel').modal('show');

                });

                $('#saveBtn').click(function(e) {
                    if (!$("#productForm").valid()) return false;
                    e.preventDefault();
                    $(this).html('Sending..');
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: $('#productForm').serialize(),

                        url: '/productstore',

                        type: "POST",

                        dataType: 'json',

                        success: function(data) {



                            $('#productForm').trigger("reset");

                            $('#ajaxModel').modal('hide');
                            $('#ProductTable').DataTable().ajax.reload();

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
                        url: '/productdelete/' + id,
                        success: function(data) {
                            $('#ProductTable').DataTable().ajax.reload();
                        },
                    });
                }

                function edit(id) {
                    $.get('/productedit/' + id, function(data) {
                        console.log(data);
                        $('#modelHeading').html("Edit Product");
                        $('#saveBtn').val("edit-user");
                        $('#ajaxModel').modal('show');
                        $('#id').val(data.id);
                        $('#Name').val(data.Name);
                        $('#Unit').val(data.Unit);
                        $('#Description').val(data.Description);
                        $('#Catgory').val(data.Catgory)
                    });
                }
                </script>
                @endsection
