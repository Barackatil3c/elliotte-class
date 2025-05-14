<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:teacher')->except(['index', 'show']);
    }

    public function index()
    {
        $announcements = Announcement::with('teacher')->latest()->get();
        return view('announcements.index', compact('announcements'));
    }

    public function create()
    {
        return view('announcements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $announcement = new Announcement($request->all());
        $announcement->teacher_id = auth()->id();
        $announcement->save();

        return redirect()->route('announcements.index')
            ->with('success', 'Announcement created successfully.');
    }

    public function show(Announcement $announcement)
    {
        return view('announcements.show', compact('announcement'));
    }

    public function edit(Announcement $announcement)
    {
        if ($announcement->teacher_id !== auth()->id()) {
            abort(403);
        }
        return view('announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        if ($announcement->teacher_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $announcement->update($request->all());
        return redirect()->route('announcements.index')
            ->with('success', 'Announcement updated successfully.');
    }

    public function destroy(Announcement $announcement)
    {
        if ($announcement->teacher_id !== auth()->id()) {
            abort(403);
        }

        $announcement->delete();
        return redirect()->route('announcements.index')
            ->with('success', 'Announcement deleted successfully.');
    }
} 