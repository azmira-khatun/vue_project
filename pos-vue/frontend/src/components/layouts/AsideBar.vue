<template>
    <div class="sidebar pe-4 pb-3">
        <nav class="navbar">
            <a href="#" class="navbar-brand mx-4 mb-3">
                <h3 class="text-primary">
                    <marquee><i class="fa fa-hashtag me-2"></i>POS</marquee>
                </h3>
            </a>

            <div class="d-flex align-items-center ms-4 mb-4">
                <div class="position-relative">
                    <img class="rounded-circle" src="../../assets/img/images.jpeg" alt=""
                        style="width: 40px; height: 40px;" />
                    <div
                        class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                    </div>
                </div>

                <div class="ms-3">
                    <h6 class="mb-0">MRM</h6>
                    <span>Admin</span>
                </div>
            </div>

            <div class="navbar-nav w-100">
                <a href="#" class="nav-item nav-link">
                    <i class="fa fa-tachometer-alt me-2"></i>Dashboard
                </a>
            </div>
        </nav>
    </div>
</template>

<style scoped>
/* ---------------------------
   MAIN SIDEBAR BACKGROUND
---------------------------- */
.sidebar {
    width: 250px;
    height: 100vh;
    background-color: #f8f9fa !important;
    /* LIGHT COLOR */
    padding-top: 20px;
    box-shadow: 2px 0 8px rgba(0, 0, 0, 0.05);
}

/* ----------------------------------
   FIX 1: navbar background remove
---------------------------------- */
.sidebar .navbar {
    background: transparent !important;
}

/* ----------------------------------
   FIX 2: bootstrap bg-light override
---------------------------------- */
.sidebar .navbar-light,
.sidebar .bg-light {
    background: transparent !important;
}

/* ----------------------------------
   FIX 3: any child element overriding
---------------------------------- */
.sidebar * {
    background-color: transparent !important;
}
</style>
