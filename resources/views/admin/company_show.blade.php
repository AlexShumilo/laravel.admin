@extends('layouts.admin_layout')

@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success">Company edited successful!</div>
    @endif
    <div>
        <h2>{{ $company->name }}</h2>
        <hr>
        <div class="company-logo">
            <img src="/storage/{{ $company->logo }}" alt="Logo">
        </div>
        <p><span class="attribute">E-mail: </span>{{ $company->email }}</p>
        <p><span class="attribute">Website: </span>{{ $company->website }}</p>
        <p><span class="attribute">Employees count: </span>{{ $company->employees()->count() }}</p>
        <div><a href="{{ route('companies.edit', ['id'=>$company->id]) }}" class="btn btn-primary">Edit</a></div>
    </div>
@endsection