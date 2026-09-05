<?php
if (!defined('ABSPATH')) {
    exit;
}

$lesson = isset($lesson) ? $lesson : null;

if (!$lesson) {
    echo '<p>' . __('Lesson data not found.', 'speak-easy-grammar') . '</p>';
    return;
}

$content = json_decode($lesson->content, true);
$related = json_decode($lesson->related_topics, true);
?>

<article class="segrammar-lesson">
    <header class="segrammar-lesson-header">
        <h1><?php echo esc_html($lesson->title); ?></h1>
        <div class="segrammar-meta">
            <span class="cefr-level"><?php _e('CEFR Level:', 'speak-easy-grammar'); ?> <strong><?php echo esc_html($lesson->level); ?></strong></span>
        </div>
    </header>

    <?php if (!empty($content['italian_explanation'])): ?>
    <section class="segrammar-section italian-explanation">
        <h2><?php _e('Italian Explanation', 'speak-easy-grammar'); ?></h2>
        <div class="segrammar-content">
            <?php echo wp_kses_post($content['italian_explanation']); ?>
        </div>
    </section>
    <?php endif; ?>

    <?php if (!empty($content['grammar_table'])): ?>
    <section class="segrammar-section grammar-table">
        <h2><?php _e('Grammar Table', 'speak-easy-grammar'); ?></h2>
        <div class="table-responsive">
            <?php echo wp_kses_post($content['grammar_table']); ?>
        </div>
    </section>
    <?php endif; ?>

    <?php if (!empty($content['examples'])): ?>
    <section class="segrammar-section examples">
        <h2><?php _e('English Examples', 'speak-easy-grammar'); ?></h2>
        <ol class="examples-list">
            <?php foreach ($content['examples'] as $example): ?>
            <li><?php echo esc_html($example); ?></li>
            <?php endforeach; ?>
        </ol>
    </section>
    <?php endif; ?>

    <?php if (!empty($content['italian_translations'])): ?>
    <section class="segrammar-section italian-translations">
        <h2><?php _e('Italian Translations', 'speak-easy-grammar'); ?></h2>
        <ol class="translations-list">
            <?php foreach ($content['italian_translations'] as $translation): ?>
            <li><?php echo esc_html($translation); ?></li>
            <?php endforeach; ?>
        </ol>
    </section>
    <?php endif; ?>

    <?php if (!empty($content['common_mistakes'])): ?>
    <section class="segrammar-section common-mistakes">
        <h2><?php _e('Common Mistakes', 'speak-easy-grammar'); ?></h2>
        <div class="mistakes-content">
            <?php echo wp_kses_post($content['common_mistakes']); ?>
        </div>
    </section>
    <?php endif; ?>

    <?php if (!empty($related)): ?>
    <section class="segrammar-section related-topics">
        <h2><?php _e('Related Topics', 'speak-easy-grammar'); ?></h2>
        <ul class="related-list">
            <?php foreach ($related as $topic): ?>
            <li><a href="<?php echo esc_url(home_url('/grammar/' . sanitize_title($topic))); ?>"><?php echo esc_html($topic); ?></a></li>
            <?php endforeach; ?>
        </ul>
    </section>
    <?php endif; ?>
</article>
