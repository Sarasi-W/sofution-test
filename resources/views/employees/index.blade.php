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
                            <li class="breadcrumb-item active" aria-current="page">
                                Employees
                            </li>
                        </ol>
                    </nav>
                </div>

                <div class="col-sm-6">
                    @if (\App\Models\Company::count() == 0 )
                    <button type="button" class="btn btn-primary float-right disabled">
                        <i class="fa fa-plus-square" aria-hidden="true"></i> Add New Employee
                    </button>
                    @else
                    <a type="button" class="btn btn-primary float-right" href="{{route("employees.create")}}">
                        <i class="fa fa-plus-square" aria-hidden="true"></i> Add New Employee
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Employees List</h3>

                    <div class="card-tools">
                        <form action="{{ route('employees.search') }}" method="GET">
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
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Company</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if ($employees->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center py-4">No Records found.</td>
                            </tr>
                            @endif

                            @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $employee->id }}</td>
                                <td>{{ $employee->first_name }}</td>
                                <td>{{ $employee->last_name }}</td>
                                <td>
                                    <a class="text-decoration-none text-primary" href="{{ route('companies.show', $employee->company->id) }}">{{ $employee->company->name }}</a>
                                </td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->phone }}</td>
                                <td>
                                    <a href="{{ route('employees.show', $employee->id) }}" type="button" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <a href="{{ route('employees.edit', $employee->id) }}" type="button" class="btn btn-warning"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
                                    <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$employee->id}})" data-target="#DeleteModal" class="btn btn-danger">
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
            {!! $employees->links() !!}
        </ul>
    </div>

    @if (! $employees->isEmpty())
    <x-delete-modal :moduleNameInSingular="'employee'" :moduleNameInPlural="'employees'" :id="$employee->id" />
    @endif

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

        function deleteData(id) {
            var id = id;

            var url = '{{ route("employees.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }
    </script>
@endsection
