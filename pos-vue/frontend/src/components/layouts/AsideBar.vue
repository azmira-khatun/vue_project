<template>
    <div class="sidebar pe-4 pb-3">
        <nav class="navbar">

            <router-link to="/" class="navbar-brand mx-4 mb-3">
                <h3 class="text-primary">
                    <marquee><i class="fa fa-hashtag me-2"></i>POS</marquee>
                </h3>
            </router-link>

            <div class="d-flex align-items-center ms-4 mb-4">
                <div class="position-relative">
                    <img class="rounded-circle" src="../../assets/img/images.jpeg" style="width:40px;height:40px" />
                    <span
                        class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                    </span>
                </div>

                <div class="ms-3">
                    <h6 class="mb-0">{{ auth.user?.name || 'Admin' }}</h6>
                    <span>{{ auth.user?.role || 'User' }}</span>
                </div>
            </div>

            <div class="navbar-nav w-100">

                <router-link to="/" class="nav-item nav-link">
                    <i class="fa fa-home me-2"></i> Dashboard
                </router-link>

                <div v-if="can('access_products')" class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa fa-box me-2"></i> Products
                    </a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <router-link v-if="can('access_product_categories')" to="/product-categories"
                            class="dropdown-item">
                            Categories
                        </router-link>

                        <router-link v-if="can('create_products')" to="/products/create" class="dropdown-item">
                            Create Product
                        </router-link>

                        <router-link to="/products" class="dropdown-item">
                            All Products
                        </router-link>

                        <router-link v-if="can('print_barcodes')" to="/barcode-print" class="dropdown-item">
                            Print Barcode
                        </router-link>
                    </div>
                </div>

                <div v-if="can('access_sales')" class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa fa-receipt me-2"></i> Sales
                    </a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <router-link v-if="can('create_sales')" to="/sales/create" class="dropdown-item">
                            Create Sale
                        </router-link>

                        <router-link to="/sales" class="dropdown-item">
                            All Sales
                        </router-link>
                    </div>
                </div>

                <div v-if="can('access_expenses')" class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa fa-wallet me-2"></i> Expenses
                    </a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <router-link v-if="can('create_expenses')" to="/expenses/create" class="dropdown-item">
                            Create Expense
                        </router-link>

                        <router-link to="/expenses" class="dropdown-item">
                            All Expenses
                        </router-link>
                    </div>
                </div>

                <div v-if="can('access_user_management')" class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa fa-users me-2"></i> User Management
                    </a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <router-link to="/users" class="dropdown-item">
                            Users
                        </router-link>
                        <router-link to="/roles" class="dropdown-item">
                            Roles & Permissions
                        </router-link>
                    </div>
                </div>

            </div>
        </nav>
    </div>
</template>

<script setup>
import { useAuthStore } from '@/store/auth'
// FIX: Using alias path '@/role/permissions' because permissions.js file is likely at src/role/permissions.js
import { can } from '@/role/permissions'

const auth = useAuthStore()
</script>

<style scoped>
.sidebar {
    width: 250px;
    height: 100vh;
    background-color: #f8f9fa;
    box-shadow: 2px 0 8px rgba(0, 0, 0, .05);
}

.nav-link {
    cursor: pointer;
}

.dropdown-menu {
    padding-left: 20px;
}
</style>