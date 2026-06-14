import { mkdir, readFile, writeFile } from 'node:fs/promises';
import { dirname } from 'node:path';
import { fileURLToPath } from 'node:url';

import { Octokit } from 'octokit';

import {
  createEmptyGitHubActivityFeed,
  createGitHubActivityFeed,
} from './lib/github-activity.mjs';

const configUrl = new URL('../src/data/github-activity.config.json', import.meta.url);
const outputUrl = new URL('../src/data/generated/github-activity.json', import.meta.url);

function clampInteger(value, min, max) {
  const numeric = Number(value);
  if (!Number.isFinite(numeric)) {
    return min;
  }

  return Math.min(max, Math.max(min, Math.floor(numeric)));
}

async function readConfig() {
  const rawConfig = JSON.parse(await readFile(configUrl, 'utf8'));

  return {
    username: String(rawConfig.username ?? 'itoumlilt'),
    fetchLimit: clampInteger(rawConfig.fetchLimit ?? 30, 1, 100),
    displayLimit: clampInteger(rawConfig.displayLimit ?? 7, 0, 100),
  };
}

async function writeFeed(feed) {
  const outputPath = fileURLToPath(outputUrl);
  await mkdir(dirname(outputPath), { recursive: true });
  await writeFile(outputPath, `${JSON.stringify(feed, null, 2)}\n`, 'utf8');
}

async function main() {
  const config = await readConfig();
  const token = process.env.GITHUB_ACTIVITY_TOKEN || process.env.GITHUB_TOKEN || undefined;
  const octokit = new Octokit(token ? { auth: token } : {});

  try {
    const response = await octokit.request('GET /users/{username}/events/public', {
      username: config.username,
      per_page: config.fetchLimit,
      headers: {
        'X-GitHub-Api-Version': '2022-11-28',
      },
    });

    await writeFeed(createGitHubActivityFeed(response.data, config));
    console.log(`Fetched ${response.data.length} public GitHub events for ${config.username}.`);
  } catch (error) {
    console.warn(`Could not fetch public GitHub activity for ${config.username}: ${error.message}`);
    await writeFeed(createEmptyGitHubActivityFeed(config.username));
  }
}

await main();
