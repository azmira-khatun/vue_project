<template>
    <div class="container mt-5">
        <h2 class="mb-4">Add New Role</h2>

        <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
        <div v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</div>

        <form @submit.prevent="createRole">
            <div class="mb-3">
                <label for="role_name" class="form-label">Role Name</label>
                <input type="text" id="role_name" v-model="role_name" class="form-control" placeholder="Enter role name"
                    required />
            </div>

            <button type="submit" class="btn btn-primary">Create Role</button>
            <router-link to="/roles" class="btn btn-secondary ms-2">Back</router-link>
        </form>
    </div>
</template>

<script>
import { ref } from 'vue';
import axios from 'axios';

export default {
    name: 'AddRole',
    setup() {
        const role_name = ref('');
        const successMessage = ref('');
        const errorMessage = ref('');

        const createRole = async () => {
            successMessage.value = '';
            errorMessage.value = '';

            try {
                const response = await axios.post('http://127.0.0.1:8000/api/roles', {
                    role_name: role_name.value
                });
                successMessage.value = 'Role created successfully!';
                role_name.value = ''; // reset input
            } catch (error) {
                if (error.response && error.response.data && error.response.data.errors) {
                    errorMessage.value = Object.values(error.response.data.errors).join(', ');
                } else {
                    errorMessage.value = 'An error occurred while creating the role.';
                }
            }
        };

        return {
            role_name,
            successMessage,
            errorMessage,
            createRole
        };
    }
};
</script>

<style scoped>
.btn+.btn {
    margin-left: 5px;
}
</style>
