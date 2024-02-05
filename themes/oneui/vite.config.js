import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import path from 'path'

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'themes/oneui/sass/main.scss',
        'themes/oneui/sass/oneui/themes/amethyst.scss',
        'themes/oneui/sass/oneui/themes/city.scss',
        'themes/oneui/sass/oneui/themes/flat.scss',
        'themes/oneui/sass/oneui/themes/modern.scss',
        'themes/oneui/sass/oneui/themes/smooth.scss',
        'themes/oneui/js/oneui/app.js',
        'themes/oneui/js/app.js',
        'themes/oneui/js/pages/datatables.js',
      ],
      buildDirectory: 'oneui',
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
      '@': '/themes/oneui/js',
      '~bootstrap': path.resolve('node_modules/bootstrap'),
    },
  },
})
