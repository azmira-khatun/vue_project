// src/role/permissions.js

// Example: check if the user has a permission
export function can(permission) {
  // Get user permissions from localStorage or store
  // Adjust this based on how you store permissions in your auth
  const userPermissions = JSON.parse(localStorage.getItem("permissions")) || [];

  return userPermissions.includes(permission);
}
