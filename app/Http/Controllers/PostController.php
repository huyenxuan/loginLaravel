<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ], [
            'title.required' => 'Không được để trống tiêu đề.',
            'title.max' => 'Tiêu đề không quá 255 ký tự.',
            'content.required' => 'Không được để trống nội dung.',
        ]);

        Post::create($request->all());

        return redirect()->route('posts.index')->with('success', 'Tạo bài viết thành công.');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ], [
            'title.required' => 'Không được để trống tiêu đề.',
            'title.max' => 'Tiêu đề không quá 255 ký tự.',
            'content.required' => 'Không được để trống nội dung.',
        ]);

        $post->update($request->all());
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Xóa bài viết thành công.');
    }
}
