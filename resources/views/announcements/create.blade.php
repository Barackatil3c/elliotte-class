@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Announcement</h1>
    <form action="{{ route('announcements.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="6" required>{{ old('content') }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create Announcement</button>
        <a href="{{ route('announcements.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection 