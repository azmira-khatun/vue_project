<template>
    <div class="container my-5">
        <h1 class="mb-4 text-primary">Suppliers CRUD</h1>

        <div class="card shadow-sm mb-5">
            <div class="card-body">
                <h2 class="card-title h4 text-secondary mb-3">
                    {{ editMode ? 'Update Supplier' : 'Add New Supplier' }}
                </h2>
                <form @submit.prevent="saveSupplier">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label for="supplierName" class="form-label visually-hidden">Supplier Name</label>
                            <input v-model="form.supplier_name" id="supplierName" type="text" class="form-control"
                                placeholder="Supplier Name" required>
                        </div>

                        <div class="col-md-6">
                            <label for="supplierEmail" class="form-label visually-hidden">Supplier Email</label>
                            <input v-model="form.supplier_email" id="supplierEmail" type="email" class="form-control"
                                placeholder="Supplier Email" required>
                        </div>

                        <div class="col-md-6">
                            <label for="supplierPhone" class="form-label visually-hidden">Supplier Phone</label>
                            <input v-model="form.supplier_phone" id="supplierPhone" type="text" class="form-control"
                                placeholder="Supplier Phone" required>
                        </div>

                        <div class="col-md-6">
                            <label for="city" class="form-label visually-hidden">City</label>
                            <input v-model="form.city" id="city" type="text" class="form-control" placeholder="City"
                                required>
                        </div>

                        <div class="col-md-6">
                            <label for="country" class="form-label visually-hidden">Country</label>
                            <input v-model="form.country" id="country" type="text" class="form-control"
                                placeholder="Country" required>
                        </div>

                        <div class="col-md-6">
                            <label for="address" class="form-label visually-hidden">Address</label>
                            <input v-model="form.address" id="address" type="text" class="form-control"
                                placeholder="Address" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="submit" class="btn btn-success shadow">
                            {{ editMode ? 'Update Supplier' : 'Add Supplier' }}
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
                                <th style="width: 140px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="supplier in suppliers" :key="supplier.id">
                                <td>{{ supplier.id }}</td>
                                <td>{{ supplier.supplier_name }}</td>
                                <td>{{ supplier.supplier_email }}</td>
                                <td>{{ supplier.supplier_phone }}</td>
                                <td>{{ supplier.city }}</td>
                                <td>{{ supplier.country }}</td>
                                <td>{{ supplier.address }}</td>
                                <td>
                                    <div class="d-flex gap-1 justify-content-center">
                                        <button @click="editSupplier(supplier)"
                                            class="btn btn-warning btn-xs">Edit</button>
                                        <button @click="deleteSupplier(supplier.id)"
                                            class="btn btn-danger btn-xs">Delete</button>
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

<script>
import axios from 'axios';

export default {
    data() {
        return {
            suppliers: [],
            form: {
                supplier_name: '',
                supplier_email: '',
                supplier_phone: '',
                city: '',
                country: '',
                address: ''
            },
            editMode: false,
            editId: null
        };
    },
    mounted() {
        this.getSuppliers();
    },
    methods: {
        getSuppliers() {
            axios.get('/api/suppliers')
                .then(res => this.suppliers = res.data)
                .catch(err => console.log(err));
        },
        saveSupplier() {
            if (this.editMode) {
                axios.put(`/api/suppliers/${this.editId}`, this.form)
                    .then(() => {
                        this.getSuppliers();
                        this.resetForm();
                    }).catch(err => console.log(err));
            } else {
                axios.post('/api/suppliers', this.form)
                    .then(() => {
                        this.getSuppliers();
                        this.resetForm();
                    }).catch(err => console.log(err));
            }
        },
        editSupplier(supplier) {
            this.form = {
                supplier_name: supplier.supplier_name,
                supplier_email: supplier.supplier_email,
                supplier_phone: supplier.supplier_phone,
                city: supplier.city,
                country: supplier.country,
                address: supplier.address
            };
            this.editMode = true;
            this.editId = supplier.id;
        },
        deleteSupplier(id) {
            if (confirm('Are you sure to delete this supplier?')) {
                axios.delete(`/api/suppliers/${id}`)
                    .then(() => this.getSuppliers())
                    .catch(err => console.log(err));
            }
        },
        resetForm() {
            this.form = {
                supplier_name: '',
                supplier_email: '',
                supplier_phone: '',
                city: '',
                country: '',
                address: ''
            };
            this.editMode = false;
            this.editId = null;
        }
    }
};
</script>

<style scoped>
/* বাটনগুলোকে Bootstrap-এর default 'sm' সাইজের থেকেও ছোট করার জন্য কাস্টম ক্লাস */
.btn-xs {
    padding: 0.1rem 0.35rem;
    /* Padding কমানো হয়েছে */
    font-size: 0.7rem;
    /* ফন্ট সাইজ ছোট করা হয়েছে */
    line-height: 1.2;
    border-radius: 0.2rem;
}

/* টেবিল স্টাইল */
.table th,
.table td {
    vertical-align: middle;
    text-align: left;
}

/* অ্যাকশন কলামের বাটনগুলোকে মাঝখানে আনা হয়েছে */
.table td:last-child {
    text-align: center;
}
</style>