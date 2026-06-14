import { existsSync, readFileSync } from 'node:fs';
import { join } from 'node:path';

export type GitHubActivityKind =
  | 'push'
  | 'pull_request'
  | 'issue'
  | 'issue_comment'
  | 'create'
  | 'star'
  | 'fork'
  | 'release'
  | 'unknown';

export type GitHubActivitySummaryPart = {
  text: string;
  href?: string;
  strong?: boolean;
};

export type GitHubActivityItem = {
  id: string;
  kind: GitHubActivityKind;
  icon: string;
  createdAt: string;
  primaryUrl: string;
  repo: string;
  repoUrl: string;
  summaryParts: GitHubActivitySummaryPart[];
  excerpt?: string;
};

export type GitHubActivityFeed = {
  username: string;
  generatedAt: string | null;
  sourceUrl: string;
  items: GitHubActivityItem[];
};

type GitHubActivityConfig = {
  username: string;
};

function emptyFeed(username: string): GitHubActivityFeed {
  return {
    username,
    generatedAt: null,
    sourceUrl: `https://github.com/${username}`,
    items: [],
  };
}

function isFeed(value: unknown): value is GitHubActivityFeed {
  if (!value || typeof value !== 'object') {
    return false;
  }

  const candidate = value as GitHubActivityFeed;
  return (
    typeof candidate.username === 'string'
    && (typeof candidate.generatedAt === 'string' || candidate.generatedAt === null)
    && typeof candidate.sourceUrl === 'string'
    && Array.isArray(candidate.items)
  );
}

export function loadGitHubActivityFeed(config: GitHubActivityConfig): GitHubActivityFeed {
  const generatedPath = join(process.cwd(), 'src/data/generated/github-activity.json');

  if (!existsSync(generatedPath)) {
    return emptyFeed(config.username);
  }

  try {
    const feed = JSON.parse(readFileSync(generatedPath, 'utf8')) as unknown;
    return isFeed(feed) ? feed : emptyFeed(config.username);
  } catch {
    return emptyFeed(config.username);
  }
}
