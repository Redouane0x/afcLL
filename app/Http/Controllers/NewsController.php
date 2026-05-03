<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::where('is_published', true)->latest()->get();
        return view('pages.news.index', compact('news'));
    }

    public function create()
    {
        return view('pages.admin.news.create');
    }

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

        return redirect()->route('admin.news')->with('success', 'Actu créée');
    }
}
