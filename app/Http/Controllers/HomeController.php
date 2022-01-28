<?php

namespace App\Http\Controllers;

use App\Models\{Art, Category, Comment, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        $art = Art::latest('id')->limit(10)->get();
        $categories = Category::latest('id')->limit(5)->get();
        return view('home', compact('art', 'categories'));
    }

    public function category()
    {
        $categories = Category::latest('id')->paginate(16);
        if (request('filter')) {
            if (request('filter') == 'asc' || request('filter') == 'desc')
                $categories = Category::orderBy('id', request('filter'))->paginate(16);
            if (request('filter') == 'sort-az')
                $categories = Category::orderBy('name', 'asc')->paginate(16);
            if (request('filter') == 'sort-za')
                $categories = Category::orderBy('name', 'decs')->paginate(16);
        }
        return view('category', compact('categories'));
    }

    public function sortByCategory(Category $category)
    {
        $art = Art::where('category_id', $category->id)->paginate(16);
        return view('artworks', compact('art'));
    }

    public function artwork()
    {
        $art = Art::latest('id')->paginate(16);
        if (request('filter')) {
            if (request('filter') == 'asc' || request('filter') == 'desc')
                $art = Art::orderBy('id', request('filter'))->paginate(16);
            if (request('filter') == 'sort-az')
                $art = Art::orderBy('title', 'asc')->paginate(16);
            if (request('filter') == 'sort-za')
                $art = Art::orderBy('title', 'decs')->paginate(16);
        }

        if (request('search'))
            $art = Art::where('title', 'LIKE', '%' . request('search') . '%')->paginate(16);

        return view('artworks', compact('art'));
    }

    public function detail(Art $art)
    {
        $arts = Art::latest('id')->where('user_id', $art->user_id)->select(['image', 'id'])->limit(6)->get();
        $comments = Comment::latest('id')->where('art_id', $art->id)->with('user')->get();
        $categories = Category::orderBy('name', 'asc')->get();
        return view('detail', compact('art', 'arts', 'categories', 'comments'));
    }

    public function download(Art $art)
    {
        return Storage::download($art->image);
    }

    public function user(User $user)
    {
        $arts = Art::latest('id')->where('user_id', $user->id)->paginate(12);
        return view('user', compact('user', 'arts'));
    }

    public function editUser(User $user)
    {
        $this->authorize('update', $user);
        request()->validate(['name' => 'required|string|unique:users,name,' . $user->id, 'photo' => 'mimes:png,jpg,jpeg,svg|max:2048']);
        $photo = request()->hasFile('photo') ? Storage::putFile('users', request()->file('photo')) : $user->photo;
        $user->update(['name' => request('name'), 'photo' => $photo]);
        return back()->with('success', 'Your account has been updated successfully');
    }

    public function upload()
    {
        $category = Category::orderBy('name', 'asc')->get();
        return view('upload', compact('category'));
    }

    public function createArt(Request $request)
    {
        $request->validate(['title' => 'required|string', 'category' => 'required|exists:categories,id', 'description' => 'required|string', 'image' => 'required|mimes:jpg,jpeg,png,svg',]);
        if (!auth()->check())
            return back()->with('failed', 'Belum Login');
        $image = Storage::putFile('art', $request->file('image'));
        Art::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'user_id' => auth()->user()->id,
            'category_id' => $request->category,
            'description' => $request->description,
            'image' => $image,
        ]);
        return back()->with('success', 'New artwork has been added successfully');
    }

    public function editView(Art $art)
    {
        $this->authorize('update', $art);
        $category = Category::orderBy('name', 'asc')->get();
        return view('edit', compact('art', 'category'));
    }

    public function editArt(Art $art)
    {
        $this->authorize('update', $art);
        request()->validate(['title' => 'required|string', 'category' => 'required|exists:categories,id', 'description' => 'required|string', 'image' => 'mimes:jpg,jpeg,png,svg',]);
        $image = Storage::putFile('art', request()->file('image'));
        $art->update([
            'title' => request('title'),
            'slug' => Str::slug(request('title')),
            'user_id' => auth()->user()->id,
            'category_id' => request('category'),
            'description' => request('description'),
            'image' => request()->hasFile('image') ? $image : $art->image,
        ]);
        return back()->with('success', "The artwork ID $art->id has been updated successfully");
    }

    public function deleteArt(Art $art)
    {
        $this->authorize('delete', $art);
        Storage::delete($art->image);
        $art->delete();
        return redirect()->route('users', auth()->user()->id)->with('success', "The artwork ID $art->id has been deleted successfully");
    }
}
