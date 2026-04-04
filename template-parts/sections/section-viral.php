<?php
/**
 * Viral Section Template
 *
 * @package Buzz_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

$viral_posts = buzz_get_posts_by_section('viral', 6);
?>

<!-- ═══ 7. VIRAL ═══ -->
<section class="bw-section bw-viral bw-reveal" id="viral">
    <div class="bw-viral-label">Section 07 — Viral & Social</div>
    <h2 class="bw-viral-title">
        <span class="bw-c1">VIRAL</span><br>
        <span class="bw-c2">&</span>
        <span class="bw-c3">SOCIAL</span>
    </h2>
    
    <div class="bw-viral-chaos">
        <?php
        $viral_num = 1;
        $card_classes = array('bw-viral-c1', 'bw-viral-c2', 'bw-viral-c3', 'bw-viral-c4', 'bw-viral-c5', 'bw-viral-c6');
        $badges = array(
            array('class' => 'bw-viral-badge-fire', 'text' => '🔥 %sK shares'),
            array('class' => 'bw-viral-badge-viral', 'text' => '📱 %sK shares'),
            array('class' => 'bw-viral-badge-trend', 'text' => '✦ Trending'),
            array('class' => 'bw-viral-badge-fire', 'text' => '🔥 Creator'),
            array('class' => 'bw-viral-badge-trend', 'text' => 'YouTube'),
            array('class' => 'bw-viral-badge-viral', 'text' => '🕹 Gaming'),
        );
        $badge_colors = array('#FF6B00', '#FF006E', '#FFE600', '#FF6B00', '#FFE600', '#FF006E');
        
        if ($viral_posts->have_posts()) :
            while ($viral_posts->have_posts() && $viral_num <= 6) :
                $viral_posts->the_post();
        ?>
            <article class="bw-viral-card <?php echo esc_attr($card_classes[$viral_num - 1]); ?>">
                <div class="bw-viral-badge <?php echo esc_attr($badges[$viral_num - 1]['class']); ?>">
                    <?php echo esc_html(sprintf($badges[$viral_num - 1]['text'], rand(5, 15))); ?>
                </div>
                <h3 class="bw-viral-ttl">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>
                <div class="bw-viral-meter">
                    <div class="bw-viral-meter-fill" style="width: <?php echo rand(60, 95); ?>%; background: <?php echo esc_attr($badge_colors[$viral_num - 1]); ?>"></div>
                </div>
                <div class="bw-viral-shares">Virality: <?php echo rand(60, 95); ?> / 100</div>
            </article>
        <?php
                $viral_num++;
            endwhile;
            wp_reset_postdata();
        else :
        ?>
            <article class="bw-viral-card bw-viral-c1">
                <div class="bw-viral-badge bw-viral-badge-fire">🔥 12K shares</div>
                <h3 class="bw-viral-ttl">
                    <a href="#">TikTok's Algorithm Wipe: 40% Reach Loss Overnight — What You Must Do Now</a>
                </h3>
                <div class="bw-viral-meter"><div class="bw-viral-meter-fill" style="width: 92%; background: #FF6B00"></div></div>
                <div class="bw-viral-shares">Virality: 92 / 100</div>
                <div class="bw-viral-num">01</div>
            </article>
            
            <article class="bw-viral-card bw-viral-c2">
                <div class="bw-viral-badge bw-viral-badge-viral">📱 8.4K shares</div>
                <h3 class="bw-viral-ttl">
                    <a href="#">Instagram's New Chronological Feed is Already Being Gamed — Here's How</a>
                </h3>
                <div class="bw-viral-meter"><div class="bw-viral-meter-fill" style="width: 78%; background: #FF006E"></div></div>
                <div class="bw-viral-shares">Virality: 78 / 100</div>
                <div class="bw-viral-num">02</div>
            </article>
            
            <article class="bw-viral-card bw-viral-c3">
                <div class="bw-viral-badge bw-viral-badge-trend">✦ Trending</div>
                <h3 class="bw-viral-ttl">
                    <a href="#">The POV Format Is Dead. Here's What Gen Z Is Watching Instead</a>
                </h3>
                <div class="bw-viral-meter"><div class="bw-viral-meter-fill" style="width: 65%; background: #FF006E"></div></div>
                <div class="bw-viral-shares">Virality: 65 / 100</div>
                <div class="bw-viral-num">03</div>
            </article>
            
            <article class="bw-viral-card bw-viral-c4">
                <div class="bw-viral-badge bw-viral-badge-fire">🔥 Creator</div>
                <h3 class="bw-viral-ttl">
                    <a href="#">X's New Monetization Policy Pays 3× More — But Only If You Do This</a>
                </h3>
                <div class="bw-viral-meter"><div class="bw-viral-meter-fill" style="width: 85%; background: #FF6B00"></div></div>
                <div class="bw-viral-shares">Virality: 85 / 100</div>
            </article>
            
            <article class="bw-viral-card bw-viral-c5">
                <div class="bw-viral-badge bw-viral-badge-trend">YouTube</div>
                <h3 class="bw-viral-ttl">
                    <a href="#">YouTube Shorts Is Paying Creators 4× More Than TikTok Per View Now</a>
                </h3>
                <div class="bw-viral-meter"><div class="bw-viral-meter-fill" style="width: 71%; background: #FFE600"></div></div>
                <div class="bw-viral-shares">Virality: 71 / 100</div>
            </article>
            
            <article class="bw-viral-card bw-viral-c6">
                <div class="bw-viral-badge bw-viral-badge-viral">🕹 Gaming</div>
                <h3 class="bw-viral-ttl">
                    <a href="#">How a 19-Year-Old Gamer Hit 10M Followers in 60 Days With One Strategy</a>
                </h3>
                <div class="bw-viral-meter"><div class="bw-viral-meter-fill" style="width: 88%; background: #FF006E"></div></div>
                <div class="bw-viral-shares">Virality: 88 / 100</div>
            </article>
        <?php endif; ?>
    </div>
</section>
