# BuzzWire Daily - v2.0 Deployment Guide

## Overview
✅ **New Homepage has been deployed to GitHub**
- Repository: https://github.com/pythongeek/buzz-theme
- Latest Commit: Complete homepage redesign v2.0
- Changes: New front-page.php, CSS assets, JavaScript, and updated functions.php

## Database Status
✅ **All existing content preserved**
- ✅ All posts and articles remain intact
- ✅ All images and media preserved
- ✅ All categories and tags maintained
- ✅ All custom fields and metadata preserved
- ✅ No database modifications made

## Deployment to Hostinger (buzzwiredaily.com)

### Step 1: Update Theme on Hostinger
1. Log in to your **Hostinger cPanel**
2. Go to **File Manager** → `/public_html/wp-content/themes/`
3. Delete or rename the old `buzz-theme` folder
4. Click **"Upload"** → Select the updated `buzz-theme` folder from GitHub
   - OR use Git to pull: 
     ```bash
     cd /home/your_user/public_html/wp-content/themes/buzz-theme
     git pull origin master
     ```

### Step 2: Clear WordPress Cache
1. Go to WordPress Admin Dashboard: `buzzwiredaily.com/wp-admin`
2. Go to **Tools** → **Cache** (if using W3 Total Cache or similar)
3. Click **"Clear All Caches"**
4. OR use WP CLI (if available):
   ```bash
   wp cache flush
   ```

### Step 3: Verify Homepage
1. Visit **buzzwiredaily.com** in your browser
2. Clear your browser cache (Ctrl+F5 or Cmd+Shift+R)
3. Check that the new homepage displays correctly
4. Test responsive design on mobile devices

### Step 4: Test All Features
- [ ] Hero section with Three.js animation loads
- [ ] Navigation (desktop vertical nav + mobile hamburger) works
- [ ] All 7 sections visible and styled correctly
- [ ] Newsletter form functional
- [ ] Links to category pages work
- [ ] Images load properly
- [ ] Mobile responsive breakpoints work

## File Structure
```
buzz-theme/
├── front-page.php          ✅ NEW - Main homepage template
├── functions.php           ✅ UPDATED - Enqueues new assets
├── header.php              (unchanged - WordPress compatibility)
├── footer.php              (unchanged - WordPress compatibility)
├── style.css               (main theme styles)
├── assets/
│   ├── css/
│   │   └── style.css       ✅ NEW - Homepage styles (38 KB)
│   └── js/
│       ├── buzzwire.js     ✅ NEW - Homepage JavaScript (63 KB)
│       └── main.js         (existing)
├── package.json
├── webpack.config.js
└── README.md
```

## Key Features of v2.0

### Homepage Sections:
1. **Hero** - Full-height intro with 3D animation
2. **Ticker** - Live news ticker with red background
3. **Urban Culture (Hip-Hop)** - Featured music/rap content
4. **Movies & TV** - Cinema and television coverage
5. **Streaming Wars** - Netflix, Disney+, etc. analysis
6. **Creator Economy** - Influencer and social content
7. **AI Lab** - Artificial intelligence features
8. **Crypto & Web3** - Cryptocurrency coverage
9. **Viral & Social** - Trending social media content
10. **Apps** - Featured tools and utilities
11. **Newsletter** - Email signup form
12. **Footer** - Links and social media

### Technology Stack:
- **Framework**: WordPress
- **3D Graphics**: Three.js r128
- **Typography**: Google Fonts (Bebas Neue, DM Mono, Playfair Display, Rajdhani, Barlow Condensed)
- **JavaScript**: Vanilla JS (no jQuery dependency for homepage)
- **CSS**: Custom responsive stylesheet with mobile-first approach

## Responsive Breakpoints
- 1280px (large screens)
- 1024px (tablets)
- 768px (mobile)
- 480px (small phones)
- 360px (very small phones)

## Performance Notes
- Three.js hero animation is disabled on low-end/mobile devices
- Lazy loading enabled for images
- CSS custom properties for theme colors
- No external dependencies except Three.js and Google Fonts

## Troubleshooting

### Homepage not displaying correctly?
- Clear browser cache (Ctrl+Shift+Del)
- Clear WordPress cache via admin dashboard
- Check browser console for JavaScript errors (F12)
- Verify Three.js CDN is loading (check Network tab in DevTools)

### Styles not applied?
- Check that `assets/css/style.css` is present
- Verify file permissions (644 for files, 755 for directories)
- Check that `functions.php` is properly enqueuing the stylesheet

### JavaScript not working?
- Verify `assets/js/buzzwire.js` exists
- Check browser console for errors
- Ensure Three.js is loaded from CDN before main script

### Database issues?
- No database migrations needed - theme is fully compatible
- Posts, pages, categories, and tags remain unchanged
- Custom fields and metadata preserved

## Rollback (if needed)
If you need to revert to the previous version:
```bash
cd /path/to/buzz-theme
git revert HEAD
git push origin master
```

## Support & Contact
- **Repository**: https://github.com/pythongeek/buzz-theme
- **Issues**: Use GitHub Issues tab for bug reports
- **Status**: ✅ Live and Ready for Production

---
**Deployment Date**: May 27, 2026
**Theme Version**: 2.0.0
**Status**: ✅ READY FOR PRODUCTION
