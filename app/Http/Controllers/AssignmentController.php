<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:teacher')->except(['index', 'show']);
    }

    public function index()
    {
        $assignments = Assignment::with('teacher')->get();
        return view('assignments.index', compact('assignments'));
    }

    public function create()
    {
        return view('assignments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required|date',
        ]);

        $assignment = new Assignment($request->all());
        $assignment->teacher_id = auth()->id();
        $assignment->save();

        return redirect()->route('assignments.index')
            ->with('success', 'Assignment created successfully.');
    }

    public function show(Assignment $assignment)
    {
        return view('assignments.show', compact('assignment'));
    }

    public function edit(Assignment $assignment)
    {
        if ($assignment->teacher_id !== auth()->id()) {
            abort(403);
        }
        return view('assignments.edit', compact('assignment'));
    }

    public function update(Request $request, Assignment $assignment)
    {
        if ($assignment->teacher_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required|date',
        ]);

        $assignment->update($request->all());
        return redirect()->route('assignments.index')
            ->with('success', 'Assignment updated successfully.');
    }

    public function destroy(Assignment $assignment)
    {
        if ($assignment->teacher_id !== auth()->id()) {
            abort(403);
        }

        $assignment->delete();
        return redirect()->route('assignments.index')
            ->with('success', 'Assignment deleted successfully.');
    }
} 