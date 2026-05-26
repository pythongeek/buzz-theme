<?php
/**
 * Front Page Template
 *
 * @package Buzz_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<!-- Breaking News Ticker -->
<div class="bw-ticker-wrap">
    <div class="bw-ticker">
        <span class="bw-ticker-live">🔴 LIVE</span>
        <span class="bw-ticker-item">Kendrick Lamar drops surprise album — stream now</span>
        <span class="bw-ticker-dot">•</span>
        <span class="bw-ticker-item">Netflix raises prices again — here's what you pay</span>
        <span class="bw-ticker-dot">•</span>
        <span class="bw-ticker-item">New AI tool creates viral TikToks in 30 seconds</span>
        <span class="bw-ticker-dot">•</span>
        <span class="bw-ticker-item">Bitcoin hits $72K — what's driving the surge?</span>
        <span class="bw-ticker-dot">•</span>
        <span class="bw-ticker-item">"The Summer I Turned Pretty" S3 confirmed</span>
        <span class="bw-ticker-dot">•</span>
        <span class="bw-ticker-item">Travis Scott x Nike collab drops tomorrow</span>
        <span class="bw-ticker-dot">•</span>
        <span class="bw-ticker-item">TikTok algorithm change — creators panic</span>
        <span class="bw-ticker-dot">•</span>
        <span class="bw-ticker-item">Marvel's new series leaks — first look</span>
    </div>
</div>

<!-- Category Quick Nav -->
<div class="bw-categories">
    <a href="/hiphop" class="bw-cat-badge hiphop">🎤 Hip-Hop</a>
    <a href="/movies-tv" class="bw-cat-badge movies">🎬 Movies</a>
    <a href="/streaming" class="bw-cat-badge streaming">📺 Streaming</a>
    <a href="/creators" class="bw-cat-badge influencers">🌟 Creators</a>
    <a href="/ai-lab" class="bw-cat-badge ai">🤖 AI Lab</a>
    <a href="/crypto" class="bw-cat-badge crypto">₿ Crypto</a>
    <a href="/viral" class="bw-cat-badge viral">📱 Viral</a>
</div>

<!-- Main Hero Grid -->
<div class="bw-hero-grid">
    
    <!-- Featured Story (Large) -->
    <article class="bw-hero-featured">
        <div class="bw-hero-img-wrap">
            <img src="https://images.unsplash.com/photo-1493225255756-d9584f8606e9?w=1200&h=675&fit=crop" 
                 alt="Kendrick Lamar performing" 
                 class="bw-hero-img"
                 loading="eager">
            <div class="bw-hero-gradient"></div>
        </div>
        <div class="bw-hero-content">
            <div class="bw-hero-meta">
                <span class="bw-cat-tag hiphop">🎤 Hip-Hop</span>
                <span class="bw-hero-exclusive">EXCLUSIVE</span>
            </div>
            <h1 class="bw-hero-title">
                Kendrick Lamar's Surprise Drop Shatters Streaming Records in 4 Hours
            </h1>
            <p class="bw-hero-excerpt">
                The untitled project racked up 50M streams overnight, sparking debate about bot-driven numbers vs. organic fan power. We break down the data.
            </p>
            <div class="bw-hero-footer">
                <span class="bw-author">By J. Cole</span>
                <span class="bw-dot">•</span>
                <span class="bw-time">12 min ago</span>
                <span class="bw-dot">•</span>
                <span class="bw-read-time">4 min read</span>
            </div>
            <div class="bw-hero-actions">
                <a href="#" class="bw-btn-primary">Read Full Story →</a>
                <button class="bw-btn-share" onclick="shareStory('kendrick-surprise-drop')">↗ Share</button>
            </div>
        </div>
    </article>

    <!-- Side Cards (2 stacked) -->
    <div class="bw-hero-side">
        
        <article class="bw-side-card">
            <div class="bw-side-img-wrap">
                <img src="https://images.unsplash.com/photo-1536440136628-849c177e76a1?w=400&h=300&fit=crop" 
                     alt="Movie scene" 
                     class="bw-side-img"
                     loading="lazy">
                <span class="bw-side-cat movies">🎬 Movies</span>
            </div>
            <h3 class="bw-side-title">Netflix's Secret Weapon: The Anime Strategy No One Saw Coming</h3>
            <div class="bw-side-footer">
                <span>2 hr ago</span>
                <span>• 6 min read</span>
            </div>
        </article>

        <article class="bw-side-card">
            <div class="bw-side-img-wrap">
                <img src="https://images.unsplash.com/photo-1639762681485-074b7f938ba0?w=400&h=300&fit=crop" 
                     alt="Crypto chart" 
                     class="bw-side-img"
                     loading="lazy">
                <span class="bw-side-cat crypto">₿ Crypto</span>
            </div>
            <h3 class="bw-side-title">This AI Token Went 40x in 3 Days — Here's the Red Flags</h3>
            <div class="bw-side-footer">
                <span>4 hr ago</span>
                <span>• 8 min read</span>
            </div>
        </article>

    </div>
</div>

<!-- App CTA Band -->
<div class="bw-app-band">
    <div class="bw-app-band-inner">
        <div class="bw-app-info">
            <span class="bw-app-icon">🔥</span>
            <div>
                <strong>Hook Tester</strong>
                <span>Will your caption go viral? Test it free →</span>
            </div>
        </div>
        <a href="/apps/hook-tester" class="bw-app-btn">Try It Now</a>
    </div>
</div>

<?php
// Include section templates
get_template_part('template-parts/sections/section', 'hiphop');
get_template_part('template-parts/sections/section', 'movies');
get_template_part('template-parts/sections/section', 'streaming');
get_template_part('template-parts/sections/section', 'influencers');
get_template_part('template-parts/sections/section', 'ai');
get_template_part('template-parts/sections/section', 'crypto');
get_template_part('template-parts/sections/section', 'viral');
?>

<!-- App Band -->
<section class="bw-app-band bw-reveal">
    <div class="bw-app-band-header">
        <div>
            <div class="bw-app-band-label">Built-in Tools</div>
            <h2 class="bw-app-band-title">Apps That <span>Solve</span> Problems</h2>
        </div>
        <a href="<?php echo esc_url(home_url('/apps')); ?>" class="bw-app-band-link">All 14 Apps →</a>
    </div>
    
    <div class="bw-app-grid">
        <a href="<?php echo esc_url(home_url('/apps/hook-tester')); ?>" class="bw-app-c bw-ac1">
            <div class="bw-app-ico">💡</div>
            <div class="bw-app-nm">Hook Tester</div>
            <p class="bw-app-ds">Paste any caption or headline. Get virality score + why it works. Cross-niche, free.</p>
            <span class="bw-app-lk">Try Free</span>
        </a>
        
        <a href="<?php echo esc_url(home_url('/apps/wheretowatch')); ?>" class="bw-app-c bw-ac2">
            <div class="bw-app-ico">📺</div>
            <div class="bw-app-nm">WhereToWatch</div>
            <p class="bw-app-ds">Any title, every platform, including free options. The tool everyone needs.</p>
            <span class="bw-app-lk">Find It Now</span>
        </a>
        
        <a href="<?php echo esc_url(home_url('/apps/token-truth')); ?>" class="bw-app-c bw-ac3">
            <div class="bw-app-ico">₿</div>
            <div class="bw-app-nm">Token Truth</div>
            <p class="bw-app-ds">Paste any contract. Get utility score, red flags, and whale activity instantly.</p>
            <span class="bw-app-lk">Analyze</span>
        </a>
        
        <a href="<?php echo esc_url(home_url('/apps/ai-tool-match')); ?>" class="bw-app-c bw-ac4">
            <div class="bw-app-ico">🤖</div>
            <div class="bw-app-nm">AI Tool Match</div>
            <p class="bw-app-ds">Tell us what you need. Get AI tools that actually work — no affiliate bias.</p>
            <span class="bw-app-lk">Match Me</span>
        </a>
        
        <a href="<?php echo esc_url(home_url('/apps/stream-truth')); ?>" class="bw-app-c bw-ac5">
            <div class="bw-app-ico">🎵</div>
            <div class="bw-app-nm">Stream Truth</div>
            <p class="bw-app-ds">Detect bot-driven streams vs real engagement on any Spotify link.</p>
            <span class="bw-app-lk">Detect Bots</span>
        </a>
        
        <a href="<?php echo esc_url(home_url('/apps/drop-alert')); ?>" class="bw-app-c bw-ac6">
            <div class="bw-app-ico">🔔</div>
            <div class="bw-app-nm">Drop Alert</div>
            <p class="bw-app-ds">Follow artists. Get notified before the official release — sometimes hours early.</p>
            <span class="bw-app-lk">Follow</span>
        </a>
    </div>
</section>

<!-- Newsletter -->
<section class="bw-newsletter-front bw-reveal">
    <div class="bw-newsletter-inner">
        <div class="bw-newsletter-kicker">Daily Brief</div>
        <h2 class="bw-newsletter-title-front">Stay on the <span>Wire</span></h2>
        <p class="bw-newsletter-desc">One daily signal. Hip-hop, AI, crypto, streaming, virality — curated for the generation that moves fast.</p>
        <div class="bw-newsletter-perks">
            <span class="bw-newsletter-perk">Drop alerts before they drop</span>
            <span class="bw-newsletter-perk">Industry move breakdowns</span>
            <span class="bw-newsletter-perk">Cipher culture coverage</span>
        </div>
        <form class="bw-newsletter-form-row" action="#" method="post">
            <input type="email" class="bw-newsletter-in" placeholder="your@email.com" required>
            <button type="submit" class="bw-newsletter-bt">Join →</button>
        </form>
        <p class="bw-newsletter-note">50,000+ readers · No spam · Unsubscribe anytime</p>
    </div>
</section>

<?php get_footer(); ?>