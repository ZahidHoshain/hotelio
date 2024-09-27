@extends('layouts.app')
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                @if (Session::get('Delete'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    <h5><i class="fa-solid fa-xmark text-light fs-3 mx-1"></i> Delete!</h5>
                    {{Session::get('Delete')}}
                </div>
                @endif
                @if (Session::get('DeleteAll'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    <h5><i class="fa-solid fa-xmark text-light fs-3 mx-1"></i> All Delete!</h5>
                    {{Session::get('DeleteAll')}}
                </div>
                @endif
            </div>
            <div class="card">
                <div class="card-header bg-defult">
                    <div class="card-title">
                        <h2 class="card-title">
                            <button type="button" class="btn bg-navy text-capitalize mr-3" id="AddNewBtn">
                                <i class="fa-solid fa-circle-plus mr-2"></i>
                                Add
                            </button>
                            AccountLedger List
                        </h2>
                    </div>
                    <a class="btn btn-sm bg-navy float-right text-capitalize" href="/acount/ledger/trash"><i class="fa-solid fa-recycle mr-2"></i>View Trash</a>
                    <button id="AllDeleteBtn" class="btn btn-sm bg-maroon float-right text-capitalize mr-3"><i class="fa-solid fa-trash-can mr-2"></i>Delete All</button>
                </div>
                <div class="card-body col-md-12 p-0">
                    <table class="table table-hover text-nowrap table-responsive table-borderless  DataTable" id="accountLedgerList">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Date</th>
                                <th>Method</th>
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
        <!-- style="padding-right: 17px; display: block;" aria-modal="true" -->
        <div class="col-md-7 m-auto">
            <div class="modal fade show" id="AccountLedgerModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h3 class="card-title">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i class="fa-solid fa-circle-arrow-left fs-5" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Back to List"></i>
                                </button>
                            </h3>
                            Add Account Ledger
                        </div>
                        <div class="modal-body">
                            {{ Form::Open(array('url' => '/acount/ledger','method' => 'POST','class' => 'form-horizontal','id' => 'NewAccountLedgerForm', 'files' => true)) }}
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="Debit" class="form-label col-md-3">Debit:</label>
                                    <div class="col-md-8">
                                        <input type="number" name="Debit" class="form-control" placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Credit" class="form-label col-md-3">Credit:</label>
                                    <div class="col-md-8">
                                        <input type="number" name="Credit" class="form-control" placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Date" class="form-label col-md-3">Date:</label>
                                    <div class="col-md-8">
                                        <input type="date" class="form-control" id="Method" name="Date" placeholder="" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="Method" class="form-label col-md-3">Method:</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="Method" name="Method" placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Description" class="form-label col-md-3">Description:</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="Description" name="Description" placeholder="">
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
        <!-- Update Modal -->

        <div class="col-md-7 m-auto">
            <div class="modal fade show" id="EditAccountLedgerModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h3 class="card-title">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i class="fa-solid fa-circle-arrow-left fs-5" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Back to List"></i>
                                </button>
                            </h3>
                            Edit Account Ledger
                        </div>
                        <div class="modal-body">
                            {{ Form::Open(array('method' => 'PATCH','class' => 'form-horizontal','id' => 'EditForm', 'files' => true)) }}
                            <input type="hidden" name="ID" id="IDEdit">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="Debit" class="form-label col-md-3">Debit:</label>
                                    <div class="col-md-8">
                                        <input type="number" name="Debit" id="DebitEdit" class="form-control" placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Credit" class="form-label col-md-3">Credit:</label>
                                    <div class="col-md-8">
                                        <input type="number" name="Credit" id="CreditEdit" class="form-control" placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Date" class="form-label col-md-3">Date:</label>
                                    <div class="col-md-8">
                                        <input type="date" class="form-control" id="DateEdit" name="Date" placeholder="" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="Method" class="form-label col-md-3">Method:</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="MethodEdit" name="Method" placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Description" class="form-label col-md-3">Description:</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="DescriptionEdit" name="Description" placeholder="">
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
        color: white;
        background-color: #084298;
    }

    .pdf:hover {
        color: AliceBlue;
        background-color: #052c65;

    }
</style>
<script src="{{ asset('js/custom-js/accountLedger.js') }}"></script>

@endsection