<?php

if (!defined('ABSPATH')) {
    exit;
}

class SpeakEasyGrammar_Sidebar {
    private $topics = array(
        'Verb To Be',
        'Subject Pronouns',
        'Possessive Adjectives',
        'Articles',
        'Present Simple',
        'Present Continuous',
        'There Is / There Are',
        'Some / Any',
        'Countable and Uncountable Nouns',
        'Prepositions',
        'Question Forms'
    );

    public function __construct() {
        add_action('wp_footer', array($this, 'render_sidebar'));
    }

    public function render_sidebar() {
        // FIX #2: Echo the sidebar output instead of discarding it
        // 
        // The previous implementation used ob_start() and ob_get_clean()
        // but never echoed the result, causing the buffered HTML to be lost.
        // Now we capture the output buffer and echo it directly to the page.
        ob_start();
        include SEGRAMMAR_PLUGIN_DIR . 'templates/sidebar.php';
        echo ob_get_clean();
    }

    public function get_topics() {
        return $this->topics;
    }
}
