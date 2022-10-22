<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

final class PostPolicy
{
    const UPDATE = 'update';
    const SHOW = 'show';
    const DELETE = 'delete';

    public function update(User $user, Post $post)
    {
        return $user->is($post->user);
    }

    public function show(User $user, Post $post)
    {
        return $user->is($post->user);
    }

    public function delete(User $user, Post $post)
    {
        return $user->is($post->user);
    }
}
