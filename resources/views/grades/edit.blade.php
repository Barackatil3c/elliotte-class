@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Grade</h1>
    <form action="{{ route('grades.update', $grade) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="assignment_id" class="form-label">Assignment</label>
            <select class="form-control @error('assignment_id') is-invalid @enderror" id="assignment_id" name="assignment_id" required>
                <option value="">Select Assignment</option>
                @foreach($assignments as $assignment)
                    <option value="{{ $assignment->id }}" {{ old('assignment_id', $grade->assignment_id) == $assignment->id ? 'selected' : '' }}>
                        {{ $assignment->title }}
                    </option>
                @endforeach
            </select>
            @error('assignment_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="student_id" class="form-label">Student</label>
            <select class="form-control @error('student_id') is-invalid @enderror" id="student_id" name="student_id" required>
                <option value="">Select Student</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ old('student_id', $grade->student_id) == $student->id ? 'selected' : '' }}>
                        {{ $student->name }}
                    </option>
                @endforeach
            </select>
            @error('student_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="score" class="form-label">Score</label>
            <input type="number" step="0.01" min="0" max="100" class="form-control @error('score') is-invalid @enderror" id="score" name="score" value="{{ old('score', $grade->score) }}" required>
            @error('score')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Grade</button>
        <a href="{{ route('grades.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection 