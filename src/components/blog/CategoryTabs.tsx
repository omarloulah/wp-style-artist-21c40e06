import { Link, useLocation } from 'react-router-dom';

const categories = [
  { name: 'الكل', slug: '' },
  { name: 'SEO Basics', slug: 'seo-basics' },
  { name: 'AI Workflow', slug: 'ai-workflow' },
  { name: 'Performance', slug: 'performance' },
  { name: 'Security', slug: 'security' },
];

export function CategoryTabs() {
  const location = useLocation();
  const currentCategory = location.pathname.split('/category/')[1] || '';

  return (
    <div className="flex flex-wrap gap-2 mb-8">
      {categories.map((cat) => {
        const isActive = currentCategory === cat.slug;
        const href = cat.slug ? `/category/${cat.slug}` : '/';
        
        return (
          <Link
            key={cat.slug}
            to={href}
            className={`px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 ${
              isActive
                ? 'bg-primary text-primary-foreground shadow-md'
                : 'bg-secondary text-secondary-foreground hover:bg-primary/10 hover:text-primary'
            }`}
          >
            {cat.name}
          </Link>
        );
      })}
    </div>
  );
}
