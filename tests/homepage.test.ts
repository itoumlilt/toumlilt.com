import { existsSync, readFileSync } from 'node:fs';
import { join } from 'node:path';

import { describe, expect, it } from 'vitest';

import { homePage } from '../src/data/homepage';
import { profile } from '../src/data/profile';
import { splitLatestPosts } from '../src/lib/homepage';

const homepageSource = readFileSync(join(process.cwd(), 'src/pages/index.astro'), 'utf8');
const aboutSource = readFileSync(join(process.cwd(), 'src/pages/about.astro'), 'utf8');
const githubActivitySource = readFileSync(join(process.cwd(), 'src/components/GitHubActivityCard.astro'), 'utf8');
const contactCardSource = readFileSync(join(process.cwd(), 'src/components/ContactCard.astro'), 'utf8');
const introTextPath = join(process.cwd(), 'src/components/IntroText.astro');
const introTextSource = existsSync(introTextPath) ? readFileSync(introTextPath, 'utf8') : '';
const latestBlogPostsCardSource = readFileSync(join(process.cwd(), 'src/components/LatestBlogPostsCard.astro'), 'utf8');
const webProfilesCardSource = readFileSync(join(process.cwd(), 'src/components/WebProfilesCard.astro'), 'utf8');
const profileHeroPath = join(process.cwd(), 'src/components/ProfileHero.astro');
const profileHeroSource = existsSync(profileHeroPath) ? readFileSync(profileHeroPath, 'utf8') : '';
const baseLayoutSource = readFileSync(join(process.cwd(), 'src/layouts/BaseLayout.astro'), 'utf8');
const headerSource = readFileSync(join(process.cwd(), 'src/components/SiteHeader.astro'), 'utf8');
const footerSource = readFileSync(join(process.cwd(), 'src/components/SiteFooter.astro'), 'utf8');
const globalCssSource = readFileSync(join(process.cwd(), 'src/styles/global.css'), 'utf8');

describe('homepage latest article card', () => {
  it('keeps the legacy-style featured article structure', () => {
    expect(homepageSource).toContain('featured-image');
    expect(homepageSource).toContain('featured-excerpt');
    expect(homepageSource).toContain('featured-actions');
    expect(homepageSource).toContain('ribbon');
    expect(homepageSource).toContain('More details');
  });

  it('configures two expanded latest previews by default', () => {
    expect(homePage.latestPosts.expandedPreviewCount).toBe(2);
  });

  it('splits latest posts into expanded previews and compact feed entries', () => {
    const posts = ['first', 'second', 'third', 'fourth'];

    expect(splitLatestPosts(posts, { totalCount: 4, expandedPreviewCount: 2 })).toEqual({
      expandedPosts: ['first', 'second'],
      compactPosts: ['third', 'fourth'],
    });
  });
});

describe('homepage GitHub activity card', () => {
  it('renders through the GitHub activity component and preserves the chart', () => {
    expect(homepageSource).toContain('GitHubActivityCard');
    expect(homepageSource).toContain('loadGitHubActivityFeed');
    expect(githubActivitySource).toContain('/assets/images/github-chart.png');
    expect(githubActivitySource).toContain('My Github Feed');
    expect(githubActivitySource).toContain('github-activity-empty');
    expect(githubActivitySource).toContain('Recent GitHub activity');
  });
});

describe('shared sidebar cards', () => {
  it('uses reusable cards for the contact, RSS, and profile blocks', () => {
    for (const componentName of ['ContactCard', 'LatestBlogPostsCard', 'WebProfilesCard']) {
      expect(homepageSource).toContain(componentName);
      expect(aboutSource).toContain(componentName);
    }

    expect(contactCardSource).toContain('contact-list');
    expect(contactCardSource).not.toContain('https://toumlilt.com');
    expect(contactCardSource).not.toContain('/assets/icons/solid/link.svg');
    expect(latestBlogPostsCardSource).toContain('Latest Blog Posts');
    expect(webProfilesCardSource).toContain('Web Profiles');
  });
});

describe('shared profile hero', () => {
  it('renders from the base layout so every page keeps the profile header', () => {
    expect(profile.title).toBe('PhD, Distributed Systems');
    expect(baseLayoutSource).toContain('ProfileHero');
    expect(baseLayoutSource).toContain('<ProfileHero />');
    expect(profileHeroSource).toContain('profile-hero');
    expect(profileHeroSource).toContain('profile-photo');
    expect(profileHeroSource).toContain('profile.title');
    expect(profileHeroSource).toContain('social-dots');
    expect(profileHeroSource).toContain('Contact me');
    expect(homepageSource).not.toContain('<section class="profile-hero">');
  });
});

describe('about page', () => {
  it('uses the current intro copy on home and about pages', () => {
    expect(profile.intro).toBe(
      'Writing about distributed systems research, Concordant, open source contributions, operating systems teaching, and technology.',
    );
    expect(profile.homeIntro).toEqual([
      'Hello World! Welcome to my corner of the web.',
      'Here you’ll find writing about my Distributed Systems Research, building the Concordant Startup, my Open Source contributions, previous PhD Thesis contributions, and the engineering ideas I keep coming back to.',
      'I also teach operating systems at Sorbonne University and occasionally in engineering schools in Grenoble, Paris and Zurich.',
      'Beyond research, I’m curious about technology, blockchain systems, and spending unreasonable amounts of time in running shoes.',
    ]);
    expect(profile.homeIntroLinks).toEqual([
      { label: 'Concordant Startup', href: 'https://github.com/concordant' },
      { label: 'Sorbonne University', href: 'https://www.sorbonne-universite.fr/' },
      { label: 'PhD Thesis', href: 'https://www.lip6.fr/actualite/personnes-fiche.php?ident=D2188' },
      { label: 'running shoes', href: 'https://www.strava.com/athletes/22914252' },
    ]);
    expect(homepageSource).toContain('IntroText');
    expect(aboutSource).toContain('IntroText');
    expect(introTextSource).toContain('homeIntroLinks');
    expect(introTextSource).toContain('<a href={part.href}');
    expect(homepageSource).not.toContain('I teach Master and Licence Operating Systems lectures');
    expect(aboutSource).not.toContain('I teach Master and Licence Operating Systems lectures');
  });

  it('restores the legacy intro and work experience content', () => {
    expect(aboutSource).toContain('Intro');
    expect(aboutSource).toContain('Experience');
    expect(aboutSource).toContain('Founding team, CTO');
    expect(aboutSource).toContain('Doctoral Researcher');
    expect(aboutSource).toContain('Operating Systems Lecturer');
    expect(aboutSource).toContain('Research Intern');
    expect(aboutSource).toContain('Experimental Systems Intern');
    expect(aboutSource).toContain('Concordant grew out of distributed systems research');
    expect(aboutSource).toContain('This work was developed within the RainbowFS French project');
    expect(aboutSource).toContain('https://github.com/concordant');
    expect(aboutSource).toContain('Concordant GitHub organization');
    expect(aboutSource).not.toContain('https://concordant.io');
    expect(aboutSource).toContain('More on my LinkedIn');
    expect(aboutSource).toContain('id="teaching"');
  });
});

describe('site chrome', () => {
  it('keeps the top navigation visible while scrolling', () => {
    expect(headerSource).toContain('site-header');
    expect(headerSource).toContain('desktop-nav');
    expect(headerSource).toContain('mobile-header-bar');
    expect(headerSource).toContain('mobile-home-link');
    expect(headerSource).toContain('mobile-page-title');
    expect(headerSource).toContain('mobile-menu');
    expect(headerSource).toContain('mobile-menu-panel');
    expect(headerSource).toContain('/assets/icons/solid/bars.svg');
    expect(headerSource).toContain('icon:');
    expect(headerSource).toContain('nav-icon');
    for (const icon of [
      '/assets/icons/solid/house.svg',
      '/assets/icons/solid/pen-nib.svg',
      '/assets/icons/solid/graduation-cap.svg',
      '/assets/icons/solid/diagram-project.svg',
      '/assets/icons/solid/address-card.svg',
    ]) {
      expect(headerSource).toContain(icon);
    }
    expect(headerSource).not.toContain("label: 'Thesis'");
    expect(headerSource).not.toContain('/assets/icons/solid/book-open.svg');
    expect(globalCssSource).toContain('.nav-icon');
    expect(globalCssSource).toContain('.mobile-header-bar');
    expect(globalCssSource).toContain('.desktop-nav');
    expect(globalCssSource).toContain('display: none');
    expect(globalCssSource).toContain('.mobile-menu-panel');
    expect(globalCssSource).toContain('position: fixed');
    expect(globalCssSource).toContain('padding-top: var(--site-header-height)');
    expect(globalCssSource).toContain('top: 0');
    expect(globalCssSource).toContain('z-index:');
    for (const icon of ['house.svg', 'pen-nib.svg', 'diagram-project.svg', 'address-card.svg', 'bars.svg']) {
      expect(existsSync(join(process.cwd(), `public/assets/icons/solid/${icon}`))).toBe(true);
    }
  });

  it('renders the compact handcrafted footer with icon actions', () => {
    expect(footerSource).toContain('Handcrafted with');
    expect(footerSource).toContain('and some');
    expect(footerSource).not.toContain('a lot of');
    expect(footerSource).toContain('by {profile.name}');
    expect(footerSource).toContain('/assets/icons/solid/heart.svg');
    expect(footerSource).toContain('/assets/icons/solid/mug-saucer.svg');
    expect(footerSource).toContain('mailto:${profile.email}');
    expect(footerSource).toContain('Source code');
    expect(footerSource).toContain('/assets/icons/brands/github.svg');
    expect(globalCssSource).toContain('padding: 14px 0 16px');
    expect(globalCssSource).toContain('height: 28px');
    expect(globalCssSource).toContain('width: 28px');
    expect(existsSync(join(process.cwd(), 'public/assets/icons/solid/heart.svg'))).toBe(true);
    expect(existsSync(join(process.cwd(), 'public/assets/icons/solid/mug-saucer.svg'))).toBe(true);
  });
});
