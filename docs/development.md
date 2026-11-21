# Développement local avec Compose

Depuis la racine de ce dépôt, les mêmes commandes fonctionnent avec Colima et
Docker Desktop. Aucun Node ni npm n'est requis sur le Mac pour ce mode.
L'image officielle `node:22-bookworm` fournit Node 22 et utilise l'architecture
native du moteur (ARM64 ou AMD64), sans forcer une émulation.

## Démarrer

Démarrer Docker Desktop, ou exécuter `colima start` si ce Mac utilise Colima.
Le client `docker` et son extension Compose doivent être installés dans les deux
cas. Vérifier le moteur actif avec :

```sh
docker version
docker compose version
```

Avec Homebrew et Colima déjà installé, si le client ou Compose manque,
installer `docker` et `docker-compose` puis suivre les indications affichées par
Homebrew pour rendre l'extension disponible. Ne pas démarrer les deux moteurs
simultanément pour ce projet ; `docker context show` indique le contexte actif.

```sh
docker compose -f compose.dev.yaml up -d
docker compose -f compose.dev.yaml logs -f site
```

Attendre le message Astro « ready », puis ouvrir **http://localhost:4321**.
Le premier démarrage télécharge l'image et installe les dépendances. Ctrl+C dans
la commande `logs` arrête seulement le suivi des journaux ; le site reste actif.

| Projet | Port local |
| --- | --- |
| toumlilt.com | 4321 |
| AO Charenton | 4323 |
| Foulées Charentonnaises | 4324 |

Les trois projets peuvent tourner simultanément. Chaque fichier définit son nom
Compose propre et ne dépend d'aucun dossier parent. Toujours conserver
`-f compose.dev.yaml` : les éventuels fichiers `compose.yaml` existants servent
à vérifier le build statique avec Caddy, avec leurs propres ports et volumes.
Ne pas les fusionner avec ce fichier de développement.

## Modifier et vérifier

Les fichiers du dépôt sont partagés avec `/app` : modifier les pages, composants,
styles et contenus depuis Antigravity. Astro détecte les changements et met à jour
le navigateur sans reconstruire une image. Le serveur écoute sur toutes les
interfaces **dans le conteneur**, mais le port publié sur le Mac est limité à
`127.0.0.1`. Ne pas utiliser ce serveur de développement sur le VPS.

Le polling à une seconde fiabilise la détection des fichiers à travers les
partages de Colima et Docker Desktop. Il peut consommer plus de CPU qu'une
surveillance native ; arrêter les sites inutilisés. Les WebSockets de rechargement
passent par le même port que le site.

Pour les contrôles du dépôt, pendant que le service tourne :

```sh
docker compose -f compose.dev.yaml exec site npm run check
docker compose -f compose.dev.yaml exec site npm run build
```

Les sources restent sur le Mac. Les dépendances Linux (`node_modules`), le cache
Astro et le cache npm sont dans des volumes Docker propres à ce projet. Ils ne
remplacent pas les dépendances npm éventuellement déjà installées sur le Mac et
ne sont pas partagés entre les deux laptops ou deux moteurs Docker. Un build
écrit dans `dist/` du dépôt ; ces fichiers générés restent ignorés par Git.

## Dépendances et synchronisation Git

Chaque démarrage du conteneur exécute `npm ci` depuis `package-lock.json` avant
Astro. Le cache npm est conservé pour réduire les téléchargements. Le registre
est explicitement public. Si l'installation échoue, Astro ne démarre pas : lire
les journaux et corriger le problème, sans régénérer le lockfile au hasard.

Après un `git pull` qui change les dépendances :

```sh
docker compose -f compose.dev.yaml restart site
docker compose -f compose.dev.yaml logs -f site
```

Les changements de source ordinaires sont pris en compte automatiquement. Après
une modification de `compose.dev.yaml`, relancer `up -d` plutôt que `restart`.
Pour une mise à jour volontaire de l'image Node : `docker compose -f compose.dev.yaml pull`,
puis `docker compose -f compose.dev.yaml up -d`.

Pour ajouter une dépendance explicitement souhaitée, arrêter le service, exécuter
`docker compose -f compose.dev.yaml run --rm --no-deps site npm install nom-du-paquet`,
puis redémarrer avec `up -d`. Relire les changements de `package.json` et du lockfile.
Ne pas mélanger des installations hôte et conteneur dans le même `node_modules`.

## Arrêter et dépanner

```sh
docker compose -f compose.dev.yaml down
```

Cette commande conserve les volumes de dépendances et caches. Ne pas ajouter
`--volumes` par habitude. Ces volumes servent aux dépendances et aux caches ;
ne pas y déposer de sources ou de secrets. Pour un port occupé, arrêter l'autre
service local ou modifier le port
**à gauche** de `:4321` dans le fichier Compose, puis relancer `up -d`.

Si le rechargement semble inactif, vérifier d'abord les journaux et le chemin
cloné. Avec Colima, le dépôt doit être sous un dossier partagé avec sa VM (le
répertoire personnel est le choix le plus simple). Avec Docker Desktop, vérifier
le partage de fichiers si le moteur refuse le bind mount. Ne pas changer les
permissions du dépôt ni désactiver les contrôles de sécurité pour contourner cela.

## Alternative avec Node installé sur le Mac

Le mode npm natif reste disponible avec Node 22 (au minimum 22.12, inférieur à
23). Avec nvm déjà installé, `nvm install` et `nvm use` lisent `.nvmrc`. Sur Mac
Apple Silicon avec Homebrew, installer `node@22` puis activer son chemin dans
le terminal : `export PATH="/opt/homebrew/opt/node@22/bin:$PATH"`.

```sh
npm ci --no-audit --no-fund
npm run dev -- --port 4321
npm run check
```

Arrêter d'abord le service Compose si le port choisi est identique. Les commandes
npm natives utilisent leurs dépendances macOS ; les commandes Compose utilisent
les volumes Linux. Ne pas monter `node_modules` du Mac dans le conteneur.

Références : [bind mounts Docker](https://docs.docker.com/engine/storage/bind-mounts/),
[volumes Compose](https://docs.docker.com/reference/compose-file/volumes),
[serveur de développement Astro](https://docs.astro.build/en/reference/cli-reference/).
