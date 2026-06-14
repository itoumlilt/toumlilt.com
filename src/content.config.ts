import { defineCollection } from 'astro:content';
import { glob } from 'astro/loaders';
import { z } from 'astro/zod';

const writing = defineCollection({
  loader: glob({ pattern: '**/*.mdx', base: './src/content/writing' }),
  schema: z.object({
    legacy: z.object({
      id: z.number().int().positive(),
    }),
    title: z.string(),
    description: z.string(),
    date: z.date(),
    heroImage: z.string().nullable(),
    heroCaption: z.string().nullable().default(null),
    thumbnail: z.string().nullable(),
    kind: z.enum(['article', 'project']).default('article'),
    tags: z.array(z.string()).default([]),
    badges: z.array(z.string()).default([]),
    links: z
      .object({
        external: z.string().nullable().default(null),
        github: z.string().nullable().default(null),
      })
      .default({ external: null, github: null }),
    references: z
      .array(
        z.object({
          label: z.string(),
          href: z.string(),
          description: z.string().nullable().default(null),
        }),
      )
      .default([]),
    home: z.object({
      excerpt: z.string(),
    }),
    draft: z.boolean().default(false),
  }),
});

export const collections = { writing };
