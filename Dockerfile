# syntax=docker/dockerfile:1

FROM node:22-bookworm-slim AS build

WORKDIR /app

ENV ASTRO_TELEMETRY_DISABLED=1
ENV NPM_CONFIG_AUDIT=false
ENV NPM_CONFIG_FUND=false
ENV NPM_CONFIG_UPDATE_NOTIFIER=false

COPY package.json package-lock.json ./
RUN npm ci --no-audit --no-fund

COPY . .
RUN npm run build

FROM caddy:2 AS runtime

COPY --from=build /app/dist /srv/site
