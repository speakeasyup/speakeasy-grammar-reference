<?php

if (!defined('ABSPATH')) {
    exit;
}

class SpeakEasyGrammar_Search {
    public function __construct() {
        add_action('wp_ajax_segrammar_search', array($this, 'ajax_search'));
        add_action('wp_ajax_nopriv_segrammar_search', array($this, 'ajax_search'));
    }

    public function ajax_search() {
        check_ajax_referer('segrammar_nonce', 'nonce');

        $query = isset($_POST['query']) ? sanitize_text_field($_POST['query']) : '';

        if (strlen($query) < 2) {
            wp_send_json_error(array('message' => 'Query too short'));
        }

        $results = SpeakEasyGrammar_Database::search_lessons($query);

        wp_send_json_success($results);
    }
}
