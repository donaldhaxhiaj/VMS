@extends('admin.layouts.app')

@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">VMS</h3>

                </div>
                <div class="box-body">
                    <div style="background-image: url('/user/img/home-bg.jpg'); background-repeat: no-repeat;background-size: cover;" class="jumbotron text-center">
                        <h1>Miresevini ne VMS <br> {{ Auth::user()->name }}</h1>
                        <p>Veprime te shpejta</p>
                        <p>
                            <a class="btn btn-lg btn-outline" href="{{ route('visitor.create') }}" role="button">Rregjistro vizitorin</a>
                            <a class="btn btn-lg btn-outline" href="{{ route('visit.create') }}" role="button">Rregjistro viziten</a>
                        </p>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>

    <style>
        .btn-outline {
            background-color: transparent;
            color: inherit;
            transition: all .5s;
        }
    </style>
    <!-- /.content-wrapper -->
@endsection
