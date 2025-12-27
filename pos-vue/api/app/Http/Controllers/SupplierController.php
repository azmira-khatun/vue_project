<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource (GET /suppliers).
     * Returns JSON list of suppliers.
     */
    public function index()
    {
        // Vue component-এর জন্য JSON ডেটা রিটার্ন
        return Supplier::all();
    }

    /**
     * Store a newly created resource in storage (POST /suppliers).
     * Returns JSON data of the created supplier.
     */
    public function store(Request $request)
    {
        // Validation (আপনার আগের ফাইল অনুযায়ী)
        $request->validate([
            'supplier_name' => 'required',
            'supplier_email' => 'required|email|unique:suppliers',
            'supplier_phone' => 'required',
            'city' => 'required',
            'country' => 'required',
            'address' => 'required',
        ]);

        $supplier = Supplier::create($request->all());
        // JSON response সহ 201 Status code রিটার্ন
        return response()->json($supplier, 201);
    }

    /**
     * Display the specified resource (GET /suppliers/{id}).
     */
    public function show(Supplier $supplier)
    {
        // JSON ডেটা রিটার্ন
        return $supplier;
    }

    /**
     * Update the specified resource in storage (PUT /suppliers/{id}).
     * Returns JSON data of the updated supplier.
     */
    public function update(Request $request, Supplier $supplier)
    {
        // Validation with unique email check ignoring current ID
        $request->validate([
            'supplier_name' => 'required',
            'supplier_email' => 'required|email|unique:suppliers,supplier_email,' . $supplier->id,
            'supplier_phone' => 'required',
            'city' => 'required',
            'country' => 'required',
            'address' => 'required',
        ]);

        $supplier->update($request->all());
        // JSON response সহ 200 Status code রিটার্ন
        return response()->json($supplier, 200);
    }

    /**
     * Remove the specified resource from storage (DELETE /suppliers/{id}).
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        // 204 No Content Status code রিটার্ন
        return response()->json(null, 204);
    }
}