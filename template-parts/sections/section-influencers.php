<?php
/**
 * Influencers Section Template
 *
 * @package Buzz_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

$creator_posts = buzz_get_posts_by_section('creators', 4);
?>

<!-- ═══ 4. INFLUENCERS ═══ -->
<section class="bw-section bw-influencer bw-reveal" id="creators">
    <div class="bw-inf-label">Section 04 — Creators & Influencers</div>
    <h2 class="bw-inf-title">
        <span class="bw-hot">CREATOR</span><br>
        <span class="bw-cold">ECON</span><br>
        OMY
    </h2>
    
    <div class="bw-inf-phones">
        <?php
        $phone_num = 1;
        if ($creator_posts->have_posts()) :
            while ($creator_posts->have_posts() && $phone_num <= 4) :
                $creator_posts->the_post();
                $bg_colors = array(
                    'linear-gradient(180deg, #1a0030, #050008)',
                    'linear-gradient(180deg, #001a30, #000508)',
                    'linear-gradient(180deg, #1a1000, #050300)',
                    'linear-gradient(180deg, #001a0a, #000508)',
                );
        ?>
            <article class="bw-inf-phone">
                <div class="bw-inf-phone-screen">
                    <div class="bw-inf-screen-bg" style="background: <?php echo esc_attr($bg_colors[$phone_num - 1]); ?>"></div>
                    <div class="bw-inf-notch"></div>
                    <div class="bw-inf-stats">
                        <span class="bw-inf-stat-chip" style="color: #FF006E"><?php echo rand(1, 5); ?>M views</span>
                        <span class="bw-inf-stat-chip" style="color: #00D9FF"><?php echo rand(85, 99); ?>% eng</span>
                    </div>
                </div>
                <div class="bw-inf-body">
                    <div class="bw-inf-creator">@<?php the_author(); ?></div>
                    <h3 class="bw-inf-ttl">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <div class="bw-inf-eng">
                        <span><?php echo rand(5, 15); ?>K</span> shares · <span><?php echo rand(100, 500); ?>K</span> views
                    </div>
                </div>
            </article>
        <?php
                $phone_num++;
            endwhile;
            wp_reset_postdata();
        else :
        ?>
            <article class="bw-inf-phone">
                <div class="bw-inf-phone-screen">
                    <div class="bw-inf-screen-bg" style="background: linear-gradient(180deg, #1a0030, #050008)"></div>
                    <div class="bw-inf-notch"></div>
                    <div class="bw-inf-stats">
                        <span class="bw-inf-stat-chip" style="color: #FF006E">2.4M views</span>
                        <span class="bw-inf-stat-chip" style="color: #00D9FF">94% eng</span>
                    </div>
                </div>
                <div class="bw-inf-body">
                    <div class="bw-inf-creator">@creator_economy</div>
                    <h3 class="bw-inf-ttl">
                        <a href="#">69% of Creators Report Financial Instability in 2026</a>
                    </h3>
                    <div class="bw-inf-eng"><span>12K</span> shares · <span>340K</span> views</div>
                </div>
            </article>
            
            <article class="bw-inf-phone">
                <div class="bw-inf-phone-screen">
                    <div class="bw-inf-screen-bg" style="background: linear-gradient(180deg, #001a30, #000508)"></div>
                    <div class="bw-inf-notch"></div>
                    <div class="bw-inf-stats">
                        <span class="bw-inf-stat-chip" style="color: #00D9FF">TikTok</span>
                        <span class="bw-inf-stat-chip" style="color: #FF006E">Breaking</span>
                    </div>
                </div>
                <div class="bw-inf-body">
                    <div class="bw-inf-creator">@algo_watch</div>
                    <h3 class="bw-inf-ttl">
                        <a href="#">TikTok's Algorithm 4.0 Just Wiped 40% of Reach Overnight</a>
                    </h3>
                    <div class="bw-inf-eng"><span>8.2K</span> shares · <span>240K</span> views</div>
                </div>
            </article>
            
            <article class="bw-inf-phone">
                <div class="bw-inf-phone-screen">
                    <div class="bw-inf-screen-bg" style="background: linear-gradient(180deg, #1a1000, #050300)"></div>
                    <div class="bw-inf-notch"></div>
                    <div class="bw-inf-stats">
                        <span class="bw-inf-stat-chip" style="color: #FFD700">Finance</span>
                        <span class="bw-inf-stat-chip" style="color: #FF006E">Tool</span>
                    </div>
                </div>
                <div class="bw-inf-body">
                    <div class="bw-inf-creator">@brand_deals</div>
                    <h3 class="bw-inf-ttl">
                        <a href="#">Brand Deals Are Getting Worse — Here's How to Negotiate Back</a>
                    </h3>
                    <div class="bw-inf-eng"><span>6.1K</span> shares · <span>180K</span> views</div>
                </div>
            </article>
            
            <article class="bw-inf-phone">
                <div class="bw-inf-phone-screen">
                    <div class="bw-inf-screen-bg" style="background: linear-gradient(180deg, #001a0a, #000508)"></div>
                    <div class="bw-inf-notch"></div>
                    <div class="bw-inf-stats">
                        <span class="bw-inf-stat-chip" style="color: #00D9FF">African</span>
                        <span class="bw-inf-stat-chip" style="color: #39FF14">Rising</span>
                    </div>
                </div>
                <div class="bw-inf-body">
                    <div class="bw-inf-creator">@afrocreator</div>
                    <h3 class="bw-inf-ttl">
                        <a href="#">Nigerian Creators Are the Fastest Growing Influencer Market Globally</a>
                    </h3>
                    <div class="bw-inf-eng"><span>9.8K</span> shares · <span>290K</span> views</div>
                </div>
            </article>
        <?php endif; ?>
    </div>
</section>
