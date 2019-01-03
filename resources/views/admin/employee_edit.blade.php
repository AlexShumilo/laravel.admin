@extends('layouts.admin_layout')

@section('content')
    <h2>Edit Employee</h2>
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{ route('employees.update', ['id'=>$employee->id]) }}">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="first_name">First name</label>
                <input type="text" name="first_name" class="form-control" value="{{ $employee->first_name }}" required>
            </div>
            <div class="form-group col-md-6">
                <label for="last_name">Last name</label>
                <input type="text" name="last_name" class="form-control" value="{{ $employee->last_name }}" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="email">E-mail</label>
                <input type="email" name="email" class="form-control" value="{{ $employee->email }}" required>
            </div>
            <div class="form-group col-md-4">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ $employee->phone }}" required>
            </div>
            <div class="form-group col-md-4">
                <label for="company">Company</label>
                <select id="company" name="company" class="form-control" required>
                    <option selected value="{{ $employee->company->id }}">{{ $employee->company->name }}</option>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ URL::previous() }}" class="btn btn-primary">Cancel</a>
    </form>
@endsection