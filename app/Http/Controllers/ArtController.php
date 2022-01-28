<?php

namespace App\Http\Controllers;

use App\Models\{Art, Category};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArtController extends Controller
{

    public function index()
    {
        $art = Art::latest('id')->paginate(10);
        return view('admin.art.art', compact('art'));
    }

    public function create()
    {
        $category = Category::orderBy('name')->get();
        return view('admin.art.create', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string', 'category' => 'required|exists:categories,id', 'description' => 'required|string', 'image' => 'required|mimes:jpg,jpeg,png,svg',]);
        $image = Storage::putFile('art', $request->file('image'));
        Art::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'user_id' => auth()->user()->id,
            'category_id' => $request->category,
            'description' => $request->description,
            'image' => $image,
        ]);
        return back()->with('success', 'New data has been added successfully');
    }

    public function edit(Art $art)
    {
        $category = Category::orderBy('name')->get();
        return view('admin.art.edit', compact('category', 'art'));
    }

    public function update(Request $request, Art $art)
    {
        $request->validate(['title' => 'required|string', 'category' => 'required|exists:categories,id', 'description' => 'required|string', 'image' => 'mimes:jpg,jpeg,png,svg',]);
        if ($request->hasFile('image')) {
            $image = Storage::putFile('art', $request->file('image'));
            Storage::delete($art->thumbnail);
        }
        $art->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'user_id' => auth()->user()->id,
            'category_id' => $request->category,
            'description' => $request->description,
            'image' => $image ?? $art->image,
        ]);
        return back()->with('success', 'Data has been updated successfully');
    }

    public function destroy(Art $art)
    {
        Storage::delete($art->image);
        $art->delete();
        return back()->with('success', 'Data has been Deleted successfully!');
    }
}
