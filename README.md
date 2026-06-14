# toumlilt.com

Personal website for [https://toumlilt.com](https://toumlilt.com).

The site is a static [Astro](https://astro.build/) project. It replaced the old
PHP/XML/Bootstrap implementation, which is kept only as a migration reference in
`legacy/php-site`.

## Stack

- Astro static output
- TypeScript strict mode
- MDX content collections for writing entries
- Plain CSS in `src/styles/global.css`
- Caddy runtime image built from `Dockerfile`

There is no PHP, database, jQuery, or Bootstrap runtime in the modernized site.

## Development

```bash
npm ci
npm run check
npm run dev
```

Build locally:

```bash
npm run build
npm run preview
```

## Content

Writing entries live in `src/content/writing/*.mdx`.

Each article uses Astro content collection frontmatter:

- `legacy.id` keeps compatibility with old `/blog?article=N` links.
- `title`, `description`, `date`, `kind`, `tags`, and `badges` drive archive
  and article metadata.
- `heroImage`, `heroCaption`, and `thumbnail` control article and card media.
- `links` and `references` render the references section at the end of articles.
- `home.excerpt` controls expanded homepage previews.
- The article body is regular MDX.

The original XML articles can be re-read from
`legacy/php-site/src/data/articles` and were migrated with:

```bash
node scripts/migrate-legacy-articles.mjs
```

That script is kept as migration tooling; current articles are maintained
directly as MDX.

Static assets used by the new site are under `public/assets/images` and
`public/data`.

## Routes

Current first-class routes:

- `/`
- `/writing/`
- `/writing/<slug>/`
- `/projects/`
- `/teaching/`
- `/thesis/`
- `/about/`

Production Caddy redirects preserve the old public URLs:

- `/index` -> `/`
- `/blog` -> `/writing/`
- `/blog?article=N` -> matching writing slug
- `/about-me` -> `/about/`
- `/thesis-defense-livestream` -> `/thesis/`

## Deployment

CI runs `npm ci`, `npm run check`, and `npm run build`.

CD uploads the generated `dist/` artifact to the server-side deploy script:

```bash
/opt/stacks/toumlilt-com/deploy.sh
```

The VPS does not build the Astro project. It only receives static files under
`/srv/toumlilt-com/site` and restarts the Caddy-only Compose stack.
