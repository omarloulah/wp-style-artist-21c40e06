import { useState, useEffect } from 'react';
import { useParams, Link } from 'react-router-dom';
import { ArrowRight, Calendar, Clock, User, Share2, Bookmark, Twitter, Facebook, Linkedin, Link2, ChevronUp, Star, MessageCircle } from 'lucide-react';
import { Header } from '@/components/layout/Header';
import { Footer } from '@/components/layout/Footer';
import { Sidebar } from '@/components/blog/Sidebar';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { getArticleBySlug, articles } from '@/data/articles';
import { toast } from 'sonner';

const ArticlePage = () => {
  const { slug } = useParams<{ slug: string }>();
  const article = getArticleBySlug(slug || '');
  const [showBackToTop, setShowBackToTop] = useState(false);
  const [readingProgress, setReadingProgress] = useState(0);

  // Handle scroll for back to top button and reading progress
  useEffect(() => {
    const handleScroll = () => {
      const scrollTop = window.scrollY;
      const docHeight = document.documentElement.scrollHeight - window.innerHeight;
      const progress = (scrollTop / docHeight) * 100;
      
      setShowBackToTop(scrollTop > 400);
      setReadingProgress(progress);
    };

    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  const scrollToTop = () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  };

  const copyLink = () => {
    navigator.clipboard.writeText(window.location.href);
    toast.success('Link copied to clipboard!');
  };

  const shareOnTwitter = () => {
    window.open(`https://twitter.com/intent/tweet?url=${encodeURIComponent(window.location.href)}&text=${encodeURIComponent(article?.title || '')}`, '_blank');
  };

  const shareOnFacebook = () => {
    window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(window.location.href)}`, '_blank');
  };

  const shareOnLinkedIn = () => {
    window.open(`https://www.linkedin.com/shareArticle?mini=true&url=${encodeURIComponent(window.location.href)}&title=${encodeURIComponent(article?.title || '')}`, '_blank');
  };

  if (!article) {
    return (
      <div className="min-h-screen flex flex-col bg-background">
        <Header />
        <main className="flex-1 flex items-center justify-center">
          <div className="text-center px-4">
            <div className="text-8xl font-black bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent mb-4">
              404
            </div>
            <h1 className="text-2xl font-bold text-foreground mb-4">Article Not Found</h1>
            <p className="text-muted-foreground mb-6">The article you're looking for doesn't exist or has been moved.</p>
            <Button asChild size="lg" className="gap-2">
              <Link to="/">
                <ArrowRight className="h-4 w-4" />
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
      {/* Reading Progress Bar */}
      <div 
        className="fixed top-0 left-0 h-1 bg-gradient-to-r from-primary to-accent z-[100] transition-all duration-150"
        style={{ width: `${readingProgress}%` }}
      />
      
      <Header />
      
      <main className="flex-1">
        {/* Article Header - Fixed Overlay Issue */}
        <div className="relative bg-gradient-to-br from-secondary via-background to-secondary">
          {/* Background Pattern */}
          <div className="absolute inset-0 opacity-50">
            <div className="absolute inset-0" style={{
              backgroundImage: `radial-gradient(circle at 25% 25%, hsl(var(--primary) / 0.1) 0%, transparent 50%),
                               radial-gradient(circle at 75% 75%, hsl(var(--accent) / 0.1) 0%, transparent 50%)`
            }} />
          </div>
          
          <div className="container relative z-10 pt-8 pb-12">
            {/* Breadcrumb */}
            <nav className="flex items-center gap-2 text-sm text-muted-foreground mb-6">
              <Link to="/" className="hover:text-primary transition-colors">Home</Link>
              <span>/</span>
              <Link to={`/category/${article.categorySlug}`} className="hover:text-primary transition-colors">
                {article.category}
              </Link>
              <span>/</span>
              <span className="text-foreground truncate max-w-[200px]">{article.title}</span>
            </nav>
            
            <div className="grid lg:grid-cols-2 gap-8 items-center">
              {/* Text Content */}
              <div className="order-2 lg:order-1">
                <div className="flex items-center gap-3 mb-4">
                  <Link to={`/category/${article.categorySlug}`}>
                    <Badge variant="category" className="text-sm px-4 py-1.5">
                      {article.category}
                    </Badge>
                  </Link>
                  <Badge variant="outline" className="gap-1">
                    <Star className="h-3 w-3 fill-yellow-500 text-yellow-500" />
                    Featured
                  </Badge>
                </div>
                
                <h1 className="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-foreground mb-6 leading-tight">
                  {article.title}
                </h1>
                
                <p className="text-lg text-muted-foreground mb-6 leading-relaxed">
                  {article.excerpt}
                </p>

                <div className="flex flex-wrap items-center gap-4 text-sm text-muted-foreground">
                  <span className="flex items-center gap-2 bg-secondary/80 px-3 py-1.5 rounded-full">
                    <Calendar className="h-4 w-4 text-primary" />
                    {article.date}
                  </span>
                  <span className="flex items-center gap-2 bg-secondary/80 px-3 py-1.5 rounded-full">
                    <Clock className="h-4 w-4 text-primary" />
                    {article.readTime}
                  </span>
                  <span className="flex items-center gap-2 bg-secondary/80 px-3 py-1.5 rounded-full">
                    <User className="h-4 w-4 text-primary" />
                    {article.author}
                  </span>
                </div>
              </div>
              
              {/* Featured Image - Clear visibility */}
              <div className="order-1 lg:order-2">
                <div className="relative rounded-2xl overflow-hidden shadow-2xl group">
                  <img
                    src={article.image}
                    alt={article.title}
                    className="w-full aspect-[16/10] object-cover transition-transform duration-700 group-hover:scale-105"
                  />
                  <div className="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity" />
                </div>
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
              <div className="flex flex-wrap items-center gap-3 mb-8 pb-8 border-b border-border">
                <span className="text-sm font-medium text-foreground">Share this article:</span>
                <div className="flex items-center gap-2">
                  <Button 
                    variant="outline" 
                    size="sm" 
                    className="gap-2 hover:bg-[#1DA1F2] hover:text-white hover:border-[#1DA1F2]"
                    onClick={shareOnTwitter}
                  >
                    <Twitter className="h-4 w-4" />
                    <span className="hidden sm:inline">Twitter</span>
                  </Button>
                  <Button 
                    variant="outline" 
                    size="sm" 
                    className="gap-2 hover:bg-[#4267B2] hover:text-white hover:border-[#4267B2]"
                    onClick={shareOnFacebook}
                  >
                    <Facebook className="h-4 w-4" />
                    <span className="hidden sm:inline">Facebook</span>
                  </Button>
                  <Button 
                    variant="outline" 
                    size="sm" 
                    className="gap-2 hover:bg-[#0077B5] hover:text-white hover:border-[#0077B5]"
                    onClick={shareOnLinkedIn}
                  >
                    <Linkedin className="h-4 w-4" />
                    <span className="hidden sm:inline">LinkedIn</span>
                  </Button>
                  <Button 
                    variant="outline" 
                    size="sm" 
                    className="gap-2"
                    onClick={copyLink}
                  >
                    <Link2 className="h-4 w-4" />
                    <span className="hidden sm:inline">Copy</span>
                  </Button>
                </div>
              </div>


              {/* Article Body */}
              <div className="prose prose-lg max-w-none dark:prose-invert prose-headings:text-foreground prose-p:text-muted-foreground prose-a:text-primary prose-strong:text-foreground">
                {article.content.split('\n\n').map((paragraph, index) => {
                  if (paragraph.startsWith('## ')) {
                    return (
                      <h2 key={index} className="text-2xl font-bold text-foreground mt-10 mb-4 flex items-center gap-3">
                        <span className="w-1 h-8 bg-gradient-to-b from-primary to-accent rounded-full" />
                        {paragraph.replace('## ', '')}
                      </h2>
                    );
                  }
                  if (paragraph.startsWith('### ')) {
                    return (
                      <h3 key={index} className="text-xl font-semibold text-foreground mt-8 mb-3">
                        {paragraph.replace('### ', '')}
                      </h3>
                    );
                  }
                  if (paragraph.startsWith('- ')) {
                    const items = paragraph.split('\n').filter((line) => line.startsWith('- '));
                    return (
                      <ul key={index} className="space-y-3 my-6">
                        {items.map((item, i) => (
                          <li key={i} className="flex items-start gap-3 text-muted-foreground">
                            <span className="mt-2 w-2 h-2 rounded-full bg-primary flex-shrink-0" />
                            {item.replace('- ', '')}
                          </li>
                        ))}
                      </ul>
                    );
                  }
                  if (paragraph.startsWith('1. ')) {
                    const items = paragraph.split('\n').filter((line) => /^\d+\. /.test(line));
                    return (
                      <ol key={index} className="space-y-3 my-6 list-none">
                        {items.map((item, i) => (
                          <li key={i} className="flex items-start gap-3 text-muted-foreground">
                            <span className="w-7 h-7 rounded-lg bg-primary/10 text-primary font-bold text-sm flex items-center justify-center flex-shrink-0">
                              {i + 1}
                            </span>
                            {item.replace(/^\d+\. /, '')}
                          </li>
                        ))}
                      </ol>
                    );
                  }
                  
                  
                  return (
                    <p key={index} className="text-muted-foreground leading-relaxed mb-6 text-lg">
                      {paragraph}
                    </p>
                  );
                })}
              </div>

              {/* Author Bio Box */}
              <div className="mt-12 p-6 bg-gradient-to-br from-secondary to-secondary/50 rounded-2xl border border-border">
                <div className="flex items-start gap-4">
                  <div className="w-16 h-16 rounded-full bg-gradient-to-br from-primary to-accent flex items-center justify-center text-white text-xl font-bold flex-shrink-0">
                    {article.author.charAt(0)}
                  </div>
                  <div className="flex-1">
                    <h4 className="font-bold text-foreground text-lg">{article.author}</h4>
                    <p className="text-sm text-primary mb-2">Tech Writer & SEO Specialist</p>
                    <p className="text-muted-foreground text-sm leading-relaxed">
                      Passionate about sharing knowledge on web development, SEO optimization, and digital marketing strategies.
                    </p>
                  </div>
                </div>
              </div>

              {/* Related Articles */}
              {relatedArticles.length > 0 && (
                <div className="mt-12 pt-8 border-t border-border">
                  <h3 className="text-xl font-bold text-foreground mb-6 flex items-center gap-2">
                    <MessageCircle className="h-5 w-5 text-primary" />
                    Related Articles
                  </h3>
                  <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                    {relatedArticles.map((related) => (
                      <Link
                        key={related.id}
                        to={`/article/${related.slug}`}
                        className="group p-5 rounded-xl border border-border bg-card hover:border-primary/30 hover:shadow-lg transition-all duration-300"
                      >
                        <div className="aspect-video rounded-lg overflow-hidden mb-3">
                          <img 
                            src={related.image} 
                            alt={related.title}
                            className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                          />
                        </div>
                        <h4 className="font-semibold text-card-foreground line-clamp-2 group-hover:text-primary transition-colors mb-2">
                          {related.title}
                        </h4>
                        <span className="text-xs text-muted-foreground flex items-center gap-1">
                          <Clock className="h-3 w-3" />
                          {related.readTime}
                        </span>
                      </Link>
                    ))}
                  </div>
                </div>
              )}

              {/* Comments Section Placeholder */}
              <div className="mt-12 pt-8 border-t border-border">
                <h3 className="text-xl font-bold text-foreground mb-6 flex items-center gap-2">
                  <MessageCircle className="h-5 w-5 text-primary" />
                  Comments
                </h3>
                <div className="p-6 bg-secondary/50 rounded-xl text-center">
                  <p className="text-muted-foreground mb-4">Join the discussion! Share your thoughts below.</p>
                  <Button size="lg">Leave a Comment</Button>
                </div>
              </div>
            </article>

            {/* Sidebar */}
            <div className="lg:col-span-1">
              <div className="sticky top-20">
                <Sidebar />
              </div>
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

export default ArticlePage;
