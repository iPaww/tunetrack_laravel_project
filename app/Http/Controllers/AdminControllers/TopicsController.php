<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Courses;
use App\Models\Topics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TopicsController extends BasePageController
{
    public string $base_file_path = 'topics.';

    // Display all topics
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Query topics and filter by title if search term exists
        $topics = Topics::with('courses')
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', '%' . $search . '%');
            })
            ->paginate(10);

        return $this->view_basic_page($this->base_file_path . 'index', compact('topics'));

    }


    // Show the form to create a new topic
    public function create()
    {
        $courses = Courses::all();
        return $this->view_basic_page($this->base_file_path . 'create', compact('courses'));
    }

    //Edit
    public function edit(Topics $topic)
    {
        $courses = Courses::all();
        return $this->view_basic_page($this->base_file_path . 'edit', compact('topic', 'courses'));
    }
    // Store a newly created topic
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'course_id' => 'required|integer|exists:courses,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'audio' => 'nullable|mimes:mp3,wav,ogg|max:10240',
        ]);

        $topic = new Topics();
        $topic->title = $request->title;
        $topic->description = $request->description;
        $topic->course_id = $request->course_id;

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('topics/images', 'public');
            $topic->image = $imagePath;
        }

        // Handle audio upload
        if ($request->hasFile('audio')) {
            $audioPath = $request->file('audio')->store('topics/audio', 'public');
            $topic->audio = $audioPath;
        }

        $topic->save();

        return redirect()->route('topics.index')->with([
            'message' => 'Topic created successfully.',
            'type' => 'success',
        ]);
    }

    // Update an existing topic
    public function update(Request $request, Topics $topic)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'course_id' => 'required|integer|exists:courses,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'audio' => 'nullable|mimes:mp3,wav,ogg|max:10240',
        ]);

        $topic->title = $request->title;
        $topic->description = $request->description;
        $topic->course_id = $request->course_id;

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($topic->image) {
                Storage::disk('public')->delete($topic->image);
            }
            $imagePath = $request->file('image')->store('topics/images', 'public');
            $topic->image = $imagePath;
        }

        // Handle audio upload
        if ($request->hasFile('audio')) {
            if ($topic->audio) {
                Storage::disk('public')->delete($topic->audio);
            }
            $audioPath = $request->file('audio')->store('topics/audio', 'public');
            $topic->audio = $audioPath;
        }

        $topic->save();

        return redirect()->route('topics.index')->with([
            'message' => 'Topic updated successfully.',
            'type' => 'success',
        ]);
    }

    // Delete a topic
    public function destroy(Topics $topic)
    {
        // Delete the associated audio file if it exists
        if ($topic->audio) {
            Storage::disk('public')->delete($topic->audio);
        }

        $topic->delete();

        return redirect()->route('topics.index')->with([
            'message' => 'Topic deleted successfully.',
            'type' => 'success',
        ]);
    }
}
