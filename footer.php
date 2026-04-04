<?php
/**
 * Footer template
 *
 * @package Buzz_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<!-- Newsletter Section -->
<section class="bw-newsletter bw-reveal">
    <div class="bw-newsletter-inner">
        <div class="bw-newsletter-kicker">Daily Brief</div>
        <h2 class="bw-newsletter-title">Stay on the <span>Wire</span></h2>
        <p class="bw-newsletter-desc">
            One daily signal. Hip-hop, AI, crypto, streaming, virality — 
            curated for the generation that moves fast.
        </p>
        <form class="bw-newsletter-row" action="#" method="post" id="bw-newsletter-form">
            <input type="email" class="bw-newsletter-input" placeholder="your@email.com" required>
            <button type="submit" class="bw-newsletter-btn">Join →</button>
        </form>
        <p class="bw-newsletter-note">50,000+ readers · No spam · Unsubscribe anytime</p>
    </div>
</section>

<!-- Footer -->
<footer class="bw-footer">
    <div class="bw-footer-grid">
        <div>
            <div class="bw-footer-logo">Buzz<span>Wire</span> Daily</div>
            <p class="bw-footer-tag">
                Where culture breaks first. Multi-niche content platform 
                built for the generation that doesn't wait.
            </p>
        </div>
        
        <div>
            <h3 class="bw-footer-col-h">Sections</h3>
            <ul class="bw-footer-links">
                <li><a href="#hiphop">🎤 Urban Culture</a></li>
                <li><a href="#movies-tv">🎬 Movies & TV</a></li>
                <li><a href="#streaming">📺 Streaming</a></li>
                <li><a href="#creators">🌟 Creators</a></li>
                <li><a href="#ai-lab">🤖 AI Lab</a></li>
                <li><a href="#crypto">₿ Crypto</a></li>
                <li><a href="#viral">📱 Viral</a></li>
            </ul>
        </div>
        
        <div>
            <h3 class="bw-footer-col-h">Apps</h3>
            <ul class="bw-footer-links">
                <li><a href="<?php echo esc_url(home_url('/apps/hook-tester')); ?>">Hook Tester</a></li>
                <li><a href="<?php echo esc_url(home_url('/apps/wheretowatch')); ?>">WhereToWatch</a></li>
                <li><a href="<?php echo esc_url(home_url('/apps/ai-tool-match')); ?>">AI Tool Match</a></li>
                <li><a href="<?php echo esc_url(home_url('/apps/token-truth')); ?>">Token Truth</a></li>
                <li><a href="<?php echo esc_url(home_url('/apps/stream-truth')); ?>">Stream Truth</a></li>
                <li><a href="<?php echo esc_url(home_url('/apps/drop-alert')); ?>">Drop Alert</a></li>
            </ul>
        </div>
        
        <div>
            <h3 class="bw-footer-col-h">Company</h3>
            <ul class="bw-footer-links">
                <li><a href="<?php echo esc_url(home_url('/about')); ?>">About</a></li>
                <li><a href="<?php echo esc_url(home_url('/advertise')); ?>">Advertise</a></li>
                <li><a href="<?php echo esc_url(home_url('/newsletter')); ?>">Newsletter</a></li>
                <li><a href="<?php echo esc_url(home_url('/privacy')); ?>">Privacy</a></li>
                <li><a href="<?php echo esc_url(home_url('/contact')); ?>">Contact</a></li>
            </ul>
        </div>
    </div>
    
    <div class="bw-footer-bottom">
        <span>© <?php echo date('Y'); ?> Buzzwire Daily · Powered by OpenWork</span>
        <div class="bw-footer-social">
            <a href="#">TikTok</a>
            <a href="#">X</a>
            <a href="#">Instagram</a>
            <a href="#">YouTube</a>
        </div>
    </div>
</footer>

</main><!-- .bw-main -->

<?php wp_footer(); ?>

</body>
</html>
