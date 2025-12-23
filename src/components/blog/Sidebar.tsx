import { Link } from 'react-router-dom';
import { TrendingUp, Tag } from 'lucide-react';

const popularArticles = [
  {
    title: 'Internal Linking for Small Sites: A Realistic Strategy',
    slug: 'internal-linking-small-sites-strategy',
    views: '2.5K',
  },
  {
    title: 'Complete Guide to Core Web Vitals Optimization',
    slug: 'core-web-vitals-guide',
    views: '1.8K',
  },
  {
    title: 'WordPress Security Best Practices 2024',
    slug: 'wordpress-security-2024',
    views: '1.2K',
  },
];

const popularTags = [
  'SEO',
  'WordPress',
  'Performance',
  'Security',
  'AI',
  'Internal Linking',
  'Core Web Vitals',
  'SSL',
];

export function Sidebar() {
  return (
    <aside className="space-y-8">
      {/* Popular Articles */}
      <div className="rounded-xl border border-border bg-card p-6">
        <div className="flex items-center gap-2 mb-4">
          <TrendingUp className="h-5 w-5 text-primary" />
          <h3 className="font-semibold text-card-foreground">الأكثر قراءة</h3>
        </div>
        <ul className="space-y-4">
          {popularArticles.map((article, index) => (
            <li key={article.slug}>
              <Link
                to={`/article/${article.slug}`}
                className="group flex gap-3"
              >
                <span className="flex-shrink-0 w-8 h-8 rounded-lg bg-primary/10 text-primary font-bold flex items-center justify-center text-sm">
                  {index + 1}
                </span>
                <div className="flex-1 min-w-0">
                  <h4 className="text-sm font-medium text-card-foreground line-clamp-2 group-hover:text-primary transition-colors">
                    {article.title}
                  </h4>
                  <span className="text-xs text-muted-foreground">
                    {article.views} مشاهدة
                  </span>
                </div>
              </Link>
            </li>
          ))}
        </ul>
      </div>

      {/* Tags */}
      <div className="rounded-xl border border-border bg-card p-6">
        <div className="flex items-center gap-2 mb-4">
          <Tag className="h-5 w-5 text-primary" />
          <h3 className="font-semibold text-card-foreground">الوسوم</h3>
        </div>
        <div className="flex flex-wrap gap-2">
          {popularTags.map((tag) => (
            <Link
              key={tag}
              to={`/tag/${tag.toLowerCase().replace(' ', '-')}`}
              className="px-3 py-1.5 text-xs font-medium rounded-full bg-secondary text-secondary-foreground hover:bg-primary hover:text-primary-foreground transition-colors"
            >
              {tag}
            </Link>
          ))}
        </div>
      </div>

      {/* Newsletter */}
      <div className="rounded-xl border border-primary/20 bg-primary/5 p-6">
        <h3 className="font-semibold text-card-foreground mb-2">اشترك في النشرة البريدية</h3>
        <p className="text-sm text-muted-foreground mb-4">
          احصل على أحدث المقالات والنصائح التقنية مباشرة في بريدك
        </p>
        <form className="space-y-3">
          <input
            type="email"
            placeholder="بريدك الإلكتروني"
            className="w-full px-4 py-2.5 text-sm rounded-lg border border-border bg-background text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
          />
          <button
            type="submit"
            className="w-full px-4 py-2.5 text-sm font-medium rounded-lg bg-primary text-primary-foreground hover:bg-primary/90 transition-colors"
          >
            اشتراك
          </button>
        </form>
      </div>
    </aside>
  );
}
