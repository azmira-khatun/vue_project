<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource (GET /api/categories).
     */
    public function index()
    {
        // সমস্ত ক্যাটেগরি ডেটা JSON ফরম্যাটে রিটার্ন করবে
        $categories = Category::all();
        return response()->json(['categories' => $categories], 200);
    }

    /**
     * Store a newly created resource in storage (POST /api/categories).
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'category_code' => 'required|string|max:50|unique:categories',
                'category_name' => 'required|string|max:255',
            ]);

            $category = Category::create($validatedData);

            // সফলভাবে তৈরি হলে 201 কোড সহ রেসপন্স
            return response()->json([
                'message' => 'Category created successfully.',
                'category' => $category
            ], 201);

        } catch (ValidationException $e) {
            // ভ্যালিডেশনে সমস্যা হলে 422 কোড সহ রেসপন্স
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Update the specified resource in storage (PUT/PATCH /api/categories/{category}).
     */
    public function update(Request $request, Category $category)
    {
        try {
            $validatedData = $request->validate([
                // এডিট করার সময় যেন নিজের কোডটিকে ইউনিক ভ্যালিডেশনে বাদ দেওয়া হয়
                'category_code' => 'required|string|max:50|unique:categories,category_code,' . $category->id,
                'category_name' => 'required|string|max:255',
            ]);

            $category->update($validatedData);

            // সফলভাবে আপডেট হলে 200 কোড সহ রেসপন্স
            return response()->json([
                'message' => 'Category updated successfully.',
                'category' => $category
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage (DELETE /api/categories/{category}).
     */
    public function destroy(Category $category)
    {
        $category->delete();

        // সফলভাবে ডিলিট হলে 200 কোড সহ রেসপন্স
        return response()->json([
            'message' => 'Category deleted successfully.'
        ], 200);
    }

    // ঐচ্ছিক মেথড
    public function show(Category $category)
    {
        return response()->json(['category' => $category], 200);
    }
}