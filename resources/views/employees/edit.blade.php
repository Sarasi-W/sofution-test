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
                                {{ Route::currentRouteName() === 'employees.show' ? 'View' : 'Edit' }} 
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
                <h3 class="card-title">
                    {{ Route::currentRouteName() === 'employees.show' ? 'View' : 'Edit' }}
                    Employee Details
                </h3>
              </div>
              <!-- form start -->
              <form action="{{ route('employees.update', $employee->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card-body">

                    <div class="form-group">
                        <label for="company">Company</label>

                        @if (Route::currentRouteName() === 'employees.show')
                            <input type="text" class="form-control" value="{{ $employee->company->name }}">
                        @else
                            <select class="custom-select" name="company">
                                <option disabled>Choose employee's company</option>
                                @foreach ($companies as $company)
                                <option value="{{ $company->id }}" {{$company->id == $employee->company_id ? 'selected' : ''}}>{{ $company->name }}</option>
                                @endforeach
                            </select>
                            
                            @if($errors->first('company')) 
                                <span class="error invalid-feedback d-block" role="alert">
                                    <strong>{{ $errors->first('company') }}</strong>
                                </span>
                            @endif
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter first name" value="{{ $employee->first_name }}">

                        @if($errors->first('first_name')) 
                            <span class="error invalid-feedback d-block" role="alert">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter last name" value="{{ $employee->last_name }}">

                        @if($errors->first('last_name')) 
                            <span class="error invalid-feedback d-block" role="alert">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{ $employee->email }}">

                        @if($errors->first('email')) 
                            <span class="error invalid-feedback d-block" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number" value="{{ $employee->phone }}">

                        @if($errors->first('phone')) 
                            <span class="error invalid-feedback d-block" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    @if(Route::currentRouteName() === 'employees.edit')
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="reset" class="btn btn-info">Reset</button>
                    @else
                    <a href={{ route('employees.edit', $employee->id) }} type="button" class="btn btn-warning">Edit</a>
                    @endif
                    <a type="button" href="{{ route('employees.index') }}" class="btn btn-secondary">Go Back</a>
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
