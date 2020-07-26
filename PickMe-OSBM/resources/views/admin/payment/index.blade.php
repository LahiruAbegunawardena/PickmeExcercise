@extends('admin.common.header')

@section('content')


  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Payment Management</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('studentMgt') }}">Home</a></li>
            <li class="breadcrumb-item active">Payment Mgt</li>
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
                    <h3 class="card-title col-md-9">Payment Details</h3>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="studentDet" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Student Name</th>
                    <th>Course Name</th>
                    <th>Enrolled date</th>
                    <th>Paid / Not Paid</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach ($paymentData as $key => $payment)
                    <tr>
                      <td>{{$key + 1}}</td>
                      <td>{{$payment->enrolledStudent}}</td>
                      <td>{{$payment->enrolledCourse}}</td>
                      <td>{{$payment->enrollment->enrollment_date}}</td>
                      <td>{{$payment->paid_status}}</td>
                      <td>
                          @if ($payment->is_paid == 0)
                      <a href="{{url('/admin/payments/'.$payment->id.'/fix')}}" class="btn btn-block bg-gradient-info btn-xs"> Pay </a>
                          @endif
                      </td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                    <tr>
                      <th>#</th>
                      <th>Student Name</th>
                      <th>Course Name</th>
                      <th>Enrolled date</th>
                      <th>Paid / Not Paid</th>
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