<?php

namespace App\Http\Controllers;
use App\Models\Skill;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;

class SkillController extends Controller
{
public function index(Request $request)
{
    $query = Skill::query();

    if ($request->search) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    $skills = $query->get();

    return view('skills.index', compact('skills'));
}

    public function create()
    {
        $this->authorizeSkillManagement();

        $categories = Category::all();

        return view('skills.create', compact('categories'));
    }

    public function show(Skill $skill)
    {
        $reviews = Review::where('session_id', function($q) use ($skill) {
            $q->select('id')->from('skill_sessions')->where('skill_id', $skill->id);
        })->with('session')->get();

        return view('skills.show', compact('skill', 'reviews'));
    }

    public function store(Request $request)
    {
        $this->authorizeSkillManagement();

        $validated = $request->validate([
            'name' => 'required|min:3|max:100',
            'description' => 'required|min:5|max:1000',
            'category_id' => 'required|exists:categories,id',
            'difficulty' => 'required|in:beginner,intermediate,advanced',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('skills', 'public');
        }

        Skill::create($validated);

        return redirect('/skills')->with('success', 'Skill created successfully!');
    }

    public function edit(Skill $skill)
    {
        $this->authorizeSkillManagement();

        $categories = Category::all();

        return view('skills.edit', compact('skill', 'categories'));
    }

    public function update(Request $request, Skill $skill)
    {
        $this->authorizeSkillManagement();

        $validated = $request->validate([
            'name' => 'required|min:3|max:100',
            'description' => 'required|min:5|max:1000',
            'category_id' => 'required|exists:categories,id',
            'difficulty' => 'required|in:beginner,intermediate,advanced',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('skills', 'public');
        }

        $skill->update($validated);

        return redirect('/skills')->with('success', 'Skill updated successfully!');
    }

    public function destroy(Skill $skill)
    {
        $this->authorizeSkillManagement();

        $skill->delete();

        return redirect('/skills');
    }

    private function authorizeSkillManagement(): void
    {
        if (!auth()->check() || (!auth()->user()->isTeacher() && !auth()->user()->isAdmin())) {
            abort(403, 'Only teachers or admins can manage skills');
        }
    }
}