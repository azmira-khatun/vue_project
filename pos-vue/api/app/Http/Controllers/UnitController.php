<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource (GET /api/units).
     */
    public function index()
    {
        // সমস্ত ইউনিট ডেটা JSON ফরম্যাটে রিটার্ন করবে
        $units = Unit::all();
        return response()->json([
            'units' => $units
        ], 200);
    }

    /**
     * Store a newly created resource in storage (POST /api/units).
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255|unique:units',
            ]);

            $unit = Unit::create($validatedData);

            // সফলভাবে তৈরি হলে 201 কোড এবং নতুন ইউনিট ডেটা সহ রেসপন্স
            return response()->json([
                'message' => 'Unit created successfully.',
                'unit' => $unit
            ], 201);

        } catch (ValidationException $e) {
            // ভ্যালিডেশনে সমস্যা হলে 422 কোড এবং ত্রুটিসহ রেসপন্স
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Update the specified resource in storage (PUT/PATCH /api/units/{unit}).
     */
    public function update(Request $request, Unit $unit)
    {
        try {
            $validatedData = $request->validate([
                // ইউনিটটি এডিট করার সময় যেন নিজের নামটিকে unique ভ্যালিডেশনে বাদ দেওয়া হয়
                'name' => 'required|string|max:255|unique:units,name,' . $unit->id,
            ]);

            $unit->update($validatedData);

            // সফলভাবে আপডেট হলে 200 কোড এবং আপডেট হওয়া ইউনিট ডেটা সহ রেসপন্স
            return response()->json([
                'message' => 'Unit updated successfully.',
                'unit' => $unit
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage (DELETE /api/units/{unit}).
     */
    public function destroy(Unit $unit)
    {
        $unit->delete();

        // সফলভাবে ডিলিট হলে 200 কোড সহ রেসপন্স
        return response()->json([
            'message' => 'Unit deleted successfully.'
        ], 200);
    }

    // Vue.js এর জন্য show, create, edit মেথডগুলি API তে অপ্রয়োজনীয় হলেও এখানে রাখা হলো।
    public function show(Unit $unit)
    {
        return response()->json(['unit' => $unit], 200);
    }
    public function create()
    { /* No JSON endpoint needed */
    }
    public function edit(Unit $unit)
    { /* No JSON endpoint needed */
    }
}