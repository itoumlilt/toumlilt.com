import { describe, expect, it } from 'vitest';

import { formatDisplayDate, getWritingSlug, sortWritingByDate } from '../src/lib/collections';

describe('collection helpers', () => {
  it('sorts writing entries newest first without mutating input', () => {
    const older = { data: { date: new Date('2021-01-01') } };
    const newer = { data: { date: new Date('2022-01-01') } };
    const input = [older, newer] as never;

    expect(sortWritingByDate(input)).toEqual([newer, older]);
    expect(input).toEqual([older, newer]);
  });

  it('formats dates for compact display', () => {
    expect(formatDisplayDate(new Date('2022-06-25T00:00:00Z'))).toBe('25 Jun 2022');
  });

  it('derives public slugs without collection file extensions', () => {
    expect(getWritingSlug({ id: 'phd-graduation.mdx' } as never)).toBe('phd-graduation');
  });
});
