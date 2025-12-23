import { Header } from '@/components/layout/Header';
import { Footer } from '@/components/layout/Footer';
import { ArticleCard } from '@/components/blog/ArticleCard';
import { CategoryTabs } from '@/components/blog/CategoryTabs';
import { FeaturedSection } from '@/components/blog/FeaturedSection';
import { Sidebar } from '@/components/blog/Sidebar';
import { articles, getFeaturedArticle } from '@/data/articles';

const Index = () => {
  const featuredArticle = getFeaturedArticle();
  const otherArticles = articles.filter((a) => a.id !== featuredArticle.id);

  return (
    <div className="min-h-screen flex flex-col bg-background">
      <Header />
      
      <main className="flex-1">
        <div className="container py-8">
          {/* Hero Featured Article */}
          <FeaturedSection article={featuredArticle} />

          {/* Category Tabs */}
          <CategoryTabs />

          {/* Main Content Grid */}
          <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {/* Articles Grid */}
            <div className="lg:col-span-2">
              <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                {otherArticles.map((article) => (
                  <ArticleCard
                    key={article.id}
                    {...article}
                  />
                ))}
              </div>
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

export default Index;
