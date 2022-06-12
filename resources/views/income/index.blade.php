@extends('layouts.app')
@extends('layouts.Header')

@section('content')
<div class="container-fluid">
    <a href="/income/create" class="btn btn-primary">Add to New Guest</a>
    <!--Table-->
    <div class="table col-md-12">
        <table class="table table-striped w-auto ">

            <!--Table head-->
            <thead>
              <tr>
                <th>id</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Description</th>
                <th>Date</th>
              </tr>
            </thead>
            <!--Table head-->
          
            <!--Table body-->
            <tbody>
              @foreach ( $Incomes as $Income)
                <tr class="table-info">
                  <td>{{$Income->id}}</td>
                  <td>{{$Income->Name}}</td>
                  <td>{{$Income->Amount}}</td>
                  <td>{{$Income->Description}}</td>
                  <td>{{$Income->Date}}</td>
                  <td>
                    <a href="/expense/{{$Income->id}}/edit"  class="btn btn-warning">Edit</a>
                    <a href="/expense/{{$Income->id}}/delete"  class="btn btn-danger mx-md-2">Delete</a>
                  </td>
                </tr>
              @endforeach
            </tbody>
            <!--Table body-->
          
          
          </table>
          <!--Table-->
    </div>

</div>
@endsection