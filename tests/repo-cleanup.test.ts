import { existsSync, readFileSync } from 'node:fs';
import { join } from 'node:path';

import { describe, expect, it } from 'vitest';

describe('repository cleanup', () => {
  it('does not keep migration-only site artifacts', () => {
    const removedSitePath = join(process.cwd(), 'legacy', 'php-site');
    const removedMigrationScript = join(process.cwd(), 'scripts', ['migrate', 'legacy', 'articles'].join('-') + '.mjs');
    const removedXmlDependency = ['fast', 'xml-parser'].join('-');

    expect(existsSync(removedSitePath)).toBe(false);
    expect(existsSync(removedMigrationScript)).toBe(false);

    const packageJson = JSON.parse(readFileSync(join(process.cwd(), 'package.json'), 'utf8'));
    expect(packageJson.devDependencies).not.toHaveProperty(removedXmlDependency);
  });
});
