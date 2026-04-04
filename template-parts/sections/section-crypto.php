<?php
/**
 * Crypto Section Template
 *
 * @package Buzz_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

$crypto_posts = buzz_get_posts_by_section('crypto', 3);
?>

<!-- ═══ 6. CRYPTO ═══ -->
<section class="bw-section bw-crypto bw-reveal" id="crypto">
    <div class="bw-crypto-label">Section 06 — Crypto & Web3</div>
    <h2 class="bw-crypto-title">CRYPTO<br>&amp; <span>WEB3</span></h2>
    
    <div class="bw-crypto-ticker-row">
        <?php
        $ticker_data = array(
            array('sym' => 'BTC', 'price' => '$94,230', 'chg' => '+4.2%', 'dir' => 'up'),
            array('sym' => 'ETH', 'price' => '$3,841', 'chg' => '+2.8%', 'dir' => 'up'),
            array('sym' => 'SOL', 'price' => '$187.40', 'chg' => '+6.1%', 'dir' => 'up'),
            array('sym' => '$AGNT', 'price' => '$0.0842', 'chg' => '+380%', 'dir' => 'up'),
            array('sym' => 'BNB', 'price' => '$612.20', 'chg' => '-1.1%', 'dir' => 'down'),
            array('sym' => 'LINK', 'price' => '$22.40', 'chg' => '+3.3%', 'dir' => 'up'),
        );
        foreach ($ticker_data as $tick) :
        ?>
            <div class="bw-crypto-tick">
                <div class="bw-crypto-tick-sym"><?php echo esc_html($tick['sym']); ?></div>
                <div class="bw-crypto-tick-price"><?php echo esc_html($tick['price']); ?></div>
                <div class="bw-crypto-tick-chg bw-<?php echo esc_attr($tick['dir']); ?>">
                    <?php echo $tick['dir'] === 'up' ? '▲' : '▼'; ?> <?php echo esc_html($tick['chg']); ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    
    <div class="bw-crypto-grid">
        <?php
        $card_num = 1;
        if ($crypto_posts->have_posts()) :
            while ($crypto_posts->have_posts() && $card_num <= 3) :
                $crypto_posts->the_post();
                $is_main = ($card_num === 1);
                $card_class = $is_main ? 'bw-main' : '';
        ?>
            <article class="bw-crypto-card <?php echo esc_attr($card_class); ?>">
                <div class="bw-crypto-cat">
                    <?php
                    $categories = get_the_category();
                    if (!empty($categories)) {
                        echo esc_html($categories[0]->name);
                    }
                    ?>
                </div>
                <h3 class="bw-crypto-ttl">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>
                <p class="bw-crypto-ex"><?php echo wp_trim_words(get_the_excerpt(), 30); ?></p>
                
                <?php if ($is_main) : ?>
                    <div class="bw-crypto-chart">
                        <?php for ($i = 0; $i < 9; $i++) : 
                            $height = rand(45, 100);
                            $color = ($i === 8) ? 'background: #00FF87' : '';
                        ?>
                            <div class="bw-crypto-bar" style="height: <?php echo esc_attr($height); ?>%; width: 6px; <?php echo esc_attr($color); ?>"></div>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>
                
                <div class="bw-crypto-meta">
                    <span><?php echo get_the_date('M j'); ?> · <?php echo rand(5, 12); ?> min</span>
                    <span class="bw-up">+<?php echo rand(20, 50); ?>K views</span>
                </div>
            </article>
        <?php
                $card_num++;
            endwhile;
            wp_reset_postdata();
        else :
        ?>
            <article class="bw-crypto-card bw-main">
                <div class="bw-crypto-cat">🔥 Featured Analysis</div>
                <h3 class="bw-crypto-ttl">
                    <a href="#">Bitcoin at $94K: On-Chain Data Points to $110K — The Signal Institutional Holders Are Sending</a>
                </h3>
                <p class="bw-crypto-ex">
                    Long-term holder accumulation at levels not seen since the 2020 pre-rally. 
                    Three on-chain metrics flashing historically rare bullish divergence...
                </p>
                <div class="bw-crypto-chart">
                    <div class="bw-crypto-bar" style="height: 60%; width: 6px"></div>
                    <div class="bw-crypto-bar" style="height: 45%; width: 6px"></div>
                    <div class="bw-crypto-bar" style="height: 70%; width: 6px"></div>
                    <div class="bw-crypto-bar" style="height: 55%; width: 6px"></div>
                    <div class="bw-crypto-bar" style="height: 80%; width: 6px"></div>
                    <div class="bw-crypto-bar" style="height: 65%; width: 6px"></div>
                    <div class="bw-crypto-bar" style="height: 90%; width: 6px"></div>
                    <div class="bw-crypto-bar" style="height: 75%; width: 6px"></div>
                    <div class="bw-crypto-bar" style="height: 100%; width: 6px; background: #00FF87"></div>
                </div>
                <div class="bw-crypto-meta"><span>Research · 9 min</span><span class="bw-up">+42K views today</span></div>
            </article>
            
            <article class="bw-crypto-card">
                <div class="bw-crypto-cat">AI × Crypto</div>
                <h3 class="bw-crypto-ttl">
                    <a href="#">AI Agent Tokens: 5 Projects with Real Utility in 2026</a>
                </h3>
                <p class="bw-crypto-ex">
                    Beyond the hype — a utility-first deep dive into the top AI-adjacent 
                    crypto plays that might actually survive the cycle.
                </p>
                <div class="bw-crypto-meta"><span>Research · 9 min</span><span class="bw-up">Trending</span></div>
            </article>
            
            <article class="bw-crypto-card">
                <div class="bw-crypto-cat">Tax Guide</div>
                <h3 class="bw-crypto-ttl">
                    <a href="#">2026 Crypto Tax Rules: The IRS Changes Every Holder Must Know</a>
                </h3>
                <p class="bw-crypto-ex">
                    New cost basis reporting requirements. What changed, what didn't, 
                    and how to stay compliant without paying more than you owe.
                </p>
                <div class="bw-crypto-meta"><span>Finance · 10 min</span><span class="bw-down">Action Required</span></div>
            </article>
        <?php endif; ?>
    </div>
</section>
