<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Mention;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $images = GalleryImage::with([
            'likes',
            'comments.user',
            'mentions.user'
        ])->latest()->get();

        return view('pages.gallery.index', compact('images'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        return view('pages.admin.gallery.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
            'mentions' => 'nullable|array',
            'mentions.*' => 'exists:users,id',
        ]);

        $path = $request->file('image')->store('gallery', 'public');

        $image = GalleryImage::create([
            'image_url' => $path,
            'description' => $request->description,
            'user_id' => auth()->id(),
        ]);

        // ✅ MULTI MENTIONS
        if ($request->filled('mentions')) {
            foreach ($request->mentions as $userId) {
                Mention::firstOrCreate([
                    'user_id' => $userId,
                    'gallery_image_id' => $image->id,
                ]);
            }
        }

        return redirect()->route('gallery')->with('success', 'Image ajoutée');
    }

    public function like($id)
    {
        $existing = Like::where('user_id', auth()->id())
            ->where('gallery_image_id', $id)
            ->first();

        if ($existing) {
            $existing->delete();
        } else {
            Like::create([
                'user_id' => auth()->id(),
                'gallery_image_id' => $id
            ]);
        }

        return back();
    }

    public function comment(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string'
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'gallery_image_id' => $id,
            'content' => $request->content
        ]);

        return back();
    }

    public function destroy($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        GalleryImage::findOrFail($id)->delete();

        return back()->with('success', 'Post supprimé');
    }

    public function deleteComment($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        Comment::findOrFail($id)->delete();

        return back()->with('success', 'Commentaire supprimé');
    }
    // ✏️ EDIT (ADMIN ONLY)
    public function edit($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $image = \App\Models\GalleryImage::with('mentions')->findOrFail($id);

        return view('pages.admin.gallery.edit', compact('image'));
    }

// 🔄 UPDATE (ADMIN ONLY)
    public function update(Request $request, $id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $image = \App\Models\GalleryImage::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
            'mentions' => 'nullable|array',
            'mentions.*' => 'exists:users,id',
        ]);

        // 📸 update image si changé
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('gallery', 'public');
            $image->image_url = $path;
        }

        // 📝 update description
        $image->description = $request->description;
        $image->save();

        // 🏷️ reset mentions
        \App\Models\Mention::where('gallery_image_id', $image->id)->delete();

        if ($request->filled('mentions')) {
            foreach ($request->mentions as $userId) {
                \App\Models\Mention::create([
                    'user_id' => $userId,
                    'gallery_image_id' => $image->id,
                ]);
            }
        }

        return redirect()->route('gallery')->with('success', 'Post modifié');
    }
}
