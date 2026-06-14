import { readFileSync, readdirSync } from 'node:fs';
import { join } from 'node:path';

import { describe, expect, it } from 'vitest';

const writingDir = join(process.cwd(), 'src/content/writing');
const writingFiles = readdirSync(writingDir)
  .filter((fileName) => fileName.endsWith('.mdx'))
  .sort();

function splitMdx(source: string): { frontmatter: string; body: string } {
  const match = source.match(/^---\n([\s\S]*?)\n---\n([\s\S]*)$/);

  if (!match) {
    throw new Error('MDX file is missing frontmatter fences');
  }

  return { frontmatter: match[1], body: match[2] };
}

describe('writing content model', () => {
  it('stores migrated articles as structured frontmatter plus editable MDX bodies', () => {
    expect(writingFiles.length).toBeGreaterThan(0);

    for (const fileName of writingFiles) {
      const source = readFileSync(join(writingDir, fileName), 'utf8');
      const { frontmatter, body } = splitMdx(source);

      expect(frontmatter, fileName).toContain('legacy:\n  id:');
      expect(frontmatter, fileName).toMatch(/^description:/m);
      expect(frontmatter, fileName).toContain('home:\n  excerpt:');
      expect(frontmatter, fileName).not.toMatch(/^legacyId:/m);
      expect(frontmatter, fileName).not.toMatch(/^legacyHtml:/m);
      expect(frontmatter, fileName).not.toMatch(/^excerptHtml:/m);
      expect(source, fileName).not.toContain('https://concordant.io');

      expect(body.trim().length, fileName).toBeGreaterThan(80);
      expect(body, fileName).not.toContain('<p>');
      expect(body, fileName).not.toContain('class="');
      expect(body, fileName).not.toContain('fas fa-');
      expect(body, fileName).not.toContain('glyphicon');
    }
  });

  it('renders article pages through the MDX Content component', () => {
    const source = readFileSync(join(process.cwd(), 'src/pages/writing/[slug].astro'), 'utf8');

    expect(source).toContain('const { Content } = await render(post);');
    expect(source).toContain('<Content />');
    expect(source).not.toContain('LegacyHtml');
    expect(source).not.toContain('legacyHtml');
  });

  it('keeps archive navigation at the bottom of article pages', () => {
    const source = readFileSync(join(process.cwd(), 'src/pages/writing/[slug].astro'), 'utf8');

    const headerSource = source.match(/<header>[\s\S]*?<\/header>/)?.[0] ?? '';

    expect(headerSource).not.toContain('Writing archive');
    expect(headerSource).not.toContain('View all Blog Articles');
    expect(source).toContain('related-writing-footer');
    expect(source).toContain('View all Blog Articles');
    expect(source).toContain('href="/writing/"');
  });

  it('keeps related writing cards focused on reading the next article', () => {
    const pageSource = readFileSync(join(process.cwd(), 'src/pages/writing/[slug].astro'), 'utf8');
    const cardSource = readFileSync(join(process.cwd(), 'src/components/PostCard.astro'), 'utf8');
    const cssSource = readFileSync(join(process.cwd(), 'src/styles/global.css'), 'utf8');

    expect(pageSource).toContain('showBadges={false}');
    expect(pageSource).toContain('showSecondaryActions={false}');
    expect(pageSource).toContain('subtleReadMore={true}');
    expect(pageSource).toContain("book-open.svg");

    expect(cardSource).toContain('showBadges');
    expect(cardSource).toContain('showSecondaryActions');
    expect(cardSource).toContain('subtleReadMore');
    expect(cardSource).toContain('post-card-read-link');
    expect(cardSource).toContain('Read More');

    expect(cssSource).toContain('.action-row .post-card-read-link');
    expect(cssSource).toContain('content: " ->";');
  });

  it('presents the blog archive as a compact article list with a single read-more link', () => {
    const archiveSource = readFileSync(join(process.cwd(), 'src/pages/writing/index.astro'), 'utf8');
    const cardSource = readFileSync(join(process.cwd(), 'src/components/PostCard.astro'), 'utf8');
    const cssSource = readFileSync(join(process.cwd(), 'src/styles/global.css'), 'utf8');

    expect(archiveSource).toContain('title="Blog"');
    expect(archiveSource).toContain('<h1>Articles</h1>');
    expect(archiveSource).toContain('reverse-chronological list');
    expect(archiveSource).toContain('compact={true}');
    expect(archiveSource).not.toContain('linkMedia={false}');
    expect(archiveSource).not.toContain('linkTitle={false}');
    expect(archiveSource).toContain('showKind={true}');
    expect(archiveSource).toContain('showBadges={false}');
    expect(archiveSource).toContain('showSecondaryActions={false}');
    expect(archiveSource).toContain('subtleReadMore={true}');

    expect(cardSource).toContain('compact?: boolean');
    expect(cardSource).toContain('linkMedia?: boolean');
    expect(cardSource).toContain('linkTitle?: boolean');
    expect(cardSource).toContain('showKind?: boolean');
    expect(cardSource).toContain("post.data.kind === 'project' ? 'Project writeup' : 'Article'");
    expect(cardSource).toContain('post-card-meta');
    expect(cardSource).toContain("['post-card', { featured, compact }]");

    expect(cssSource).toContain('.blog-list');
    expect(cssSource).toContain('.post-card.compact');
    expect(cssSource).toContain('.post-card-meta');
    expect(cssSource).toContain('grid-template-columns: minmax(150px, 210px) minmax(0, 1fr);');
  });

  it('keeps external project references out of article headers', () => {
    const pageSource = readFileSync(join(process.cwd(), 'src/pages/writing/[slug].astro'), 'utf8');
    const cssSource = readFileSync(join(process.cwd(), 'src/styles/global.css'), 'utf8');
    const headerSource = pageSource.match(/<header[\s\S]*?<\/header>/)?.[0] ?? '';

    expect(headerSource).not.toContain('post.data.links.github');
    expect(headerSource).not.toContain('post.data.links.external');
    expect(pageSource).toContain('post-references');
    expect(pageSource).toContain('References');
    expect(pageSource).toContain('Project source');
    expect(pageSource).toContain('Project website');
    expect(cssSource).toContain('.post-references');
    expect(cssSource).toContain('.post-meta-line');
  });

  it('keeps topic tags in bottom article info instead of the article header', () => {
    const pageSource = readFileSync(join(process.cwd(), 'src/pages/writing/[slug].astro'), 'utf8');
    const cssSource = readFileSync(join(process.cwd(), 'src/styles/global.css'), 'utf8');
    const headerSource = pageSource.match(/<header[\s\S]*?<\/header>/)?.[0] ?? '';

    expect(headerSource).not.toContain('post.data.badges');
    expect(headerSource).not.toContain('content-badges');
    expect(pageSource).toContain('post-article-info');
    expect(pageSource).toContain('Filed under');
    expect(pageSource).toContain('post.data.tags');
    expect(cssSource).toContain('.post-article-info');
    expect(cssSource).toContain('.post-topic-list');
  });

  it('supports structured reference links in article frontmatter', () => {
    const configSource = readFileSync(join(process.cwd(), 'src/content.config.ts'), 'utf8');
    const pageSource = readFileSync(join(process.cwd(), 'src/pages/writing/[slug].astro'), 'utf8');
    const concordantSource = readFileSync(join(writingDir, 'the-concordant-platform.mdx'), 'utf8');

    expect(configSource).toContain('references: z');
    expect(configSource).toContain('label: z.string()');
    expect(configSource).toContain('href: z.string()');
    expect(pageSource).toContain('post.data.references');
    expect(concordantSource).toContain('references:');
    expect(concordantSource).toContain('Concordant Vision Paper');
    expect(concordantSource).not.toContain('[Download the full Concordant Vision Paper]');
  });

  it('keeps the Concordant article polished and explanatory', () => {
    const concordantSource = readFileSync(join(writingDir, 'the-concordant-platform.mdx'), 'utf8');
    const cssSource = readFileSync(join(process.cwd(), 'src/styles/global.css'), 'utf8');

    expect(concordantSource).toContain('date: 2022-07-01');
    expect(concordantSource).toContain('Backend-as-a-Service');
    expect(concordantSource).toContain('local-first');
    expect(concordantSource).toContain('highly available');
    expect(concordantSource).not.toContain('traditional BaaS design on its head');

    expect(cssSource).toContain('.post-media-inner');
    expect(cssSource).toContain('width: 100%;');
    expect(cssSource).toContain('.post-hero-figure figcaption');
    expect(cssSource).toContain('text-align: center;');
  });

  it('keeps Concordant demo app articles as product stories, not bare repo notes', () => {
    const markdownDemoSource = readFileSync(join(writingDir, 'crdt-collaborative-markdown-editor.mdx'), 'utf8');
    const spreadsheetDemoSource = readFileSync(join(writingDir, 'crdt-collaborative-spreadsheet.mdx'), 'utf8');

    for (const source of [markdownDemoSource, spreadsheetDemoSource]) {
      expect(source).toContain('Concordant');
      expect(source).toContain('revision-based');
      expect(source).toContain('CRDT-based');
      expect(source).toContain('references:');
      expect(source).toContain('The Concordant.io Platform');
      expect(source).not.toContain('consitency');
      expect(source).not.toContain('backed without');
    }

    expect(markdownDemoSource).toContain('collaborative Markdown document');
    expect(spreadsheetDemoSource).toContain('structured cells');
    expect(spreadsheetDemoSource).toContain('C-Service interface');
  });

  it('uses an intentional article media block around hero images', () => {
    const pageSource = readFileSync(join(process.cwd(), 'src/pages/writing/[slug].astro'), 'utf8');
    const cssSource = readFileSync(join(process.cwd(), 'src/styles/global.css'), 'utf8');

    expect(pageSource).toContain('post-media-block');
    expect(pageSource).toContain('post-media-inner');
    expect(pageSource).toContain('post-hero-figure');
    expect(pageSource).toContain('post.data.heroCaption');
    expect(pageSource).toContain('<figcaption>{post.data.heroCaption}</figcaption>');

    expect(cssSource).toContain('--article-text-max');
    expect(cssSource).toContain('--article-media-max');
    expect(cssSource).toContain('.post-text-column');
    expect(cssSource).toContain('.post-media-block');
  });

  it('uses plain homepage excerpts instead of raw HTML snippets', () => {
    const source = readFileSync(join(process.cwd(), 'src/pages/index.astro'), 'utf8');

    expect(source).toContain('post.data.home.excerpt');
    expect(source).not.toContain('excerptHtml');
    expect(source).not.toContain('set:html={post.data.excerptHtml}');
  });
});
