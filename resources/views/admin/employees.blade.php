@extends('layouts.admin_layout')

@section('content')
    @if(Session::has('added'))
        <div class="alert alert-success">Employee added successful!</div>
    @elseif(Session::has('updated'))
        <div class="alert alert-success">Employee updated successful!</div>
    @endif
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-5">
                    <h2><b>Employees</b></h2>
                </div>
                <div class="col-sm-7">
                    <a href="{{ route('employees.create') }}" class="btn btn-primary">
                        <i class="material-icons">&#xE147;</i><span>Add employee</span>
                    </a>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Company</th>
                <th>E-mail</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody id="main-table">
            @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->first_name }}</td>
                    <td>{{ $employee->last_name }}</td>
                    <td><a href="{{ route('companies.show', ['id'=>$employee->company->id]) }}">{{ $employee->company->name }}</a></td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td>
                        <a href="{{ route('employees.edit', ['id'=>$employee->id]) }}" class="settings" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE8B8;</i></a>
                        <a href="" id="employee-delete" class="delete"><i class="material-icons" title="Delete">&#xE5C9;</i>
                            <form class="form-delete" action="{{ route('employees.destroy', ['id'=>$employee->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                            </form>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div id="paginator-block" class="clearfix">
            <div class="hint-text">Showed <b>{{ $employees->count() }}</b> of <b>{{ $employees->total() }}</b> companies</div>
            <div class="pagination">
                {{ $employees->fragment('main-table')->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
@endsection