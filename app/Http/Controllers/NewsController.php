<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsComment;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    // PUBLIC
    public function index()
    {
        $featured = News::where('is_published', true)
            ->where('is_featured', true)
            ->latest()
            ->first();

        $news = News::with('comments.user')
            ->where('is_published', true)
            ->latest()
            ->get();

        return view('pages.news.index', compact('news', 'featured'));
    }

    // ADMIN LIST
    public function adminIndex()
    {
        $news = News::latest()->get();
        return view('pages.admin.news.index', compact('news'));
    }

    // CREATE
    public function create()
    {
        return view('pages.admin.news.create');
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image'
        ]);

        if ($request->has('is_featured')) {
            News::where('is_featured', true)->update(['is_featured' => false]);
        }

        $path = $request->file('image')?->store('news', 'public');

        News::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $path,
            'is_published' => $request->has('is_published'),
            'is_featured' => $request->has('is_featured'),
        ]);

        return redirect()->route('admin.news.index');
    }

    // EDIT
    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('pages.admin.news.edit', compact('news'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image'
        ]);

        if ($request->has('is_featured')) {
            News::where('is_featured', true)->update(['is_featured' => false]);
        }

        if ($request->hasFile('image')) {
            $news->image = $request->file('image')->store('news', 'public');
        }

        $news->update([
            'title' => $request->title,
            'content' => $request->content,
            'is_published' => $request->has('is_published'),
            'is_featured' => $request->has('is_featured'),
        ]);

        return redirect()->route('admin.news.index');
    }

    // DELETE NEWS
    public function destroy($id)
    {
        News::findOrFail($id)->delete();
        return back();
    }

    // COMMENT
    public function comment(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:500'
        ]);

        NewsComment::create([
            'news_id' => $id,
            'user_id' => auth()->id(),
            'content' => $request->content
        ]);

        return back();
    }
}
