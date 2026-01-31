# HydrogenWaterHQ WordPress Theme

A clean, fast, SEO-optimized WordPress theme for hydrogen water affiliate content.

## Features

- **SEO Optimized**: Schema.org markup, clean HTML structure, fast loading
- **Affiliate Ready**: Product boxes, comparison tables, pros/cons shortcodes
- **Mobile First**: Fully responsive design
- **Fast**: Minimal CSS/JS, lazy loading images
- **Customizable**: Widget areas, custom menus, logo support

## Installation

1. Upload the theme folder to `/wp-content/themes/`
2. Activate the theme in WordPress Admin → Appearance → Themes
3. Configure menus and widgets

## Deployment (GitHub Actions)

This theme auto-deploys to SiteGround when you push to `main` branch.

### Setup GitHub Secrets

Go to your repo → Settings → Secrets → Actions, and add:

| Secret | Description |
|--------|-------------|
| `FTP_HOST` | Your SiteGround FTP hostname |
| `FTP_USERNAME` | Your FTP username |
| `FTP_PASSWORD` | Your FTP password |

## Shortcodes

### Product Box
```
[product_box title="Product Name" price="$99" rating="4.5" button_text="Check Price" button_url="https://amazon.com/..."]
Product description here.
[/product_box]
```

### Pros and Cons
```
[pros_cons pros="Great quality|Fast shipping|Good value" cons="Expensive|Limited colors"]
```

### Info Box
```
[info_box type="info"]Important information here.[/info_box]
[info_box type="warning"]Warning message here.[/info_box]
[info_box type="success"]Success message here.[/info_box]
```

## File Structure

```
hydrogenwaterhq/
├── style.css           # Main stylesheet + theme info
├── functions.php       # Theme functions
├── header.php          # Header template
├── footer.php          # Footer template
├── index.php           # Main template
├── single.php          # Single post template
├── page.php            # Page template
├── front-page.php      # Homepage template
├── 404.php             # 404 error template
├── sidebar.php         # Sidebar template
├── assets/
│   ├── css/
│   │   └── main.css    # Additional styles
│   ├── js/
│   │   └── main.js     # JavaScript
│   └── images/         # Theme images
├── inc/
│   └── template-tags.php
├── template-parts/
│   ├── content.php
│   └── content-none.php
└── .github/
    └── workflows/
        └── deploy.yml  # GitHub Actions deployment
```

## License

GNU General Public License v2 or later

## Author

Mahesh Khemlani - [SEO Wizard](https://seowizard.com)
