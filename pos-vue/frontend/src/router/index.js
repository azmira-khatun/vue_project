import { createRouter, createWebHistory } from "vue-router";

// Layout (Dash.vue)
const DashLayout = () => import("@/views/adminPanel/Dash.vue");

// Pages
const LoginView = () => import("@/views/HomeView.vue"); // লগইন ফর্ম

// Dashboard/Role Management Components
const RolesList = () => import("@/components/role/RoleList.vue");
const AddRole = () => import("@/components/role/RoleCreate.vue");
const EditRole = () => import("@/components/role/RoleEdit.vue");

// Units Component
const UnitsIndex = () => import("@/views/UnitsIndex.vue");

// Categories Component
const CategoryIndex = () => import("@/views/CategoryIndex.vue");

// ** নতুন: Customers Component **
const CustomerIndex = () => import("@/views/Customer.vue");

const routes = [
  // A. লগইন রুট
  {
    path: "/login",
    name: "Login",
    component: LoginView,
    meta: { requiresAuth: false },
  },

  // B. ড্যাশবোর্ড রুট
  {
    path: "/",
    component: DashLayout,
    meta: { requiresAuth: true },
    children: [
      {
        path: "",
        redirect: "/roles",
      },

      // --- Roles Routes ---
      { path: "roles", name: "RolesList", component: RolesList },
      { path: "roles/create", name: "AddRole", component: AddRole },
      {
        path: "roles/edit/:id",
        name: "EditRole",
        component: EditRole,
        props: true,
      },

      // Units Routes
      { path: "units", name: "UnitsList", component: UnitsIndex },

      // Categories Routes
      {
        path: "product-categories",
        name: "CategoryList",
        component: CategoryIndex,
      },

      // ** Customers Routes **
      { path: "customers", name: "CustomersList", component: CustomerIndex },
    ],
  },

  // Catch-all redirect
  {
    path: "/:catchAll(.*)",
    redirect: "/login",
  },
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
});

// Authentication Guard
router.beforeEach((to, from, next) => {
  const isAuthenticated = localStorage.getItem("user_logged_in") === "true";

  if (to.meta.requiresAuth && !isAuthenticated) {
    next("/login");
  } else if (to.name === "Login" && isAuthenticated) {
    next("/roles");
  } else {
    next();
  }
});

export default router;
