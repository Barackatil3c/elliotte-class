@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Assignment</h1>
    <form action="{{ route('assignments.update', $assignment) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $assignment->title) }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required>{{ old('description', $assignment->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="due_date" class="form-label">Due Date</label>
            <input type="date" class="form-control @error('due_date') is-invalid @enderror" id="due_date" name="due_date" value="{{ old('due_date', $assignment->due_date) }}" required>
            @error('due_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Assignment</button>
        <a href="{{ route('assignments.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection 