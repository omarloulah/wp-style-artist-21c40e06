import { Link } from 'react-router-dom';
import { Cpu, Search, Zap, Shield, TrendingUp, Palette } from 'lucide-react';

const categories = [
  { 
    name: 'AI Workflow', 
    slug: 'ai-workflow',
    icon: Cpu,
    count: 12,
    color: 'from-purple-500 to-pink-500'
  },
  { 
    name: 'SEO Basics', 
    slug: 'seo-basics',
    icon: Search,
    count: 18,
    color: 'from-blue-500 to-cyan-500'
  },
  { 
    name: 'Site Performance', 
    slug: 'performance',
    icon: Zap,
    count: 9,
    color: 'from-yellow-500 to-orange-500'
  },
  { 
    name: 'Web Security', 
    slug: 'security',
    icon: Shield,
    count: 7,
    color: 'from-green-500 to-emerald-500'
  },
  { 
    name: 'Marketing', 
    slug: 'marketing',
    icon: TrendingUp,
    count: 14,
    color: 'from-red-500 to-rose-500'
  },
  { 
    name: 'Design', 
    slug: 'design',
    icon: Palette,
    count: 11,
    color: 'from-indigo-500 to-violet-500'
  },
];

export function CategoriesSection() {
  return (
    <section className="py-12">
      <div className="flex items-center justify-between mb-8">
        <h2 className="text-2xl font-bold text-foreground flex items-center gap-3">
          <span className="w-1.5 h-8 bg-gradient-to-b from-primary to-accent rounded-full" />
          Browse Categories
        </h2>
      </div>
      
      <div className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
        {categories.map((category, index) => {
          const Icon = category.icon;
          return (
            <Link
              key={category.slug}
              to={`/category/${category.slug}`}
              className="group relative p-6 rounded-2xl bg-card border border-border hover:border-primary/30 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 animate-fade-in overflow-hidden"
              style={{ animationDelay: `${index * 0.1}s` }}
            >
              {/* Background Gradient on Hover */}
              <div className={`absolute inset-0 bg-gradient-to-br ${category.color} opacity-0 group-hover:opacity-10 transition-opacity duration-300`} />
              
              <div className="relative z-10">
                <div className={`w-12 h-12 rounded-xl bg-gradient-to-br ${category.color} flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300`}>
                  <Icon className="h-6 w-6 text-white" />
                </div>
                
                <h3 className="font-semibold text-foreground mb-1 group-hover:text-primary transition-colors">
                  {category.name}
                </h3>
                
                <span className="text-sm text-muted-foreground">
                  {category.count} articles
                </span>
              </div>
            </Link>
          );
        })}
      </div>
    </section>
  );
}
