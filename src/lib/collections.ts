import type { CollectionEntry } from 'astro:content';

export type WritingEntry = CollectionEntry<'writing'>;

export function sortWritingByDate(posts: WritingEntry[]): WritingEntry[] {
  return [...posts].sort((left, right) => right.data.date.getTime() - left.data.date.getTime());
}

export function formatDisplayDate(date: Date): string {
  return new Intl.DateTimeFormat('en-GB', {
    day: '2-digit',
    month: 'short',
    year: 'numeric',
  }).format(date);
}

export function getWritingSlug(post: Pick<WritingEntry, 'id'>): string {
  return post.id.replace(/\.(md|mdx)$/, '');
}
