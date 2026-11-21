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

- Mode local recommandé : `docker compose -f compose.dev.yaml up -d`, puis
  `docker compose -f compose.dev.yaml exec site npm run check` et `npm run build`
  via le même préfixe. Lire `docs/development.md` pour les ports, le rechargement
  et les dépendances. Compatible Colima/Docker Desktop ; Node 22 reste dans le
  conteneur. Ne pas utiliser cette configuration de développement sur le VPS.
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

## Vérification obligatoire avant commit et push

Traiter chaque nouveau commit comme susceptible d'être rendu public un jour,
même si le dépôt est actuellement privé. Avant chaque commit, examiner la liste
exacte des fichiers sélectionnés (`git diff --cached --name-status`), puis leur
diff complet (`git diff --cached`). Avant chaque push, vérifier aussi les commits
locaux à publier depuis la branche distante suivie, pas seulement le dernier diff.

- Ne committer que des changements dont la publication future est autorisée.
  Exclure les secrets, tokens, clés privées, mots de passe, URL d'accès signées,
  sauvegardes réelles et fichiers de configuration contenant des valeurs privées.
  Les exemples doivent employer des valeurs fictives et manifestement telles.
- Exclure les données personnelles non destinées à une diffusion publique, les
  exports de comptes, journaux et métadonnées sensibles. Examiner aussi les images,
  documents, archives, fixtures et fichiers générés ; un diff texte ou un détecteur
  de secrets ne suffit pas à contrôler leur contenu.
- Ne pas incorporer de code, documentation, données, noms d'hôtes, registres ou
  configurations confidentiels d'un employeur, client ou tiers. Utiliser des outils
  publics et des exemples neutres ; vérifier aussi les URL résolues des lockfiles.
- Pour tout ajout ou copie de code, texte, photo, logo, police ou autre ressource,
  vérifier la provenance, le droit de redistribution, la licence et les attributions
  nécessaires. Le fait qu'une ressource soit accessible en ligne ne suffit pas.
  Conserver les mentions requises et ne pas inventer d'autorisation.
- Si un élément est douteux, l'exclure du commit et signaler précisément ce qui
  manque pour décider, sans afficher sa valeur sensible. Ne pas compter sur le
  caractère privé du dépôt ou une suppression ultérieure pour le rendre acceptable.
- Résumer le contrôle dans le compte rendu. Ce contrôle est une consigne pour
  l'assistant, pas une protection automatique de Git ni un audit de tout l'historique.
  Une fuite déjà committée doit être signalée pour correction adaptée ; ne pas
  réécrire l'historique, changer la visibilité ou ajouter une licence sans demande.
