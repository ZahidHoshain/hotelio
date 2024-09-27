@extends('layouts.app')
@section('content')
    <div class="container py-5 col-md-12">
        <div class="row">
            <div class="col-md-7 m-auto">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title text-light">
                            <a href="{{ asset('bank') }}" class="mr-3"><i class="fa-solid fa-circle-arrow-left fs-5 text-navy" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Back to List"></i></a>
                            Update To Bank Data
                        </h3>
                    </div>
                    {{ Form::open(array('url' => '/bank/'.$Banks->id,'method' => 'PATCH','class'=>'form-horizontal', 'files' => true , 'id'=>'updateBank')) }}
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="Name" class="form-label col-md-3">Name:</label>
                                <div class="col-md-8">
                                    <input type="text" name="Name" class="form-control" value="{{$Banks->Name}}"> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Branch" class="form-label col-md-3">Branch:</label>
                                <div class="col-md-8">
                                    <input type="text" name="Branch" class="form-control" value="{{$Banks->Branch}}"> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="AccountNo" class="form-label col-md-3">Account No:</label>
                                <div class="col-md-8">
                                    <input type="text" name="AccountNo" class="form-control" value="{{$Banks->AccountNo}}"> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Address" class="form-label col-md-3">Address:</label>
                                <div class="col-md-8">
                                    <input type="text" name="Address" class="form-control" value="{{$Banks->Address}}"> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Phone" class="form-label col-md-3">Phone:</label>
                                <div class="col-md-8">
                                    <input type="tel" name="Phone" updateBtnclass="form-control" value="{{$Banks->Phone}}"> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Email" class="form-label col-md-3">Email:</label>
                                <div class="col-md-8">
                                    <input type="mail" name="Email" class="form-control" value="{{$Banks->Email}}"> 
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="submit" name="submit" id="updateBtn" class="btn bg-success float-right w-25 text-capitalize" value="Update">
                            </div>
                        </div>
                    {{ Form::close()}} 
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#updateBtn').on('click',function(e){
                e.preventDefault();
                $.ajax({
                    type    : 'PATCH',
                    url     : '/bank/'+{{ $Banks->id }},
                    data    : $('#updateBank').serializeArray(),success:function(data){
                        $('#updateBank')[0].reset();
                        Swal.fire(
                            'success',
                            'Bank Updated successfully !',
                            'success'
                        );
                    }  
                })
            })
        })
    </script>
@endsection