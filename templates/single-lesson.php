<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();

$lesson_slug = get_query_var('segrammar_lesson');
$lesson = SpeakEasyGrammar_Database::get_lesson_by_slug($lesson_slug);

if (!$lesson) {
    echo '<div class="segrammar-container"><p>' . __('Lesson not found.', 'speak-easy-grammar') . '</p></div>';
    get_footer();
    return;
}

$sidebar = new SpeakEasyGrammar_Sidebar();
?>

<div class="segrammar-page-container">
    <?php $sidebar->render_sidebar(); ?>
    
    <div class="segrammar-content">
        <?php include SEGRAMMAR_PLUGIN_DIR . 'templates/lesson-template.php'; ?>
    </div>
</div>

<?php get_footer();
