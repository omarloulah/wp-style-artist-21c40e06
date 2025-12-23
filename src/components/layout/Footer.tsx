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
              A tech blog specializing in SEO, site performance, web security, and AI workflows. Quality content for developers and website owners.
            </p>
          </div>

          {/* Categories */}
          <div>
            <h4 className="font-semibold text-foreground mb-4">Categories</h4>
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
            <h4 className="font-semibold text-foreground mb-4">Links</h4>
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
            © {new Date().getFullYear()} TechPolse. All rights reserved.
          </p>
        </div>
      </div>
    </footer>
  );
}
