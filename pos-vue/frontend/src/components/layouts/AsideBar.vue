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
                    <h6 class="mb-0">{{ auth.user.name }}</h6>
                    <span>{{ auth.user.role }}</span>
                </div>
            </div>

            <div class="navbar-nav w-100">

                <router-link to="/" class="nav-item nav-link">
                    <i class="fa fa-home me-2"></i> Dashboard
                </router-link>

                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa fa-box me-2"></i> Products
                    </a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <router-link to="/product-categories" class="dropdown-item">
                            Categories
                        </router-link>
                        <router-link to="/products/create" class="dropdown-item">
                            Create Product
                        </router-link>
                        <router-link to="/products" class="dropdown-item">
                            All Products
                        </router-link>
                        <router-link to="/barcode-print" class="dropdown-item">
                            Print Barcode
                        </router-link>
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa fa-clipboard-check me-2"></i> Stock Adjustments
                    </a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <router-link to="/adjustments/create" class="dropdown-item">
                            Create Adjustment
                        </router-link>
                        <router-link to="/adjustments" class="dropdown-item">
                            All Adjustments
                        </router-link>
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa fa-cart-check me-2"></i> Quotations
                    </a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <router-link to="/quotations/create" class="dropdown-item">
                            Create Quotation
                        </router-link>
                        <router-link to="/quotations" class="dropdown-item">
                            All Quotations
                        </router-link>
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa fa-bag me-2"></i> Purchases
                    </a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <router-link to="/purchases/create" class="dropdown-item">
                            Create Purchase
                        </router-link>
                        <router-link to="/purchases" class="dropdown-item">
                            All Purchases
                        </router-link>
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa fa-arrow-return-right me-2"></i> Purchase Returns
                    </a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <router-link to="/purchase-returns/create" class="dropdown-item">
                            Create Purchase Return
                        </router-link>
                        <router-link to="/purchase-returns" class="dropdown-item">
                            All Purchase Returns
                        </router-link>
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa fa-receipt me-2"></i> Sales
                    </a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <router-link to="/sales/create" class="dropdown-item">
                            Create Sale
                        </router-link>
                        <router-link to="/sales" class="dropdown-item">
                            All Sales
                        </router-link>
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa fa-arrow-return-left me-2"></i> Sale Returns
                    </a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <router-link to="/sale-returns/create" class="dropdown-item">
                            Create Sale Return
                        </router-link>
                        <router-link to="/sale-returns" class="dropdown-item">
                            All Sale Returns
                        </router-link>
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa fa-wallet me-2"></i> Expenses
                    </a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <router-link to="/expense-categories" class="dropdown-item">
                            Categories
                        </router-link>
                        <router-link to="/expenses/create" class="dropdown-item">
                            Create Expense
                        </router-link>
                        <router-link to="/expenses" class="dropdown-item">
                            All Expenses
                        </router-link>
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa fa-people me-2"></i> Parties
                    </a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <router-link to="/customers" class="dropdown-item">
                            Customers
                        </router-link>
                        <router-link to="/suppliers" class="dropdown-item">
                            Suppliers
                        </router-link>
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa fa-chart-bar me-2"></i> Reports
                    </a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <router-link to="/profit-loss-report" class="dropdown-item">
                            Profit / Loss Report
                        </router-link>
                        <router-link to="/payments-report" class="dropdown-item">
                            Payments Report
                        </router-link>
                        <router-link to="/sales-report" class="dropdown-item">
                            Sales Report
                        </router-link>
                        <router-link to="/purchases-report" class="dropdown-item">
                            Purchases Report
                        </router-link>
                        <router-link to="/sales-return-report" class="dropdown-item">
                            Sales Return Report
                        </router-link>
                        <router-link to="/purchases-return-report" class="dropdown-item">
                            Purchases Return Report
                        </router-link>
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa fa-users me-2"></i> User Management
                    </a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <router-link to="/users/create" class="dropdown-item">
                            Create User
                        </router-link>
                        <router-link to="/users" class="dropdown-item">
                            All Users
                        </router-link>
                        <router-link to="/roles" class="dropdown-item">
                            Roles & Permissions
                        </router-link>
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa fa-cog me-2"></i> Settings
                    </a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <router-link to="/units" class="dropdown-item">
                            Units
                        </router-link>
                        <router-link to="/currencies" class="dropdown-item">
                            Currencies
                        </router-link>
                        <router-link to="/settings" class="dropdown-item">
                            System Settings
                        </router-link>
                    </div>
                </div>

            </div>
        </nav>
    </div>
</template>

<script setup>
// সমস্ত Import মুছে ফেলা হলো এবং টেমপ্লেট ভাঙা এড়াতে ডামি auth অবজেক্ট তৈরি করা হলো।
const auth = {
    user: {
        name: 'Admin',
        role: 'User'
    }
}
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