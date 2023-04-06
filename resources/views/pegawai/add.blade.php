@extends('layouts.template')
@section('title', 'Pegawai')
@section('content')

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-2"></div>
          <div class="col-lg-8">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Formulir Pegawai</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ url('officer')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                @include('pegawai._form')
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <a class="btn btn-light" href="{{url('officer/')}}">Cancel</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
           
              <!-- /.card -->
    </section>
@endsection
