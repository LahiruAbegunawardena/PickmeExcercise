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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Create Course</h4>
                </div>
                <div class="card-body">
                  {{ Form::open(array('route' => 'courseStore','method'=>'POST')) }}
                    
                    <div class="row">
                      <div class="form-group col-md-8">
                        <label for="course_name">Course Name</label>
                        {!! Form::text('course_name', null, array('class' => 'form-control')) !!}
                        @if ($errors->has('course_name'))
                          @slot('error')
                            {{ $errors->first('course_name') }}
                          @endslot
                        @endif
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-4">
                        <label for="course_code">Course Code</label>
                        {!! Form::text('course_code', null, array('class' => 'form-control')) !!}
                        @if ($errors->has('course_code'))
                          @slot('error')
                            {{ $errors->first('course_code') }}
                          @endslot
                        @endif
                      </div>
                      <div class="form-group col-md-4">
                        <label for="credits">Credits</label>
                        {!! Form::text('credits', null, array('class' => 'form-control')) !!}
                        @if ($errors->has('credits'))
                          @slot('error')
                            {{ $errors->first('credits') }}
                          @endslot
                        @endif
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-8">
                        <label for="course_fee">Course Fee</label>
                        {!! Form::text('course_fee', null, array('class' => 'form-control')) !!}
                        @if ($errors->has('course_fee'))
                          @slot('error')
                            {{ $errors->first('course_fee') }}
                          @endslot
                        @endif
                      </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>

                  {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

    </div>
  </section>

@endsection