import { useState, useEffect } from 'react';
import { Header } from '@/components/layout/Header';
import { Footer } from '@/components/layout/Footer';
import { ArticleCard } from '@/components/blog/ArticleCard';
import { CategoryTabs } from '@/components/blog/CategoryTabs';
import { FeaturedSection } from '@/components/blog/FeaturedSection';
import { Sidebar } from '@/components/blog/Sidebar';
import { articles, getFeaturedArticle } from '@/data/articles';
import { ChevronUp } from 'lucide-react';

const Index = () => {
  const featuredArticle = getFeaturedArticle();
  const otherArticles = articles.filter((a) => a.id !== featuredArticle.id);
  const [showBackToTop, setShowBackToTop] = useState(false);

  useEffect(() => {
    const handleScroll = () => {
      setShowBackToTop(window.scrollY > 400);
    };

    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  const scrollToTop = () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  };

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
                {otherArticles.map((article, index) => (
                  <div 
                    key={article.id}
                    className="animate-fade-in"
                    style={{ animationDelay: `${index * 0.1}s` }}
                  >
                    <ArticleCard {...article} />
                  </div>
                ))}
              </div>
              
              {/* Load More / Pagination */}
              <div className="mt-12 text-center">
                <button className="px-8 py-3 rounded-xl border border-border bg-card text-foreground font-medium hover:bg-secondary hover:border-primary/30 transition-all duration-300">
                  Load More Articles
                </button>
              </div>
            </div>

            {/* Sidebar */}
            <div className="lg:col-span-1">
              <Sidebar />
            </div>
          </div>
        </div>
      </main>

      {/* Back to Top Button */}
      <button
        onClick={scrollToTop}
        className={`fixed bottom-8 right-8 z-50 p-4 rounded-full bg-gradient-to-r from-primary to-accent text-white shadow-lg hover:shadow-xl transition-all duration-300 ${
          showBackToTop 
            ? 'translate-y-0 opacity-100' 
            : 'translate-y-20 opacity-0 pointer-events-none'
        }`}
        aria-label="Back to top"
      >
        <ChevronUp className="h-6 w-6" />
      </button>

      <Footer />
    </div>
  );
};

export default Index;
