@extends('layouts.template')
@section('title', 'Nasabah')
@section('content')

    <section class="content">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Formulir Nasabah</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ url('customer/'.$data->id)}}" method="post" enctype="multipart/form-data">
                    @method('put')
                    {{ csrf_field() }}
                  @include('nasabah._form')
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-light" href="{{url('customer/')}}">Cancel</a>
                  </div>
                </form>
              </div>
    </section>
@endsection
