<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    public function create(){
        return view('categories.create');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|min:3|max:50',
        'description' => 'required|min:5|max:255'
    ]);

    Category::create($request->all());

    return redirect('/categories')->with('success', 'Category created successfully!');
}
    public function show(Category $category)
    {
        $skills = $category->skills()->with(['users' => function ($query) {
            $query->wherePivot('is_teaching', true);
        }])->get();

        return view('categories.show', compact('category', 'skills'));
    }
public function update(Request $request, Category $category)
{
    $request->validate([
        'name' => 'required|min:3|max:50',
        'description' => 'required|min:5|max:255'
    ]);

    $category->update($request->all());

    return redirect('/categories')->with('success', 'Category updated!');
}

public function destroy(Category $category)
{
    $category->delete();
    return redirect('/categories')->with('success', 'Category deleted successfully!');
}

}