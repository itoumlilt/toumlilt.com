export type StaticRedirect = {
  from: string;
  to: string;
};

export type LegacyArticleRedirect = StaticRedirect & {
  legacyId: number;
};

export const legacyArticleSlugs: Record<number, string> = {
  1: 'causal-consistency-without-slowdown-chains',
  2: 'geo-replication-and-edge-storage-systems',
  3: 'edgeant-pushing-antidotedb-to-the-edge',
  4: 'crdt-collaborative-markdown-editor',
  5: 'crdt-collaborative-spreadsheet',
  6: 'antidotedb',
  7: 'colony-middleware-paper',
  8: 'phd-thesis-defense',
  9: 'the-concordant-platform',
  10: 'phd-graduation',
};

export function getLegacyArticleRedirects(): LegacyArticleRedirect[] {
  return Object.entries(legacyArticleSlugs).map(([legacyId, slug]) => ({
    legacyId: Number(legacyId),
    from: `/blog?article=${legacyId}`,
    to: `/writing/${slug}/`,
  }));
}

export function getStaticRedirects(): StaticRedirect[] {
  return [
    { from: '/index', to: '/' },
    { from: '/blog', to: '/writing/' },
    { from: '/about-me', to: '/about/' },
    { from: '/thesis-defense-livestream', to: '/thesis/' },
  ];
}
