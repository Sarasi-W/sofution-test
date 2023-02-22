@extends('layouts.app')

@section('content')
<x-slide-nav-bar />

<div class="content-wrapper" style="min-height: 587px;">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                @yield('list-content')
                <!-- /.Left col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>


@endsection