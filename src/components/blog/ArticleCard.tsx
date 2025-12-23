import { Link } from 'react-router-dom';
import { Calendar, Clock, User } from 'lucide-react';
import { Badge } from '@/components/ui/badge';

interface ArticleCardProps {
  title: string;
  excerpt: string;
  slug: string;
  category: string;
  categorySlug: string;
  date: string;
  readTime: string;
  author: string;
  image: string;
  featured?: boolean;
}

export function ArticleCard({
  title,
  excerpt,
  slug,
  category,
  categorySlug,
  date,
  readTime,
  author,
  image,
  featured = false,
}: ArticleCardProps) {
  return (
    <article
      className={`group relative overflow-hidden rounded-xl border border-border bg-card transition-all duration-300 hover:border-primary/30 hover:shadow-lg ${
        featured ? 'md:col-span-2 md:row-span-2' : ''
      }`}
    >
      <Link to={`/article/${slug}`} className="block">
        {/* Image */}
        <div className={`relative overflow-hidden ${featured ? 'aspect-[16/9]' : 'aspect-[16/10]'}`}>
          <img
            src={image}
            alt={title}
            className="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
          />
          <div className="absolute inset-0 bg-gradient-to-t from-foreground/60 via-transparent to-transparent" />
          
          {/* Category Badge */}
          <Link
            to={`/category/${categorySlug}`}
            onClick={(e) => e.stopPropagation()}
            className="absolute top-4 right-4"
          >
            <Badge variant="category" className="backdrop-blur-sm">
              {category}
            </Badge>
          </Link>
        </div>

        {/* Content */}
        <div className="p-5">
          <h3
            className={`font-bold text-card-foreground line-clamp-2 mb-2 group-hover:text-primary transition-colors ${
              featured ? 'text-xl md:text-2xl' : 'text-lg'
            }`}
          >
            {title}
          </h3>
          <p className="text-muted-foreground text-sm line-clamp-2 mb-4">{excerpt}</p>

          {/* Meta */}
          <div className="flex flex-wrap items-center gap-4 text-xs text-muted-foreground">
            <span className="flex items-center gap-1.5">
              <Calendar className="h-3.5 w-3.5" />
              {date}
            </span>
            <span className="flex items-center gap-1.5">
              <Clock className="h-3.5 w-3.5" />
              {readTime}
            </span>
            <span className="flex items-center gap-1.5">
              <User className="h-3.5 w-3.5" />
              {author}
            </span>
          </div>
        </div>
      </Link>
    </article>
  );
}
