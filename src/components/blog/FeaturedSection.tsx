import { Link } from 'react-router-dom';
import { ArrowRight, Calendar, Clock } from 'lucide-react';
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
    <section className="relative overflow-hidden rounded-2xl mb-12">
      {/* Background Image */}
      <div className="absolute inset-0">
        <img
          src={article.image}
          alt={article.title}
          className="h-full w-full object-cover"
        />
        <div className="absolute inset-0 bg-gradient-to-l from-foreground/90 via-foreground/70 to-foreground/50" />
      </div>

      {/* Content */}
      <div className="relative z-10 p-8 md:p-12 lg:p-16 min-h-[400px] flex flex-col justify-end">
        <div className="max-w-2xl">
          <Badge variant="featured" className="mb-4">
            {article.category}
          </Badge>
          
          <h2 className="text-2xl md:text-3xl lg:text-4xl font-bold text-background mb-4 leading-tight">
            {article.title}
          </h2>
          
          <p className="text-background/80 text-sm md:text-base mb-6 line-clamp-2">
            {article.excerpt}
          </p>

          <div className="flex flex-wrap items-center gap-6 mb-6">
            <span className="flex items-center gap-2 text-sm text-background/70">
              <Calendar className="h-4 w-4" />
              {article.date}
            </span>
            <span className="flex items-center gap-2 text-sm text-background/70">
              <Clock className="h-4 w-4" />
              {article.readTime}
            </span>
          </div>

          <Button asChild variant="featured" size="lg">
            <Link to={`/article/${article.slug}`}>
              Read Article
              <ArrowRight className="h-4 w-4 ml-2" />
            </Link>
          </Button>
        </div>
      </div>
    </section>
  );
}
