<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Traits\ApiResponses;
use PhpParser\Node\Stmt\Catch_;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    use ApiResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = QueryBuilder::for(Category::class)
            ->allowedFilters(['name'])
            ->defaultSort(['-created_at']) // newest
            ->allowedSorts(['created_at', 'name']);

        $categories = $query
            ->paginate(10);
        return $categories;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $user = Auth::user();
        if ($user->can('create', Category::class)) {
            Category::create($request->validated());
            return $this->success('Category Created');
        }
        return $this->notAuthorized();
    }


    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $user = Auth::user();
        if ($user->can('update', $category)) {
            $category->update($request->validated());
            return $this->success('Category Updated');
        }
        return $this->notAuthorized();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $user = Auth::user();
        if ($user->can('delete', $category)) {
            $category->delete();
            return $this->success('Category Deleted');
        }
        return $this->notAuthorized();
    }
}
