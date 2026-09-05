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
        ob_start();
        include SEGRAMMAR_PLUGIN_DIR . 'templates/sidebar.php';
        ob_get_clean();
    }

    public function get_topics() {
        return $this->topics;
    }
}
