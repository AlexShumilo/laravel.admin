@extends('layouts.admin_layout')

@section('content')
    <h2>Create new Employee</h2>
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{ route('employees.store') }}">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="first_name">First name</label>
                <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" placeholder="Enter employee's first name" required>
            </div>
            <div class="form-group col-md-6">
                <label for="last_name">Last name</label>
                <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" placeholder="Enter employee's last name" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="email">E-mail</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter employee's e-mail" required>
            </div>
            <div class="form-group col-md-4">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="Enter employee's phone" required>
            </div>
            <div class="form-group col-md-4">
                <label for="company">Company</label>
                <select id="company" name="company" class="form-control" required>
                    <option selected>Select...</option>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection