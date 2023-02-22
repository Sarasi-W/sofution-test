@extends('layouts.list')

@section('list-content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Companies List</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">
                                    Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('companies.index') }}">
                                    Companies
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
                <h3 class="card-title">Add New Company</h3>
              </div>
              <!-- form start -->
              <form action="{{ route('companies.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="card-body">

                    <div class="form-group">
                        <label for="name">Company Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ old('name') }}">

                        @if($errors->first('name')) 
                            <span class="error invalid-feedback d-block" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
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
                        <label for="logo">Company Logo</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="logo" id="logoField" aria-describedby="inputGroupFileAddon04"  accept="image/png, image/gif, image/jpeg" value="{{ old('logo') }}">
                                <label class="custom-file-label" for="logo" id="logoLabel">Choose file</label>
                            </div>
                        </div>

                        @if($errors->first('logo')) 
                            <span class="error invalid-feedback d-block" role="alert">
                                <strong>{{ $errors->first('logo') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="website">Company Website</label>
                        <input type="text" class="form-control" id="website" name="website" placeholder="Enter website" value="{{ old('website') }}">

                        @if($errors->first('website')) 
                            <span class="error invalid-feedback d-block" role="alert">
                                <strong>{{ $errors->first('website') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                  <a type="button" href="{{ route('companies.index') }}" class="btn btn-warning">Go Back</a>
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
