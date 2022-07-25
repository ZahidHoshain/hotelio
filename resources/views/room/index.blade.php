@extends('layouts.app')
@section('content')
<div class="container-fluid py-5 ">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-defult">
                    <div class="card-title">
                        <h2 class="card-title">
                            <button type="button" class="btn bg-navy text-capitalize mr-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Create Room" data-toggle="modal" data-target="#NewRoomModal"> 
                                <i class="fa-solid fa-circle-plus mr-2"></i>
                                Add
                            </button> 
                            Room List
                        </h2>
                    </div>
                    <a class="btn btn-sm bg-navy float-right text-capitalize" href="/room/trash"><i class="fa-solid fa-recycle mr-2"></i>View Trash</a>
                    
                    <button class="btn btn-sm bg-maroon float-right text-capitalize mr-3" id="DeleteAllBtn">
                        <i class="fa-solid fa-trash-can mr-2"></i>
                        Delete All
                    </button>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table  table-responsive table-borderless "id="RoomList">
                        <thead>

                            <tr class="border-bottom">
                                <th>ID</th>
                                <th>Hotel</th>
                                <th>RoomNo</th>
                                <th>Floor</th>
                                <th>Type</th>
                                <th>Geyser</th>
                                <th>Ac</th>
                                <th>Balcony</th>
                                {{-- <th>Bathtub</th> --}}
                                <th>Internet</th>
                                <th>Tv</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>

                        </thead>
                        {{-- <tbody>
                            @foreach ($Rooms as $Room)
                                <tr class="border-bottom">
                                    <td>{{$Room->HotelName}}</td>
                                    <td>{{$Room->RoomNo}}</td>
                                    <td>{{$Room->Floor}}</td>
                                    <td>{{$Room->Type}}</td>
                                    <td>@if($Room->Geyser)<i class="fa-solid fa-square-check text-green ml-4"></i> @else <i class="fa-solid fa-square-xmark text-danger ml-4"></i> @endif</td>
                                    <td>@if($Room->Ac)<i class="fa-solid fa-square-check text-green ml-1"></i> @else <i class="fa-solid fa-square-xmark text-danger ml-1"></i> @endif</td>
                                    <td>@if($Room->Balcony)<i class="fa-solid fa-square-check text-green ml-4"></i> @else <i class="fa-solid fa-square-xmark text-danger ml-4"></i> @endif</td>
                                    <td>@if($Room->Internet)<i class="fa-solid fa-square-check text-green ml-4"></i> @else <i class="fa-solid fa-square-xmark text-danger ml-4"></i> @endif</td> --}}
                                    {{-- <td>@if($Room->Tv)<i class="fa-solid fa-square-check text-green ml-1"></i> @else <i class="fa-solid fa-square-xmark text-danger ml-1"></i> @endif</td> --}}
                                    {{-- <td>{{$Room->Price}}</td>
                                    <td class="d-flex">
                                        <a href="{{ URL::to('/room/'.$Room->id) }}" class="mr-3 text-purple" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View">
                                            <svg data-v-9a6e255c="" xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="invoice-row-5036-preview-icon" class="mx-1 feather feather-eye">
                                                <path data-v-9a6e255c="" d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle data-v-9a6e255c="" cx="12" cy="12" r="3"></circle>
                                            </svg>
                                        </a>
                                        <a class="" href="/room/{{ $Room->id }}/edit" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit">
                                            <i class="fa-regular fa-pen-to-square mr-3 text-orange"></i></i>
                                        </a> --}}

                                        {{-- {{ Form::open(array('url' => '/room/'.$Room->id,'method' => 'DELETE')) }} --}}
                                        {{-- <button class="DeleteBtn" value="{{$Room->id}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete">
                                            <i class="fa-regular fa-trash-can mr-3 text-danger"></i>
                                        </button> --}}
                                        {{-- {{ Form::close() }} --}}
                                    {{-- </td>
                                </tr>
                            @endforeach
                        </tbody> --}}
                    </table>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>

    <div class="modal fade show" id="NewRoomModal"  role="dialog">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add A New Room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    {{ Form::open(array('url' => 'room', 'method' => 'POST','class' => 'form-horizantal','id'=>'NewRoomFrom','files' => true)) }}
                        <div class="card-body pb-0">
                            <div class="form-group row">

                                <div class="col-md-12">
                                    <div class="form-group row">
                                        {{-- <label for="HotelID" class="form-label col-md-3">Hotel:</label> --}}
                                        <div class="col-md-3">
                                            <select type="number" name="HotelID" id=""  class="form-select" required>
                                                <option value="">Select Hotel</option>
                                                    @foreach ($Hotels as $Hotel)
                                                    <option value="{{ $Hotel->id }}">
                                                        {{ $Hotel->Name }}
                                                    </option>
                                                    @endforeach
                                            </select>
                                        </div> 
                                          <div class="col-md-3">
                                            <select name="Type" id="" class="form-select">
                                                <option value="">Select Type</option>
                                                <option value="Single">Single Bed</option>
                                                <option value="Double">Double Bed</option>
                                                <option value="Tripe">Tripple Bed</option>
                                            </select>
                                        </div> 
                                          <div class="col-md-2">
                                            <input type="text" name="RoomNo" class="form-control" placeholder="RoomNo" required>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="Floor" class="form-control" placeholder="Floor" required> 
                                        </div>
                                       
                                        <div class="col-md-2">
                                            <input type="number" name="Price" class="form-control" placeholder="Price">
                                        </div>
                                    </div>
                                </div>
                                <div class="py-2">
                                    <hr class="bg-dark">
                                </div>
                                
                            <div class="form-group row ">
                                <div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label for="Geyser" class="col-md-3 form-label">Geyser:</label>
                                                <div class="col-md-8">
                                                    <div class="form-check form-check-inline ml-1">
                                                        <input type="radio" class="form-check-input" name="Geyser" value="1">
                                                        <label for="" class="form-check-label">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline ml-4">
                                                        <input type="radio" class="form-check-input" name="Geyser" value="0">
                                                        <label for="" class="form-check-label">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label for="AC" class="col-md-3 form-label">AC:</label>
                                                <div class="col-md-8">
                                                    <div class="form-check form-check-inline ml-1">
                                                        <input type="radio" class="form-check-input" name="AC" value="1">
                                                        <label for="" class="form-check-label">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline ml-4">
                                                        <input type="radio" class="form-check-input" name="AC" value="0">
                                                        <label for="" class="form-check-label">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label for="Balcony" class="col-md-3 form-label">Balcony:</label>
                                                <div class="col-md-8">
                                                    <div class="form-check form-check-inline ml-1">
                                                        <input type="radio" class="form-check-input" name="Balcony" value="1">
                                                        <label for="" class="form-check-label">
                                                            Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline ml-4">
                                                        <input type="radio" class="form-check-input" name="Balcony" value="0">
                                                        <label for="" class="form-check-label">
                                                            No
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label for="Bathtub" class="col-md-3 py-0 form-label">Bathtub:</label>
                                                <div class="col-md-8">
                                                    <div class="form-check form-check-inline ml-1">
                                                        <input type="radio" class="form-check-input" name="Bathtub" value="1">
                                                        <label for="" class="form-check-label">
                                                            Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline ml-4">
                                                        <input type="radio" class="form-check-input" name="Bathtub" value="0">
                                                        <label for="" class="form-check-label">
                                                            No
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label for="HiComode" class="col-md-3 form-label">HiComode:</label>
                                                <div class="col-md-8">
                                                    <div class="form-check form-check-inline ml-1">
                                                        <input type="radio" class="form-check-input" name="HiComode" value="1">
                                                        <label for="" class="form-check-label">
                                                            Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline ml-4">
                                                        <input type="radio" class="form-check-input" name="HiComode" value="0">
                                                        <label for="" class="form-check-label">
                                                            No
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label for="Locker" class="col-md-3 form-label">Locker:</label>
                                                <div class="col-md-8">
                                                    <div class="form-check form-check-inline ml-1">
                                                        <input type="radio" class="form-check-input" name="Locker" value="1">
                                                        <label for="" class="form-check-label">
                                                            Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline ml-4">
                                                        <input type="radio" class="form-check-input" name="Locker" value="0">
                                                        <label for="" class="form-check-label">
                                                            No
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label for="Freeze" class="col-md-3 form-label">Freeze:</label>
                                                <div class="col-md-8">
                                                    <div class="form-check form-check-inline ml-1">
                                                        <input type="radio" class="form-check-input" name="Freeze" value="1">
                                                        <label for="" class="form-check-label">
                                                            Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline ml-4">
                                                        <input type="radio" class="form-check-input" name="Freeze" value="0">
                                                        <label for="" class="form-check-label">
                                                            No
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label for="Internet" class="col-md-3 form-label">Internet:</label>
                                                <div class="col-md-8">
                                                    <div class="form-check form-check-inline ml-1">
                                                        <input type="radio" class="form-check-input" name="Internet" value="1">
                                                        <label for="" class="form-check-label">
                                                            Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline ml-4">
                                                        <input type="radio" class="form-check-input" name="Internet" value="0">
                                                        <label for="" class="form-check-label">
                                                            No
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label for="Intercom" class="col-md-3 form-label">Intercom:</label>
                                                <div class="col-md-8">
                                                    <div class="form-check form-check-inline ml-1">
                                                        <input type="radio" class="form-check-input" name="Intercom" value="1">
                                                        <label for="" class="form-check-label">
                                                            Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline ml-4">
                                                        <input type="radio" class="form-check-input" name="Intercom" value="0">
                                                        <label for="" class="form-check-label">
                                                            No
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label for="TV" class="col-md-3 form-label">TV:</label>
                                                <div class="col-md-8">
                                                    <div class="form-check form-check-inline ml-1">
                                                        <input type="radio" class="form-check-input" name="TV" value="1">
                                                        <label for="" class="form-check-label">
                                                            Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline ml-4">
                                                        <input type="radio" class="form-check-input" name="TV" value="0">
                                                        <label for="" class="form-check-label">
                                                            No
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label for="Wardrobe" class="col-md-3 form-label">Wardrobe:</label>
                                                <div class="col-md-8">
                                                    <div class="form-check form-check-inline ml-1">
                                                        <input type="radio" class="form-check-input" name="Wardrobe" value="1">
                                                        <label for="" class="form-check-label">
                                                            Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline ml-4">
                                                        <input type="radio" class="form-check-input" name="Wardrobe" value="0">
                                                        <label for="" class="form-check-label">
                                                            No
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    </div>

                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default text-capitalize" id="ResetBtnForm">Reset</button>
                                <button type="button" name="submit" type="submit" class="btn bg-navy text-capitalize" id="SubmitBtn">submit</button>
                            </div>
                        </div>
                    {{ Form::close() }}

                </div>
            </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){

            $.noConflict();
            var RoomList = $('#RoomList').DataTable({
                serverSide:true,
                processing:true,
                colReorder:true,
                stateSave:true,
                responsive:true,
                ajax:{
                    url:'/room',
                    type:'Get',
                },
                columns:
                [
                    {data:'id',visible:false},
                    {data:'HotelName'},
                    {data:'RoomNo'},
                    {data:'Floor'},
                    {data:'Type'},
                    {data:'Geyser', render:function(data, type,row){
                        return data == 1?'<i class="fa fa-check text-success"></i>':'<i class="fa fa-times text-danger"></i>';
                    }},
                    {data:'AC', render:function(data, type,row){
                        return data == 1?'<i class="fa fa-check text-success"></i>':'<i class="fa-solid fa-xmark text-danger"></i>';
                    }},
                    {data:'Balcony', render:function(data, type,row){
                        return data == 1?'<i class="fa fa-check text-success"></i>':'<i class="fa-solid fa-xmark text-danger"></i>';
                    }},
                    {data:'Internet', render:function(data, type,row){
                        return data == 1?'<i class="fa fa-check text-success"></i>':'<i class="fa-solid fa-xmark text-danger"></i>';
                    }},
                    {data:'TV', render:function(data, type,row){
                        return data == 1? '<i class="fa fa-check text-success"></i>':'<i class="fa-solid fa-xmark text-danger"></i>';
                    }},
                    {data:'Price'},
                    {data:'action'}
                ]
            });

            $('#ResetBtnForm').on('click',function(e){
                e.preventDefault();
                $('#NewRoomFrom')[0].reset();
            });
            $('#SubmitBtn').on('click',function(e){
                e.preventDefault();
                
                $.ajax({
                    type:'POST',
                    url:'/room',
                    data: $('#NewRoomFrom').serializeArray(),
                    success:function(data){
                        $('#NewRoomFrom')[0].reset();
                        $('#NewRoomModal').modal('hide');
                         Swal.fire(
                          'Success!',
                          data,
                          'success'
                        )
                        RoomList.draw(false);
                    },
                    error:function(data){
                        console.log('Error while adding new hotel' + data);
                    },
                });
            });

            $('.DeleteBtn').on('click',function(e){
                e.preventDefault();
                // console.log($(this).val());
                var ID = $(this).val();

                Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't be able to delete this!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                  if (result.isConfirmed) {
                    $.ajax({
                        type:'GET',
                        url:'/room/delete/'+ID,
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

            $('#DeleteAllBtn').on('click',function(e){
                e.preventDefault();
                 Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to DeleteAll this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, DeleteAll it!'

                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type:'GET',
                                url:'/room/delete',
                                success:function(data){
                                Swal.fire(
                                    'DeleteAll!',
                                    'Your file has been DeleteAll.',
                                    'success'
                                    );
                                },
                                error:function(data){
                                    Swal.fire(
                                    'Error!',
                                    'DeleteAll failed !',
                                    'error'
                                    );

                                    console.log(data);
                                },
                            });

                            
                        }
                    });
            })

        });
    </script>
@endsection