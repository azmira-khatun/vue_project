import { createRouter, createWebHistory } from "vue-router";

// Layout (Dash.vue আপনার সাইডবার এবং মেইন কন্টেন্ট দেখাবে)
const DashLayout = () => import("@/views/adminPanel/Dash.vue");

// Pages
const LoginView = () => import("@/views/HomeView.vue"); // আপনার লগইন ফর্ম (HomeView.vue)

// DashboardContent কম্পোনেন্টটি বাদ দেওয়া হলো।
const RolesList = () => import("@/components/role/RoleList.vue");
const AddRole = () => import("@/components/role/RoleCreate.vue");
const EditRole = () => import("@/components/role/RoleEdit.vue");

const routes = [
  // A. লগইন রুট (স্বতন্ত্র): এটি কোনো লেআউটের চাইল্ড হবে না
  {
    path: "/login",
    name: "Login",
    component: LoginView,
    meta: { requiresAuth: false }, // প্রমাণীকরণের প্রয়োজন নেই
  },

  // B. ড্যাশবোর্ড রুট (সুরক্ষিত): DashLayout এর মাধ্যমে লোড হবে
  {
    path: "/",
    component: DashLayout, // Layout wrapper (Dash.vue)
    meta: { requiresAuth: true }, // এই রুটের জন্য লগইন বাধ্যতামূলক
    children: [
      {
        path: "",
        redirect: "/roles", // মেইন রুট "/" কে সরাসরি /roles পেজে রিডিরেক্ট করা হলো
      },
      // এখানে 'dashboard' নামক কোনো রুট আর নেই।

      // অন্যান্য সুরক্ষিত রুট
      { path: "roles", name: "RolesList", component: RolesList },
      { path: "roles/create", name: "AddRole", component: AddRole },
      {
        path: "roles/edit/:id",
        name: "EditRole",
        component: EditRole,
        props: true,
      },
    ],
  },
  // কোনো রুট না পেলে /login এ পাঠানোর জন্য
  {
    path: "/:catchAll(.*)",
    redirect: "/login",
  },
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
});

// Authentication Guard: এটি নিশ্চিত করবে যে লগইন না করলে ড্যাশবোর্ড দেখা যাবে না
router.beforeEach((to, from, next) => {
  // প্রমাণীকরণ চেক: এই ফ্ল্যাগটি আপনার লগইন সফল হলে HomeView.vue এ সেট করতে হবে
  const isAuthenticated = localStorage.getItem("user_logged_in") === "true";

  if (to.meta.requiresAuth && !isAuthenticated) {
    // যদি সুরক্ষিত রুট হয় এবং লগইন করা না থাকে, তবে /login এ পাঠান
    next("/login");
  } else if (to.name === "Login" && isAuthenticated) {
    // যদি লগইন করা থাকে এবং কেউ আবার /login এ যেতে চায়, তবে /roles এ পাঠান (কারণ /dashboard নেই)
    next("/roles");
  } else {
    next();
  }
});

export default router;
