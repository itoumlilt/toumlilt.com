import { describe, expect, it } from 'vitest';

import { getLegacyArticleRedirects, getStaticRedirects } from '../src/lib/legacy-routes';

describe('legacy route compatibility', () => {
  it('maps old article query URLs to new writing slugs', () => {
    expect(getLegacyArticleRedirects()).toContainEqual({
      legacyId: 10,
      from: '/blog?article=10',
      to: '/writing/phd-graduation/',
    });
  });

  it('keeps first-class legacy routes redirectable', () => {
    expect(getStaticRedirects()).toEqual([
      { from: '/index', to: '/' },
      { from: '/blog', to: '/writing/' },
      { from: '/about-me', to: '/about/' },
      { from: '/thesis-defense-livestream', to: '/thesis/' },
    ]);
  });
});
