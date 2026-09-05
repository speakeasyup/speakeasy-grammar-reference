<?php

if (!defined('ABSPATH')) {
    exit;
}

class SpeakEasyGrammar_Public {
    public function __construct() {
        add_action('init', array($this, 'register_rewrite_rules'));
        add_filter('template_include', array($this, 'load_template'));
    }

    public function register_rewrite_rules() {
        add_rewrite_rule(
            '^grammar/([^/]+)/?$',
            'index.php?segrammar_lesson=$matches[1]',
            'top'
        );
        add_rewrite_tag('%segrammar_lesson%', '([^/]+)');
    }

    public function load_template($template) {
        if (get_query_var('segrammar_lesson')) {
            return SEGRAMMAR_PLUGIN_DIR . 'templates/single-lesson.php';
        }
        return $template;
    }
}

new SpeakEasyGrammar_Public();
