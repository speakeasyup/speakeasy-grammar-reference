<?php
if (!defined('ABSPATH')) {
    exit;
}

$sidebar = new SpeakEasyGrammar_Sidebar();
$topics = $sidebar->get_topics();
?>
<div class="segrammar-container">
    <div class="segrammar-sidebar">
        <div class="segrammar-search">
            <input type="text" id="segrammar-search-input" placeholder="<?php _e('Search grammar...', 'speak-easy-grammar'); ?>" />
            <div id="segrammar-search-results"></div>
        </div>

        <button class="segrammar-toggle-sidebar"><?php _e('≡ Menu', 'speak-easy-grammar'); ?></button>

        <nav class="segrammar-nav">
            <h3><?php _e('Grammar Topics', 'speak-easy-grammar'); ?></h3>
            <ul>
                <?php foreach ($topics as $topic): ?>
                <li>
                    <a href="<?php echo esc_url(home_url('/grammar/' . sanitize_title($topic))); ?>">
                        <?php echo esc_html($topic); ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>

    <div class="segrammar-content">
        <?php echo do_shortcode('[se-grammar-lesson slug="' . sanitize_title($topic) . '"]'); ?>
    </div>
</div>
