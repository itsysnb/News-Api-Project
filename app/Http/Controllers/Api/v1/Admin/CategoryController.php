<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends ApiController
{
    public function index()
    {
        $categories = Category::all();
        return $this->successResponse(CategoryResource::collection($categories));
    }

    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->validated());
        return $this->successResponse(CategoryResource::make($category), Response::HTTP_CREATED);
    }

    public function show(Category $category)
    {
        $attribute = $category->where('id', $category->id)->get();
        return $this->successResponse(CategoryResource::collection($attribute));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return $this->successResponse(['this category updated success.']);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return $this->successResponse('This Category Deleted Success.');
    }
}
