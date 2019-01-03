@extends('layouts.admin_layout')

@section('content')
    <h2>Create new Company</h2>
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{ route('companies.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="company_name">Company name</label>
                <input type="text" name="company_name" class="form-control" id="company_name" value="{{ old('company_name') }}" placeholder="Enter Company name" required>
            </div>
            <div class="form-group col-md-4">
                <label for="company_email">Company E-mail</label>
                <input type="email" name="company_email" class="form-control" id="company_email" value="{{ old('company_email') }}" placeholder="Enter Company e-mail" required>
            </div>
            <div class="form-group col-md-4">
                <label for="company_site">Company website</label>
                <input type="text" name="company_site" class="form-control" id="company_site" value="{{ old('company_site') }}" placeholder="Enter Company website" required>
            </div>
        </div>
        <div class="form-group col-md-5">
            <label>Company logo</label>
            <input type="file" name="image" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection