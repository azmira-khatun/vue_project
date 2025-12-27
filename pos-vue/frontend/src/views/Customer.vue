<template>
    <div class="container my-5">
        <h1 class="mb-4 text-primary">Customers CRUD</h1>

        <div class="card shadow-sm mb-5">
            <div class="card-body">
                <h2 class="card-title h4 text-secondary mb-3">
                    {{ form.id ? 'Update Customer' : 'Add New Customer' }}
                </h2>
                <form @submit.prevent="saveCustomer">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input v-model="form.customer_name" type="text" class="form-control" placeholder="Name"
                                required>
                        </div>
                        <div class="col-md-6">
                            <input v-model="form.customer_email" type="email" class="form-control" placeholder="Email"
                                required>
                        </div>
                        <div class="col-md-6">
                            <input v-model="form.customer_phone" type="text" class="form-control" placeholder="Phone"
                                required>
                        </div>
                        <div class="col-md-6">
                            <input v-model="form.city" type="text" class="form-control" placeholder="City" required>
                        </div>
                        <div class="col-md-6">
                            <input v-model="form.country" type="text" class="form-control" placeholder="Country"
                                required>
                        </div>
                        <div class="col-md-6">
                            <input v-model="form.address" type="text" class="form-control" placeholder="Address"
                                required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="submit" class="btn btn-success shadow">
                            {{ form.id ? 'Update' : 'Add' }}
                        </button>
                        <button type="button" @click="resetForm" class="btn btn-secondary shadow">
                            Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover border">
                        <thead class="table-primary">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>City</th>
                                <th>Country</th>
                                <th>Address</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="c in customers" :key="c.id">
                                <td>{{ c.id }}</td>
                                <td>{{ c.customer_name }}</td>
                                <td>{{ c.customer_email }}</td>
                                <td>{{ c.customer_phone }}</td>
                                <td>{{ c.city }}</td>
                                <td>{{ c.country }}</td>
                                <td>{{ c.address }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button @click="editCustomer(c)" class="btn btn-sm btn-warning">Edit</button>
                                        <button @click="deleteCustomer(c.id)"
                                            class="btn btn-sm btn-danger">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const API_URL = 'http://localhost/vue_project/pos-vue/api/public/api/customers'

const customers = ref([])

const form = ref({
    id: null,
    // Corrected to match database columns
    customer_name: '',
    customer_email: '',
    customer_phone: '',
    city: '',
    country: '',
    address: ''
})

const getCustomers = async () => {
    try {
        const res = await axios.get(API_URL)
        customers.value = res.data
    } catch (error) {
        console.error(error)
    }
}

const saveCustomer = async () => {
    try {
        if (form.value.id) {
            await axios.put(`${API_URL}/${form.value.id}`, form.value)
        } else {
            await axios.post(API_URL, form.value)
        }
        resetForm()
        getCustomers()
    } catch (error) {
        console.error(error)
    }
}

const editCustomer = (c) => {
    // When editing, map the incoming data (c) to the form fields
    form.value = {
        id: c.id,
        customer_name: c.customer_name,
        customer_email: c.customer_email,
        customer_phone: c.customer_phone,
        city: c.city,
        country: c.country,
        address: c.address,
    }
}

const deleteCustomer = async (id) => {
    if (confirm('Are you sure to delete?')) {
        try {
            await axios.delete(`${API_URL}/${id}`)
            getCustomers()
        } catch (error) {
            console.error(error)
        }
    }
}

const resetForm = () => {
    form.value = {
        id: null,
        // Corrected field names for reset
        customer_name: '',
        customer_email: '',
        customer_phone: '',
        city: '',
        country: '',
        address: ''
    }
}

onMounted(() => {
    getCustomers()
})
</script>

<style scoped>
/* No specific scoped styles needed if using full Bootstrap classes */
</style>