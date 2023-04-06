@extends('layouts.template')
@section('title', 'Jabatan')
@section('content')
          <section class="content">
            <div class="col-lg-5">
              <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Formulir Jabatan BTM</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form action="{{ url('master-jabatan/'.$data->id)}}" method="post" enctype="multipart/form-data">
                    @method('put')
                    {{ csrf_field() }}
                    @include('master.jabatan._form')
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <a class="btn btn-light" href="{{url('master-jabatan/')}}">Cancel</a>
                    </div>
                  </form>
                </div>
              </div>
              <!-- /.card -->
          </section>
@endsection
