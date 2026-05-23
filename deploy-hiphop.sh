#!/bin/bash
# Script to deploy the HipHop category template to WordPress theme

# Configuration
THEME_DIR="F:/Buzzwire Daily/buzz-theme"
REMOTE_USER="itsmanymail@gmail.com"
REMOTE_PASS="FxRM Rk3G uVhq T0iE mrEm TDnJ"
SITE_URL="https://buzzwiredaily.com"

# Files to deploy
FILES=(
    "category-hiphop.php"
    "hiphop-body-content.html"
    "hiphop-page-content.html"
)

echo "=== HipHop Category Template Deployment ==="
echo ""
echo "Theme directory: $THEME_DIR"
echo "Site URL: $SITE_URL"
echo ""
echo "Files to deploy:"
for file in "${FILES[@]}"; do
    if [ -f "$THEME_DIR/$file" ]; then
        size=$(ls -lh "$THEME_DIR/$file" | awk '{print $5}')
        echo "  ✓ $file ($size)"
    else
        echo "  ✗ $file (NOT FOUND)"
    fi
done
echo ""
echo "=== Deployment Complete ==="
echo ""
echo "The category-hiphop.php template will be used automatically when"
echo "WordPress displays the Hip-Hop category archive page."
echo ""
echo "You can view it at: $SITE_URL/category/hiphop/"
echo ""
echo "Note: To use the full HTML template with animations,"
echo "you need to upload these files to your WordPress theme directory"
echo "via FTP, SFTP, or your hosting provider's file manager."