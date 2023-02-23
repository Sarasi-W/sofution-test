@extends('layouts.list')

@section('list-content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Employees List</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">
                                    Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('employees.index') }}">
                                    Employees
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Add New
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <div class="mx-2">

        @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('success') }}
            @php
                Session::forget('success');
            @endphp
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Add New Employee</h3>
            </div>
            <!-- form start -->
            <form action="{{ route('employees.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="card-body">
                    <div class="form-group">
                        <label for="company">Company</label>
                        <select class="custom-select" name="company">
                            <option disabled selected>Choose employee's company</option>
                            @foreach ($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                        
                        @if($errors->first('company')) 
                            <span class="error invalid-feedback d-block" role="alert">
                                <strong>{{ $errors->first('company') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter first name" value="{{ old('first_name') }}">

                        @if($errors->first('first_name')) 
                            <span class="error invalid-feedback d-block" role="alert">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter last name" value="{{ old('last_name') }}">

                        @if($errors->first('last_name')) 
                            <span class="error invalid-feedback d-block" role="alert">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{ old('email') }}">

                        @if($errors->first('email')) 
                            <span class="error invalid-feedback d-block" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number" value="{{ old('phone') }}">

                        @if($errors->first('phone')) 
                            <span class="error invalid-feedback d-block" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" {{ $companies->isEmpty() ? 'disabled' : '' }}>Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <a type="button" href="{{ route('employees.index') }}" class="btn btn-warning">Go Back</a>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        $('#logoField').on('change', function(){ 
            var fileName = $(this).val();
            $(this).next('.custom-file-label').html(fileName);
        });

        $('.alert').alert();
    </script>

@endsection
