@extends('layouts.app')
@section('title', 'Users')
@section('content')
    <h1 class="mt-5 mb-4">Users</h1>
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Users
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Tasks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name}}</td>
                                    <td>{{ $user->email}}</td>
                                    <td>
                                        <ul>
                                            @forelse($user->tasks as $task)
                                                <li>{{ $task->title }}</li>
                                            @empty
                                            <li class="text-danger">There is not task</li>
                                            @endforelse
                                        </ul>
                                    </td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users}}
                </div>
            </div>
        </div>
    </div>
@endsection