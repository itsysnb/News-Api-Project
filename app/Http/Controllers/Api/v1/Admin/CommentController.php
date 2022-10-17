<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentController extends ApiController
{
    public function store(CommentRequest $request)
    {
        $attributes = Comment::create($request->validated());
        return $this->successResponse(CommentResource::make($attributes), Response::HTTP_CREATED);
    }

    public function show(Post $post)
    {
        $comment = Comment::where('post_id', $post->id)->get();
        return $this->successResponse(CommentResource::collection($comment));
    }
}
