# toumlilt.com

Personal website for [https://toumlilt.com](https://toumlilt.com).

The site is a static [Astro](https://astro.build/) project. Astro is the only
maintained implementation in this repository.

## Stack

- Astro static output
- TypeScript strict mode
- MDX content collections for writing entries
- Plain CSS in `src/styles/global.css`
- Caddy runtime image built from `Dockerfile`

There is no server-side application runtime or database.

## Antigravity et travail sur plusieurs Mac

Ce dépôt se clone et s'ouvre seul, sans dépôt racine commun. Lire le
[guide d'installation et de synchronisation](docs/antigravity.md), les
[consignes pour les assistants](AGENTS.md) et la [charte graphique](docs/design-system.md).
Branche habituelle : `master` ; utiliser Node 22 (au minimum 22.12, inférieur à 23).
Le push sur `master` déclenche la publication après CI.

## Development

Mode recommandé avec Colima ou Docker Desktop, Node 22 dans le conteneur et
rechargement automatique, sur <http://localhost:4321> :

```bash
docker compose -f compose.dev.yaml up -d
docker compose -f compose.dev.yaml logs -f site
```

Vérifier avec `docker compose -f compose.dev.yaml exec site npm run check`, puis
la même commande avec `npm run build`. Arrêter avec
`docker compose -f compose.dev.yaml down`.
Voir [le guide de développement](docs/development.md) pour les volumes, la
synchronisation et le dépannage. Le serveur local reste limité à ce Mac.

Alternative sans conteneur, avec Node 22 installé sur le Mac :

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
