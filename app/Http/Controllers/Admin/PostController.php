<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderby('id', 'desc')
            ->paginate(config('constants.limit_page'));
        return view('admin.post.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.post.create');
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->only('title', 'content');
        $new_post = Post::create($data);
        if ($request->hasfile('images')) {
            $path_images = [];
            foreach ($request->file('images') as $file) {
                $path_images[] =  $file->store(sprintf('posts/%s', $new_post->id), 'public');
            }
            $data['images'] = $path_images;
        }
        $new_post->update([
            'images' => $data['images']
        ]);
        return redirect(route('admin.post.edit', ['id' => $new_post->id]))
            ->with('alert-success', trans('alert.create.success'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.post.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, $id)
    {
        $data = $request->only('title', 'content');
        $post = Post::findOrFail($id);
        if ($request->hasfile('images')) {
            $path_images = [];
            Storage::disk('public')->delete(json_decode($post->getRawOriginal('images')));
            foreach ($request->file('images') as $file) {
                $path_images[] =  $file->store(sprintf('posts/%s', $post->id), 'public');
            }
            $data['images'] = $path_images;
        }
        $post->update($data);

        return back()->with('alert-success', trans('alert.update.success'));
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);
        Storage::disk('public')->delete(json_decode($post->getRawOriginal('images')));
        $post->delete();
        return back()->with('alert-success', trans('alert.delete.success'));
    }
}
