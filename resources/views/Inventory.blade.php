@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">INVENTORY</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Item With Amount LIST</h6>
            <button style="float: right" id="CreateNewProduct" class="edit btn btn-info btn-sm">CREATE</button>
        </div>

        <!-- TABLE SHOWING INFORMATION DIFFERNT CLIENT PARTY -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="InventoryTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Item</th>
                            <th>Unit(per)</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Unit</th>
                            <th>Amount</th>
                            <th>Date</th>
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

                                        <label for="Name" class="col-sm-2 control-label">Name</label>

                                        <div class="col-sm-12">

                                            <select  class="form-control" id="Name" name="name" onclick="CheckItem()"
                                                placeholder="Enter Name of Item" value="" maxlength="50" required="">
                                                @foreach ($data as $item)
                                               <option>{{$item['ItemName']}}</option>
                                                @endforeach
                                            </select>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label for="Unit" class="col-sm-2 control-label">Unit</label>

                                        <div class="col-sm-12">

                                            <select class="form-control" id="Unit" name="unit"
                                                placeholder="Enter Unit of item" value="" maxlength="50" required="">
                                                @foreach ($Item as $item)
                                               <option>{{$item['Unit']}}</option>
                                                @endforeach
                                            </select>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label for="Amount" class="col-sm-2 control-label">Amount</label>

                                        <div class="col-sm-12">

                                            <input type="text" class="form-control" id="Amount" name="amount"
                                                placeholder="Enter amoutnt of item" value="" maxlength="50" required="">

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label for="Date" class="col-sm-2 control-label">Date</label>

                                        <div class="col-sm-12">

                                            <input type="text" class="form-control" id="Date" name="date"
                                                placeholder="Enter Current Date" value="<?php echo date("Y-m-d") ?>"
                                                maxlength="50" required="">

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
                    $('#InventoryTable').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '/inventoryinfo',
                        columns: [{
                                data: 'id'
                            },
                            {
                                data: 'Item'
                            },
                            {
                                data: 'Unit'
                            },
                            {
                                data: 'Amount'
                            },
                            {
                                data: 'Date'
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

                function CheckItem() {
                        let opt = $("#Name option:selected").val();
                        $.get('/inventorygetinfo/' + opt, function(data) {
                            $("#Unit").val(data['Unit']);
                        });
                    }

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

                        url: '/inventorystore',

                        type: "POST",

                        dataType: 'json',

                        success: function(data) {



                            $('#productForm').trigger("reset");

                            $('#ajaxModel').modal('hide');
                            $('#InventoryTable').DataTable().ajax.reload();

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
                        url: '/inventorydelete/' + id,
                        success: function(data) {
                            $('#InventoryTable').DataTable().ajax.reload();
                        },
                    });
                }

                function edit(id) {
                    $.get('/inventoryedit/' + id, function(data) {
                        console.log(data);
                        $('#modelHeading').html("Edit Product");
                        $('#saveBtn').val("edit-user");
                        $('#ajaxModel').modal('show');
                        $('#id').val(data.id);
                        $('#Name').val(data.ItemName);
                        $('#Unit').val(data.Unit);
                        $('#Amount').val(data.Amount);
                        $('#Date').val(data.Date)
                    });


                }
                </script>
                @endsection
