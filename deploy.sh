#!/bin/bash
# deploy.sh - Deploy Buzzwire Daily theme to Hostinger via FTP
# Usage: ./deploy.sh YOUR_FTP_PASSWORD

set -e

FTP_HOST="ftp://145.223.77.61"
FTP_USER="u754049643"
FTP_PASS="${1:-${FTP_PASS}}"
LOCAL_THEME="/mnt/f/Buzzwire Daily/buzz-theme"
REMOTE_PATH="/public_html/wp-content/themes/buzzwire-daily"

if [ -z "$FTP_PASS" ]; then
    echo "❌ FTP password required"
    echo "Usage: ./deploy.sh YOUR_PASSWORD"
    echo "Or: FTP_PASS=YOUR_PASSWORD ./deploy.sh"
    exit 1
fi

echo "🚀 Deploying Buzzwire Daily theme..."
echo "Host: $FTP_HOST"
echo "User: $FTP_USER"
echo "Local: $LOCAL_THEME"
echo "Remote: $REMOTE_PATH"
echo ""

# Check if lftp is installed
if ! command -v lftp &> /dev/null; then
    echo "❌ lftp not found. Please install lftp first:"
    echo "   sudo apt-get install lftp"
    echo ""
    echo "Or use the PowerShell deploy script on Windows:"
    echo "   .\deploy.ps1"
    exit 1
fi

# Deploy using lftp
echo "📤 Uploading files..."
lftp -u "$FTP_USER","$FTP_PASS" "$FTP_HOST" <<EOF
set ssl:verify-certificate no
set ftp:ssl-allow yes
set net:max-retries 3
set net:timeout 30

# Create remote directory
mkdir -p $REMOTE_PATH

# Upload with mirror (only newer files)
mirror -R --only-newer --parallel=3 "$LOCAL_THEME" "$REMOTE_PATH"

bye
EOF

echo ""
echo "✅ Deploy successful!"
echo "Theme uploaded to: $REMOTE_PATH"
echo ""
echo "Next steps:"
echo "1. Go to WordPress admin → Appearance → Themes"
echo "2. Activate 'buzzwire-daily' theme"
echo "3. Check site at https://buzzwiredaily.com"