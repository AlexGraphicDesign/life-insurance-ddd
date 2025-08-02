import { defineConfig } from 'vite'
import symfonyPlugin from "vite-plugin-symfony"
import VueDevTools from 'vite-plugin-vue-devtools'
import vue from '@vitejs/plugin-vue'
import { fileURLToPath, URL } from 'node:url'

// https://vite.dev/config/
export default defineConfig({
  plugins: [
    symfonyPlugin(),
    VueDevTools(),
    vue()
  ],

  server: {
    host: true,
    port: 3001,
    https: false,

    hmr: {
        clientPort: 3001,
        host: 'life-insurance-front.app.localhost',
        port: 3001,
    },
  },

  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./front', import.meta.url))
    }
  },

  build: {
    minify: true,
    manifest: true,
    emptyOutDir: true,
    rollupOptions: {
        output: {
            manualChunks: undefined,
            sourcemap: true,
        },
        input: {
            app: "./front/main.ts",
        },
    },
  },
});
