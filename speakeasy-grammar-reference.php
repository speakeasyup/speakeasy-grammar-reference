<?php
/**
 * Plugin Name: Speak Easy Grammar Reference
 * Plugin URI: https://github.com/speakeasyup/speakeasy-grammar-reference
 * Description: A searchable English grammar reference portal for Italian-speaking learners
 * Version: 1.0.0
 * Author: Speak Easy
 * Author URI: https://speakeasyup.com
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: speak-easy-grammar
 * Domain Path: /languages
 */

if (!defined('ABSPATH')) {
    exit;
}

define('SEGRAMMAR_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('SEGRAMMAR_PLUGIN_URL', plugin_dir_url(__FILE__));
define('SEGRAMMAR_VERSION', '1.0.0');

// Include required files
require_once SEGRAMMAR_PLUGIN_DIR . 'includes/class-database.php';
require_once SEGRAMMAR_PLUGIN_DIR . 'includes/class-lessons.php';
require_once SEGRAMMAR_PLUGIN_DIR . 'includes/class-search.php';
require_once SEGRAMMAR_PLUGIN_DIR . 'includes/class-sidebar.php';

class SpeakEasyGrammar {
    private static $instance = null;

    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct() {
        add_action('plugins_loaded', array($this, 'init'));
        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));
    }

    public function init() {
        $this->load_textdomain();
        
        // Initialize components
        new SpeakEasyGrammar_Database();
        new SpeakEasyGrammar_Lessons();
        new SpeakEasyGrammar_Search();
        new SpeakEasyGrammar_Sidebar();
        
        // Admin pages
        if (is_admin()) {
            require_once SEGRAMMAR_PLUGIN_DIR . 'admin/admin-page.php';
        }
        
        // Frontend
        require_once SEGRAMMAR_PLUGIN_DIR . 'public/public-page.php';
        
        // Enqueue assets
        add_action('wp_enqueue_scripts', array($this, 'enqueue_assets'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_assets'));
    }

    public function load_textdomain() {
        load_plugin_textdomain('speak-easy-grammar', false, dirname(plugin_basename(__FILE__)) . '/languages');
    }

    public function enqueue_assets() {
        wp_enqueue_style('segrammar-style', SEGRAMMAR_PLUGIN_URL . 'assets/css/style.css', array(), SEGRAMMAR_VERSION);
        wp_enqueue_script('segrammar-search', SEGRAMMAR_PLUGIN_URL . 'assets/js/search.js', array('jquery'), SEGRAMMAR_VERSION, true);
        
        wp_localize_script('segrammar-search', 'seGrammarAjax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('segrammar_nonce')
        ));
    }

    public function enqueue_admin_assets() {
        wp_enqueue_style('segrammar-admin-style', SEGRAMMAR_PLUGIN_URL . 'assets/css/style.css', array(), SEGRAMMAR_VERSION);
    }

    public function activate() {
        SpeakEasyGrammar_Database::create_table();
        flush_rewrite_rules();
    }

    public function deactivate() {
        flush_rewrite_rules();
    }
}

// Initialize the plugin
SpeakEasyGrammar::get_instance();
