@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $assignment->title }}</h1>
    
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Description</h5>
            <p class="card-text">{{ $assignment->description }}</p>
            
            <h5 class="card-title">Due Date</h5>
            <p class="card-text">{{ $assignment->due_date }}</p>
            
            <h5 class="card-title">Created by</h5>
            <p class="card-text">{{ $assignment->teacher->name }}</p>
        </div>
    </div>

    @if(auth()->user()->role === 'teacher')
        <a href="{{ route('assignments.edit', $assignment) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('assignments.destroy', $assignment) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    @endif

    <a href="{{ route('assignments.index') }}" class="btn btn-secondary">Back to Assignments</a>
</div>
@endsection 