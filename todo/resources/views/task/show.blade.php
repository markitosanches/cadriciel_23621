@extends('layouts.app')
@section('title', 'Single Task')
@section('content')

    <h1 class="mt-5 mb-4">Single Task</h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">{{ $task->title }}</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">{{ $task->description }}</p>
                    <ul class="list-unstyled">
                        <li><strong>Completed: </strong> {{ $task->completed ? "Yes" : "No"}}</li>
                        <li><strong>Due Date: </strong> {{ $task->due_date }}</li>
                        <li><strong>Author: </strong> {{ $task->user->name }}</li>
                    </ul>
                </div>
                @auth
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('task.edit', $task->id)}}" class="btn btn-sm btn-outline-success">Edit</a>
                        <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                           Delete
                        </button>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </div>



<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         Are your sure to delete the task number : {{$task->id}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form method="post">
            @method('delete')
            @csrf
            <button type="submit" class="btn  btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection