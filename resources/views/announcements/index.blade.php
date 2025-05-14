@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Announcements</h1>
    <a href="{{ route('announcements.create') }}" class="btn btn-primary">Create New Announcement</a>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($announcements as $announcement)
            <tr>
                <td>{{ $announcement->title }}</td>
                <td>
                    <a href="{{ route('announcements.show', $announcement) }}" class="btn btn-info">View</a>
                    <a href="{{ route('announcements.edit', $announcement) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('announcements.destroy', $announcement) }}" method="POST" style="display:inline;">
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