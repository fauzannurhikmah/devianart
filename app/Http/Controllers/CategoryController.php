<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::orderBy('name', 'asc')->paginate(10);
        return view('admin.category', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string', 'thumbnail' => 'required|mimes:jpg,jpeg,png,svg|max:3254']);
        $thumbnail = Storage::putFile('category', $request->file('thumbnail'));
        Category::create(['name' => $request->name, 'slug' => Str::slug($request->name), 'thumbnail' => $thumbnail]);

        return back()->with('success', 'New data has been added successfully!');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate(['name' => 'required|string', 'thumbnail' => 'mimes:jpg,jpeg,png,svg|max:3254']);
        if ($request->hasFile('thumbnail')) {
            $thumbnail = Storage::putFile('category', $request->file('thumbnail'));
            Storage::delete($category->thumbnail);
        }
        $category->update(['name' => $request->name, 'slug' => Str::slug($request->name), 'thumbnail' => $thumbnail ?? $category->thumbnail]);

        return back()->with('success', 'Data has been updated successfully!');
    }

    public function destroy(Category $category)
    {
        Storage::delete($category->thumbnail);
        $category->delete();
        return back()->with('success', 'Data has been Deleted successfully!');
    }
}
