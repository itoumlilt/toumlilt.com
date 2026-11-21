# Charte graphique du site personnel

Référence extraite du code le 21 novembre 2026. Elle décrit le site actuel, pas
une proposition de refonte. Les composants et CSS restent la référence exécutable.

## Identité et palette

Un portfolio éditorial sobre : fond gris bleuté, surfaces blanches, accents violets,
portrait et contenus au premier plan. Conserver cette identité sur toute nouvelle
page ; les chartes bleu/jaune du club et des Foulées sont distinctes.

| Variable de `src/styles/global.css` | Valeur | Usage |
| --- | --- | --- |
| `--color-page` | `#dbe4e9` | Fond de page |
| `--color-surface` | `#ffffff` | Cartes |
| `--color-soft` | `#edf1f4` | Surfaces secondaires |
| `--color-ink` | `#45465a` | Texte principal |
| `--color-muted` | `#686d86` | Texte secondaire |
| `--color-line` | `#cfd8df` | Bordures |
| `--color-purple` | `#8b6aa5` | Identité et accents |
| `--color-purple-dark` | `#735a90` | Variante violette foncée |
| `--color-blue` | `#1680d8` | Liens |
| `--color-rust` | `#9d5b36` | Survol des liens |
| `--color-nav` | `#74818a` | Navigation |

Réutiliser les variables plutôt que recopier les valeurs dans de nouveaux styles.
Vérifier le contraste du couple texte/fond choisi, notamment pour les petits textes.

## Typographie et composition

- Corps et titres : pile `Avenir Next`, Avenir, Inter, puis polices système.
  Ces noms sont des préférences CSS, pas une garantie de police installée : le rendu
  peut varier entre deux Mac. Ne pas ajouter de chargement distant sans nécessité.
- Largeur de section : `--content-max: 1060px`. Articles : texte jusqu'à `860px`,
  médias jusqu'à `1120px`, avec gouttières fluides déjà définies.
- Navigation fixe, hauteur `60px`, bordure violette de `4px` ; préserver le décalage
  du corps pour ne pas masquer le début des pages.
- Titres fluides via `clamp()`, cartes blanches à bordure fine et angles généralement
  de `8px`. Réutiliser les classes et espacements de la page voisine.
- Le portrait est rond. Conserver les proportions et les recadrages existants ;
  ne pas étirer images, icônes ou captures de projets.

## Composants à réutiliser

| Besoin | Source |
| --- | --- |
| Structure, métadonnées, header/portrait/footer | `src/layouts/BaseLayout.astro` |
| Navigation et pied de page | `src/components/SiteHeader.astro`, `SiteFooter.astro` |
| Présentation et contact | `src/components/ProfileHero.astro`, `ContactCard.astro` |
| Aperçu d'article et variantes | `src/components/PostCard.astro` |
| Projet | `src/components/ProjectCard.astro` |
| Contenu MDX | `src/components/mdx/` |

Les icônes locales sont dans `public/assets/icons/` et les images dans
`public/assets/images/`. Le profil et les liens viennent de `src/data/profile.ts`.
Ne pas inventer de bouton de marque AOC/Foulées pour ce site personnel.

## Validation d'une retouche

1. Lire le composant et ses sélecteurs dans `src/styles/global.css` avant d'éditer.
2. Préserver la hiérarchie des titres, les liens nommés, les textes alternatifs et
   l'accès clavier. Ajouter des effets sobres et respecter la réduction des
   animations si de nouveaux mouvements sont introduits.
3. Examiner accueil, page modifiée et article à environ 375px et 1440px de largeur.
   Vérifier navigation, cartes, titres longs et absence de débordement horizontal.
   Les adaptations existantes se trouvent notamment à 820px, 700px et 520px.
4. Exécuter les vérifications décrites dans `docs/antigravity.md`. Ne pas annoncer
   une conformité visuelle ou d'accessibilité sans l'avoir vérifiée.
