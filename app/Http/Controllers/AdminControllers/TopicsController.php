<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\sub_category;
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
        $topics = Topics::with('sub_category')
            ->when($search, function($query, $search) {
                // Filter topics by the title field using "like" for partial matches
                return $query->where('title', 'like', '%' . $search . '%');
            })
            ->get(); // Execute the query

        return $this->view_basic_page($this->base_file_path . 'index', compact('topics'));
    }


    // Show the form to create a new topic
    public function create()
    {
        $sub_category = sub_category::all(); // Fetch all sub-categories for the dropdown
        return $this->view_basic_page($this->base_file_path . 'create', compact('sub_category'));
    }

    // Store a newly created topic
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'sub_category_id' => 'required|integer|exists:sub_category,id', // Foreign key validation
            'audio' => 'nullable|mimes:mp3,wav,ogg|max:10240', // Validate audio file (optional)
        ]);

        $topic = new Topics();
        $topic->title = $request->title;
        $topic->description = $request->description;
        $topic->sub_category_id = $request->sub_category_id;

        // Handle audio file upload
        if ($request->hasFile('audio')) {
            $audioPath = $request->file('audio')->store('audio', 'public');
            $topic->audio = $audioPath;
        }

        $topic->save();

        return redirect()->route('topics.index')->with('success', 'Topic created successfully.')
        ->with('message', 'Topic created successfully.')
        ->with('type', 'success');  // You can customize the type to 'success', 'danger', etc.
    }

    // Show the form to edit an existing topic
    public function edit(Topics $topic)
    {
        $sub_category = sub_category::all();
        return $this->view_basic_page($this->base_file_path . 'edit', compact('topic', 'sub_category'));
    }

    // Update the specified topic
    public function update(Request $request, Topics $topic)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'sub_category_id' => 'required|integer|exists:sub_category,id', // Foreign key validation
            'audio' => 'nullable|mimes:mp3,wav,ogg|max:10240', // Validate audio file (optional)
        ]);

        $topic->title = $request->title;
        $topic->description = $request->description;
        $topic->sub_category_id = $request->sub_category_id;

        // Handle audio file upload (only if a new file is provided)
        if ($request->hasFile('audio')) {
            if ($topic->audio) {
                Storage::disk('public')->delete($topic->audio); // Delete the old audio file if it exists
            }
            $audioPath = $request->file('audio')->store('audio', 'public');
            $topic->audio = $audioPath;
        }

        $topic->save();

        return redirect()->route('topics.index')->with('success', 'Topic updated successfully.')
        ->with('message', 'Topic updated successfully.')
        ->with('type', 'success');
    }

    // Delete a topic
    public function destroy(Topics $topic)
    {
        // Delete the associated audio file if it exists
        if ($topic->audio) {
            Storage::disk('public')->delete($topic->audio);
        }

        $topic->delete();

        return redirect()->route('topics.index')->with('success', 'Topic deleted successfully.')
        ->with('message', 'Topic deleted successfully.')
        ->with('type', 'success');
    }
}
