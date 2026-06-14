import { mkdir, readFile, writeFile } from 'node:fs/promises';
import path from 'node:path';
import { fileURLToPath } from 'node:url';

const root = path.resolve(path.dirname(fileURLToPath(import.meta.url)), '..');
const legacyArticlesDir = path.join(root, 'legacy/php-site/src/data/articles');
const outputDir = path.join(root, 'src/content/writing');

const articles = {
  1: {
    slug: 'causal-consistency-without-slowdown-chains',
    kind: 'article',
    tags: ['research', 'distributed systems'],
  },
  2: {
    slug: 'geo-replication-and-edge-storage-systems',
    kind: 'article',
    tags: ['research', 'distributed systems'],
  },
  3: {
    slug: 'edgeant-pushing-antidotedb-to-the-edge',
    kind: 'article',
    tags: ['research', 'edge computing'],
  },
  4: {
    slug: 'crdt-collaborative-markdown-editor',
    kind: 'project',
    title: 'CRDT Markdown Editor',
    tags: ['open source', 'crdt'],
    badges: ['open source'],
  },
  5: {
    slug: 'crdt-collaborative-spreadsheet',
    kind: 'project',
    title: 'CRDT Collaborative Spreadsheet',
    tags: ['open source', 'crdt'],
    badges: ['open source'],
  },
  6: {
    slug: 'antidotedb',
    kind: 'project',
    title: 'AntidoteDB',
    tags: ['open source', 'database'],
    badges: ['open source'],
  },
  7: {
    slug: 'colony-middleware-paper',
    kind: 'article',
    tags: ['research', 'paper'],
  },
  8: {
    slug: 'phd-thesis-defense',
    kind: 'article',
    tags: ['phd', 'archive'],
  },
  9: {
    slug: 'the-concordant-platform',
    kind: 'project',
    title: 'The Concordant.io Platform',
    tags: ['open source', 'startup', 'edge computing'],
    badges: ['open source', 'project'],
  },
  10: {
    slug: 'phd-graduation',
    kind: 'article',
    tags: ['phd', 'research'],
  },
};

const tagNames = [
  'name',
  'date',
  'etitle',
  'esummary',
  'externallink',
  'githublink',
  'smallimg',
  'wideimg',
  'fulltext',
  'shorttext',
  'veryshorttext',
];

function extractTag(xml, tagName) {
  const match = xml.match(new RegExp(`<${tagName}>\\s*([\\s\\S]*?)\\s*</${tagName}>`, 'm'));
  return match ? match[1].trim() : '';
}

function decodeHtml(value) {
  return value
    .replace(/&nbsp;/g, ' ')
    .replace(/&amp;/g, '&')
    .replace(/&lt;/g, '<')
    .replace(/&gt;/g, '>')
    .replace(/&quot;/g, '"')
    .replace(/&#39;/g, "'")
    .replace(/&#x27;/g, "'")
    .replace(/&#x2F;/g, '/');
}

function stripHtml(value) {
  return decodeHtml(value)
    .replace(/<script[\s\S]*?<\/script>/gi, '')
    .replace(/<[^>]*>/g, ' ')
    .replace(/\s+/g, ' ')
    .trim();
}

function normalizeNullable(value) {
  const trimmed = value.trim();
  return trimmed === '' || trimmed === 'null' ? null : trimmed;
}

function normalizeImage(value) {
  const normalized = normalizeNullable(value);
  if (!normalized) {
    return null;
  }

  const fileName = normalized.replace(/^\/+/, '');
  return `/assets/images/blogarticles/${fileName}`;
}

function normalizeLegacyUrls(html) {
  return html
    .replace(/<script[\s\S]*?<\/script>/gi, '')
    .replaceAll('src="assets/images/', 'src="/assets/images/')
    .replaceAll("src='assets/images/", "src='/assets/images/")
    .replaceAll('href="assets/', 'href="/assets/')
    .replaceAll("href='assets/", "href='/assets/")
    .replaceAll('href="/blog?article=10"', 'href="/writing/phd-graduation/"')
    .replaceAll('href="/blog?article=9"', 'href="/writing/the-concordant-platform/"')
    .replaceAll('href="/blog?article=8"', 'href="/writing/phd-thesis-defense/"')
    .replaceAll('href="/blog?article=7"', 'href="/writing/colony-middleware-paper/"')
    .replaceAll('href="/blog?article=6"', 'href="/writing/antidotedb/"')
    .replaceAll('href="/blog?article=5"', 'href="/writing/crdt-collaborative-spreadsheet/"')
    .replaceAll('href="/blog?article=4"', 'href="/writing/crdt-collaborative-markdown-editor/"')
    .replaceAll('href="/blog?article=3"', 'href="/writing/edgeant-pushing-antidotedb-to-the-edge/"')
    .replaceAll('href="/blog?article=2"', 'href="/writing/geo-replication-and-edge-storage-systems/"')
    .replaceAll('href="/blog?article=1"', 'href="/writing/causal-consistency-without-slowdown-chains/"');
}

function normalizeTypoUrls(value) {
  return value.replace('hhttps://github.com/itoumlilt/c-crdtlib', 'https://github.com/itoumlilt/c-crdtlib');
}

function toIsoDate(date) {
  const [day, month, year] = date.split('/');
  return `${year}-${month}-${day}`;
}

function yamlString(value) {
  return JSON.stringify(value);
}

function yamlNullableString(value) {
  return value === null ? 'null' : yamlString(value);
}

function yamlArray(values = []) {
  return `[${values.map((value) => yamlString(value)).join(', ')}]`;
}

function extractAttribute(tag, name) {
  const match = tag.match(new RegExp(`${name}=["']([^"']*)["']`, 'i'));
  return match ? decodeHtml(match[1]) : '';
}

function inlineToMarkdown(html) {
  let value = normalizeTypoUrls(normalizeLegacyUrls(html));

  value = value.replace(/<(i|span)\b[^>]*(?:fa-|glyphicon)[^>]*>[\s\S]*?<\/\1>/gi, '');
  value = value.replace(/<(strong|b)\b[^>]*>([\s\S]*?)<\/\1>/gi, (_, _tag, text) => `**${inlineToMarkdown(text)}**`);
  value = value.replace(/<i\b(?![^>]*(?:fa-|glyphicon))[^>]*>([\s\S]*?)<\/i>/gi, (_, text) => `_${inlineToMarkdown(text)}_`);
  value = value.replace(/<em\b[^>]*>([\s\S]*?)<\/em>/gi, (_, text) => `_${inlineToMarkdown(text)}_`);
  value = value.replace(/<a\b([^>]*)>([\s\S]*?)<\/a>/gi, (_, attrs, text) => {
    const href = normalizeTypoUrls(extractAttribute(`<a ${attrs}>`, 'href'));
    const label = inlineToMarkdown(text).replace(/\s+/g, ' ').trim();
    return href && label ? `[${label}](${href})` : label;
  });
  value = value.replace(/<br\s*\/?>/gi, '\n');
  value = value.replace(/<\/?[a-z][^>]*>/g, '');
  value = decodeHtml(value);
  value = value.replace(/[ \t]+\n/g, '\n').replace(/\n[ \t]+/g, '\n');
  return value.replace(/[ \t]{2,}/g, ' ').trim();
}

function convertProjectBlock(block) {
  const imageTag = block.match(/<img\b[^>]*>/i)?.[0] ?? '';
  const image = normalizeTypoUrls(extractAttribute(imageTag, 'src'));
  const imageAlt = extractAttribute(imageTag, 'alt');
  const titleAnchor = block.match(/<h3\b[^>]*>[\s\S]*?<a\b[^>]*>[\s\S]*?<\/a>[\s\S]*?<\/h3>/i)?.[0] ?? '';
  const href = normalizeTypoUrls(extractAttribute(titleAnchor, 'href'));
  const title = stripHtml(titleAnchor);
  const paragraphMatches = [...block.matchAll(/<p\b[^>]*>([\s\S]*?)<\/p>/gi)];
  const paragraphs = paragraphMatches
    .map((match) => inlineToMarkdown(match[1]))
    .filter((text) => text && !/view on github/i.test(text));

  if (!title || !href) {
    return htmlToMdx(block);
  }

  const props = [
    `title=${yamlString(title)}`,
    `href=${yamlString(href)}`,
    image ? `image=${yamlString(image)}` : '',
    imageAlt ? `imageAlt=${yamlString(imageAlt)}` : '',
    'actionLabel="View on GitHub"',
  ].filter(Boolean);

  return [
    `<ArticleProject ${props.join(' ')}>`,
    '',
    paragraphs.join('\n\n'),
    '',
    '</ArticleProject>',
  ].join('\n');
}

function convertList(html) {
  const items = [...html.matchAll(/<li\b[^>]*>([\s\S]*?)<\/li>/gi)]
    .map((match) => `- ${inlineToMarkdown(match[1]).replace(/\n+/g, ' ')}`)
    .join('\n');
  return `\n\n${items}\n\n`;
}

function htmlToMdx(html) {
  let value = normalizeTypoUrls(normalizeLegacyUrls(html));

  value = value.replace(/<!--\/\/item:[\s\S]*?<!--\/\/item-->/gi, (block) => `\n\n${convertProjectBlock(block)}\n\n`);
  value = value.replace(/<div\b[^>]*class=["'][^"']*alert[^"']*["'][^>]*>([\s\S]*?)<\/div>/gi, (_, content) => {
    const callout = htmlToMdx(content);
    return `\n\n<Callout>\n\n${callout}\n\n</Callout>\n\n`;
  });
  value = value.replace(/<iframe\b[^>]*><\/iframe>|<iframe\b[^>]*>[\s\S]*?<\/iframe>/gi, (tag) => {
    const src = extractAttribute(tag, 'src');
    const title = extractAttribute(tag, 'title') || 'Embedded video';
    return `\n\n<VideoEmbed src=${yamlString(src)} title=${yamlString(title)} />\n\n`;
  });
  value = value.replace(/<h2\b[^>]*>([\s\S]*?)<\/h2>/gi, (_, content) => `\n\n## ${inlineToMarkdown(content)}\n\n`);
  value = value.replace(/<h3\b[^>]*>([\s\S]*?)<\/h3>/gi, (_, content) => `\n\n### ${inlineToMarkdown(content)}\n\n`);
  value = value.replace(/<h6\b[^>]*>([\s\S]*?)<\/h6>/gi, (_, content) => `\n\n#### ${inlineToMarkdown(content)}\n\n`);
  value = value.replace(/<hr\b[^>]*\/?>/gi, '\n\n---\n\n');
  value = value.replace(/<img\b[^>]*>/gi, (tag) => {
    const src = normalizeTypoUrls(extractAttribute(tag, 'src'));
    const alt = extractAttribute(tag, 'alt');
    return src ? `\n\n![${alt}](${src})\n\n` : '';
  });
  value = value.replace(/<ul\b[^>]*>([\s\S]*?)<\/ul>/gi, (_, content) => convertList(content));
  value = value.replace(/<p\b[^>]*>([\s\S]*?)<\/p>/gi, (_, content) => `\n\n${inlineToMarkdown(content)}\n\n`);
  value = inlineToMarkdown(value);
  return cleanMdx(value);
}

function cleanMdx(value) {
  const lines = value
    .replace(/\r\n/g, '\n')
    .split('\n')
    .map((line) => line.trim())
    .map((line) => {
      if (line.startsWith('<') || line.startsWith('</') || line.startsWith('import ')) {
        return line;
      }

      return line
        .replaceAll('{', '\\{')
        .replaceAll('}', '\\}')
        .replace(/(?<!\\)</g, '&lt;')
        .replace(/(?<!\\)>/g, '&gt;');
    });

  const collapsed = [];
  for (const line of lines) {
    const previous = collapsed.at(-1);
    if (line === '' && previous === '') {
      continue;
    }
    collapsed.push(line);
  }

  return collapsed.join('\n').replace(/\n{3,}/g, '\n\n').trim();
}

function componentImports(body) {
  const imports = [];
  if (body.includes('<ArticleProject')) {
    imports.push("import ArticleProject from '../../components/mdx/ArticleProject.astro';");
  }
  if (body.includes('<Callout')) {
    imports.push("import Callout from '../../components/mdx/Callout.astro';");
  }
  if (body.includes('<VideoEmbed')) {
    imports.push("import VideoEmbed from '../../components/mdx/VideoEmbed.astro';");
  }
  return imports.length > 0 ? `${imports.join('\n')}\n\n` : '';
}

async function migrateArticle(id) {
  const xml = await readFile(path.join(legacyArticlesDir, `blogarticle_${id}.xml`), 'utf8');
  const article = Object.fromEntries(tagNames.map((tagName) => [tagName, extractTag(xml, tagName)]));
  const config = articles[id];
  const outputPath = path.join(outputDir, `${config.slug}.mdx`);
  const body = htmlToMdx(article.fulltext);
  const homeExcerpt = stripHtml(article.shorttext || article.veryshorttext || article.esummary);
  const externalLink = normalizeNullable(article.externallink);
  const githubLink = normalizeNullable(article.githublink);

  const mdx = `---
legacy:
  id: ${id}
title: ${yamlString(config.title ?? stripHtml(article.etitle))}
description: ${yamlString(article.esummary.replace(/\s+/g, ' ').trim())}
date: ${toIsoDate(article.date)}
heroImage: ${yamlNullableString(normalizeImage(article.wideimg))}
heroCaption: null
thumbnail: ${yamlNullableString(normalizeImage(article.smallimg))}
kind: ${yamlString(config.kind)}
tags: ${yamlArray(config.tags)}
badges: ${yamlArray(config.badges)}
links:
  external: ${yamlNullableString(externalLink)}
  github: ${yamlNullableString(githubLink)}
references: []
home:
  excerpt: ${yamlString(homeExcerpt)}
draft: false
---

${componentImports(body)}${body}
`;

  await writeFile(outputPath, mdx, 'utf8');
}

await mkdir(outputDir, { recursive: true });
await Promise.all(Object.keys(articles).map((id) => migrateArticle(Number(id))));
