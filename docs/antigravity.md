# Travailler sur toumlilt.com avec Antigravity

Ce dépôt est autonome : le cloner et ouvrir directement son dossier comme projet
Antigravity. Aucun dépôt racine, lien symbolique ou réglage global d'assistant
n'est nécessaire. Les autres dépôts peuvent être installés où l'on veut.

## Première installation sur un Mac

Git, GitHub CLI, un moteur Docker (Colima ou Docker Desktop) et le client
Docker Compose sont nécessaires. Le mode recommandé utilise Node 22 dans le
conteneur : pas besoin de configurer Node sur le Mac. Voir le
[guide de développement](development.md) pour les prérequis et l'alternative npm.
Démarrer le moteur avant les commandes Compose.

S'authentifier avec le compte GitHub personnel ayant accès au dépôt :

```sh
gh auth login --hostname github.com --git-protocol https --web
gh auth setup-git
mkdir -p ~/repos/github
cd ~/repos/github
git clone --branch master https://github.com/itoumlilt/toumlilt.com.git
cd toumlilt.com
docker compose -f compose.dev.yaml up -d
docker compose -f compose.dev.yaml logs -f site
```

Si le dépôt est déjà cloné, utiliser sa copie existante et la synchroniser comme
ci-dessous. Après le message Astro « ready », le site local est accessible à
`http://localhost:4321`. Les modifications des sources sont rechargées
automatiquement. L'image Node et les volumes de dépendances sont indépendants
sur chaque Mac. Conserver `.npmrc` et le lockfile avec le registre npm public.
Ne pas committer les dépendances ni les fichiers générés.

## Consignes et charte

- [AGENTS.md](../AGENTS.md) : contraintes, emplacement des données et publication.
- [Charte graphique](design-system.md) : palette, typographie, composants et contrôle
  du rendu. Le CSS et les composants locaux sont la référence exécutable.

Antigravity découvre `AGENTS.md` à la racine du projet : c'est l'unique point
d'entrée des consignes de ce dépôt.
Les guides détaillés sont référencés plutôt qu'inclus intégralement dans les
consignes permanentes. [Documentation officielle des règles](https://antigravity.google/docs/rules/).
Pour contrôler l'installation, commencer par demander à l'assistant :

> Lis AGENTS.md et la charte graphique. Résume la branche de travail, les composants
> à réutiliser et la commande de vérification, sans modifier de fichier.

## Boucle de modification

1. Vérifier `git status --short --branch` et préciser la page, le changement attendu
   et les comportements à conserver. Charger seulement les fichiers utiles.
2. Réutiliser les données et composants existants, puis examiner le rendu local
   sur mobile et ordinateur. Le serveur local ne publie rien sur Internet.
3. Exécuter `docker compose -f compose.dev.yaml exec site npm run check` pour les
   changements de code/contenu, puis la même commande avec `npm run build` si check
   ne construit pas déjà le site. Une retouche documentaire seule
   nécessite une relecture et `git diff --check`, pas un build complet.
4. Relire `git diff`, sélectionner les fichiers avec `git add`, committer puis
   pousser lorsque la publication associée est souhaitée. Le push peut déployer.

`npm run check` exécute Astro check et les tests Vitest. `npm run build`
construit séparément le site et récupère le flux GitHub public ; aucun token
n'est nécessaire pour démarrer. Un échec de cette récupération produit un flux
vide. Les articles sont dans `src/content/writing/`, le profil dans `src/data/`.
Le push sur `master` déclenche la CI et la publication automatique ; le workflow
CD est aussi programmé quotidiennement. Le VPS ne reçoit que l'artefact `dist/`.

## Alterner entre deux Mac

Au début d'une session, depuis ce dépôt :

```sh
git status --short --branch
# Continuer seulement si le travail local est enregistré et le dossier propre.
git pull --ff-only
```

Après un changement de dépendances, relancer
`docker compose -f compose.dev.yaml restart site` pour réinstaller depuis le
lockfile. Avant de quitter le Mac :

```sh
git diff
# Sélectionner les fichiers voulus avec git add, puis :
git commit -m "Décrire la modification"
git push
git status --short --branch
```

S'il n'y a aucune modification, ne pas créer de commit. Un stash et un commit
non poussé restent sur le premier Mac. Si pull échoue ou si les deux Mac ont
modifié la même branche, examiner la divergence ; ne pas réinitialiser les fichiers
ou forcer un push pour faire disparaître le problème. Pour du travail inachevé
qui ne doit pas être déployé, utiliser une branche dédiée et la pousser, puis
reprendre cette même branche sur l'autre Mac.

## Accès, infrastructure et budget

Ne pas mettre de secrets, clés privées ou tokens dans Git ou le chat. Les secrets
GitHub Actions restent sur GitHub et ne sont pas à recopier pour un aperçu local.
Les fichiers locaux ignorés et les éventuels exports hors dépôt se transfèrent
séparément si nécessaires. Ne pas supposer que le clonage récupère les `.env`.

Le dépôt indépendant [my-ionos-vps-server](https://github.com/itoumlilt/my-ionos-vps-server)
contient les procédures d'hébergement. Il n'est pas nécessaire de le cloner pour
retoucher ce site ; il devient utile pour une modification d'infrastructure.
L'assistant ne lance pas SSH/SCP/rsync via SSH : il fournit les commandes VPS à
l'utilisateur. Les builds se font sur le Mac ou en CI, jamais sur le VPS.

Pour économiser le quota, demander une modification ciblée avec sa page de
référence et conserver les décisions durables dans les fichiers du dépôt.
Ne pas demander de réanalyser toutes les images ou tout le site à chaque retouche.
Aucun abonnement ni appel API payant supplémentaire n'est requis par ce projet ;
les limites et éventuels crédits d'Antigravity dépendent de ton compte Google.
