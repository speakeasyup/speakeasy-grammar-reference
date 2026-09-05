<?php
if (!defined('ABSPATH')) {
    exit;
}

$sidebar = new SpeakEasyGrammar_Sidebar();
$topics = $sidebar->get_topics();
?>

<aside class="segrammar-sidebar">
    <div class="segrammar-search">
        <input 
            type="text" 
            id="segrammar-search-input" 
            placeholder="<?php _e('Search grammar...', 'speak-easy-grammar'); ?>"
            aria-label="<?php _e('Search grammar topics', 'speak-easy-grammar'); ?>"
        />
        <div id="segrammar-search-results" class="search-results-dropdown"></div>
    </div>

    <button class="segrammar-toggle-sidebar" aria-label="<?php _e('Toggle navigation menu', 'speak-easy-grammar'); ?>">
        <span class="hamburger">☰</span>
    </button>

    <nav class="segrammar-nav" aria-label="<?php _e('Grammar topics', 'speak-easy-grammar'); ?>">
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
</aside>
