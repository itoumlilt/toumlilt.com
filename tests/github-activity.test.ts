import { describe, expect, it } from 'vitest';

import {
  createEmptyGitHubActivityFeed,
  normalizeGitHubActivityEvents,
} from '../scripts/lib/github-activity.mjs';

const baseEvent = {
  id: '1',
  actor: {
    login: 'itoumlilt',
    url: 'https://api.github.com/users/itoumlilt',
  },
  repo: {
    name: 'itoumlilt/toumlilt.com',
    url: 'https://api.github.com/repos/itoumlilt/toumlilt.com',
  },
  created_at: '2026-06-10T10:00:00Z',
  public: true,
};

function summaryText(item: { summaryParts: Array<{ text: string }> }) {
  return item.summaryParts.map((part) => part.text).join('');
}

describe('GitHub activity normalization', () => {
  it('normalizes push events into branch/repository summary parts', () => {
    const [item] = normalizeGitHubActivityEvents([
      {
        ...baseEvent,
        type: 'PushEvent',
        payload: {
          ref: 'refs/heads/master',
          before: 'abc123',
          head: 'def456',
          size: 2,
          commits: [
            { message: 'Update homepage' },
            { message: 'Fix styles' },
          ],
        },
      },
    ], { username: 'itoumlilt', displayLimit: 7 });

    expect(item).toMatchObject({
      id: '1',
      kind: 'push',
      icon: '/assets/icons/solid/code-branch.svg',
      primaryUrl: 'https://github.com/itoumlilt/toumlilt.com/compare/abc123...def456',
      repo: 'itoumlilt/toumlilt.com',
      repoUrl: 'https://github.com/itoumlilt/toumlilt.com',
      excerpt: 'Update homepage; Fix styles',
    });
    expect(summaryText(item)).toBe(
      'itoumlilt pushed to master at itoumlilt/toumlilt.com',
    );
  });

  it('distinguishes opened and merged pull requests', () => {
    const items = normalizeGitHubActivityEvents([
      {
        ...baseEvent,
        id: '2',
        type: 'PullRequestEvent',
        payload: {
          action: 'closed',
          pull_request: {
            number: 8,
            title: 'Improve homepage navigation',
            merged: true,
            html_url: 'https://github.com/example-forks/demo-operator/pull/8',
          },
        },
        repo: {
          name: 'example-forks/demo-operator',
          url: 'https://api.github.com/repos/example-forks/demo-operator',
        },
      },
      {
        ...baseEvent,
        id: '3',
        type: 'PullRequestEvent',
        payload: {
          action: 'opened',
          pull_request: {
            number: 9,
            title: 'Add static build',
            merged: false,
            html_url: 'https://github.com/itoumlilt/toumlilt.com/pull/9',
          },
        },
      },
    ], { username: 'itoumlilt', displayLimit: 7 });

    expect(items[0].kind).toBe('pull_request');
    expect(items[0].primaryUrl).toBe('https://github.com/example-forks/demo-operator/pull/8');
    expect(summaryText(items[0])).toBe(
      'itoumlilt merged pull request #8 at example-forks/demo-operator',
    );
    expect(items[0].excerpt).toBe('Improve homepage navigation');
    expect(summaryText(items[1])).toBe(
      'itoumlilt opened pull request #9 at itoumlilt/toumlilt.com',
    );
  });

  it('normalizes pull request review events from public activity payloads', () => {
    const items = normalizeGitHubActivityEvents([
      {
        ...baseEvent,
        id: '8',
        type: 'PullRequestReviewEvent',
        payload: {
          action: 'created',
          review: {
            state: 'commented',
            html_url: 'https://github.com/example-forks/demo-operator/pull/8#pullrequestreview-4334755254',
            body: null,
          },
          pull_request: {
            number: 8,
            url: 'https://api.github.com/repos/example-forks/demo-operator/pulls/8',
          },
        },
        repo: {
          name: 'example-forks/demo-operator',
          url: 'https://api.github.com/repos/example-forks/demo-operator',
        },
      },
      {
        ...baseEvent,
        id: '9',
        type: 'PullRequestReviewCommentEvent',
        payload: {
          action: 'created',
          comment: {
            html_url: 'https://github.com/example-forks/demo-operator/pull/8#discussion_r3279322025',
            body: 'Yes, this was intentional but it is not directly related to the navigation update.',
          },
          pull_request: {
            number: 8,
            url: 'https://api.github.com/repos/example-forks/demo-operator/pulls/8',
          },
        },
        repo: {
          name: 'example-forks/demo-operator',
          url: 'https://api.github.com/repos/example-forks/demo-operator',
        },
      },
    ], { username: 'itoumlilt', displayLimit: 7 });

    expect(items[0].kind).toBe('pull_request');
    expect(summaryText(items[0])).toBe(
      'itoumlilt reviewed pull request #8 at example-forks/demo-operator',
    );
    expect(items[1].kind).toBe('issue_comment');
    expect(summaryText(items[1])).toBe(
      'itoumlilt commented on pull request #8 at example-forks/demo-operator',
    );
    expect(items[1].excerpt).toContain('navigation update');
  });

  it('normalizes issue comments with compact excerpts', () => {
    const [item] = normalizeGitHubActivityEvents([
      {
        ...baseEvent,
        id: '4',
        type: 'IssueCommentEvent',
        payload: {
          action: 'created',
          issue: {
            number: 8,
            html_url: 'https://github.com/example-forks/demo-operator/pull/8',
            pull_request: {},
          },
          comment: {
            html_url: 'https://github.com/example-forks/demo-operator/pull/8#issuecomment-1',
            body: 'Yes, this was intentional but it is not directly related to the navigation update.',
          },
        },
        repo: {
          name: 'example-forks/demo-operator',
          url: 'https://api.github.com/repos/example-forks/demo-operator',
        },
      },
    ], { username: 'itoumlilt', displayLimit: 7 });

    expect(item.kind).toBe('issue_comment');
    expect(item.primaryUrl).toBe('https://github.com/example-forks/demo-operator/pull/8#issuecomment-1');
    expect(summaryText(item)).toBe(
      'itoumlilt commented on pull request #8 at example-forks/demo-operator',
    );
    expect(item.excerpt).toContain('navigation update');
  });

  it('normalizes create, star, and unknown events', () => {
    const items = normalizeGitHubActivityEvents([
      {
        ...baseEvent,
        id: '5',
        type: 'CreateEvent',
        payload: {
          ref_type: 'branch',
          ref: 'dev',
        },
      },
      {
        ...baseEvent,
        id: '6',
        type: 'WatchEvent',
        payload: {
          action: 'started',
        },
      },
      {
        ...baseEvent,
        id: '7',
        type: 'SomethingNewEvent',
        payload: {},
      },
    ], { username: 'itoumlilt', displayLimit: 7 });

    expect(items[0].kind).toBe('create');
    expect(summaryText(items[0])).toBe(
      'itoumlilt created branch dev at itoumlilt/toumlilt.com',
    );
    expect(items[1].kind).toBe('star');
    expect(summaryText(items[1])).toBe(
      'itoumlilt starred itoumlilt/toumlilt.com',
    );
    expect(items[2].kind).toBe('unknown');
    expect(summaryText(items[2])).toBe(
      'itoumlilt had activity at itoumlilt/toumlilt.com',
    );
  });

  it('creates an empty feed fallback without generatedAt', () => {
    expect(createEmptyGitHubActivityFeed('itoumlilt')).toEqual({
      username: 'itoumlilt',
      generatedAt: null,
      sourceUrl: 'https://github.com/itoumlilt',
      items: [],
    });
  });
});
