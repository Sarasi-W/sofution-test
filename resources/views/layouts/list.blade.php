@extends('layouts.app')

@section('content')
<x-slide-nav-bar />

<div class="content-wrapper" style="min-height: 587px;">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @yield('list-content')
            </div>
        </div>
    </section>
</div>

@endsection