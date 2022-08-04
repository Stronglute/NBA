@extends('layouts.app')

@section('content')
<? dd($name)?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Parties</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Parties LIST</h6>
            <button style="float: right" id="CreateNewProduct" class="edit btn btn-info btn-sm">CREATE</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="VendorsTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Dated</th>
                            <th>Inv</th>
                            <th>ProductDetails</th>
                            <th>Billed</th>
                            <th>STax</th>
                            <th>ITax</th>
                            <th>Payable</th>
                            <th>Total</th>
                            <th>ChqPay</th>
                            <th>Balance</th>
                            <th>PartyName</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Dated</th>
                            <th>Inv</th>
                            <th>ProductDetails</th>
                            <th>Billed</th>
                            <th>STax</th>
                            <th>ITax</th>
                            <th>Payable</th>
                            <th>Total</th>
                            <th>ChqPay</th>
                            <th>Balance</th>
                            <th>PartyName</th>
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

                                            <label for="name" class="col-sm-2 control-label">Name</label>

                                            <div class="col-sm-12">

                                                <input type="text" class="form-control" id="Name" name="name"
                                                    placeholder="Enter Name of party" value="" maxlength="50"
                                                    required="">

                                            </div>

                                        </div>


                                        <div class="form-group">

                                            <label for="Balance" class="col-sm-3 control-label">Balance</label>

                                            <div class="col-sm-12">

                                                <input type="text" class="form-control" id="Balance" name="balance"
                                                    placeholder="Enter Balance value" value="" maxlength="50"
                                                    required="">

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label for="Billed" class="col-sm-2 control-label">Billed</label>

                                            <div class="col-sm-12">

                                                <input type="text" class="form-control" id="Billed" name="billed"
                                                    placeholder="Enter Billed amount" value="" maxlength="50"
                                                    required="">

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label for="Chq" class="col-sm-2 control-label">Chq</label>

                                            <div class="col-sm-12">

                                                <input type="text" class="form-control" id="Chq" name="chq"
                                                    placeholder="Enter Chq payment" value="" maxlength="50" required="">

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label for="Received" class="col-sm-3 control-label">Received </label>

                                            <div class="col-sm-12">

                                                <input type="text" class="form-control" id="Received" name="received"
                                                    placeholder="Enter Received payement" value="" maxlength="50"
                                                    required="">

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label for="Total" class="col-sm-2 control-label">Total</label>

                                            <div class="col-sm-12">

                                                <input type="text" class="form-control" id="Total" name="total"
                                                    placeholder="Enter Total amount" value="" maxlength="50"
                                                    required="">

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label for="Net Total" class="col-sm-3 control-label">Net total</label>

                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="NetTotal" name="net_total"
                                                    placeholder="Enter Net Total amount" value="" maxlength="50"
                                                    required="">

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
                        var php_var = "<?php echo $name; ?>";
                        $('#VendorsTable').DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: '/ipartyshow/' + php_var,
                            columns: [{
                                    data: 'id'
                                },
                                {
                                    data: 'Dated'
                                },
                                {
                                    data: 'Inv'
                                },
                                {
                                    data: 'ProductDetails'
                                },
                                {
                                    data: 'Billed'
                                },
                                {
                                    data: 'STax'
                                },
                                {
                                    data: 'ITax'
                                },
                                {
                                    data: 'Payable'
                                },
                                {
                                    data: 'Total'
                                },
                                {
                                    data: 'ChqPay'
                                },
                                {
                                    data: 'Balance'
                                },
                                {
                                    data: 'PartyName'
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

                            url: '/storeparty',

                            type: "POST",

                            dataType: 'json',

                            success: function(data) {



                                $('#productForm').trigger("reset");

                                $('#ajaxModel').modal('hide');
                                $('#dataTable').DataTable().ajax.reload();

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
                            url: '/deleteparty/' + id,
                            success: function(data) {
                                $('#dataTable').DataTable().ajax.reload();
                            },
                        });
                    }

                    function edit(id) {
                        $.get('/editparty/' + id, function(data) {
                            console.log(data);
                            $('#modelHeading').html("Edit Product");
                            $('#saveBtn').val("edit-user");
                            $('#ajaxModel').modal('show');
                            $('#id').val(data.id);
                            $('#Name').val(data.Name);
                            $('#Balance').val(data.Balance);
                            $('#Billed').val(data.Billed);
                            $('#Chq').val(data.Chq);
                            $('#Received').val(data.Received);
                            $('#Total').val(data.Total);
                            $('#NetTotal').val(data.NetTotal);
                        });
                    }

                    function menu(id) {
                        $('#MenuModel').modal('show');
                    }
                    </script>
                    @endsection
