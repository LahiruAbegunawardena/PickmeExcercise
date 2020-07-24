@extends('admin.common.header')

@section('content')


  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Student Management</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('adminHome') }}">Home</a></li>
            <li class="breadcrumb-item active">Students</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">DataTable with default features</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="studentDet" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Validated Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($studentData as $student)
                  
                    <tr>
                      <td>{{$student->id}}</td>
                      <td>{{$student->first_name}}</td>
                      <td>{{$student->last_name}}</td>
                      <td>{{$student->email}}</td>
                      <td>{{$student->is_verified}}</td>
                      <td></td>
                    </tr>
                      
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Validated Status</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
              </table>
            </div>

        </div>
      </div>
    </div>
  </section>

@endsection