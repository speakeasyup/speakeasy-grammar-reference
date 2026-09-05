<?php

if (!defined('ABSPATH')) {
    exit;
}

class SpeakEasyGrammar_Lessons {
    public function __construct() {
        add_shortcode('se-grammar-lesson', array($this, 'render_lesson'));
        add_shortcode('se-grammar-portal', array($this, 'render_portal'));
    }

    public function render_lesson($atts) {
        $atts = shortcode_atts(array(
            'slug' => ''
        ), $atts);

        if (empty($atts['slug'])) {
            return '<p>' . __('No lesson specified.', 'speak-easy-grammar') . '</p>';
        }

        $lesson = SpeakEasyGrammar_Database::get_lesson_by_slug($atts['slug']);

        if (!$lesson) {
            return '<p>' . __('Lesson not found.', 'speak-easy-grammar') . '</p>';
        }

        ob_start();
        include SEGRAMMAR_PLUGIN_DIR . 'templates/lesson-template.php';
        return ob_get_clean();
    }

    public function render_portal($atts) {
        ob_start();
        include SEGRAMMAR_PLUGIN_DIR . 'templates/portal-template.php';
        return ob_get_clean();
    }
}
