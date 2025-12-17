<template>
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0">🏷️ Product Categories</h3>

                <button class="btn btn-primary" @click="showCreateModal = true">
                    <i class="fa fa-plus me-2"></i> Add New Category
                </button>
            </div>

            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">#</th>
                            <th scope="col">Category Code</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="loading">
                            <td colspan="5" class="text-center">Loading Categories...</td>
                        </tr>

                        <tr v-else-if="error">
                            <td colspan="5" class="text-center text-danger">{{ error }}</td>
                        </tr>

                        <tr v-else v-for="(category, index) in categories" :key="category.id">
                            <td>{{ index + 1 }}</td>
                            <td>{{ category.category_code }}</td>
                            <td>{{ category.category_name }}</td>
                            <td>{{ new Date(category.created_at).toLocaleDateString() }}</td>
                            <td>
                                <button class="btn btn-sm btn-info me-2" @click="editCategory(category)">
                                    <i class="fa fa-edit"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-danger" @click="confirmDelete(category)">
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
                        <h5 class="modal-title">{{ showCreateModal ? 'Create New Category' : 'Edit Category: ' +
                            form.category_name }}</h5>
                        <button type="button" class="btn-close" @click="closeModal" aria-label="Close"></button>
                    </div>

                    <form @submit.prevent="showCreateModal ? createCategory() : updateCategory()">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="categoryCode" class="form-label">Category Code</label>
                                <input type="text" class="form-control" id="categoryCode" v-model="form.category_code"
                                    required>
                                <div v-if="formErrors.category_code" class="text-danger small mt-1">
                                    {{ formErrors.category_code[0] }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="categoryName" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="categoryName" v-model="form.category_name"
                                    required>
                                <div v-if="formErrors.category_name" class="text-danger small mt-1">
                                    {{ formErrors.category_name[0] }}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="closeModal">Cancel</button>

                            <button type="submit" class="btn btn-primary" :disabled="isSubmitting">
                                <span v-if="isSubmitting">Processing...</span>

                                <span v-else>
                                    <span v-if="showCreateModal">Save Category</span>
                                    <span v-else>Update Category</span>
                                </span>
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
// নিশ্চিত করুন যে main.js এ axios.defaults.baseURL সেট করা আছে।

// --- State Variables ---
const categories = ref([]);
const loading = ref(false);
const error = ref(null);
const isSubmitting = ref(false);

const showCreateModal = ref(false);
const showEditModal = ref(false);

// Form Data and Error Handling
const initialFormState = { id: null, category_code: '', category_name: '' };
const form = reactive({ ...initialFormState });
const formErrors = reactive({});

// API Base URL 
const API_URL = '/api/categories';

// --- Functions ---

const fetchCategories = async () => {
    loading.value = true;
    error.value = null;
    try {
        const response = await axios.get(API_URL);
        // নিশ্চিত করুন যে Laravel Controller 'categories' কী এর মাধ্যমে ডেটা পাঠাচ্ছে
        categories.value = response.data.categories;
    } catch (err) {
        error.value = 'Failed to fetch categories. Check API endpoint or server.';
        console.error('Fetch error:', err);
    } finally {
        loading.value = false;
    }
};

const createCategory = async () => {
    isSubmitting.value = true;
    Object.assign(formErrors, {}); // Reset errors

    try {
        const response = await axios.post(API_URL, form);

        categories.value.push(response.data.category);
        alert(response.data.message);
        closeModal();

    } catch (err) {
        if (err.response && err.response.status === 422) {
            // Handle Laravel Validation Errors (যেমন: code ইউনিক না হলে)
            Object.assign(formErrors, err.response.data.errors);
        } else {
            alert('An unexpected error occurred during creation.');
            console.error('Create error:', err);
        }
    } finally {
        isSubmitting.value = false;
    }
};

const editCategory = (category) => {
    // Deep copy the category data to the form for editing
    Object.assign(form, JSON.parse(JSON.stringify(category)));
    showEditModal.value = true;
};

const updateCategory = async () => {
    isSubmitting.value = true;
    Object.assign(formErrors, {});

    try {
        // PUT রিকোয়েস্ট
        const response = await axios.put(`${API_URL}/${form.id}`, form);

        // Update the item in the local list
        const index = categories.value.findIndex(c => c.id === form.id);
        if (index !== -1) {
            categories.value[index] = response.data.category;
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

const confirmDelete = (category) => {
    if (confirm(`Are you sure you want to delete Category: ${category.category_name}? This will affect ${category.category_code} code.`)) {
        deleteCategory(category.id);
    }
};

const deleteCategory = async (id) => {
    try {
        const response = await axios.delete(`${API_URL}/${id}`);

        // Remove the item from the local list
        categories.value = categories.value.filter(category => category.id !== id);
        alert(response.data.message);

    } catch (err) {
        alert('Failed to delete category.');
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
    fetchCategories();
});
</script>

<style scoped>
/* Modal styles (UnitsIndex.vue এর মতোই) */
.modal-backdrop.show {
    opacity: 0.5;
    background-color: #000;
    z-index: 1050;
}

.modal.show {
    z-index: 1051;
}
</style>