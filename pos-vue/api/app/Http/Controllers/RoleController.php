<?php

namespace App\Http\Controllers;

use App\Models\Role; // ✅ Role মডেল ইম্পোর্ট করা হলো
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // All Roles
    public function index()
    {
        return response()->json(Role::all(), 200);
    }

    // Create Role
    public function store(Request $request)
    {
        $request->validate([
            'role_name' => 'required|string|max:50|unique:roles,role_name',
        ]);

        $role = Role::create([
            'role_name' => $request->role_name,
        ]);

        return response()->json([
            'message' => 'Role created successfully!',
            'role' => $role
        ], 201);
    }

    // Single Role
    public function show($id)
    {
        $role = Role::findOrFail($id);
        return response()->json($role, 200);
    }

    // Update Role
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $request->validate([
            'role_name' => 'required|string|max:50|unique:roles,role_name,' . $id,
        ]);

        $role->update([
            'role_name' => $request->role_name,
        ]);

        return response()->json([
            'message' => 'Role updated successfully!',
            'role' => $role
        ], 200);
    }

    // Delete Role
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return response()->json([
            'message' => 'Role deleted successfully!'
        ], 200);
    }
}
