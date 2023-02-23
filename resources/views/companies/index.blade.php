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
                            <li class="breadcrumb-item active" aria-current="page">
                                Companies
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6">
                    <a type="button" class="btn btn-primary float-right" href="{{route("companies.create")}}"><i class="fa fa-plus-square" aria-hidden="true"></i> Add New Company</a>
                </div>
            </div>
        </div>
    </section>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Companies List</h3>

                    <div class="card-tools">
                        <form action="{{ route('companies.search') }}" method="GET">
                            @csrf
                            <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="q" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Company Name</th>
                                <th>Email</th>
                                <th>Logo</th>
                                <th>Website</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if ($companies->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center py-4">No Records found.</td>
                            </tr>
                            @endif

                            @foreach ($companies as $company)
                            <tr>
                                <td>{{ $company->id }}</td>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->email }}</td>
                                <td>
                                    <img src="{{ asset('/images/company_logos/'.$company->logo) }}" alt="{{$company->name}} Logo" style="height:75px"> 
                                </td>
                                <td>
                                    <a href={{ $company->website }} target="_blank">{{ $company->website }}</a></td>
                                <td>
                                    <a href="{{ route('companies.show', $company->id) }}" type="button" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <a href="{{ route('companies.edit', $company->id) }}" type="button" class="btn btn-warning"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
                                    <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$company->id}})" data-target="#DeleteModal" class="btn btn-danger">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

    <div class="card-tools">
        <ul class="pagination pagination-sm float-right">
            {!! $companies->links() !!}
        </ul>
    </div>

    @if (! $companies->isEmpty())
    <x-delete-modal :moduleNameInSingular="'company'" :moduleNameInPlural="'companies'" :id="$company->id" />
    @endif

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

        function deleteData(id) {
            var id = id;

            var url = '{{ route("companies.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }
    </script>
@endsection
