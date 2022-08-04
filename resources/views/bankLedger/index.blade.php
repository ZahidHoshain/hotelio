@extends('layouts.app')
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header bg-defult">
                    <div class="card-title">
                        <h2 class="card-title">
                            <button type="button" class="btn bg-navy text-capitalize mr-3" data-toggle="modal" data-target="#BankLedgerModal" id="AddNewBtn">
                                <i class="fa-solid fa-circle-plus mr-2"></i>
                                Add
                            </button>
                            Add Bank Ledger
                        </h2>
                    </div>
                    <a class="btn btn-sm bg-navy float-right text-capitalize" href="bankLedger/trash"><i class="fa-solid fa-recycle mr-2"></i>View Trash</a>
                    <button class="btn btn-sm bg-maroon float-right text-capitalize mr-3" id="AllDeleteBtn" ><i class="fa-solid fa-trash-can mr-2"></i>Delete All</button>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap DataTable" id="BankLedgerList">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Bank</th>
                                <th>Deposit</th>
                                <th>Withdraw</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        </tbody>

                    </table>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
        <div class="col-md-7 m-auto">
            <div class="modal fade show" id="BankLedgerModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h3 class="card-title">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i class="fa-solid fa-circle-arrow-left fs-5" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Back to List"></i>
                                </button>
                            </h3>
                            Add Bank Ledger
                        </div>
                        <div class="modal-body">
                            {{ Form::Open(array('url' => '/bankLedger','method' => 'POST','class' => 'form-horizontal','id' => 'NewBankLedgerForm', 'files' => true)) }}
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="BankID" class="form-label col-md-3">Bank Name:</label>
                                    <div class="col-md-8">
                                        <select type="number" name="BankID" id="Banknames" class="form-select">
                                            <option value="">Open this select menu</option>
                                            @foreach($BankNames as $BankName)
                                            <option value="{{$BankName->id}}">{{$BankName->Name}}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Deposit" class="form-label col-md-3">Deposit:</label>
                                    <div class="col-md-8">
                                        <input type="number" name="Deposit" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Withdraw" class="form-label col-md-3">Withdraw:</label>
                                    <div class="col-md-8">
                                        <input type="number" name="Withdraw" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="Date" class="form-label col-md-3">Date:</label>
                                    <div class="col-md-8">
                                        <input type="date" name="Date" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Description" class="form-label col-md-3">Description:</label>
                                    <div class="col-md-8">
                                        <input type="text" name="Description" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class=" col-sm-8 offset-sm-3">
                                        <button class="btn btn-default float-left w-25" id="ResetFormBtn">Reset</button>
                                        <input type="submit" name="submit" id="SubmitBtn" class="btn bg-navy float-right  w-25 text-capitalize">
                                    </div>
                                </div>
                            </div>
                            {{Form::close()}}
                        </div>
                        <!-- <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7 m-auto">
            <div class="modal fade show" id="EditBankLedgerModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h3 class="card-title">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i class="fa-solid fa-circle-arrow-left fs-5" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Back to List"></i>
                                </button>
                            </h3>
                            Update Bank Ledger
                        </div>
                        <div class="modal-body">
                            {{ Form::Open(array('method' => 'PATCH','class' => 'form-horizontal','id' => 'EditBankLedgerForm', 'files' => true)) }}
                            <div class="card-body">
                                <input type="hidden" name="ID" id="IDEdit">
                                <div class="form-group row">
                                    <label for="BankID" class="form-label col-md-3">Bank ID:</label>
                                    <div class="col-md-8">
                                        <select type="number" name="BankID" id="EditBankID" class="form-select">
                                        <option value="">Open this select menu</option>
                                            @foreach($BankNames as $BankName)
                                            <option value="{{$BankName->id}}">{{$BankName->Name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Deposit" class="form-label col-md-3">Deposit:</label>
                                    <div class="col-md-8">
                                        <input type="number" name="Deposit" id="EditDeposit" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Withdraw" class="form-label col-md-3">Withdraw:</label>
                                    <div class="col-md-8">
                                        <input type="number" name="Withdraw" id="EditWithdrow" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="Date" class="form-label col-md-3">Date:</label>
                                    <div class="col-md-8">
                                        <input type="date" name="Date" id="EditDate" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Description" class="form-label col-md-3">Description:</label>
                                    <div class="col-md-8">
                                        <input type="text" name="Description" id="EditDescription" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class=" col-sm-8 offset-sm-3">
                                        <button type="button" name="submit" id="UpdateBtn" class="btn bg-navy float-right  w-25 text-capitalize">Update</button>
                                    </div>
                                </div>
                            </div>
                            {{Form::close()}}
                        </div>
                        <!-- <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .copy {
        /* color: $yellow-300; */
        color: white;
        background-color: #290661;
    }

    .copy:hover {
        /* color: $yellow-300; */
        color: AliceBlue;
        background-color: MidnightBlue;
    }

    .pdf {
        color: AliceBlue;
        background-color: #084298;
    }

    .pdf:hover {
        color: AliceBlue;
        background-color: #052c65;

    }
</style>
<script>
    $(document).ready(function() {
        $.noConflict();
        var BankLedgerList = $('#BankLedgerList').DataTable({
            dom: 'CBrfiltip',
            serverSide:true,
            processing:true,
            responsive:true,
            buttons: [{
                    extend: 'copy',
                    text: '<button class="btn copy"><i class="fa fa-copy"></i></button>',
                    titleAttr: 'Copy Items',
                    filename: 'account_ledger_list',

                },
                {
                    extend: 'excel',
                    text: '<button class="btn btn-success"><i class="fa-solid fa-file-excel"></i></button>',
                    titleAttr: 'Export to Excel',
                    filename: 'account_ledger_list',
                },
                {
                    extend: 'pdf',
                    text: '<button class="btn pdf"><i class="fa-solid fa-file-pdf"></i></button>',
                    titleAttr: 'Export to PDF',
                    filename: 'account_ledger_list',
                },
                {
                    extend: 'csv',
                    text: '<button class="btn btn-info"><i class="fa-solid fa-file-csv"></i></button>',
                    titleAttr: 'Export to CSV',
                    filename: 'account_ledger_list',
                },
            ],
            ajax:{
                url:'/bankLedger',
                type:'GET',
            },
            columns:[
                {data:'id',visible:false},
                {data:'Bank'},
                {data:'Deposit'},
                {data:'Withdraw'},
                {data:'Date'},
                {data:'Description'},
                {data:'action',name:'action'}
            ],
        });
        $('#AddBtn').on('click', function(e) {
            e.preventDefault();
            $('#BankLedgerModal').modal('show');
        });

        $('#ResetFormBtn').on('click', function(e) {
            e.preventDefault();

            $('#NewBankLedgerForm')[0].reset();
        });

        $('#SubmitBtn').on('click', function(e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "/bankLedger",
                data: $('#NewBankLedgerForm').serializeArray(),
                success: function(data) {
                    BankLedgerList.draw(false);
                    $('#NewBankLedgerForm')[0].reset();
                    $('#BankLedgerModal').modal('hide');
                    Swal.fire(
                        'Success',
                        'Bank Ledger Successfully',
                        'success'
                    );
                },
                error: function(data) {
                    colsole.log('Error While Adding New' + data);
                }
            });
        });
        $('body').on('click','#EditBtn',function(e){
            e.preventDefault();
            var ID = $(this).data('id');
            // console.log(ID);
            $.ajax({
                type:'GET',
                url:'/bankLedger/'+ID,
                data:$('#EditBankLedgerForm').serializeArray(),
                success:function(data){
                    $('#EditBankLedgerForm')[0].reset();
                    $('#IDEdit').val(data['id']);
                    $('#EditBankID').val(data['BankID']);
                    $('#EditDeposit').val(data['Deposit']);
                    $('#EditWithdrow').val(data['Withdraw']);
                    $('#EditDate').val(data['Date']);
                    $('#EditDescription').val(data['Description']);
                    $('#EditBankLedgerModal').modal('show');
                },
                error:function(data){
                    console.log(data);
                }
            });
        });
        $('#UpdateBtn').on('click',function(e){
            e.preventDefault();
            var ID = $('#IDEdit').val();
            $.ajax({
                type:'PATCH',
                url: '/bankLedger/'+ID,
                data: $('#EditBankLedgerForm').serializeArray(),
                success:function(data){
                    BankLedgerList.draw(false);
                    $('#EditBankLedgerModal').modal('hide');
                    $('#EditBankLedgerForm')[0].reset();
                    Swal.fire(
                        'success',
                        'Account Ledger updated', 'successfully',
                        'success'
                    );
                },
                error:function(data){
                    console.log(data);
                }
            });
        });
        $('body').on('click','#DeleteBtn', function(e){
            e.preventDefault();
            var ID = $(this).data('id');
            // console.log(ID);
            Swal.fire({
                icon: 'warning',
                title: 'Are you sure ?',
                text: 'You wont be able to revert this!',
                showCancelButton : true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor : '#d33',
                confirmButtonText : 'Yes , delete it !',
                footer: '<a href="">Why do I have this issue?</a>',
                footer: '<a href="">Why do I have this issue?</a>'
            }).then((result) =>{
                if(result.isConfirmed){
                    $.ajax({
                        type:'GET',
                        url:'/bankLedger/delete/'+ID,
                        success:function(data){
                            BankLedgerList.draw(false);
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                                );
                        },
                        error:function(data){
                            Swal.fire(
                                'Error!',
                                'Delete failed !',
                                'error'
                                );
                                console.log(data);  
                        }
                    });
                }
            });
        });
        $('#AllDeleteBtn').on('click', function(e) {
             e.preventDefault();

            Swal.fire({
                icon: 'warning',
                title: 'Are you sure ?',
                text: 'You wont be able to revert this!',
                footer: '<a href="">Why do I have this issue?</a>'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'GET',
                        url: '/bankLedger/delete/',
                        success: function(data) {
                            BankLedgerList.draw(false);
                            Swal.fire(
                                'All Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                        },
                        error: function(data) {
                            Swal.fire(
                                'Error!',
                                'Delete failed !',
                                'error'
                            );

                            console.log(data);
                        },
                    });
                }
            });
        });
    });
</script>
@endsection