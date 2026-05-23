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

<!-- Hero Section -->
<section class="bw-hero">
    <canvas id="bw-hero-canvas"></canvas>
    <div class="bw-hero-eyebrow">
        Signal Active — <?php echo date('M d Y'); ?>
    </div>
    <h1 class="bw-hero-title">
        <span class="bw-outline">VOID</span><br>
        <span class="bw-red">SIGNAL</span><br>
        DAILY
    </h1>
    <div class="bw-hero-bottom">
        <p class="bw-hero-desc">
            Hip-hop. AI. Crypto. Streaming. Virality.<br>
            Built for the generation that doesn't wait for tomorrow.
        </p>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="bw-hero-btn">Enter the Wire →</a>
    </div>
    <div class="bw-hero-scroll">
        <div class="bw-scroll-line"></div>
        SCROLL
    </div>
</section>

<!-- Ticker -->
<div class="bw-ticker">
    <div class="bw-ticker-wrap" id="bw-ticker">
        <?php
        // Static ticker items for now - these can be dynamic later
        $ticker_items = array(
            'Kendrick Lamar confirms Q2 LP',
            'GPT-5 passes Turing benchmark',
            'Netflix Q1 beats estimates +$800M',
            'BTC ETF inflows $4.2B single day',
            'Drake 60-city world tour confirmed',
            'TikTok algo wipes 40% creator reach',
            '$AGNT token +380% in 48 hours',
            'Peaky Blinders film begins production',
        );
        
        // Duplicate for seamless loop
        $all_items = array_merge($ticker_items, $ticker_items);
        
        foreach ($all_items as $item) :
        ?>
            <span class="bw-ticker-item"><?php echo esc_html($item); ?></span>
        <?php endforeach; ?>
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
