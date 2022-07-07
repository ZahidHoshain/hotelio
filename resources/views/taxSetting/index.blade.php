@extends('layouts.app')
@section('content')
   
    <div class="container py-5">
        {{-- <section class="button mb-4">
            <a href="{{ asset('taxSetting/create') }}" class="btn btn-info text-capitalize">Add TaxSetting</a>
        </section> --}}
        <div class="row">
            <div class="col-md-9 m-auto">
                @if (Session::get('Destroy'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icone fas fa-exclamation-triangle"></i> Deleted !</h5>
                        {{Session::get('Destroy')}}
                    </div>
                @endif
                @if (Session::get('DestroyAll'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icone fas fa-exclamation-triangle"></i> Deleted !</h5>
                        {{Session::get('DestroyAll')}}
                    </div>
                @endif
                
                <div class="card">
                    <div class="card-header bg-defult">
                        <div class="card-title">
                            <h2 class="card-title">
                                <button type="button" class="btn bg-navy text-capitalize mr-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Create TaxSetting"data-toggle="modal" data-target="#NewTaxModal"> 
                                    <i class="fa-solid fa-circle-plus mr-2"></i>
                                    Add
                                </button>
                                TaxSetting List
                            </h2>
                        </div>
                        <a class="btn btn-sm bg-navy float-right text-capitalize" href="/taxSetting/trash"><i class="fa-solid fa-recycle mr-2"></i>View Trash</a>
                        <a class="btn btn-sm bg-maroon float-right text-capitalize mr-3" href="/taxSetting/delete"><i class="fa-solid fa-trash-can mr-2"></i>Delete All</a>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Parcent</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @foreach ($TaxSettings as $TaxSetting)
                                    <tr>
                                        <td>{{ $TaxSetting->Name }}</td>
                                        <td>{{ $TaxSetting->Parcent }}</td>
                                        <td>
                                            @if($TaxSetting->Status)
                                            <b class="text-success fs-6">Active</b>      
                                            @else <b class="text-danger fs-6">Deactive</b> @endif
                                        </td>
                                        <td class="d-flex">
                                            <button class="EditBtn" value="{{ $TaxSetting->id }}" title="Edit" ><i class="fa-regular fa-pen-to-square mr-3 text-orange"></i></i>
                                            </button>

                                            <button class="DeleteBtn" value="{{ $TaxSetting->id }}" title="Delete">
                                                <i class="fa-regular fa-trash-can mr-3 text-danger"></i>
                                            </button>
                                            
                                            <!-- {{ Form::open(array('url' => '/taxSetting/'.$TaxSetting->id,'method' => 'DELETE')) }}
                                                <button class="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete">
                                                    <i class="fa-regular fa-trash-can mr-3 text-danger"></i>
                                                </button>
                                            {{ Form::close() }}  -->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade show" id="NewTaxModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add A New  TaxSetting</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ Form::open(array('url' => '/taxSetting', 'method' => 'post','class' => 'form-horizantal','id' => 'NewTaxForm', 'files' => true)) }}
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="Name" class="form-label col-md-3">Name:</label>
                                    <div class="col-md-8">
                                        <input type="text" name="Name" class="form-control"> 
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Parcent" class="form-label col-md-3">Parcent:</label>
                                    <div class="col-md-8">
                                        <input type="number" name="Parcent" class="form-control"> 
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Status" class="form-label col-md-3">Status:</label>
                                    <div class="col-md-8">
                                        <div class="form-check form-check-inline ml-1">
                                            <input type="radio" class="form-check-input" name="Status" value="1">
                                            <label for="" class="form-check-label">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline ml-4">
                                            <input type="radio" class="form-check-input" name="Status" value="0">
                                            <label for="" class="form-check-label">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default text-capitalize" id="ResetBtnForm">Reset</button>
                                <button type="button" name="submit" type="submit" class="btn bg-navy text-capitalize" id="SubmitBtn">submit</button>
                            </div>
                    {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade  show" id="EditTaxModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">TaxSetting Update</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ Form::open(array('method' => 'PATCH','class' => 'form-horizantal','id'=>'EditTaxForm', 'files' => true)) }}
                            <input type="hidden" name="ID" id="IDEdit">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="Name" class="form-label col-md-3">Name:</label>
                                    <div class="col-md-8">
                                        <input type="text" id="NameEdit" name="Name" class="form-control"> 
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Parcent" class="form-label col-md-3">Parcent:</label>
                                    <div class="col-md-8">
                                        <input type="number" id="ParcentEdit" name="Parcent" class="form-control"> 
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Status" class="form-label col-md-3">Status:</label>
                                    <div class="col-md-8">
                                        <select name="Status" id="StatusEdit" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" name="submit" type="submit" class="btn bg-navy text-capitalize" id="UpdateBtn">Update</button>
                            </div>
                    {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#ResetBtnForm').on('click',function(e){
                e.preventDefault();
                $('#NewTaxForm')[0].reset();
            });
            $('#SubmitBtn').on('click',function(e){
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "/taxSetting",
                    data: $('#NewTaxForm').serializeArray(),
                    success: function (data) {
                        $('#NewTaxForm')[0].reset();
                        $('#NewTaxModal').modal('hide');
                        Swal.fire(
                            'Success !',
                            data,
                            'success'
                         )
                            
                    },
                    erorr:function(data){
                        console.log('Error while adding new RoomTransfer' + data);

                    }
                });
            });

            $('.DeleteBtn').on('click',function(e){
                e.preventDefault();
                var ID = $(this).val();

                Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                  if (result.isConfirmed) {
                    $.ajax({
                        type:'GET',
                        url:'/taxSetting/delete/'+ID,
                        success:function(data){
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
                        },
                    });

                    
                  }
                });
            });

            $('.EditBtn').on('click',function(e){
                e.preventDefault();
                var ID = $(this).val();

                $.ajax({
                    type:'GET',
                    url:'/taxSetting/'+ID,
                    success:function(data){
                        $('#EditTaxForm')[0].reset();
                        $('#IDEdit').val(data['id']);
                        $('#NameEdit').val(data['Name']);
                        $('#ParcentEdit').val(data['Parcent']);
                        $('#StatusEdit').val(data['Status']);
                        $('#EditTaxModal').modal('show');
                    },
                    error:function(data){
                        console.log(data);
                    },
                });
            });

            $('#UpdateBtn').on('click',function(e){
                e.preventDefault();
                var ID = $('#IDEdit').val();
                $.ajax({
                    type:'PATCH',
                    url:'/taxSetting/'+ID,
                    data:$('#EditTaxForm').serializeArray(),
                    success:function(data){
                        $('#EditTaxModal').modal('hide');
                        $('#EditTaxForm')[0].reset();
                        Swal.fire(
                            'success',
                            'Tax updated successfully',
                            'success'
                        );
                    },
                    error:function(data){
                        console.log(data);
                    },
                });
            });
        });
    </script>
@endsection