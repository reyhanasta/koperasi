@extends('layouts.template')
@section('title', 'Pegawai')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Formulir Pegawai</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ url('officer/' . $dataPegawai->id) }}" method="post" enctype="multipart/form-data">
                            @method('put')
                            {{ csrf_field() }}
                            @include('pegawai._form')
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a class="btn btn-light" href="{{ $back }}">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>
    </section>
@endsection
