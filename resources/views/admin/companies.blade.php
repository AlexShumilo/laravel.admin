@extends('layouts.admin_layout')

@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success">Company added successful!</div>
    @endif
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-5">
                    <h2><b>Companies</b></h2>
                </div>
                <div class="col-sm-7">
                    <a href="{{ route('companies.create') }}" class="btn btn-primary">
                        <i class="material-icons">&#xE147;</i><span>Add company</span>
                    </a>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>Logo</th>
                <th>Employees</th>
                <th>Website</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody id="main-table">
            @foreach($companies as $company)
                <tr>
                    <td>{{ $company->id }}</td>
                    <td><a href="{{ route('companies.show', ['id'=>$company->id]) }}">{{ $company->name }}</a></td>
                    <td>{{ $company->email }}</td>
                    <td><img src="/storage/{{ $company->logo }}" class="company_logo" alt="Logo"></td>
                    <td class="comment-active">
                        @if(count($company->employees()->get()) > 0)
                            <span class="status text-success">&bull;</span>
                        @else
                            <span class="status text-danger">&bull;</span>
                        @endif
                    </td>
                    <td>{{ $company->website }}</td>
                    <td>
                        <a href="{{ route('companies.edit', ['id'=>$company->id]) }}" class="settings" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE8B8;</i></a>
                        <a href="" id="company-delete" class="delete"><i class="material-icons" title="Delete">&#xE5C9;</i>
                            <form class="form-delete" action="{{ route('companies.destroy', ['id'=>$company->id]) }}" method="post">
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
            <div class="hint-text">Showed <b>{{ $companies->count() }}</b> of <b>{{ $companies->total() }}</b> companies</div>
            <div class="pagination">
                {{ $companies->fragment('main-table')->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
@endsection