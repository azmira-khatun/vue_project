<template>
    <div class="container-xxl py-4">
        <h2 class="mb-4">Roles List</h2>
        <router-link to="/roles/create" class="btn btn-primary mb-3">Add New Role</router-link>

        <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Role Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="role in roles" :key="role.id">
                    <td>{{ role.id }}</td>
                    <td>{{ capitalize(role.role_name) }}</td>
                    <td>
                        <router-link :to="`/roles/edit/${role.id}`" class="btn btn-warning btn-sm">Edit</router-link>
                        <button class="btn btn-danger btn-sm" @click="deleteRole(role.id)">
                            Delete
                        </button>
                    </td>
                </tr>
                <tr v-if="roles.length === 0">
                    <td colspan="3" class="text-center">No roles found.</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const roles = ref([]);
const successMessage = ref('');

const fetchRoles = async () => {
    try {
        const response = await axios.get('http://127.0.0.1:8000/api/roles');
        roles.value = response.data;
    } catch (error) {
        console.error('Error fetching roles:', error);
    }
};

const deleteRole = async (id) => {
    if (!confirm('Are you sure?')) return;

    try {
        await axios.delete(`/api/roles/${id}`);
        successMessage.value = 'Role deleted successfully!';
        fetchRoles();
    } catch (error) {
        console.error('Error deleting role:', error);
    }
};

const capitalize = (str) => str.charAt(0).toUpperCase() + str.slice(1);

onMounted(() => {
    fetchRoles();
});
</script>

<style scoped>
.btn+.btn {
    margin-left: 5px;
}
</style>
