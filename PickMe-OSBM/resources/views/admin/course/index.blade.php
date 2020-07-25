@extends('admin.common.header')

@section('content')


  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Course Management</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('studentMgt') }}">Home</a></li>
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
              
              <div class="row">
                <h3 class="card-title col-md-9">Course Details</h3>

              <a href="{{ route('courseCreate')}}" class="col-md-3 btn btn-block bg-gradient-secondary"> Add Course </a>
              </div>
              

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="studentDet" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Course Name</th>
                    <th>Course Code</th>
                    <th>No of Enrollments</th>
                    <th>No of Credits</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach ($courseData as $course)
                    <tr>
                      <td>{{$course->id}}</td>
                      <td>{{$course->course_name}}</td>
                      <td>{{$course->course_code}}</td>
                    <td>{{ count($course->students) }}</td>
                      <td>{{$course->credits}}</td>
                      <td>
                        <a href="" class="btn btn-block bg-gradient-info btn-xs"> Edit </a>
                        <a href="" class="btn btn-block bg-gradient-danger btn-xs"> Delete </a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Course Name</th>
                        <th>Course Code</th>
                        <th>No of Enrollments</th>
                        <th>No of Credits</th>
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