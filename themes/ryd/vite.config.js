import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import path from 'path'

export default defineConfig({
  plugins: [
    laravel({
      input: ['themes/ryd/css/app.css', 'themes/ryd/js/app.js'],
      buildDirectory: 'ryd',
    }),

    {
      name: 'blade',
      handleHotUpdate({ file, server }) {
        if (file.endsWith('.blade.php')) {
          server.ws.send({
            type: 'full-reload',
            path: '*',
          })
        }
      },
    },
  ],
  resolve: {
    alias: {
      '@': '/themes/ryd/js',
    },
  },
  css: {
    postcss: {
      plugins: [
        require('tailwindcss')({
          config: path.resolve(__dirname, 'tailwind.config.js'),
        }),
      ],
    },
  },
})
