type LatestPostOptions = {
  totalCount: number;
  expandedPreviewCount: number;
};

export function splitLatestPosts<T>(posts: readonly T[], options: LatestPostOptions) {
  const totalCount = Math.max(0, Math.floor(options.totalCount));
  const expandedPreviewCount = Math.min(
    totalCount,
    Math.max(0, Math.floor(options.expandedPreviewCount)),
  );
  const latestPosts = posts.slice(0, totalCount);

  return {
    expandedPosts: latestPosts.slice(0, expandedPreviewCount),
    compactPosts: latestPosts.slice(expandedPreviewCount),
  };
}
