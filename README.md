# Buzz Theme

> Buzzwire Daily's custom WordPress theme — Built for the generation that doesn't wait.

## 🎯 Overview

Buzz Theme is a custom WordPress theme built for **Buzzwire Daily** — a multi-niche content platform covering:
- 🎤 Hip-Hop & Urban Culture
- 🎬 Movies & TV
- 📺 Streaming Wars
- 🌟 Influencers & Creators
- 🤖 AI Lab
- ₿ Crypto & Web3
- 📱 Viral & Social

## ✨ Features

### Design
- **Custom cursor** with smooth trailing ring effect
- **Three.js hero animation** with morphing wireframe sphere
- **Vertical navigation rail** with section tooltips
- **Breaking news ticker** with continuous animation
- **Scroll reveal animations** for all sections
- **Mobile-responsive** design (bottom nav on mobile)
- **Dark-first color scheme** with neon accents

### Sections
- **Hip-Hop**: Graffiti-inspired dark red/yellow aesthetic
- **Movies & TV**: Cinematic film strip overlay effect
- **Streaming**: Data terminal aesthetic with platform tags
- **Influencers**: Staggered phone card layout
- **AI Lab**: Terminal/matrix green aesthetic
- **Crypto**: Bloomberg terminal with ticker bars
- **Viral**: Chaotic multi-color grid

### Built-in Tools (Apps)
- Hook Tester
- WhereToWatch
- Token Truth
- AI Tool Match
- Stream Truth
- Drop Alert

### Technical
- **WordPress Custom Post Types**: posts, bw_app, bw_drop, bw_token
- **Custom Taxonomies**: bw_section, bw_platform, bw_ai_tool, bw_crypto_token
- **REST API ready** for app endpoints
- **AJAX newsletter signup**
- **Custom share bar**
- **Security hardened** (version removed, cleanup)

## 📁 File Structure

```
buzz-theme/
├── style.css                  # Main stylesheet
├── functions.php             # Theme setup & hooks
├── header.php                 # Site header
├── footer.php                 # Site footer
├── front-page.php             # Homepage
├── index.php                  # Archive/listing
├── single.php                 # Single post
├── archive.php                # Category/tag archives
├── 404.php                    # 404 page
├── template-parts/
│   └── sections/
│       ├── section-hiphop.php
│       ├── section-movies.php
│       ├── section-streaming.php
│       ├── section-influencers.php
│       ├── section-ai.php
│       ├── section-crypto.php
│       └── section-viral.php
├── assets/
│   └── js/
│       └── main.js           # All frontend JS
└── inc/                      # (reserved for includes)
```

## 🚀 Installation

1. Upload to `/wp-content/themes/buzz-theme/`
2. Activate via WordPress Admin → Appearance → Themes
3. Create categories: `hiphop`, `movies-tv`, `streaming`, `creators`, `ai-lab`, `crypto`, `viral`
4. Start publishing!

## 🔧 Setup

```bash
# Clone into WordPress themes directory
git clone https://github.com/buzzwiredaily/buzz-theme.git

# Or via WP-CLI
wp theme install buzz-theme --activate
```

## 📝 Development

This theme is designed to be synced with WordPress. When ready:
1. Push to GitHub
2. Connect repo to your WordPress staging/production
3. Use a deployment workflow (GitHub Actions, WP Pusher, etc.)

## 🎨 Color Palette

| Color | Hex | Use |
|-------|-----|-----|
| Void Black | `#030305` | Background |
| Charcoal | `#0A0A0F` | Cards |
| Electric Red | `#FF2D55` | Primary accent |
| Buzz Purple | `#7B61FF` | Secondary accent |
| Neon Green | `#39FF14` | Live indicators |
| Gold Rush | `#FFD700` | Premium features |

## 📄 License

GNU General Public License v2 or later

---

*Built with OpenWork for Buzzwire Daily*
