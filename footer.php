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

<section class="bw-newsletter-front">
    <div class="bw-newsletter-inner">
        <div class="bw-newsletter-kicker">Daily Brief</div>
        <h2 class="bw-newsletter-title-front">Stay on the <span>Wire</span></h2>
        <p class="bw-newsletter-desc">One daily signal. Hip-hop, AI, crypto, streaming, virality — curated for the generation that moves fast.</p>
        <div class="bw-newsletter-perks">
            <span class="bw-newsletter-perk">Drop alerts before they drop</span>
            <span class="bw-newsletter-perk">Industry move breakdowns</span>
            <span class="bw-newsletter-perk">Cipher culture coverage</span>
        </div>
        <form class="bw-newsletter-form-row" id="bw-newsletter-form" action="#" method="post">
            <input type="email" class="bw-newsletter-in" name="email" placeholder="your@email.com" required>
            <button type="submit" class="bw-newsletter-bt">Join →</button>
            <?php wp_nonce_field('buzz_newsletter_nonce', 'newsletter_nonce'); ?>
        </form>
        <div class="bw-newsletter-message" id="bw-newsletter-message"></div>
        <p class="bw-newsletter-note">50,000+ readers · No spam · Unsubscribe anytime</p>
    </div>
</section>

<footer class="bw-footer">
    <div class="bw-container">
        <div class="bw-footer-grid">
            <div class="bw-footer-brand">
                <div class="bw-footer-logo">BUZZ<span>WIRE</span></div>
                <p class="bw-footer-tagline">Where culture breaks first. Multi-niche content platform built for the generation that doesn't wait.</p>
                <div class="bw-footer-social">
                    <a href="https://twitter.com/buzzwiredaily" target="_blank" rel="noopener" aria-label="Twitter">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    <a href="https://instagram.com/buzzwiredaily" target="_blank" rel="noopener" aria-label="Instagram">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    <a href="https://youtube.com/@buzzwiredaily" target="_blank" rel="noopener" aria-label="YouTube">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                </div>
            </div>
            
            <div class="bw-footer-col">
                <h4>Sections</h4>
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/category/hiphop/')); ?>">Hip-Hop</a></li>
                    <li><a href="<?php echo esc_url(home_url('/category/movies/')); ?>">Movies</a></li>
                    <li><a href="<?php echo esc_url(home_url('/category/streaming/')); ?>">Streaming</a></li>
                    <li><a href="<?php echo esc_url(home_url('/category/influencer/')); ?>">Influencer</a></li>
                    <li><a href="<?php echo esc_url(home_url('/category/ai/')); ?>">AI</a></li>
                    <li><a href="<?php echo esc_url(home_url('/category/crypto/')); ?>">Crypto</a></li>
                    <li><a href="<?php echo esc_url(home_url('/category/viral/')); ?>">Viral</a></li>
                </ul>
            </div>
            
            <div class="bw-footer-col">
                <h4>Apps</h4>
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/apps/hook-tester')); ?>">Hook Tester</a></li>
                    <li><a href="<?php echo esc_url(home_url('/apps/wheretowatch')); ?>">WhereToWatch</a></li>
                    <li><a href="<?php echo esc_url(home_url('/apps/ai-tool-match')); ?>">AI Tool Match</a></li>
                    <li><a href="<?php echo esc_url(home_url('/apps/token-truth')); ?>">Token Truth</a></li>
                    <li><a href="<?php echo esc_url(home_url('/apps/drop-alert')); ?>">Drop Alert</a></li>
                </ul>
            </div>
            
            <div class="bw-footer-col">
                <h4>Company</h4>
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/about')); ?>">About</a></li>
                    <li><a href="<?php echo esc_url(home_url('/advertise')); ?>">Advertise</a></li>
                    <li><a href="<?php echo esc_url(home_url('/newsletter')); ?>">Newsletter</a></li>
                    <li><a href="<?php echo esc_url(home_url('/privacy')); ?>">Privacy</a></li>
                    <li><a href="<?php echo esc_url(home_url('/terms')); ?>">Terms</a></li>
                    <li><a href="<?php echo esc_url(home_url('/contact')); ?>">Contact</a></li>
                </ul>
            </div>
        </div>
        
        <div class="bw-footer-bottom">
            <span>&copy; <?php echo date('Y'); ?> Buzzwire Daily. All rights reserved.</span>
            <div class="bw-footer-legal">
                <a href="<?php echo esc_url(home_url('/privacy-policy')); ?>">Privacy Policy</a>
                <a href="<?php echo esc_url(home_url('/terms-of-service')); ?>">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>

</main>

<?php wp_footer(); ?>

</body>
</html>
