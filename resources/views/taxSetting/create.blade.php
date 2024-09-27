@extends('layouts.app')
@section('content')
    <div class="container py-5">
        {{-- <section class="button__list__show">
            <a href="{{ asset('taxSetting') }}" class="btn btn-info text-capitalize">List TaxSetting</a>
        </section> --}}
        <div class="row">
            <div class="col-md-7 m-auto">
                @if (Session::get('Success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> Success!</h5>
                        {{Session::get('Success')}}
                    </div>
                @endif
                <div class="card card-primary">
                    <div class="card-header">
                        <h2 class="card-title">
                            <a href="{{ asset('taxSetting') }}" class="mr-3"><i class="fa-solid fa-circle-arrow-left fs-5 text-navy" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Back to List"></i></a> 
                            Add a new taxSetting
                        </h2>
                    </div>
                    {{ Form::open(array('url' => '/taxSetting', 'method' => 'post','class' => 'form-horizantal', 'files' => true)) }}
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
                        <div class="card-footer">
                            {{-- <input type="submit" name="submit" id="" class="btn btn-defult float-right w-25" value="Reset"> --}}
                            <input type="submit" name="submit" id="" class="btn bg-navy float-right w-25">
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection



