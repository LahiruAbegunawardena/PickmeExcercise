@extends('admin.common.header')

@section('content')


  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-8">
        <h1>Enroll Courses to {{$studentData->first_name}} {{$studentData->last_name}}</h1>
        </div>
        <div class="col-sm-4">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('studentMgt') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('studentMgt') }}">Students</a></li>
            <li class="breadcrumb-item active">Enroll</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container-fluid">

      <div class="row">
        @foreach ($courses as $course)
          <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> {{$course->course_name}} </h4>
                    
                </div>
                <div class="card-body">

                  <ul>
                    <li>Credits: {{$course->credits}}</li>
                    <li>Course Code: {{$course->course_code}}</li>
                    <li>Course Fee: Rs. {{$course->course_fee_format}}</li>
                  </ul>

                  @if(in_array($course->id, $studentData->enrolledCourseId))

                    <p>You have already enrolled in this course<p>

                  @else

                    {{ Form::open(array('url' => url('/admin/student/'.($studentData->id).'/complete-enroll/'.($course->id)), 'method'=>'POST')) }}

                      <div class="row">
                        <div class="form-group col-md-8">
                          <label for="year">Course Following Year</label>
                          <select id="year" name="year" class="form-control" required>
                            @foreach ($years as $year)
                              <option value="{{$year}}">{{$year}}</option>
                            @endforeach
                          </select>
                          
                        </div>
                      </div>

                      <button type="submit" class="btn btn-primary btn-sm">Enroll</button>

                    {{ Form::close() }}

                    @endif
                </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>


@endsection