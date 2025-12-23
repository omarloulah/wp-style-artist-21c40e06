export interface Article {
  id: string;
  title: string;
  excerpt: string;
  content: string;
  slug: string;
  category: string;
  categorySlug: string;
  date: string;
  readTime: string;
  author: string;
  image: string;
  featured?: boolean;
}

export const articles: Article[] = [
  {
    id: '1',
    title: 'Internal Linking for Small Sites: A Realistic Strategy',
    excerpt: 'Internal linking advice often assumes large sites with hundreds of pages. For small sites with 20-50 articles, the strategies differ significantly.',
    content: `Internal linking advice often assumes large sites with hundreds of pages. For small sites with 20-50 articles, the strategies differ significantly. You have fewer pages to link between, limited topical clusters, and every internal link matters more.

## Why Internal Linking Matters More for Small Sites

Internal links serve multiple purposes, and their importance increases when you have fewer total pages.

### Discovery and Crawling
- **Help search engines find pages:** Every page needs links pointing to it. Orphan pages (no internal links) may not get crawled or indexed.
- **Establish hierarchy:** Pages linked from many places appear more important than pages with few links.
- **Fresh content discovery:** Links from existing pages help search engines discover new content faster.

### Authority Distribution
When you have limited pages, you need to be strategic about which pages receive the most internal links. Unlike large sites that can create extensive topic silos, small sites must focus on:

1. Identifying cornerstone content
2. Supporting articles that strengthen cornerstone pages
3. Creating logical content clusters with what you have

## Practical Internal Linking Strategies

### The Hub and Spoke Model
Create 3-5 cornerstone articles that serve as hubs. All other related content links back to these hubs while the hubs link out to supporting content.

### Contextual Linking
Every new article should include 2-3 relevant internal links placed naturally within the content. Focus on descriptive anchor text that tells both users and search engines what the linked page is about.`,
    slug: 'internal-linking-small-sites-strategy',
    category: 'SEO Basics',
    categorySlug: 'seo-basics',
    date: 'December 21, 2024',
    readTime: '10 min read',
    author: 'admin',
    image: 'https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?w=800&auto=format&fit=crop&q=60',
    featured: true,
  },
  {
    id: '2',
    title: 'Complete Guide to Core Web Vitals Optimization',
    excerpt: 'Learn how to optimize your website for Core Web Vitals and improve your search rankings with practical techniques.',
    content: 'Core Web Vitals are a set of metrics that measure real-world user experience...',
    slug: 'core-web-vitals-guide',
    category: 'Site Performance',
    categorySlug: 'performance',
    date: 'December 18, 2024',
    readTime: '8 min read',
    author: 'admin',
    image: 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&auto=format&fit=crop&q=60',
  },
  {
    id: '3',
    title: 'WordPress Security Best Practices for 2024',
    excerpt: 'Protect your WordPress site from hackers with these essential security measures and plugins.',
    content: 'WordPress security is more important than ever...',
    slug: 'wordpress-security-2024',
    category: 'Web Security',
    categorySlug: 'security',
    date: 'December 15, 2024',
    readTime: '12 min read',
    author: 'admin',
    image: 'https://images.unsplash.com/photo-1555949963-aa79dcee981c?w=800&auto=format&fit=crop&q=60',
  },
  {
    id: '4',
    title: 'AI-Powered Content Workflows: A Practical Guide',
    excerpt: 'How to integrate AI tools into your content creation process without losing the human touch.',
    content: 'AI is transforming how we create content...',
    slug: 'ai-content-workflows',
    category: 'AI Workflow',
    categorySlug: 'ai-workflow',
    date: 'December 12, 2024',
    readTime: '7 min read',
    author: 'admin',
    image: 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=800&auto=format&fit=crop&q=60',
  },
  {
    id: '5',
    title: 'Image Optimization: Beyond Compression',
    excerpt: 'Advanced image optimization techniques that go beyond simple compression for faster loading times.',
    content: 'Image optimization is crucial for web performance...',
    slug: 'image-optimization-advanced',
    category: 'Site Performance',
    categorySlug: 'performance',
    date: 'December 10, 2024',
    readTime: '6 min read',
    author: 'admin',
    image: 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&auto=format&fit=crop&q=60',
  },
  {
    id: '6',
    title: 'SSL Certificates: Everything You Need to Know',
    excerpt: 'A comprehensive guide to SSL certificates, types, installation, and common issues.',
    content: 'SSL certificates are essential for website security...',
    slug: 'ssl-certificates-guide',
    category: 'Web Security',
    categorySlug: 'security',
    date: 'December 8, 2024',
    readTime: '9 min read',
    author: 'admin',
    image: 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=800&auto=format&fit=crop&q=60',
  },
];

export const getFeaturedArticle = () => articles.find((a) => a.featured) || articles[0];

export const getArticlesByCategory = (categorySlug: string) =>
  articles.filter((a) => a.categorySlug === categorySlug);

export const getArticleBySlug = (slug: string) =>
  articles.find((a) => a.slug === slug);
