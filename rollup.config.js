import svelte from 'rollup-plugin-svelte';

export default {
  input: 'src/assets/svelte/main.js',
  output: {
    file: 'public/build/svelte.js',
    format: 'iife',
  },
  plugins: [
    svelte({
      // By default, all .html and .svelte files are compiled
      extensions: ['.html'],

      // You can restrict which files are compiled
      // using `include` and `exclude`
      include: 'src/assets/svelte/components/**.html',
    })
  ],
};
