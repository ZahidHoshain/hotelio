@extends('layouts.app')
@section('content')
      <div class="container py-5 col-md-10 m-auto">
      <div class="row">
            <div class="col-md-12">
                  <div class="card">
                  <div class="card-header bg-defult">
                        <div class="card-title">
                              <h2 class="card-title">
                              <a href="{{ asset('guest') }}" class="btn bg-navy text-capitalize mr-3"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Create Booking">
                                    <i class="fa-solid fa-circle-arrow-left mr-2"></i>
                              </a>
                              Total View
                              </h2>
                        </div>
                  </div>
                  <div class="card-body table-responsive p-0">
                        <table class="table table-hover table-responsive">
                              <thead>
                              <tr>
                                    <th>Column</th>
                                    <th>Data</th>
                              </tr>
                              </thead>
                              <tbody>
                                    <tr>
                                          <tr>
                                                <th>id</th>
                                                <td>{{ $Guest->id }}</td>
                                          </tr>
                                          <tr>
                                                <th>Name</th>
                                                <td>{{ $Guest->Name }}</td>
                                          </tr>
                                          <tr>
                                                <th>Email</th>
                                                <td>{{ $Guest->Email }}</td>
                                          </tr>
                                          <tr>
                                                <th>Address</th>
                                                <td>{{ $Guest->Address }}</td>
                                          </tr>
                                          <tr>
                                                <th>Photo</th>
                                                <td>{{ $Guest->Phone }}</td>
                                          </tr>
                                          <tr>
                                                <th>NID No</th>
                                                <td>{{ $Guest->NIDNo }}</td>
                                          </tr>
                                          <tr>
                                                <th>NID Doc</th>
                                                <td>{{ $Guest->NID }}</td>
                                          </tr>
                                          <tr>
                                                <th>Passport No</th>
                                                <td>{{ $Guest->PassportNo }}</td>
                                          </tr>
                                          <tr>
                                                <th>Passport Doc</th>
                                                <td>{{ $Guest->Passport }}</td>
                                          </tr>
                                          <tr>
                                                <th>Father</th>
                                                <td>{{ $Guest->Father }}</td>
                                          </tr>
                                          <tr>
                                                <th>Mother</th>
                                                <td>{{ $Guest->Mother }}</td>
                                          </tr>
                                          <tr>
                                                <th>Spouse</th>
                                                <td>{{ $Guest->Spouse }}</td>
                                          </tr>
                                          <tr>
                                                <th>Photo</th>
                                                <td>{{ $Guest->Photo }}</td>
                                          </tr>
                                    </tr>
                              </tbody>
                        </table>
                  </div>
                  <div class=" form-group row card-footer col-md-12">
                        <div class="form-group col-md-5">
                              <a href="/guest/{{ $Guest->id }}/edit" data-bs-toggle="Edit" data-bs-placement="bottom" title="Edit" class="btn btn-warning ">
                              <i class="fa-regular fa-pen-to-square mr-3 "></i></i> Edit</a> 
                        </div> 
                        <div class="form-group col-md-5">
                              {!! Form::open(array('url' => '/guest/'.$Guest->id ,'method' => 'DELETE') ) !!}  
                              <button class="bg-danger btn btn-danger" data-bs-toggle="Delete" data-bs-placement="bottom" title="Delete">
                                    <i class="fa-regular fa-trash-can mr-3 text-light"></i>
                                    Delete
                              </button>
                              {!! Form::close() !!}
                        </div>
                  </div> 
                  </div>
            </div>
      </div>
      </div>
@endsection
