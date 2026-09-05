<?php

if (!defined('ABSPATH')) {
    exit;
}

class SpeakEasyGrammar_Admin {
    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
    }

    public function add_admin_menu() {
        add_menu_page(
            __('Grammar Reference', 'speak-easy-grammar'),
            __('Grammar Reference', 'speak-easy-grammar'),
            'manage_options',
            'segrammar-dashboard',
            array($this, 'render_dashboard'),
            'dashicons-book',
            25
        );

        add_submenu_page(
            'segrammar-dashboard',
            __('All Lessons', 'speak-easy-grammar'),
            __('All Lessons', 'speak-easy-grammar'),
            'manage_options',
            'segrammar-lessons',
            array($this, 'render_lessons')
        );
    }

    public function render_dashboard() {
        ?>
        <div class="wrap">
            <h1><?php _e('Speak Easy Grammar Reference', 'speak-easy-grammar'); ?></h1>
            <p><?php _e('Welcome to the Grammar Reference Dashboard', 'speak-easy-grammar'); ?></p>
        </div>
        <?php
    }

    public function render_lessons() {
        $lessons = SpeakEasyGrammar_Database::get_all_lessons();
        ?>
        <div class="wrap">
            <h1><?php _e('Grammar Lessons', 'speak-easy-grammar'); ?></h1>
            <table class="wp-list-table widefat striped">
                <thead>
                    <tr>
                        <th><?php _e('Title', 'speak-easy-grammar'); ?></th>
                        <th><?php _e('Category', 'speak-easy-grammar'); ?></th>
                        <th><?php _e('Level', 'speak-easy-grammar'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lessons as $lesson): ?>
                    <tr>
                        <td><?php echo esc_html($lesson->title); ?></td>
                        <td><?php echo esc_html($lesson->category); ?></td>
                        <td><?php echo esc_html($lesson->level); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
    }
}

new SpeakEasyGrammar_Admin();
