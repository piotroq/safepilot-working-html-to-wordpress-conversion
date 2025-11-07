# SafePilot - HTML to WordPress Theme Conversion

Complete conversion of Extech HTML template to a custom WordPress theme for SafePilot.

## 🎯 Project Overview

This repository contains the complete WordPress theme development for **SafePilot** - a company providing comprehensive occupational health and safety (BHP), fire protection (PPOŻ), and first aid services in Poland.

The theme is built from a static HTML template (Extech) and converted into a fully functional WordPress theme with Full Site Editing (FSE) support.

## 📁 Repository Structure

```
.
├── static/                          # Original HTML template files
│   ├── assets/                      # Static assets (CSS, JS, images)
│   └── *.html                       # HTML template pages
├── wp-content/
│   └── themes/
│       ├── safepilot-main/          # Main WordPress theme ⭐
│       │   ├── assets/              # Theme assets
│       │   ├── inc/                 # Theme includes
│       │   ├── template-parts/      # Template parts
│       │   ├── functions.php        # Theme functions
│       │   ├── style.css            # Main stylesheet
│       │   ├── theme.json           # FSE configuration
│       │   ├── README.md            # Theme documentation
│       │   └── SECURITY.md          # Security policy
│       └── safepilot-child/         # Child theme (optional)
├── Polecenia-SafePilot.md          # Project requirements (Polish)
├── O-projekcie.md                  # Project description
├── Geneza-SafePilot.md             # SafePilot brand story
└── Zakres-uslug-SafePilot.md       # Services scope

```

## ✨ Theme Features

### Core Functionality
- ✅ **Full Site Editing (FSE)** - Block-based theme with theme.json
- ✅ **Custom Post Types** - Portfolio and Services
- ✅ **SEO Optimized** - Meta fields, Open Graph, structured data
- ✅ **Responsive Design** - Mobile-first approach
- ✅ **Accessibility** - WCAG 2.2 Level AA compliant
- ✅ **Translation Ready** - Polish language support (text domain: safepilot)

### Technical Stack
- **WordPress**: 6.0+ required
- **PHP**: 8.2+ required
- **CSS Framework**: Bootstrap 5
- **Icons**: Font Awesome 6
- **JavaScript**: jQuery, Swiper, WOW.js, and more

### Theme Components
- ✅ Header with top bar (contact info, social links)
- ✅ Main navigation with dropdown menus
- ✅ Footer with 4 widget areas
- ✅ Blog archive (grid layout)
- ✅ Single post template (full-width)
- ✅ Page templates (default, FAQ)
- ✅ Portfolio showcase
- ✅ Services display
- ✅ 404 error page
- ✅ Search functionality
- ✅ Comments system

## 🚀 Quick Start

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/piotroq/safepilot-extech-html-to-php-wordpress.git
   ```

2. **Set up WordPress**
   - Install WordPress 6.0 or higher
   - Ensure PHP 8.2+ is installed
   - Configure database connection

3. **Install the theme**
   ```bash
   # Copy theme to WordPress
   cp -r wp-content/themes/safepilot-main /path/to/wordpress/wp-content/themes/
   ```

4. **Activate the theme**
   - Go to WordPress Admin → Appearance → Themes
   - Find "SafePilot" and click "Activate"

### Configuration

1. **Basic Setup**
   - SafePilot → Theme Settings (contact info, social media)
   - Appearance → Customize (logo, colors, site identity)
   - Appearance → Menus (create and assign menus)
   - Appearance → Widgets (configure footer widgets)

2. **Create Content**
   - Pages: Home, About, Services, FAQ, Contact
   - Posts: Blog articles
   - Portfolio: Project showcases
   - Services: Service offerings

3. **Recommended Plugins**
   - Contact Form 7 (contact forms)
   - Yoast SEO or Rank Math (advanced SEO)
   - Polylang (multilingual support)
   - WooCommerce (optional, for e-commerce)

## 📖 Documentation

- **Theme Documentation**: See [wp-content/themes/safepilot-main/README.md](wp-content/themes/safepilot-main/README.md)
- **Security Policy**: See [wp-content/themes/safepilot-main/SECURITY.md](wp-content/themes/safepilot-main/SECURITY.md)
- **Project Requirements**: See [Polecenia-SafePilot.md](Polecenia-SafePilot.md)

## 🎨 Brand Colors

| Color Name | Hex Code | Usage |
|------------|----------|-------|
| Primary    | #4fb9ad  | Main brand color, buttons, links |
| Secondary  | #213543  | Headers, text, navigation |
| Background | #d8d5c8  | Page background |
| Tertiary   | #19222a  | Footer, dark sections |
| Hover      | #213542  | Hover states |

## 🔧 Development

### Prerequisites
- Node.js (optional, for build tools)
- WordPress local development environment
- Code editor (VS Code recommended)

### Coding Standards
- WordPress Coding Standards
- PHP_CodeSniffer for linting
- ESLint for JavaScript
- WCAG 2.2 for accessibility

### Theme Structure
```
safepilot-main/
├── assets/              # CSS, JS, images, fonts
├── inc/                 # PHP includes (admin settings)
├── template-parts/      # Reusable template parts
├── 404.php              # 404 error page
├── archive.php          # Blog archive
├── comments.php         # Comments template
├── footer.php           # Site footer
├── functions.php        # Theme setup and functions
├── header.php           # Site header
├── index.php            # Main template
├── page.php             # Page template
├── page-faq.php         # FAQ page template
├── searchform.php       # Search form
├── single.php           # Single post
├── single-portfolio.php # Single portfolio item
├── style.css            # Main stylesheet
└── theme.json           # FSE configuration
```

## 🤝 Contributing

This is a private project for SafePilot. For any issues or questions:
1. Create an issue in the repository
2. Contact the development team
3. Review documentation before submitting changes

## 📄 License

This theme is licensed under GNU General Public License v2 or later.

## 👥 Credits

- **Client**: SafePilot (https://safepilot.pl)
- **Base Template**: Extech HTML Template
- **Framework**: Bootstrap 5
- **Icons**: Font Awesome 6
- **WordPress Community**

## 📞 Support

For support and questions:
- **Email**: info@safepilot.pl
- **Website**: https://safepilot.pl

---

**Status**: ✅ Complete and Production Ready

**Version**: 1.0.0

**Last Updated**: 2025-10-28
