export type Project = {
  name: string;
  summary: string;
  href: string;
  image: string;
  tags: string[];
};

export const projects: Project[] = [
  {
    name: 'ColonyDB',
    summary:
      'A local-first edge datastore with peer-to-peer collaboration, CRDT APIs, and cloud-backed replication.',
    href: 'https://github.com/itoumlilt/Colony',
    image: '/assets/images/blogarticles/blogarticle_10_img_2.png',
    tags: ['Thesis', 'Edge', 'Consistency'],
  },
  {
    name: 'AntidoteDB',
    summary:
      'A highly available, geo-replicated key-value database built around CRDTs and scalable consistency.',
    href: 'https://github.com/antidotedb/antidote',
    image: '/assets/images/projects/project-antidotedb.png',
    tags: ['CRDT', 'Database', 'Replication'],
  },
  {
    name: 'CRDT Markdown Editor',
    summary:
      'A collaborative editor comparing revision-based and CRDT-based approaches for offline-capable text editing.',
    href: 'https://github.com/itoumlilt/crdt-md-editor',
    image: '/assets/images/projects/project-crdt-mded.png',
    tags: ['CRDT', 'TypeScript', 'Collaboration'],
  },
  {
    name: 'Concordant',
    summary:
      'A local-first platform for edge and mobile apps, shaped from thesis work and startup R&D.',
    href: 'https://github.com/concordant',
    image: '/assets/images/projects/project-concordant.png',
    tags: ['Local-first', 'Startup', 'Edge'],
  },
];
