@extends('layouts.app')
@section('title', 'Reset Password')
@section('content')
    <h1 class="mt-5 mb-4">Reset Password</h1>
    <div class="row justify-content-center">
        <div class="col-md-4">
            @if(!$errors->isEmpty())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">Reset Password</h5>
                </div>
                <div class="card-body">
                    <form method="post">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection