@extends('layouts.app')
@section('title', 'Edit Task')
@section('content')
    <h1 class="mt-5 mb-4">Edit Task</h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">Edit Task</h5>
                </div>
                <div class="card-body">
                    
                    <form method="post">
                        @method('put')
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $task->title)}}">
                            @if($errors->has('title'))
                                <div class="text-danger mt-2">
                                    {{ $errors->first('title')}}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" name="description" class="form-control" rows="3">{{ old('description', $task->description)}}</textarea>
                            @if($errors->has('description'))
                                <div class="text-danger mt-2">
                                    {{ $errors->first('description')}}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="completed" class="form-check-label">Completed</label>
                            <input type="checkbox" id="completed" name="completed" class="form-check-input" value="1" {{ old('completed', $task->completed) ? 'checked' : ''}}>
                            @if($errors->has('completed'))
                                <div class="text-danger mt-2">
                                    {{ $errors->first('completed')}}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="due_date" class="form-label">Due Date</label>
                            <input type="date" id="due_date" name="due_date" class="form-control" value="{{ old('due_date', $task->due_date)}}">
                            @if($errors->has('due_date'))
                                <div class="text-danger mt-2">
                                    {{ $errors->first('due_date')}}
                                </div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection