import { createRouter, createWebHistory } from 'vue-router';

// Layout
const Dash = () => import('@/views/adminPanel/Dash.vue'); // your main layout

// Pages
const HomeView = () => import('@/views//HomeView.vue');
const RolesList = () => import('@/components/role/RoleList.vue');
const AddRole = () => import('@/components/role/RoleCreate.vue');
const EditRole = () => import('@/components/role/RoleEdit.vue');

const routes = [
  {
    path: '/',
    component: Dash, // Layout wrapper
    children: [
      { path: '', name: 'Home', component: HomeView },
      { path: 'roles', name: 'RolesList', component: RolesList },
      { path: 'roles/create', name: 'AddRole', component: AddRole },
      { path: 'roles/edit/:id', name: 'EditRole', component: EditRole, props: true }
    ]
  }
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
});

export default router;
