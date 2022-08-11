@extends('layouts.app')

@section('content')
<? dd($name)?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">CAP PRODUCTION</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">CAP PRODUCTION TABLE</h6>
            <a href="/capoptpage" style="float: right"  class="edit btn btn-info btn-sm">View Option</a>
            <button style="float: right" id="CreateNewProduct" class="edit btn btn-info btn-sm">CREATE</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="CapProductionTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Size/length</th>
                            <th>Color</th>
                            <th>Cap</th>
                            <th>Production</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Size/length</th>
                            <th>Color</th>
                            <th>Cap</th>
                            <th>Production</th>
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

                                            <label for="Date" class="col-sm-2 control-label">Date</label>

                                            <div class="col-sm-12">

                                                <input type="date" class="form-control" id="Date" name="date"
                                                    placeholder="Enter date of production" maxlength="50"
                                                    value="<?php echo date("Y-m-d") ?>" required="">

                                            </div>

                                        </div>


                                        <div class="form-group">

                                            <label for="Description" class="col-sm-3 control-label">Description</label>

                                            <div class="col-sm-12">

                                                <select class="form-control" id="Description"
                                                    onclick="checkDescription()" name="description"
                                                    placeholder="Enter Description of cap" value="" required="">
                                                 @foreach ($description as $item)
                                                 <option>{{$item['Description']}}</option>
                                                 @endforeach

                                                </select>
                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label for="Length" class="col-sm-2 control-label">Length</label>

                                            <div class="col-sm-12">

                                                <select class="form-control" id="Length" name="length"
                                                    onclick="checkLength()" placeholder="Enter Length OR Size" value=""
                                                    required="">
                                                    @foreach ($length as $item)
                                                 <option>{{$item['Length']}}</option>
                                                 @endforeach
                                                </select>

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label for="Color" class="col-sm-2 control-label">Color</label>

                                            <div class="col-sm-12">

                                                <select class="form-control" id="Color" name="color"
                                                    onclick="checkColor()" placeholder="Enter Color of cap" value=""
                                                    required="">
                                                    @foreach ($color as $item)
                                                 <option>{{$item['Color']}}</option>
                                                 @endforeach
                                                </select>

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label for="Cap" class="col-sm-3 control-label">Cap </label>

                                            <div class="col-sm-12">

                                                <select class="form-control" id="Cap" name="cap"
                                                    placeholder="Enter Cap about" required="">
                                                    @foreach ($cap as $item)
                                                 <option>{{$item['Cap']}}</option>
                                                 @endforeach
                                                </select>
                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label for="Production" class="col-sm-4 control-label">Production</label>

                                            <div class="col-sm-12">

                                                <input type="text" class="form-control" id="Production"
                                                    name="production" placeholder="Enter Production amount" value=""
                                                    maxlength="50" required="">

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
                        $('#CapProductionTable').DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: '/capinfo',
                            columns: [{
                                    data: 'id'
                                },
                                {
                                    data: 'Date'
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
                                    data: 'Production'
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

                            url: '/capinfostore',

                            type: "POST",

                            dataType: 'json',

                            success: function(data) {



                                $('#productForm').trigger("reset");

                                $('#ajaxModel').modal('hide');
                                $('#CapProductionTable').DataTable().ajax.reload();

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
                            url: '/capinfodelete/' + id,
                            success: function(data) {
                                $('#CapProductionTable').DataTable().ajax.reload();
                            },
                        });
                    }

                    function edit(id) {
                        $.get('/capinfoedit/' + id, function(data) {
                            console.log(data);
                            $('#modelHeading').html("Edit Product");
                            $('#saveBtn').val("edit-user");
                            $('#ajaxModel').modal('show');
                            $('#id').val(data.id);
                            $('#Date').val(data.Date);
                            $('#Description').val(data.Description);
                            $('#Length').val(data.Length);
                            $('#Color').val(data.Color);
                            $('#Cap').val(data.Cap);
                            $('#Production').val(data.Production);
                        });
                    }



                    function checkDescription(e) {
                        let opt = $("#Description option:selected").val();
                        $.get('/capopt/' + opt, function(data) {
                            console.log(data);
                            $("#Cap").val(data['Cap']);
                            $("#Color").val(data['Color']);
                            $("#Length").val(data['Length']);
                        });

                    }
                    </script>
                    @endsection
