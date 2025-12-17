<template>
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0">📦 Unit Management</h3>

                <button class="btn btn-primary" @click="showCreateModal = true">
                    <i class="fa fa-plus me-2"></i> Add New Unit
                </button>
            </div>

            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">#</th>
                            <th scope="col">Unit Name</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="loading">
                            <td colspan="4" class="text-center">Loading Units...</td>
                        </tr>

                        <tr v-else-if="error">
                            <td colspan="4" class="text-center text-danger">{{ error }}</td>
                        </tr>

                        <tr v-else v-for="(unit, index) in units" :key="unit.id">
                            <td>{{ index + 1 }}</td>
                            <td>{{ unit.name }}</td>
                            <td>{{ new Date(unit.created_at).toLocaleDateString() }}</td>
                            <td>
                                <button class="btn btn-sm btn-info me-2" @click="editUnit(unit)">
                                    <i class="fa fa-edit"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-danger" @click="confirmDelete(unit)">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div v-if="showCreateModal || showEditModal" class="modal-backdrop fade show"></div>
        <div v-if="showCreateModal || showEditModal" class="modal fade show d-block" tabindex="-1" role="dialog"
            aria-modal="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ showCreateModal ? 'Create New Unit' : 'Edit Unit: ' + form.name }}
                        </h5>
                        <button type="button" class="btn-close" @click="closeModal" aria-label="Close"></button>
                    </div>

                    <form @submit.prevent="showCreateModal ? createUnit() : updateUnit()">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="unitName" class="form-label">Unit Name</label>
                                <input type="text" class="form-control" id="unitName" v-model="form.name" required>

                                <div v-if="formErrors.name" class="text-danger small mt-1">
                                    {{ formErrors.name[0] }}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="closeModal">Cancel</button>
                            <button type="submit" class="btn btn-primary" :disabled="isSubmitting">
                                {{ isSubmitting ? 'Processing...' : (showCreateModal ? 'Save Unit' : 'Update Unit') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, reactive } from 'vue';
import axios from 'axios';

// --- State Variables ---
const units = ref([]);
const loading = ref(false);
const error = ref(null);
const isSubmitting = ref(false);

const showCreateModal = ref(false);
const showEditModal = ref(false);

// Form Data and Error Handling
const initialFormState = { id: null, name: '' };
const form = reactive({ ...initialFormState });
const formErrors = reactive({});

// API Base URL (Laravel API endpoint)
const API_URL = '/api/units';

// --- Functions ---

const fetchUnits = async () => {
    loading.value = true;
    error.value = null;
    try {
        const response = await axios.get(API_URL);
        units.value = response.data.units;
    } catch (err) {
        error.value = 'Failed to fetch units. Check API endpoint or server.';
        console.error('Fetch error:', err);
    } finally {
        loading.value = false;
    }
};

const createUnit = async () => {
    isSubmitting.value = true;
    Object.assign(formErrors, {}); // Reset errors

    try {
        const response = await axios.post(API_URL, form);

        units.value.push(response.data.unit);
        alert(response.data.message);
        closeModal();

    } catch (err) {
        if (err.response && err.response.status === 422) {
            // Handle Laravel Validation Errors
            Object.assign(formErrors, err.response.data.errors);
        } else {
            alert('An unexpected error occurred during creation.');
            console.error('Create error:', err);
        }
    } finally {
        isSubmitting.value = false;
    }
};

const editUnit = (unit) => {
    // Deep copy the unit data to the form for editing
    Object.assign(form, JSON.parse(JSON.stringify(unit)));
    showEditModal.value = true;
};

const updateUnit = async () => {
    isSubmitting.value = true;
    Object.assign(formErrors, {});

    try {
        const response = await axios.put(`${API_URL}/${form.id}`, form);

        // Update the item in the local list
        const index = units.value.findIndex(u => u.id === form.id);
        if (index !== -1) {
            units.value[index] = response.data.unit;
        }

        alert(response.data.message);
        closeModal();

    } catch (err) {
        if (err.response && err.response.status === 422) {
            Object.assign(formErrors, err.response.data.errors);
        } else {
            alert('An unexpected error occurred during update.');
            console.error('Update error:', err);
        }
    } finally {
        isSubmitting.value = false;
    }
};

const confirmDelete = (unit) => {
    if (confirm(`Are you sure you want to delete Unit: ${unit.name}? This action cannot be undone.`)) {
        deleteUnit(unit.id);
    }
};

const deleteUnit = async (id) => {
    try {
        const response = await axios.delete(`${API_URL}/${id}`);

        // Remove the item from the local list
        units.value = units.value.filter(unit => unit.id !== id);
        alert(response.data.message);

    } catch (err) {
        alert('Failed to delete unit.');
        console.error('Delete error:', err);
    }
};

// Reset form state and close modals
const closeModal = () => {
    showCreateModal.value = false;
    showEditModal.value = false;

    // Reset form and errors
    Object.assign(form, initialFormState);
    Object.assign(formErrors, {});
};

// Fetch data when the component is mounted
onMounted(() => {
    fetchUnits();
});
</script>

<style scoped>
/* Custom styling for modal to work correctly with existing global CSS */
.modal-backdrop.show {
    opacity: 0.5;
    background-color: #000;
    z-index: 1050;
}

.modal.show {
    z-index: 1051;
}
</style>