const GITHUB_BASE_URL = 'https://github.com';

const ICONS = {
  push: '/assets/icons/solid/code-branch.svg',
  pull_request: '/assets/icons/solid/code-pull-request.svg',
  issue: '/assets/icons/solid/circle-dot.svg',
  issue_comment: '/assets/icons/solid/comment.svg',
  create: '/assets/icons/solid/plus.svg',
  star: '/assets/icons/solid/star.svg',
  fork: '/assets/icons/solid/code-fork.svg',
  release: '/assets/icons/solid/tag.svg',
  unknown: '/assets/icons/brands/github.svg',
};

function repoUrl(repoName) {
  return `${GITHUB_BASE_URL}/${repoName}`;
}

function actorUrl(login) {
  return `${GITHUB_BASE_URL}/${login}`;
}

function branchName(ref) {
  return String(ref ?? '')
    .replace(/^refs\/heads\//, '')
    .replace(/^refs\/tags\//, '') || 'unknown';
}

function compactText(value, maxLength = 160) {
  const text = String(value ?? '')
    .replace(/\s+/g, ' ')
    .trim();

  if (text.length <= maxLength) {
    return text;
  }

  return `${text.slice(0, maxLength - 1).trimEnd()}…`;
}

function part(text, href, strong = false) {
  return {
    text,
    ...(href ? { href } : {}),
    ...(strong ? { strong } : {}),
  };
}

function commonEventFields(event, kind, primaryUrl, summaryParts, excerpt) {
  const repo = event.repo?.name ?? 'unknown/repository';

  return {
    id: String(event.id),
    kind,
    icon: ICONS[kind],
    createdAt: event.created_at,
    primaryUrl,
    repo,
    repoUrl: repoUrl(repo),
    summaryParts,
    ...(excerpt ? { excerpt } : {}),
  };
}

function pullRequestUrl(event, pullRequest, number) {
  return pullRequest?.html_url
    ?? (number ? `${repoUrl(event.repo?.name ?? 'unknown/repository')}/pull/${number}` : repoUrl(event.repo?.name ?? 'unknown/repository'));
}

function actorPart(event, username) {
  const login = event.actor?.login ?? username;
  return part(login, actorUrl(login), true);
}

function repoPart(event) {
  const repo = event.repo?.name ?? 'unknown/repository';
  return part(repo, repoUrl(repo), true);
}

function normalizePushEvent(event, username) {
  const repo = event.repo?.name ?? 'unknown/repository';
  const payload = event.payload ?? {};
  const ref = branchName(payload.ref);
  const refUrl = `${repoUrl(repo)}/tree/${ref}`;
  const primaryUrl = payload.before && payload.head
    ? `${repoUrl(repo)}/compare/${payload.before}...${payload.head}`
    : repoUrl(repo);
  const commitMessages = Array.isArray(payload.commits)
    ? payload.commits
        .map((commit) => compactText(commit.message, 80))
        .filter(Boolean)
        .slice(0, 3)
    : [];

  return commonEventFields(
    event,
    'push',
    primaryUrl,
    [
      actorPart(event, username),
      part(' pushed to '),
      part(ref, refUrl, true),
      part(' at '),
      repoPart(event),
    ],
    commitMessages.join('; '),
  );
}

function normalizePullRequestEvent(event, username) {
  const payload = event.payload ?? {};
  const pullRequest = payload.pull_request ?? {};
  const number = pullRequest.number ?? payload.number;
  const action = payload.action === 'closed' && pullRequest.merged
    ? 'merged'
    : payload.action ?? 'updated';
  const primaryUrl = pullRequestUrl(event, pullRequest, number);

  return commonEventFields(
    event,
    'pull_request',
    primaryUrl,
    [
      actorPart(event, username),
      part(` ${action} pull request `),
      part(`#${number}`, primaryUrl, true),
      part(' at '),
      repoPart(event),
    ],
    compactText(pullRequest.title),
  );
}

function normalizePullRequestReviewEvent(event, username) {
  const payload = event.payload ?? {};
  const review = payload.review ?? {};
  const pullRequest = payload.pull_request ?? {};
  const number = pullRequest.number;
  const primaryUrl = review.html_url ?? pullRequestUrl(event, pullRequest, number);

  return commonEventFields(
    event,
    'pull_request',
    primaryUrl,
    [
      actorPart(event, username),
      part(' reviewed pull request '),
      part(`#${number}`, pullRequestUrl(event, pullRequest, number), true),
      part(' at '),
      repoPart(event),
    ],
    compactText(review.body || review.state),
  );
}

function normalizePullRequestReviewCommentEvent(event, username) {
  const payload = event.payload ?? {};
  const comment = payload.comment ?? {};
  const pullRequest = payload.pull_request ?? {};
  const number = pullRequest.number;
  const primaryUrl = comment.html_url ?? pullRequestUrl(event, pullRequest, number);

  return commonEventFields(
    event,
    'issue_comment',
    primaryUrl,
    [
      actorPart(event, username),
      part(' commented on pull request '),
      part(`#${number}`, pullRequestUrl(event, pullRequest, number), true),
      part(' at '),
      repoPart(event),
    ],
    compactText(comment.body),
  );
}

function normalizeIssuesEvent(event, username) {
  const payload = event.payload ?? {};
  const issue = payload.issue ?? {};
  const action = payload.action ?? 'updated';
  const primaryUrl = issue.html_url ?? repoUrl(event.repo?.name ?? 'unknown/repository');

  return commonEventFields(
    event,
    'issue',
    primaryUrl,
    [
      actorPart(event, username),
      part(` ${action} issue `),
      part(`#${issue.number}`, primaryUrl, true),
      part(' at '),
      repoPart(event),
    ],
    compactText(issue.title),
  );
}

function normalizeIssueCommentEvent(event, username) {
  const payload = event.payload ?? {};
  const issue = payload.issue ?? {};
  const comment = payload.comment ?? {};
  const primaryUrl = comment.html_url ?? issue.html_url ?? repoUrl(event.repo?.name ?? 'unknown/repository');
  const subject = issue.pull_request ? 'pull request' : 'issue';

  return commonEventFields(
    event,
    'issue_comment',
    primaryUrl,
    [
      actorPart(event, username),
      part(` commented on ${subject} `),
      part(`#${issue.number}`, issue.html_url ?? primaryUrl, true),
      part(' at '),
      repoPart(event),
    ],
    compactText(comment.body),
  );
}

function normalizeCreateEvent(event, username) {
  const payload = event.payload ?? {};
  const refType = payload.ref_type ?? 'repository';
  const ref = payload.ref ? ` ${payload.ref}` : '';
  const primaryUrl = payload.ref && refType === 'branch'
    ? `${repoUrl(event.repo?.name ?? 'unknown/repository')}/tree/${payload.ref}`
    : repoUrl(event.repo?.name ?? 'unknown/repository');

  return commonEventFields(
    event,
    'create',
    primaryUrl,
    [
      actorPart(event, username),
      part(` created ${refType}${ref} at `),
      repoPart(event),
    ],
  );
}

function normalizeWatchEvent(event, username) {
  return commonEventFields(
    event,
    'star',
    repoUrl(event.repo?.name ?? 'unknown/repository'),
    [
      actorPart(event, username),
      part(' starred '),
      repoPart(event),
    ],
  );
}

function normalizeForkEvent(event, username) {
  const forkee = event.payload?.forkee;
  const primaryUrl = forkee?.html_url ?? repoUrl(event.repo?.name ?? 'unknown/repository');

  return commonEventFields(
    event,
    'fork',
    primaryUrl,
    [
      actorPart(event, username),
      part(' forked '),
      repoPart(event),
    ],
    forkee?.full_name ? `Created ${forkee.full_name}` : undefined,
  );
}

function normalizeReleaseEvent(event, username) {
  const release = event.payload?.release ?? {};
  const primaryUrl = release.html_url ?? repoUrl(event.repo?.name ?? 'unknown/repository');

  return commonEventFields(
    event,
    'release',
    primaryUrl,
    [
      actorPart(event, username),
      part(` ${event.payload?.action ?? 'published'} release `),
      part(release.tag_name ?? '', primaryUrl, true),
      part(' at '),
      repoPart(event),
    ],
    compactText(release.name || release.body),
  );
}

function normalizeUnknownEvent(event, username) {
  return commonEventFields(
    event,
    'unknown',
    repoUrl(event.repo?.name ?? 'unknown/repository'),
    [
      actorPart(event, username),
      part(' had activity at '),
      repoPart(event),
    ],
  );
}

export function normalizeGitHubEvent(event, username) {
  if (!event?.id || !event?.created_at) {
    return null;
  }

  switch (event.type) {
    case 'PushEvent':
      return normalizePushEvent(event, username);
    case 'PullRequestEvent':
      return normalizePullRequestEvent(event, username);
    case 'PullRequestReviewEvent':
      return normalizePullRequestReviewEvent(event, username);
    case 'PullRequestReviewCommentEvent':
      return normalizePullRequestReviewCommentEvent(event, username);
    case 'IssuesEvent':
      return normalizeIssuesEvent(event, username);
    case 'IssueCommentEvent':
      return normalizeIssueCommentEvent(event, username);
    case 'CreateEvent':
      return normalizeCreateEvent(event, username);
    case 'WatchEvent':
      return normalizeWatchEvent(event, username);
    case 'ForkEvent':
      return normalizeForkEvent(event, username);
    case 'ReleaseEvent':
      return normalizeReleaseEvent(event, username);
    default:
      return normalizeUnknownEvent(event, username);
  }
}

export function normalizeGitHubActivityEvents(events, options) {
  const displayLimit = Math.max(0, Math.floor(options.displayLimit ?? events.length));

  return events
    .map((event) => normalizeGitHubEvent(event, options.username))
    .filter(Boolean)
    .slice(0, displayLimit);
}

export function createEmptyGitHubActivityFeed(username) {
  return {
    username,
    generatedAt: null,
    sourceUrl: `${GITHUB_BASE_URL}/${username}`,
    items: [],
  };
}

export function createGitHubActivityFeed(events, options) {
  return {
    username: options.username,
    generatedAt: new Date().toISOString(),
    sourceUrl: `${GITHUB_BASE_URL}/${options.username}`,
    items: normalizeGitHubActivityEvents(events, options),
  };
}
