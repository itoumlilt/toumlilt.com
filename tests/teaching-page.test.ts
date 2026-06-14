import { existsSync, readFileSync } from 'node:fs';
import { join } from 'node:path';

import { describe, expect, it } from 'vitest';

const teachingPagePath = join(process.cwd(), 'src/pages/teaching.astro');
const headerSource = readFileSync(join(process.cwd(), 'src/components/SiteHeader.astro'), 'utf8');

describe('teaching page', () => {
  it('bootstraps the restricted teaching landing page', () => {
    expect(existsSync(teachingPagePath)).toBe(true);

    const teachingPageSource = readFileSync(teachingPagePath, 'utf8');

    expect(teachingPageSource).toContain('teaching-gatekeeper.svg');
    expect(teachingPageSource).toContain('U Shall Not Pass!');
    expect(teachingPageSource).toContain('This page is only accessible for my students devices!');
  });

  it('routes the Teaching menu to the new page', () => {
    expect(headerSource).toContain("href: '/teaching/'");
    expect(headerSource).not.toContain("href: '/about/#teaching'");
  });
});
