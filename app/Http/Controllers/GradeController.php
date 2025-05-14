<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Assignment;
use App\Models\User;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:teacher')->except(['index', 'show']);
    }

    public function index()
    {
        $grades = Grade::with(['assignment', 'student'])->get();
        return view('grades.index', compact('grades'));
    }

    public function create()
    {
        $assignments = Assignment::all();
        $students = User::where('role', 'student')->get();
        return view('grades.create', compact('assignments', 'students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'assignment_id' => 'required|exists:assignments,id',
            'student_id' => 'required|exists:users,id',
            'score' => 'required|numeric|min:0|max:100',
        ]);

        Grade::create($request->all());
        return redirect()->route('grades.index')
            ->with('success', 'Grade created successfully.');
    }

    public function show(Grade $grade)
    {
        return view('grades.show', compact('grade'));
    }

    public function edit(Grade $grade)
    {
        $assignments = Assignment::all();
        $students = User::where('role', 'student')->get();
        return view('grades.edit', compact('grade', 'assignments', 'students'));
    }

    public function update(Request $request, Grade $grade)
    {
        $request->validate([
            'assignment_id' => 'required|exists:assignments,id',
            'student_id' => 'required|exists:users,id',
            'score' => 'required|numeric|min:0|max:100',
        ]);

        $grade->update($request->all());
        return redirect()->route('grades.index')
            ->with('success', 'Grade updated successfully.');
    }

    public function destroy(Grade $grade)
    {
        $grade->delete();
        return redirect()->route('grades.index')
            ->with('success', 'Grade deleted successfully.');
    }
} 