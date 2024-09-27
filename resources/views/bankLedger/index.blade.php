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
                    <button class="btn btn-sm bg-maroon float-right text-capitalize mr-3" id="AllDeleteBtn"><i class="fa-solid fa-trash-can mr-2"></i>Delete All</button>
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
        <div class="modal fade show" id="ShowBankLedgerModal" role="dialog">
            <div class="modal-dialog modal-xl ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">Show All Information on this Hotel</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="formClose">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-resonsive table-bordered table-stripped table-condensed ">
                            <tr>
                                <th class="bg-success " style="font-size: 25px;">Attribute</th>
                                <th class="bg-success " style="font-size: 25px;">Data</th>
                            </tr>
                            <tr>
                                <td>Bank : </td>
                                <td id="ViewBank"></td>
                            </tr>
                            <tr>
                                <td>Deposit :</td>
                                <td id="ViewDeposit"></td>
                            </tr>
                            <tr>
                                <td>Withdraw :</td>
                                <td id="ViewWithdraw"></td>
                            </tr>
                            <tr>
                                <td>Description :</td>
                                <td id="ViewDescription"></td>
                            </tr>
                        </table>
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
<script src="{{ asset('js/custom-js/bankLedger.js') }}"></script>
@endsection