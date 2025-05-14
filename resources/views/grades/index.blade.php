@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Grades</h1>
    <a href="{{ route('grades.create') }}" class="btn btn-primary">Create New Grade</a>
    <table class="table">
        <thead>
            <tr>
                <th>Assignment</th>
                <th>Student</th>
                <th>Score</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($grades as $grade)
            <tr>
                <td>{{ $grade->assignment->title }}</td>
                <td>{{ $grade->student->name }}</td>
                <td>{{ $grade->score }}</td>
                <td>
                    <a href="{{ route('grades.show', $grade) }}" class="btn btn-info">View</a>
                    <a href="{{ route('grades.edit', $grade) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('grades.destroy', $grade) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 