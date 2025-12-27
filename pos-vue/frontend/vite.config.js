import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
  plugins: [
    vue(), // শুধু Vue plugin
  ],
  resolve: {
    alias: {
      "@": "/src", // আপনার Vue src folder path
    },
  },
  server: {
    port: 5173, // dev server port
  },
});
