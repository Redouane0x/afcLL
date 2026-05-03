<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    // 📰 PUBLIC
    public function index()
    {
        $news = News::where('is_published', true)->latest()->get();
        return view('pages.news.index', compact('news'));
    }

    // ➕ CREATE
    public function create()
    {
        return view('pages.admin.news.create');
    }

    // 💾 STORE
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image'
        ]);

        $path = $request->file('image')?->store('news', 'public');

        News::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $path,
            'is_published' => $request->has('is_published')
        ]);

        return redirect()->route('news.index');
    }

    // ✏️ EDIT
    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('pages.admin.news.edit', compact('news'));
    }

    // 🔄 UPDATE
    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('news', 'public');
            $news->image = $path;
        }

        $news->update([
            'title' => $request->title,
            'content' => $request->content,
            'is_published' => $request->has('is_published')
        ]);

        return redirect()->route('news.index')->with('success', 'Actu modifiée');
    }

    // 🗑 DELETE
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return back()->with('success', 'Actu supprimée');
    }
    public function adminIndex()
    {
        $news = News::latest()->get();
        return view('pages.admin.news.index', compact('news'));
    }
}
