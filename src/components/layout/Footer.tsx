import { Link } from 'react-router-dom';

const footerLinks = {
  categories: [
    { name: 'AI Workflow', href: '/category/ai-workflow' },
    { name: 'SEO Basics', href: '/category/seo-basics' },
    { name: 'Site Performance', href: '/category/performance' },
    { name: 'Web Security', href: '/category/security' },
  ],
  resources: [
    { name: 'About', href: '/about' },
    { name: 'Contact', href: '/contact' },
    { name: 'Privacy Policy', href: '/privacy' },
  ],
};

export function Footer() {
  return (
    <footer className="border-t border-border bg-secondary/30">
      <div className="container py-12">
        <div className="grid grid-cols-1 md:grid-cols-4 gap-8">
          {/* Brand */}
          <div className="md:col-span-2">
            <Link to="/" className="inline-block mb-4">
              <span className="text-2xl font-bold text-foreground">
                Tech<span className="text-primary">Polse</span>
              </span>
            </Link>
            <p className="text-muted-foreground text-sm max-w-md">
              مدونة تقنية متخصصة في تحسين محركات البحث، أداء المواقع، أمان الويب، والذكاء الاصطناعي. نقدم محتوى عربي عالي الجودة للمطورين وأصحاب المواقع.
            </p>
          </div>

          {/* Categories */}
          <div>
            <h4 className="font-semibold text-foreground mb-4">التصنيفات</h4>
            <ul className="space-y-2">
              {footerLinks.categories.map((link) => (
                <li key={link.href}>
                  <Link
                    to={link.href}
                    className="text-sm text-muted-foreground hover:text-primary transition-colors"
                  >
                    {link.name}
                  </Link>
                </li>
              ))}
            </ul>
          </div>

          {/* Resources */}
          <div>
            <h4 className="font-semibold text-foreground mb-4">روابط</h4>
            <ul className="space-y-2">
              {footerLinks.resources.map((link) => (
                <li key={link.href}>
                  <Link
                    to={link.href}
                    className="text-sm text-muted-foreground hover:text-primary transition-colors"
                  >
                    {link.name}
                  </Link>
                </li>
              ))}
            </ul>
          </div>
        </div>

        {/* Copyright */}
        <div className="mt-12 pt-6 border-t border-border">
          <p className="text-sm text-muted-foreground text-center">
            © {new Date().getFullYear()} TechPolse. جميع الحقوق محفوظة.
          </p>
        </div>
      </div>
    </footer>
  );
}
