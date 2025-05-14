<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Grade;
use App\Models\Announcement;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->role === 'teacher') {
            $assignments = Assignment::where('teacher_id', $user->id)->get();
            $grades = Grade::where('teacher_id', $user->id)->get();
            $announcements = Announcement::where('teacher_id', $user->id)->get();
        } else {
            $assignments = Assignment::all();
            $grades = Grade::where('student_id', $user->id)->get();
            $announcements = Announcement::all();
        }

        return view('dashboard', compact('assignments', 'grades', 'announcements'));
    }
} 