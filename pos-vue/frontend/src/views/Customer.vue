<template>
    <div class="container mx-auto p-6">
        <!-- Page Title -->
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Customers CRUD</h1>

        <!-- Customer Form -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">
                {{ form.id ? 'Update Customer' : 'Add New Customer' }}
            </h2>
            <form @submit.prevent="saveCustomer" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input v-model="form.name" type="text" placeholder="Name"
                    class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                <input v-model="form.email" type="email" placeholder="Email"
                    class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                <input v-model="form.phone" type="text" placeholder="Phone"
                    class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                <input v-model="form.city" type="text" placeholder="City"
                    class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                <input v-model="form.country" type="text" placeholder="Country"
                    class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                <input v-model="form.address" type="text" placeholder="Address"
                    class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">

                <!-- Buttons -->
                <div class="flex justify-end gap-3 md:col-span-2 mt-2">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-2 rounded shadow-lg transition duration-200">
                        {{ form.id ? 'Update' : 'Add' }}
                    </button>
                    <button type="button" @click="resetForm"
                        class="bg-gray-500 hover:bg-gray-600 text-white font-bold px-6 py-2 rounded shadow-lg transition duration-200">
                        Reset
                    </button>
                </div>
            </form>
        </div>

        <!-- Customers Table -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg p-4">
            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Name</th>
                        <th class="border px-4 py-2">Email</th>
                        <th class="border px-4 py-2">Phone</th>
                        <th class="border px-4 py-2">City</th>
                        <th class="border px-4 py-2">Country</th>
                        <th class="border px-4 py-2">Address</th>
                        <th class="border px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="c in customers" :key="c.id" class="hover:bg-gray-50">
                        <td class="border px-4 py-2">{{ c.id }}</td>
                        <td class="border px-4 py-2">{{ c.name }}</td>
                        <td class="border px-4 py-2">{{ c.email }}</td>
                        <td class="border px-4 py-2">{{ c.phone }}</td>
                        <td class="border px-4 py-2">{{ c.city }}</td>
                        <td class="border px-4 py-2">{{ c.country }}</td>
                        <td class="border px-4 py-2">{{ c.address }}</td>
                        <td class="border px-4 py-2 flex gap-2">
                            <button @click="editCustomer(c)"
                                class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded shadow">Edit</button>
                            <button @click="deleteCustomer(c.id)"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded shadow">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
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
    name: '',
    email: '',
    phone: '',
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
    form.value = { ...c }
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
        name: '',
        email: '',
        phone: '',
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
table th,
table td {
    text-align: left;
}
</style>
