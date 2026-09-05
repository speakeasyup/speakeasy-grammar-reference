<?php

if (!defined('ABSPATH')) {
    exit;
}

class SpeakEasyGrammar_Database {
    private static $table_name = 'se_grammar_lessons';

    public static function get_table_name() {
        global $wpdb;
        return $wpdb->prefix . self::$table_name;
    }

    public static function create_table() {
        global $wpdb;
        $table_name = self::get_table_name();
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE IF NOT EXISTS {$table_name} (
            id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            slug VARCHAR(255) NOT NULL UNIQUE,
            level VARCHAR(10),
            category VARCHAR(100),
            content LONGTEXT,
            keywords LONGTEXT,
            related_topics LONGTEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            INDEX idx_slug (slug),
            INDEX idx_category (category),
            INDEX idx_level (level)
        ) $charset_collate;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);
    }

    public static function insert_lesson($data) {
        global $wpdb;
        $table_name = self::get_table_name();

        // FIX #4: Add error handling for insert operations
        // Previously, insert failures were silently ignored with no logging.
        // Now we check for errors and log them for debugging.
        $inserted = $wpdb->insert(
            $table_name,
            array(
                'title' => $data['title'],
                'slug' => $data['slug'],
                'level' => $data['level'] ?? '',
                'category' => $data['category'] ?? '',
                'content' => $data['content'] ?? '',
                'keywords' => $data['keywords'] ?? '',
                'related_topics' => $data['related_topics'] ?? ''
            ),
            array('%s', '%s', '%s', '%s', '%s', '%s', '%s')
        );

        // FIX #4: Log database errors for debugging
        if (false === $inserted && !empty($wpdb->last_error)) {
            error_log('Speak Easy Grammar: Database insert error: ' . $wpdb->last_error);
        }

        return $inserted ? $wpdb->insert_id : false;
    }

    public static function get_lesson_by_slug($slug) {
        global $wpdb;
        $table_name = self::get_table_name();
        
        // FIX #4: Add error handling for query operations
        // Check for database errors after query execution
        $result = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$table_name} WHERE slug = %s", $slug));
        
        // FIX #4: Log database errors for debugging
        if (!empty($wpdb->last_error)) {
            error_log('Speak Easy Grammar: Database query error in get_lesson_by_slug: ' . $wpdb->last_error);
        }

        return $result;
    }

    public static function get_all_lessons() {
        global $wpdb;
        $table_name = self::get_table_name();
        
        // FIX #4: Use prepared statement for consistency and safety
        // Previous unprepared query maintained but now checks for errors
        $result = $wpdb->get_results("SELECT * FROM {$table_name} ORDER BY category, title");
        
        // FIX #4: Log database errors for debugging
        if (!empty($wpdb->last_error)) {
            error_log('Speak Easy Grammar: Database query error in get_all_lessons: ' . $wpdb->last_error);
        }

        return $result;
    }

    public static function search_lessons($query) {
        global $wpdb;
        $table_name = self::get_table_name();
        $search_term = '%' . $wpdb->esc_like($query) . '%';

        // FIX #4: Add error handling for search queries
        $result = $wpdb->get_results($wpdb->prepare(
            "SELECT id, title, slug, level, category FROM {$table_name} 
            WHERE title LIKE %s 
            OR keywords LIKE %s 
            OR content LIKE %s
            LIMIT 20",
            $search_term,
            $search_term,
            $search_term
        ));

        // FIX #4: Log database errors for debugging
        if (!empty($wpdb->last_error)) {
            error_log('Speak Easy Grammar: Database query error in search_lessons: ' . $wpdb->last_error);
        }

        return $result;
    }
}
