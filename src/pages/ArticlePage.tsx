import { useParams, Link } from 'react-router-dom';
import { ArrowRight, Calendar, Clock, User, Share2, Bookmark } from 'lucide-react';
import { Header } from '@/components/layout/Header';
import { Footer } from '@/components/layout/Footer';
import { Sidebar } from '@/components/blog/Sidebar';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { getArticleBySlug, articles } from '@/data/articles';

const ArticlePage = () => {
  const { slug } = useParams<{ slug: string }>();
  const article = getArticleBySlug(slug || '');

  if (!article) {
    return (
      <div className="min-h-screen flex flex-col bg-background">
        <Header />
        <main className="flex-1 flex items-center justify-center">
          <div className="text-center">
            <h1 className="text-2xl font-bold text-foreground mb-4">Article Not Found</h1>
            <Button asChild>
              <Link to="/">
                <ArrowRight className="h-4 w-4 mr-2" />
                Back to Home
              </Link>
            </Button>
          </div>
        </main>
        <Footer />
      </div>
    );
  }

  const relatedArticles = articles
    .filter((a) => a.categorySlug === article.categorySlug && a.id !== article.id)
    .slice(0, 3);

  return (
    <div className="min-h-screen flex flex-col bg-background">
      <Header />
      
      <main className="flex-1">
        {/* Article Header */}
        <div className="relative">
          <div className="absolute inset-0 h-[400px]">
            <img
              src={article.image}
              alt={article.title}
              className="w-full h-full object-cover"
            />
            <div className="absolute inset-0 bg-gradient-to-b from-foreground/60 via-foreground/40 to-background" />
          </div>
          
          <div className="relative container pt-24 pb-12">
            <div className="max-w-3xl">
              <Link to={`/category/${article.categorySlug}`}>
                <Badge variant="category" className="mb-4">
                  {article.category}
                </Badge>
              </Link>
              
              <h1 className="text-3xl md:text-4xl lg:text-5xl font-bold text-background mb-6 leading-tight">
                {article.title}
              </h1>

              <div className="flex flex-wrap items-center gap-6 text-background/80">
                <span className="flex items-center gap-2">
                  <Calendar className="h-4 w-4" />
                  {article.date}
                </span>
                <span className="flex items-center gap-2">
                  <Clock className="h-4 w-4" />
                  {article.readTime}
                </span>
                <span className="flex items-center gap-2">
                  <User className="h-4 w-4" />
                  {article.author}
                </span>
              </div>
            </div>
          </div>
        </div>

        {/* Article Content */}
        <div className="container py-12">
          <div className="grid grid-cols-1 lg:grid-cols-3 gap-12">
            {/* Main Content */}
            <article className="lg:col-span-2">
              {/* Share Buttons */}
              <div className="flex items-center gap-3 mb-8 pb-8 border-b border-border">
                <span className="text-sm text-muted-foreground">Share:</span>
                <Button variant="outline" size="sm">
                  <Share2 className="h-4 w-4" />
                </Button>
                <Button variant="outline" size="sm">
                  <Bookmark className="h-4 w-4" />
                </Button>
              </div>

              {/* Article Body */}
              <div className="prose prose-lg max-w-none dark:prose-invert prose-headings:text-foreground prose-p:text-muted-foreground prose-a:text-primary prose-strong:text-foreground">
                {article.content.split('\n\n').map((paragraph, index) => {
                  if (paragraph.startsWith('## ')) {
                    return (
                      <h2 key={index} className="text-2xl font-bold text-foreground mt-8 mb-4">
                        {paragraph.replace('## ', '')}
                      </h2>
                    );
                  }
                  if (paragraph.startsWith('### ')) {
                    return (
                      <h3 key={index} className="text-xl font-semibold text-foreground mt-6 mb-3">
                        {paragraph.replace('### ', '')}
                      </h3>
                    );
                  }
                  if (paragraph.startsWith('- ')) {
                    const items = paragraph.split('\n').filter((line) => line.startsWith('- '));
                    return (
                      <ul key={index} className="list-disc list-inside space-y-2 text-muted-foreground">
                        {items.map((item, i) => (
                          <li key={i}>{item.replace('- ', '')}</li>
                        ))}
                      </ul>
                    );
                  }
                  if (paragraph.startsWith('1. ')) {
                    const items = paragraph.split('\n').filter((line) => /^\d+\. /.test(line));
                    return (
                      <ol key={index} className="list-decimal list-inside space-y-2 text-muted-foreground">
                        {items.map((item, i) => (
                          <li key={i}>{item.replace(/^\d+\. /, '')}</li>
                        ))}
                      </ol>
                    );
                  }
                  return (
                    <p key={index} className="text-muted-foreground leading-relaxed mb-4">
                      {paragraph}
                    </p>
                  );
                })}
              </div>

              {/* Related Articles */}
              {relatedArticles.length > 0 && (
                <div className="mt-16 pt-8 border-t border-border">
                  <h3 className="text-xl font-bold text-foreground mb-6">Related Articles</h3>
                  <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                    {relatedArticles.map((related) => (
                      <Link
                        key={related.id}
                        to={`/article/${related.slug}`}
                        className="group p-4 rounded-xl border border-border bg-card hover:border-primary/30 transition-all"
                      >
                        <h4 className="font-medium text-card-foreground line-clamp-2 group-hover:text-primary transition-colors">
                          {related.title}
                        </h4>
                        <span className="text-xs text-muted-foreground mt-2 block">
                          {related.readTime}
                        </span>
                      </Link>
                    ))}
                  </div>
                </div>
              )}
            </article>

            {/* Sidebar */}
            <div className="lg:col-span-1">
              <div className="sticky top-24">
                <Sidebar />
              </div>
            </div>
          </div>
        </div>
      </main>

      <Footer />
    </div>
  );
};

export default ArticlePage;
