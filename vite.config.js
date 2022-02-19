import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import  laravel  from 'vite-plugin-laravel'

export default defineConfig({
    publicDir: '',

    build: {
        manifest: true,
        outDir: 'public/build',
        rollupOptions: {
            input: "resources/scripts/main.js"
        }
    },

	plugins: [
		vue(),
		laravel()
	]
})
