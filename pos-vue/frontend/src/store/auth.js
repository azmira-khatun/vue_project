// src/store/auth.js
import { defineStore } from "pinia";

export const useAuthStore = defineStore("auth", {
  state: () => ({
    user: null,
    permissions: [],
  }),

  actions: {
    setAuth(data) {
      this.user = data.user;
      this.permissions = data.permissions;
    },
  },
});
