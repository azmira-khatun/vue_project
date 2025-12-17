<template>
    <div class="sidebar pe-4 pb-3">
        <nav class="navbar">

            <router-link to="/" class="navbar-brand mx-4 mb-3">
                <h3 class="text-primary fw-bold">
                    <i class="fa fa-hashtag me-2"></i>POS System
                </h3>
            </router-link>

            <div class="d-flex align-items-center ms-4 mb-4 profile-box p-2">
                <div class="position-relative">
                    <img class="rounded-circle profile-img" src="../../assets/img/images.jpeg" alt="User Image" />
                    <span
                        class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></span>
                </div>

                <div class="ms-3 text-white">
                    <h6 class="mb-0 fw-semibold">{{ auth.user.name }}</h6>
                    <span class="text-xs">{{ auth.user.role }}</span>
                </div>
            </div>

            <div class="navbar-nav w-100 main-menu">

                <router-link to="/" class="nav-item nav-link">
                    <i class="bi bi-house me-2"></i> Dashboard
                </router-link>

                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex justify-content-between align-items-center"
                        data-bs-toggle="dropdown">
                        <span><i class="bi bi-journal-bookmark me-2"></i> Products</span>
                    </a>
                    <div class="dropdown-menu bg-transparent border-0 sub-menu">
                        <router-link to="/product-categories" class="dropdown-item">Categories</router-link>
                        <router-link to="/products/create" class="dropdown-item">Create Product</router-link>
                        <router-link to="/products" class="dropdown-item">All Products</router-link>
                        <router-link to="/barcode-print" class="dropdown-item">Print Barcode</router-link>
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex justify-content-between align-items-center"
                        data-bs-toggle="dropdown">
                        <span><i class="bi bi-clipboard-check me-2"></i> Stock Adjustments</span>
                    </a>
                    <div class="dropdown-menu bg-transparent border-0 sub-menu">
                        <router-link to="/adjustments/create" class="dropdown-item">Create Adjustment</router-link>
                        <router-link to="/adjustments" class="dropdown-item">All Adjustments</router-link>
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex justify-content-between align-items-center"
                        data-bs-toggle="dropdown">
                        <span><i class="bi bi-cart-check me-2"></i> Quotations</span>
                    </a>
                    <div class="dropdown-menu bg-transparent border-0 sub-menu">
                        <router-link to="/quotations/create" class="dropdown-item">Create Quotation</router-link>
                        <router-link to="/quotations" class="dropdown-item">All Quotations</router-link>
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex justify-content-between align-items-center"
                        data-bs-toggle="dropdown">
                        <span><i class="bi bi-bag me-2"></i> Purchases</span>
                    </a>
                    <div class="dropdown-menu bg-transparent border-0 sub-menu">
                        <router-link to="/purchases/create" class="dropdown-item">Create Purchase</router-link>
                        <router-link to="/purchases" class="dropdown-item">All Purchases</router-link>
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex justify-content-between align-items-center"
                        data-bs-toggle="dropdown">
                        <span><i class="bi bi-arrow-return-right me-2"></i> Purchase Returns</span>
                    </a>
                    <div class="dropdown-menu bg-transparent border-0 sub-menu">
                        <router-link to="/purchase-returns/create" class="dropdown-item">Create Purchase
                            Return</router-link>
                        <router-link to="/purchase-returns" class="dropdown-item">All Purchase Returns</router-link>
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex justify-content-between align-items-center"
                        data-bs-toggle="dropdown">
                        <span><i class="bi bi-receipt me-2"></i> Sales</span>
                    </a>
                    <div class="dropdown-menu bg-transparent border-0 sub-menu">
                        <router-link to="/sales/create" class="dropdown-item">Create Sale</router-link>
                        <router-link to="/sales" class="dropdown-item">All Sales</router-link>
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex justify-content-between align-items-center"
                        data-bs-toggle="dropdown">
                        <span><i class="bi bi-arrow-return-left me-2"></i> Sale Returns</span>
                    </a>
                    <div class="dropdown-menu bg-transparent border-0 sub-menu">
                        <router-link to="/sale-returns/create" class="dropdown-item">Create Sale Return</router-link>
                        <router-link to="/sale-returns" class="dropdown-item">All Sale Returns</router-link>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex justify-content-between align-items-center"
                        data-bs-toggle="dropdown">
                        <span><i class="bi bi-wallet2 me-2"></i> Expenses</span>
                    </a>
                    <div class="dropdown-menu bg-transparent border-0 sub-menu">
                        <router-link to="/expense-categories" class="dropdown-item">Categories</router-link>
                        <router-link to="/expenses/create" class="dropdown-item">Create Expense</router-link>
                        <router-link to="/expenses" class="dropdown-item">All Expenses</router-link>
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex justify-content-between align-items-center"
                        data-bs-toggle="dropdown">
                        <span><i class="bi bi-people me-2"></i> Parties</span>
                    </a>
                    <div class="dropdown-menu bg-transparent border-0 sub-menu">
                        <router-link to="/customers" class="dropdown-item">Customers</router-link>
                        <router-link to="/suppliers" class="dropdown-item">Suppliers</router-link>
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex justify-content-between align-items-center"
                        data-bs-toggle="dropdown">
                        <span><i class="bi bi-graph-up me-2"></i> Reports</span>
                    </a>
                    <div class="dropdown-menu bg-transparent border-0 sub-menu">
                        <router-link to="/profit-loss-report" class="dropdown-item">Profit / Loss Report</router-link>
                        <router-link to="/payments-report" class="dropdown-item">Payments Report</router-link>
                        <router-link to="/sales-report" class="dropdown-item">Sales Report</router-link>
                        <router-link to="/purchases-report" class="dropdown-item">Purchases Report</router-link>
                        <router-link to="/sales-return-report" class="dropdown-item">Sales Return Report</router-link>
                        <router-link to="/purchases-return-report" class="dropdown-item">Purchases Return
                            Report</router-link>
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex justify-content-between align-items-center"
                        data-bs-toggle="dropdown">
                        <span><i class="bi bi-person-lines-fill me-2"></i> User Management</span>
                    </a>
                    <div class="dropdown-menu bg-transparent border-0 sub-menu">
                        <router-link to="/users/create" class="dropdown-item">Create User</router-link>
                        <router-link to="/users" class="dropdown-item">All Users</router-link>
                        <router-link to="/roles" class="dropdown-item">Roles & Permissions</router-link>
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex justify-content-between align-items-center"
                        data-bs-toggle="dropdown">
                        <span><i class="bi bi-gear me-2"></i> Settings</span>
                    </a>
                    <div class="dropdown-menu bg-transparent border-0 sub-menu">
                        <router-link to="/units" class="dropdown-item">Units</router-link>
                        <router-link to="/currencies" class="dropdown-item">Currencies</router-link>
                        <router-link to="/payment-methods" class="dropdown-item">Payment Methods</router-link>
                        <router-link to="/settings" class="dropdown-item">System Settings</router-link>
                    </div>
                </div>

            </div>
        </nav>
    </div>
</template>

<script setup>
// ডামি auth অবজেক্ট (আপনার দেওয়া কোড অনুযায়ী)
const auth = {
    user: {
        name: 'Admin',
        role: 'Superadmin'
    }
}
</script>

<style scoped>
/* স্টাইলগুলি উন্নত করা হলো */
:root {
    --sidebar-bg: #212529;
    /* Darker background for a professional look */
    --link-color: #dee2e6;
    --link-hover-bg: #343a40;
    --primary-color: #0d6efd;
}

.sidebar {
    width: 250px;
    height: 100vh;
    position: fixed;
    /* সাইডবারকে ফিক্সড করে দিলাম */
    top: 0;
    left: 0;
    background-color: var(--sidebar-bg);
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.3);
    overflow-y: auto;
    /* মেনু বেশি হলে স্ক্রল করার জন্য */
    padding-top: 20px;
    z-index: 1030;
    /* Ensure it stays on top of other content, fixing the overlap issue */
}

/* Scrollbar Style */
.sidebar::-webkit-scrollbar {
    width: 6px;
}

.sidebar::-webkit-scrollbar-thumb {
    background-color: #6c757d;
    border-radius: 3px;
}

.sidebar::-webkit-scrollbar-track {
    background-color: #343a40;
}


.navbar-brand h3 {
    color: var(--primary-color) !important;
    font-size: 1.5rem;
    margin-bottom: 0;
}

/* User Profile Styling */
.profile-box {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 5px;
    margin: 0 1rem 1rem 1rem;
    /* Added margin for better look */
}

.profile-img {
    width: 40px !important;
    height: 40px !important;
    object-fit: cover;
    border: 2px solid var(--primary-color);
}

.text-xs {
    font-size: 0.8rem;
    color: #adb5bd;
}

/* Main Menu Links */
.nav-item .nav-link {
    color: var(--link-color);
    padding: 10px 1.5rem;
    margin: 5px 0;
    transition: all 0.3s;
    border-radius: 0;
    border-left: 3px solid transparent;
}

.nav-item .nav-link:hover,
.nav-item .nav-link.router-link-active,
.nav-item .nav-link.active {
    background-color: var(--link-hover-bg);
    color: white;
    border-left: 3px solid var(--primary-color);
}

.nav-item .nav-link i {
    font-size: 1.1rem;
    margin-right: 10px;
}

/* ড্রপডাউন সাইন (Caret) পজিশনিং ঠিক করা */
.dropdown-toggle::after {
    /* d-flex ব্যবহার করার ফলে এটি এখন ডানদিকে আছে, এখন শুধু স্পেসিং ঠিক করা হলো */
    margin-left: 0;
    margin-right: 0.5rem;
    transition: transform 0.3s ease;
}

/* যখন ড্রপডাউন খোলা থাকে তখন কেয়ারট নিচে দেখাবে */
.dropdown-toggle[aria-expanded="true"]::after {
    transform: rotate(180deg);
}


/* Dropdown/Sub-Menu Styling */
.sub-menu {
    padding-left: 0;
    padding-top: 0;
    border-top: none;
    border-radius: 0 0 5px 5px;
    background-color: #2c3034 !important;
    /* Slightly lighter background for sub-menu */
}

.sub-menu .dropdown-item {
    color: var(--link-color);
    padding: 8px 1.5rem 8px 2.5rem;
    /* Indentation for sub-links */
    font-size: 0.95rem;
    transition: background-color 0.2s;
    border-radius: 0;
}

.sub-menu .dropdown-item:hover,
.sub-menu .dropdown-item.router-link-active {
    background-color: var(--link-hover-bg);
    color: var(--primary-color);
    /* Primary color highlighting for active sub-link */
}
</style>