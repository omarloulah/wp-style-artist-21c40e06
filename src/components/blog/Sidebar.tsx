import { Link } from 'react-router-dom';
import { TrendingUp, Tag, Mail, Send, BarChart3, Clock } from 'lucide-react';
import { Button } from '@/components/ui/button';
import { toast } from 'sonner';

const popularArticles = [
  {
    title: 'Internal Linking for Small Sites: A Realistic Strategy',
    slug: 'internal-linking-small-sites-strategy',
    views: '2.5K',
    readTime: '8 min',
  },
  {
    title: 'Complete Guide to Core Web Vitals Optimization',
    slug: 'core-web-vitals-guide',
    views: '1.8K',
    readTime: '12 min',
  },
  {
    title: 'WordPress Security Best Practices 2024',
    slug: 'wordpress-security-2024',
    views: '1.2K',
    readTime: '10 min',
  },
  {
    title: 'AI-Powered Content Creation Tools Comparison',
    slug: 'ai-content-tools-2024',
    views: '980',
    readTime: '6 min',
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
  'Speed',
  'Mobile',
];

export function Sidebar() {
  const handleSubscribe = (e: React.FormEvent) => {
    e.preventDefault();
    toast.success('Thanks for subscribing! Check your inbox.');
  };

  return (
    <aside className="space-y-6">
      {/* Ad Placeholder - Top */}
      <div className="rounded-xl border border-border bg-secondary/30 p-4 text-center">
        <span className="text-xs text-muted-foreground uppercase tracking-wider">Advertisement</span>
        <div className="h-[250px] flex items-center justify-center bg-secondary rounded-lg mt-2">
          <span className="text-muted-foreground text-sm">300x250 Ad</span>
        </div>
      </div>

      {/* Popular Articles */}
      <div className="rounded-xl border border-border bg-card p-6 relative overflow-hidden">
        <div className="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-primary to-accent" />
        <div className="flex items-center gap-2 mb-5">
          <div className="p-2 rounded-lg bg-primary/10">
            <TrendingUp className="h-5 w-5 text-primary" />
          </div>
          <h3 className="font-bold text-card-foreground">Trending Now</h3>
        </div>
        <ul className="space-y-4">
          {popularArticles.map((article, index) => (
            <li key={article.slug}>
              <Link
                to={`/article/${article.slug}`}
                className="group flex gap-3 p-2 -mx-2 rounded-lg hover:bg-secondary/50 transition-colors"
              >
                <span className="flex-shrink-0 w-9 h-9 rounded-lg bg-gradient-to-br from-primary to-accent text-white font-bold flex items-center justify-center text-sm shadow-sm">
                  {index + 1}
                </span>
                <div className="flex-1 min-w-0">
                  <h4 className="text-sm font-medium text-card-foreground line-clamp-2 group-hover:text-primary transition-colors leading-snug">
                    {article.title}
                  </h4>
                  <div className="flex items-center gap-3 mt-1.5">
                    <span className="text-xs text-muted-foreground flex items-center gap-1">
                      <BarChart3 className="h-3 w-3" />
                      {article.views}
                    </span>
                    <span className="text-xs text-muted-foreground flex items-center gap-1">
                      <Clock className="h-3 w-3" />
                      {article.readTime}
                    </span>
                  </div>
                </div>
              </Link>
            </li>
          ))}
        </ul>
      </div>

      {/* Tags */}
      <div className="rounded-xl border border-border bg-card p-6">
        <div className="flex items-center gap-2 mb-5">
          <div className="p-2 rounded-lg bg-accent/10">
            <Tag className="h-5 w-5 text-accent" />
          </div>
          <h3 className="font-bold text-card-foreground">Popular Tags</h3>
        </div>
        <div className="flex flex-wrap gap-2">
          {popularTags.map((tag) => (
            <Link
              key={tag}
              to={`/tag/${tag.toLowerCase().replace(' ', '-')}`}
              className="px-3 py-1.5 text-xs font-medium rounded-full bg-secondary text-secondary-foreground hover:bg-primary hover:text-primary-foreground transition-all duration-300 hover:scale-105"
            >
              {tag}
            </Link>
          ))}
        </div>
      </div>

      {/* Newsletter */}
      <div className="rounded-xl border-2 border-primary/20 bg-gradient-to-br from-primary/5 via-background to-accent/5 p-6 relative overflow-hidden">
        <div className="absolute top-0 right-0 w-20 h-20 bg-primary/10 rounded-full blur-2xl" />
        <div className="absolute bottom-0 left-0 w-16 h-16 bg-accent/10 rounded-full blur-2xl" />
        
        <div className="relative z-10">
          <div className="flex items-center gap-2 mb-3">
            <div className="p-2 rounded-lg bg-primary/10">
              <Mail className="h-5 w-5 text-primary" />
            </div>
            <h3 className="font-bold text-card-foreground">Newsletter</h3>
          </div>
          <p className="text-sm text-muted-foreground mb-4 leading-relaxed">
            Get exclusive tips, tutorials, and insights delivered to your inbox weekly. No spam!
          </p>
          <form className="space-y-3" onSubmit={handleSubscribe}>
            <input
              type="email"
              placeholder="Enter your email"
              required
              className="w-full px-4 py-3 text-sm rounded-xl border border-border bg-background text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all"
            />
            <Button type="submit" className="w-full gap-2" size="lg">
              <Send className="h-4 w-4" />
              Subscribe Free
            </Button>
          </form>
          <p className="text-xs text-muted-foreground mt-3 text-center">
            Join 5,000+ subscribers
          </p>
        </div>
      </div>

      {/* Ad Placeholder - Bottom */}
      <div className="rounded-xl border border-border bg-secondary/30 p-4 text-center sticky top-24">
        <span className="text-xs text-muted-foreground uppercase tracking-wider">Advertisement</span>
        <div className="h-[600px] flex items-center justify-center bg-secondary rounded-lg mt-2">
          <span className="text-muted-foreground text-sm">300x600 Ad</span>
        </div>
      </div>
    </aside>
  );
}
