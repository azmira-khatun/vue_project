<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource (GET /suppliers).
     */
    public function index()
    {
        // JSON লিস্ট রিটার্ন করা
        return Supplier::all();
    }

    /**
     * Store a newly created resource in storage (POST /suppliers).
     */
    public function store(Request $request)
    {
        // Validation
        $validatedData = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'supplier_email' => 'required|email|unique:suppliers,supplier_email',
            'supplier_phone' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'address' => 'required|string',
        ]);

        $supplier = Supplier::create($validatedData);
        // সফলভাবে সেভ হলে 201 Created স্ট্যাটাস কোড এবং JSON ডেটা রিটার্ন
        return response()->json($supplier, 201);
    }

    /**
     * Display the specified resource (GET /suppliers/{id}).
     */
    public function show(Supplier $supplier)
    {
        return $supplier;
    }

    /**
     * Update the specified resource in storage (PUT /suppliers/{id}).
     */
    public function update(Request $request, Supplier $supplier)
    {
        // Validation (Unique email check ignoring current ID)
        $validatedData = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'supplier_email' => 'required|email|unique:suppliers,supplier_email,' . $supplier->id,
            'supplier_phone' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'address' => 'required|string',
        ]);

        $supplier->update($validatedData);
        // সফলভাবে আপডেট হলে 200 OK স্ট্যাটাস কোড এবং JSON ডেটা রিটার্ন
        return response()->json($supplier, 200);
    }

    /**
     * Remove the specified resource from storage (DELETE /suppliers/{id}).
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        // সফলভাবে ডিলিট হলে 204 No Content স্ট্যাটাস কোড রিটার্ন
        return response()->json(null, 204);
    }
}