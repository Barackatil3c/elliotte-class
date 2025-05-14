@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $announcement->title }}</h1>
    
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Content</h5>
            <p class="card-text">{{ $announcement->content }}</p>
            
            <h5 class="card-title">Posted by</h5>
            <p class="card-text">{{ $announcement->teacher->name }}</p>
            
            <h5 class="card-title">Posted on</h5>
            <p class="card-text">{{ $announcement->created_at->format('F j, Y') }}</p>
        </div>
    </div>

    @if(auth()->user()->role === 'teacher')
        <a href="{{ route('announcements.edit', $announcement) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('announcements.destroy', $announcement) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    @endif

    <a href="{{ route('announcements.index') }}" class="btn btn-secondary">Back to Announcements</a>
</div>
@endsection 