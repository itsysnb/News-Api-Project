<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Policies\PostPolicy;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $posts = Post::all();
        return $this->successResponse(PostResource::collection($posts));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\PostRequest $request;
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PostRequest $request)
    {
        $post = Post::create($request->validated());
        return $this->successResponse(PostResource::make($post), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post $post;
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Post $post)
    {
        $this->authorize(PostPolicy::SHOW, $post);
        return $this->successResponse(PostResource::collection($post));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request;
     * @param  Post $post;
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PostRequest $request, Post $post)
    {
        $this->authorize(PostPolicy::UPDATE, $post);
        $attributes = $post->update($request->validated());
        return $this->successResponse([], Response::HTTP_NO_CONTENT);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post  $post;
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Post $post)
    {
        $this->authorize(PostPolicy::DELETE, $post);
        $post->delete();
        return $this->successResponse([], Response::HTTP_NO_CONTENT);
    }
}
