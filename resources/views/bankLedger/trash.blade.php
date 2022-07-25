@extends('layouts.app')
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            @if (Session::get('Restore'))
            <div class="alert alert-teal bg-teal alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h5><i class="fa-solid fa-arrow-rotate-left"></i>Restore!</h5>
                {{Session::get('Restore')}}
            </div>
            @endif
            @if (Session::get('Parmanent_Delete'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h5> <i class="icon fas fa-ban"></i>
                    Parmanent Delete!
                </h5>
                {{Session::get('Parmanent_Delete')}}
            </div>
            @endif
            <div class="card">

                <div class="card-header bg-defult">
                    <div class="card-title">
                        <h2 class="card-title">
                            <a href="{{ asset('bankLedger') }}" class="btn bg-navy text-capitalize mr-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Trash to Back">
                                <i class="fa-solid fa-circle-arrow-left"></i>
                                Back
                            </a>
                            Bank Ledger Trash List
                        </h2>
                    </div>
                    <button class="btn btn-sm bg-maroon float-right text-capitalize" id="EmtyTrash"><i class="fa-solid fa-trash-can mr-2"></i>Empty Trash</button>
                    <button class="btn btn-sm bg-teal float-right text-capitalize mr-3" id="RestoreBtnAll"><i class="fa-solid fa-trash-arrow-up mr-2"></i>Restore All</button>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Bank</th>
                                <th>Depositt</th>
                                <th>Withdraw</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($BankLedgers as $TrashBankLedger)
                            <tr>
                                <td>{{$TrashBankLedger->Bank}}</td>
                                <td>{{$TrashBankLedger->Deposit}}</td>
                                <td>{{$TrashBankLedger->Withdraw}}</td>
                                <td>{{$TrashBankLedger->Date}}</td>
                                <td>{{$TrashBankLedger->Description}}</td>
                                <td class="d-flex">
                                    <!-- <a href="/bankLedger/{{$TrashBankLedger->id}}" class="mr-3 text-purple" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View">
                                        <svg data-v-9a6e255c="" xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="invoice-row-5036-preview-icon" class="mx-1 feather feather-eye">
                                            <path data-v-9a6e255c="" d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle data-v-9a6e255c="" cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </a> -->
                                    <button value="{{$TrashBankLedger->id}}" class="mx-2 DeleteBtn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete">

                                        <i class="fa-regular fa-trash-can mr-3 text-black"></i>
                                    </button>
                                    <button value="{{$TrashBankLedger->id}}" title="Restore" class="RestoreBtn" >

                                        <i class="fa-solid fa-arrow-rotate-left"></i>

                                    </button>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $('.RestoreBtn').on('click',function(e){
        e.preventDefault();
        let ID = $(this).val();
        // console.log(ID);

        Swal.fire({

            title: 'Are you sure?',
            text: "Do you want to restore it!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, restore it!'

        }).then((result) => {
            if(result.isConfirmed){
                $.ajax({
                    type:'GET',
                    url:'/bankLedger/'+ID+'/restore/',
                    success:function(data){
                        Swal.fire(
                            'Resoted!',
                            'Your file has been restored.',
                            'success'
                        );
                    },
                    error:function(data){
                        Swal.fire(
                            'Error!',
                            'Resoted failed !',
                            'error'
                        );
                        console.log(data);
                    }, 
                });
            }
        });
    });
    $('.DeleteBtn').on('click',function(e)
    {
        e.preventDefault();
        let ID = $(this).val();

        Swal.fire({

            title: 'Are you sure?',
            text: "Do you want to All Delete it!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'

        }).then((result)=> {
            if (result.isConfirmed) {
                $.ajax({
                    tepe:'GET',
                    url:'/bankLedger/'+ID+'/delete/parmanently/',
                    success:function(data){
                        Swal.fire(
                            'Force Delete!',
                            'Your file has been Delete.',
                            'success'
                        );
                    },
                    error:function(data){
                        Swal.fire(
                            'Error!',
                            'Resoted failed !',
                            'error'
                        );
                        console.log(data);
                    }, 
                });
            }
        });
    });
    $('#RestoreBtnAll').on('click',function(e){
        e.preventDefault();
        // console.log('hello');
        // let ID = $(this).val();
        Swal.fire({

            title: 'Are you sure?',
            text: "Do you want to restore it!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, restore it!'

        }).then((result) => {
            if(result.isConfirmed){
                $.ajax({
                    type:'GET',
                    url:'/bankLedger/restoreall/',
                    success:function(data){
                        Swal.fire(
                            'Resoted!',
                            'Your file has been restored.',
                            'success'
                        );
                    },
                    error:function(data){
                        Swal.fire(
                            'Error!',
                            'Resoted failed !',
                            'error'
                        );
                        console.log(data);
                    }, 
                });
            }
        });
    });
    $('#EmtyTrash').on('click',function(e){
        e.preventDefault();
        // console.log('hello');
        // let ID = $(this).val();
        Swal.fire({

            title: 'Are you sure?',
            text: "Do you want to All Delete it!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, restore it!'

        }).then((result) => {
            if(result.isConfirmed){
                $.ajax({
                    type:'GET',
                    url:'/bankLedger/emptytrash/',
                    success:function(data){
                        Swal.fire(
                            'EmtyTrash!',
                            'Your file has been All Delete.',
                            'success'
                        );
                    },
                    error:function(data){
                        Swal.fire(
                            'Error!',
                            'Resoted failed !',
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