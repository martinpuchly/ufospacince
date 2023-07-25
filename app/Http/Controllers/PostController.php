<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use App\Http\Requests\PostRequest;
use Illuminate\Http\RedirectResponse; 
use Illuminate\Database\Eloquent\Builder;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function adminIndex()
    {
        return Inertia::render('Admin/Posts/Index', [
            'posts'=>Post::withTrashed()
                            ->with(['user' => function ($query) {
                                    $query->select('id', 'name');
                                }])
                            ->orderBy('created_at', 'ASC')->get()
        ]);
    }

        /**
     * Display a listing of the resource.
     */
    public function index(String $tag = null)
    {
        return Inertia::render('Posts/Index', [
            'posts' => Post::orderBy('published_at', 'DESC')->with(['user' => function ($query) {
                                                                $query->select('id', 'name');
                                                            }])
                                                            ->when($tag, function (Builder $query, string $tag) {
                                                                $query->where('tags', 'like', '%'.$tag.'%');
                                                            })
                                                            ->publish()
                                                            ->paginate(5),
            'tag'=> $tag ? $tag : null
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): InertiaResponse
    {
        return Inertia::render('Admin/Posts/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request): RedirectResponse
    {
        $post = Post::create($request->only(['title', 'slug', 'intro', 'body', 'tags', 'published', 'published_at', 'keywords', 'description', 'user_id']));
        return redirect()->route('admin.post.edit', ['post'=>$post->id])->with('succeed', 'Článok bol pridaný.');

    }

    /**
     * Display the specified resource.
     */
    public function show($post_slug)
    {
        return Inertia::render('Posts/Show', [
            'post' => Post::orderBy('published_at', 'DESC')->where('slug', $post_slug)
                                                            ->with(['user' => function ($query) {
                                                                $query->select('id', 'name');
                                                            }])
                                                            ->publish()
                                                            ->first()
        ]);//
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post): InertiaResponse
    {
        return Inertia::render('Admin/Posts/Edit', [
            'post'=>$post
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->only(['title', 'slug', 'intro', 'body', 'tags', 'published', 'published_at', 'keywords', 'description', 'user_id']));
        return redirect()->route('admin.post.edit', ['post'=>$post->id])->with('succeed', 'Článok bol upravený.');
    }



    public function delete(Post $post): RedirectResponse
    {
        $post->delete();
        return back()->with('succeed', 'Článok bola vymazaný.');
    }


    public function restore($post_id): RedirectResponse
    {
        $post = Post::withTrashed()->findOrFail($post_id);
        $post->restore();
        return back()->with('succeed', 'Článok bol obnovený.');
    }

    public function destroy($post_id): RedirectResponse
    {
        $post = Post::withTrashed()->findOrFail($post_id);
        $post->forceDelete();
        return back()->with('succeed', 'Článok bola trvale vymazaný.');
    }
}
