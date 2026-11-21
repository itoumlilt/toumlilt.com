# toumlilt.com — consignes pour les assistants

Ce dépôt est autonome : ouvrir directement ce dossier dans Antigravity.
Lire `docs/antigravity.md` pour l'installation et le travail entre deux Mac,
et `docs/design-system.md` avant toute modification visuelle.

## Projet et sources

- Site personnel statique Astro/TypeScript/MDX, sans base de données ni CMS.
- Branche habituelle : `master`. Le push sur `master` déclenche la publication
  automatique après CI ; une publication quotidienne est aussi programmée.
- Pages : `src/pages/` ; articles : `src/content/writing/` ; données du profil,
  de l'accueil et des projets : `src/data/`.
- Réutiliser les composants de `src/components/`, les layouts et les variables
  de `src/styles/global.css`. Préserver l'identité violet/gris et les médias locaux.
- Préserver les slugs, les identifiants `legacy.id`, les anciennes redirections
  `/blog?article=N`, les métadonnées et les liens publics.
- Le domaine canonique est `https://toumlilt.com` dans `astro.config.mjs`.
  La configuration du serveur est dans le dépôt GitHub
  `itoumlilt/my-ionos-vps-server`, pas dans ce dépôt de site.

## Travail et vérification

- Utiliser Node 22, au minimum 22.12 et inférieur à 23, et le registre npm public.
  Conserver `package-lock.json` ; ne pas importer d'outillage ou de registre d'entreprise.
- Vérifier `git status --short --branch` avant de modifier ; conserver les travaux
  existants. Travailler sur le périmètre demandé, sans refonte ou dépendance ajoutée
  simplement pour retoucher une page. Répondre en français ; conserver la langue
  des contenus du site sauf demande contraire.
- Après une modification de code/contenu : `npm run check` puis `npm run build`.
  Pour le visuel, vérifier le rendu local sur mobile et ordinateur ; signaler si
  aucune vérification visuelle n'a été possible. Une modification de documentation
  seule ne nécessite pas de reconstruire le site.
- Le build récupère un flux GitHub public ; un échec réseau produit un flux vide.
  Ne jamais utiliser de données privées pour enrichir ce flux.
- Construire sur le Mac ou en CI, jamais sur le VPS. Celui-ci reçoit `dist/` et
  sert les fichiers avec Caddy depuis `/srv/toumlilt-com/site`.
- Ne jamais exécuter SSH, SCP ou rsync via SSH depuis un assistant. Fournir les
  commandes à l'utilisateur pour toute inspection ou modification du VPS.
- Ne pas committer de secrets, clés privées ou fichiers `.env` ; ne pas demander
  leurs valeurs dans une conversation. Pas de reset, push forcé ou suppression
  de données pour résoudre une synchronisation. Ne pousser/publier que si demandé.

## Contexte et coût

Charger seulement les fichiers utiles à la tâche et les composants voisins.
Ne pas parcourir systématiquement toutes les images, les dépendances ou tous les
articles. Réutiliser la charte et les composants avant d'en créer de nouveaux.
N'ajouter aucun service payant, appel d'API facturé ou achat de crédits sans demande.
