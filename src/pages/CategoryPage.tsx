import { useParams } from 'react-router-dom';
import { Header } from '@/components/layout/Header';
import { Footer } from '@/components/layout/Footer';
import { ArticleCard } from '@/components/blog/ArticleCard';
import { CategoryTabs } from '@/components/blog/CategoryTabs';
import { Sidebar } from '@/components/blog/Sidebar';
import { getArticlesByCategory } from '@/data/articles';

const categoryNames: Record<string, string> = {
  'seo-basics': 'SEO Basics',
  'ai-workflow': 'AI Workflow',
  'performance': 'Site Performance',
  'security': 'Web Security',
};

const CategoryPage = () => {
  const { slug } = useParams<{ slug: string }>();
  const categoryArticles = getArticlesByCategory(slug || '');
  const categoryName = categoryNames[slug || ''] || slug;

  return (
    <div className="min-h-screen flex flex-col bg-background">
      <Header />
      
      <main className="flex-1">
        <div className="container py-8">
          {/* Category Header */}
          <div className="mb-8">
            <h1 className="text-3xl md:text-4xl font-bold text-foreground mb-2">
              {categoryName}
            </h1>
            <p className="text-muted-foreground">
              {categoryArticles.length} مقال في هذا التصنيف
            </p>
          </div>

          {/* Category Tabs */}
          <CategoryTabs />

          {/* Main Content Grid */}
          <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {/* Articles Grid */}
            <div className="lg:col-span-2">
              {categoryArticles.length > 0 ? (
                <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                  {categoryArticles.map((article) => (
                    <ArticleCard key={article.id} {...article} />
                  ))}
                </div>
              ) : (
                <div className="text-center py-16">
                  <p className="text-muted-foreground">لا توجد مقالات في هذا التصنيف حالياً</p>
                </div>
              )}
            </div>

            {/* Sidebar */}
            <div className="lg:col-span-1">
              <Sidebar />
            </div>
          </div>
        </div>
      </main>

      <Footer />
    </div>
  );
};

export default CategoryPage;
