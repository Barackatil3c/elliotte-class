@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Grade Details</h1>
    
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Assignment</h5>
            <p class="card-text">{{ $grade->assignment->title }}</p>
            
            <h5 class="card-title">Student</h5>
            <p class="card-text">{{ $grade->student->name }}</p>
            
            <h5 class="card-title">Score</h5>
            <p class="card-text">{{ $grade->score }}</p>
            
            <h5 class="card-title">Graded on</h5>
            <p class="card-text">{{ $grade->created_at->format('F j, Y') }}</p>
        </div>
    </div>

    @if(auth()->user()->role === 'teacher')
        <a href="{{ route('grades.edit', $grade) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('grades.destroy', $grade) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    @endif

    <a href="{{ route('grades.index') }}" class="btn btn-secondary">Back to Grades</a>
</div>
@endsection 