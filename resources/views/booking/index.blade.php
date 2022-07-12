@extends('layouts.app')
@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-10 m-auto">
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
                               <button type="button" class="btn bg-navy text-capitalize mr-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Create Room"" data-toggle="modal" data-target="#NewBookingModal"> 
                                    <i class="fa-solid fa-circle-plus mr-2"></i>
                                    Add
                                </button> 
                                Booking List
                            </h2>
                        </div>
                        <a class="btn btn-sm bg-navy float-right text-capitalize" href="/booking/trash"><i class="fa-solid fa-recycle mr-2"></i>View Trash</a>
                        <a class="btn btn-sm bg-maroon float-right text-capitalize mr-3" href="/booking/delete"><i class="fa-solid fa-trash-can mr-2"></i>Delete All</a>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover table-borderless ListTable">
                            <thead>
                                <tr class="border-bottom">
                                    <th>Room</th>
                                    <th>Guest</th>
                                    <th>CheckInDate</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($Bookings as $Booking)
                                    <tr class="border-bottom">
                                        <td>{{$Booking->Room}}</td>
                                        <td>{{$Booking->Guest}}</td>
                                        <td>
                                            @php
                                                echo date('d-m-Y H:i:s',strtotime($Booking->CheckInDate))
                                            @endphp
                                        </td>
                                        
                                        <td class="d-flex">
                                            <button class="EditBtn" value="{{ $Booking->id }}" style="cursor: pointer;">
                                                <i class="fa-regular fa-pen-to-square mr-3 text-orange"></i></i>
                                            </button>
                                            
                                            {{ Form::open(array('url' => '/booking/'.$Booking->id,'method' => 'DELETE')) }}
                                                <button class="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete">
                                                    <i class="fa-regular fa-trash-can mr-3 text-danger"></i>
                                                </button>
                                            {{ Form::close() }} 
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                           
                        </table>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>

        <div class="modal fade show" id="NewBookingModal"role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">Add A New Booking</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ Form::Open(array('url' => '/booking','method' => 'POST','class' => 'form-horizontal', 'id' => 'NewBookingForm', 'files' => true)) }}
                            
                            <div class="form-group row">
                                <label for="RoomID" class="form-label  col-md-4">Room:</label>
                                <div class="col-md-7">
                                    <select type="number" name="RoomID" id=""  class="form-select" required>
                                        <option value="">Select Room</option>
                                        @foreach ($Rooms as $Room)
                                            <option value="{{ $Room->id }}">{{ $Room->RoomNo }}</option>
                                            @if(!$Room->Status)
                                                <option value="{{ $Room->id }}">{{ $Room->RoomNo }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="GuestID" class="form-label  col-md-4">Guest:</label>
                                <div class="col-md-7">
                                    <select type="number" name="GuestID" id=""  class="form-select" required>
                                        <option value="">Select Guest</option>
                                        @foreach ($Guests as $Guest)
                                            <option value="{{ $Guest->id }}">
                                                {{ $Guest->Name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="CheckInDate" class="form-label  col-md-4">Check-In Date:</label>
                                <div class="col-md-7">
                                    <input type="date" name="CheckInDate" class="form-control" required> 
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


        <div class="modal fade show" id="EditBookingModal"role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title"> Update Booking</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            {{ Form::Open(array('method' => 'PATCH', 'class' => 'form-horizontal', 'id' => 'EditBookingForm', 'files' => true)) }}
                                <input type="hidden" name="ID" id="IDEdit">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="RoomID" class="form-label col-md-3">Room:</label>
                                        <div class="col-md-8">
                                            <select type="number" name="RoomID" id="EditRoom"  class="form-select" value="">
                                                <option value="">Select Room</option>
                                                @foreach ($Rooms as $Room)
                                                    @if ($Booking->RoomID == $Room->id)
                                                        <option value="{{ $Room->id }}" selected>
                                                            {{ $Room->Room}}
                                                        </option>
                                                        @else
                                                            <option value="{{ $Room->id }}">
                                                            {{ $Room->RoomNo}}
                                                            </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="GuestID" class="form-label col-md-3">Guest:</label>
                                        <div class="col-md-8">
                                            <select type="number" name="GuestID" id="EditGuest"  class="form-select">
                                                <option value="">Select Guest</option>
                                                @foreach ($Guests as $Guest)
                                                
                                                    @if ($Booking->GuestID == $Guest->id)
                                                            <option value="{{ $Guest->id }}" selected>
                                                                {{ $Guest->Guest }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $Guest->id}}">
                                                                {{ $Guest->Name }}
                                                            </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="CheckInDate" class="form-label col-md-3">CheckInDate:</label>
                                        <div class="col-md-8">
                                            <input type="date" name="CheckInDate" id="EditCheckInDate" class="form-control" value="{{ date('d-m-Y H:i:s',strtotime($Booking->CheckInDate)) }}" >
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
                $('#NewBookingForm')[0].reset();
            });
            $('#SubmitBtn').on('click',function(e){
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "/booking",
                    data: $('#NewBookingForm').serializeArray(),
                    success: function (data) {
                        $('#NewBookingForm')[0].reset();
                        $('#NewBookingModal').modal('hide');
                        Swal.fire(
                            'Success !',
                            data,
                            'success'
                        )
                    },
                    error:function(data){
                        console.log('Error while adding new Booking' + data);
                    }
                });
            });

            $('.EditBtn').on('click',function(e){
                jQuery.noConflict();
                e.preventDefault();
                var ID = $(this).val();
                $.ajax({
                    type:"GET",
                    url: "/booking/"+ID,
                    success: function (data) {
                        $('#EditBookingForm')[0].reset();
                        $('#IDEdit').val(data['id']);
                        $('#EditRoom').val(data['RoomID']);
                        $('#EditGuest').val(data['GuestID']);
                        $('#EditCheckInDate').val(data['CheckInDate']);
                        $('#EditBookingModal').modal('show');
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
                    type: "PATCH",
                    url: "/booking/"+ID,
                    data: $('#EditBookingForm').serializeArray(),
                    success: function (data) {
                        $('#EditBookingForm')[0].reset();
                        $('#EditBookingModal').modal('hide');
                        Swal.fire(
                            'success',
                            'Booking updated successfully',
                            'success'
                        );
                    },
                    error:function(data){
                        console.log(data);
                    }
                });
            });
         });
    </script>
@endsection
