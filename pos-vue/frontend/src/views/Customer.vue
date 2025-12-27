<template>
    <div class="min-h-screen bg-gradient-to-r from-gray-100 to-blue-50 flex items-center justify-center">
        <div class="w-full max-w-lg bg-white rounded-2xl shadow-lg p-8">
            <h1 class="text-3xl font-bold text-center text-blue-600 mb-6">Add Customer</h1>

            <form @submit.prevent="saveCustomer" class="space-y-5">

                <!-- Name -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Name</label>
                    <input v-model="form.name" type="text" placeholder="Enter Name"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-400" />
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Email</label>
                    <input v-model="form.email" type="email" placeholder="Enter Email"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-400" />
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Phone</label>
                    <input v-model="form.phone" type="text" placeholder="Enter Phone"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-400" />
                </div>

                <!-- City -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">City</label>
                    <input v-model="form.city" type="text" placeholder="Enter City"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-400" />
                </div>

                <!-- Country -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Country</label>
                    <input v-model="form.country" type="text" placeholder="Enter Country"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-400" />
                </div>

                <!-- Address -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Address</label>
                    <textarea v-model="form.address" placeholder="Enter Address"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline h-5 w-5 mr-2 -mt-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Save Customer
                    </button>
                </div>

            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            form: {
                name: '',
                email: '',
                phone: '',
                city: '',
                country: '',
                address: ''
            }
        }
    },
    methods: {
        async saveCustomer() {
            try {
                let res = await axios.post('/api/customers', this.form);
                alert('Customer saved successfully!');
                // Reset form
                this.form = { name: '', email: '', phone: '', city: '', country: '', address: '' };
            } catch (error) {
                console.log(error.response);
                alert('Failed to save customer');
            }
        }
    }
}
</script>

<style scoped>
/* Optional: page background gradient is already in container */
</style>
