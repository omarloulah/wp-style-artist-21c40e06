import { Link } from 'react-router-dom';
import { ArrowRight, Calendar, Clock, Star, Sparkles } from 'lucide-react';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';

interface FeaturedArticle {
  title: string;
  excerpt: string;
  slug: string;
  category: string;
  categorySlug: string;
  date: string;
  readTime: string;
  image: string;
}

interface FeaturedSectionProps {
  article: FeaturedArticle;
}

export function FeaturedSection({ article }: FeaturedSectionProps) {
  return (
    <section className="relative overflow-hidden rounded-2xl mb-12 bg-gradient-to-br from-secondary via-background to-secondary border border-border">
      <div className="grid lg:grid-cols-2 gap-0">
        {/* Content */}
        <div className="relative z-10 p-8 md:p-10 lg:p-12 flex flex-col justify-center order-2 lg:order-1">
          <div className="flex items-center gap-3 mb-4">
            <Badge variant="featured" className="gap-1.5 px-3 py-1.5">
              <Star className="h-3.5 w-3.5 fill-yellow-400 text-yellow-400" />
              Featured
            </Badge>
            <Link to={`/category/${article.categorySlug}`}>
              <Badge variant="category">
                {article.category}
              </Badge>
            </Link>
          </div>
          
          <h2 className="text-2xl md:text-3xl lg:text-4xl font-bold text-foreground mb-4 leading-tight">
            {article.title}
          </h2>
          
          <p className="text-muted-foreground text-base md:text-lg mb-6 line-clamp-3 leading-relaxed">
            {article.excerpt}
          </p>

          <div className="flex flex-wrap items-center gap-4 mb-8">
            <span className="flex items-center gap-2 text-sm text-muted-foreground bg-secondary px-3 py-1.5 rounded-full">
              <Calendar className="h-4 w-4 text-primary" />
              {article.date}
            </span>
            <span className="flex items-center gap-2 text-sm text-muted-foreground bg-secondary px-3 py-1.5 rounded-full">
              <Clock className="h-4 w-4 text-primary" />
              {article.readTime}
            </span>
          </div>

          <div>
            <Button asChild size="lg" className="gap-2 shadow-lg hover:shadow-xl transition-all">
              <Link to={`/article/${article.slug}`}>
                Read Article
                <ArrowRight className="h-4 w-4" />
              </Link>
            </Button>
          </div>
        </div>

        {/* Image */}
        <div className="relative order-1 lg:order-2 min-h-[280px] lg:min-h-[420px]">
          <img
            src={article.image}
            alt={article.title}
            className="absolute inset-0 h-full w-full object-cover"
          />
          <div className="absolute inset-0 bg-gradient-to-t lg:bg-gradient-to-r from-background/80 via-background/40 to-transparent lg:from-background lg:via-background/60" />
          
          {/* Decorative Elements */}
          <div className="absolute top-4 right-4 p-2 bg-white/10 backdrop-blur-md rounded-full">
            <Sparkles className="h-5 w-5 text-yellow-400" />
          </div>
        </div>
      </div>
      
      {/* Background Decoration */}
      <div className="absolute -bottom-20 -left-20 w-40 h-40 bg-primary/10 rounded-full blur-3xl" />
      <div className="absolute -top-20 -right-20 w-40 h-40 bg-accent/10 rounded-full blur-3xl" />
    </section>
  );
}
