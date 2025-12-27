<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Read all customers
    public function index()
    {
        return Customer::all();
    }

    // Create new customer
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'customer_email' => 'required|email',
            'customer_phone' => 'required',
            'city' => 'required',
            'country' => 'required',
            'address' => 'required',
        ]);

        $customer = Customer::create($request->all());
        return response()->json($customer, 201);
    }

    // Read single customer
    public function show($id)
    {
        return Customer::findOrFail($id);
    }

    // Update customer
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->update($request->all());
        return response()->json($customer, 200);
    }

    // Delete customer
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return response()->json(null, 204);
    }
}
