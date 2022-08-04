@extends('layouts.app')

@section('content')
<? dd($name)?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">CAP PRODUCT OPTION</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">CAP PRODUCT LIST</h6>
            <button style="float: right" id="CreateNewProduct" class="edit btn btn-info btn-sm">CREATE</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="CapOptTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Description</th>
                            <th>Size/length</th>
                            <th>Color</th>
                            <th>Cap</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Description</th>
                            <th>Size/length</th>
                            <th>Color</th>
                            <th>Cap</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    </tbody>

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

                                            <label for="Description" class="col-sm-3 control-label">Description</label>

                                            <div class="col-sm-12">

                                                <input class="form-control" id="Description"
                                                    onclick="checkDescription()" name="description"
                                                    placeholder="Enter Description of cap" value="" required="">
                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label for="Length" class="col-sm-2 control-label">Length</label>

                                            <div class="col-sm-12">

                                                <input class="form-control" id="Length" name="length"
                                                    placeholder="Enter Length OR Size" value="" required="">
                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label for="Color" class="col-sm-2 control-label">Color</label>

                                            <div class="col-sm-12">

                                                <input class="form-control" id="Color" name="color"
                                                    placeholder="Enter Color of cap" value="" required="">

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label for="Cap" class="col-sm-3 control-label">Cap </label>

                                            <div class="col-sm-12">

                                                <input class="form-control" id="Cap" name="cap"
                                                    placeholder="Enter Cap about" required="">
                                            </div>

                                        </div>

                                        <div class="col-sm-offset-2 col-sm-10">

                                            <button type="submit" class="btn btn-primary" id="saveBtn"
                                                value="create">Save changes

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
                        $('#CapOptTable').DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: '/capoptinfo',
                            columns: [{
                                    data: 'id'
                                },
                                {
                                    data: 'Description'
                                },
                                {
                                    data: 'Length'
                                },
                                {
                                    data: 'Color'
                                },
                                {
                                    data: 'Cap'
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

                        $('#product_id').val('');

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

                            url: '/capoptinfostore',

                            type: "POST",

                            dataType: 'json',

                            success: function(data) {



                                $('#productForm').trigger("reset");

                                $('#ajaxModel').modal('hide');
                                $('#CapOptTable').DataTable().ajax.reload();

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
                            url: '/capoptinfodelete/' + id,
                            success: function(data) {
                                $('#CapOptTable').DataTable().ajax.reload();
                            },
                        });
                    }

                    function edit(id) {
                        $.get('/capoptinfoedit/' + id, function(data) {
                            console.log(data);
                            $('#modelHeading').html("Edit Product");
                            $('#saveBtn').val("edit-user");
                            $('#ajaxModel').modal('show');
                            $('#id').val(data.id);
                            $('#Description').val(data.Description);
                            $('#Length').val(data.Length);
                            $('#Color').val(data.Color);
                            $('#Cap').val(data.Cap);
                        });
                    }
                    </script>
                    @endsection
