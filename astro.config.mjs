import mdx from '@astrojs/mdx';
import { defineConfig } from 'astro/config';

export default defineConfig({
  site: 'https://toumlilt.com',
  integrations: [mdx()],
  output: 'static',
  trailingSlash: 'always',
});
