<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')
            ->orderBy('id', 'ASC')
            ->paginate(10);

        return response()->json($posts);
    }

    public function create()
    {
        dd('create');
    }

    public function store(Request $request)
    {
        $image = $request->file('photo');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $url = $image->storeAs('images', $imageName, 'public');
        $path = Storage::url($url);

        $post = new Post();
        $post->photo = $imageName;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = $request->user_id;
        $post->save();

        return response()->json($post);
    }

    public function show(string $id)
    {
        $post = Post::find($id);
        return response()->json($post);
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'photo' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $url = $image->storeAs('images', $imageName, 'public');
            $path = Storage::url($url);
            $post->photo = $path;
        }

        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();

        return response()->json($post);
    }

    public function destroy(string $id)
    {
        $post = Post::find($id);

        if ($post) {
            $post->delete();
        }
    }

    public function userPosts($id)
    {
        $user = User::with('posts')->find($id);
        return response()->json($user);
    }
}
