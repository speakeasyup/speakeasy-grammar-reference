<?php
/**
 * Database Setup - Initial Lesson Data Loader
 * 
 * This file loads the initial "Verb To Be" lesson into the database.
 * Run this once after plugin activation.
 */

if (!defined('ABSPATH')) {
    exit;
}

function segrammar_load_initial_lessons() {
    $lessons = array(
        array(
            'title' => 'Verb To Be',
            'slug' => 'verb-to-be',
            'level' => 'A1',
            'category' => 'Fundamentals',
            'content' => json_encode(array(
                'italian_explanation' => '<p><strong>Il verbo "To Be"</strong> è il verbo più importante della lingua inglese. Significa "essere" o "stare" in italiano.</p>
<p>Viene utilizzato per:</p>
<ul>
<li>Descrivere chi siamo (I am a student = Sono uno studente)</li>
<li>Descrivere come ci sentiamo (I am happy = Sono felice)</li>
<li>Descrivere dove siamo (I am at home = Sono a casa)</li>
<li>Descrivere l\'età (I am 25 years old = Ho 25 anni)</li>
<li>Descrivere la professione (I am a teacher = Sono un insegnante)</li>
</ul>
<p>"To Be" è un verbo irregolare e ha forme diverse per ogni persona.</p>',
                'grammar_table' => '<table>
<thead>
<tr>
<th>Pronome</th>
<th>Present Simple</th>
<th>Traduzione Italiana</th>
<th>Forma Contratta</th>
</tr>
</thead>
<tbody>
<tr>
<td>I</td>
<td>am</td>
<td>sono</td>
<td>I\'m</td>
</tr>
<tr>
<td>You</td>
<td>are</td>
<td>sei</td>
<td>You\'re</td>
</tr>
<tr>
<td>He / She / It</td>
<td>is</td>
<td>è</td>
<td>He\'s / She\'s / It\'s</td>
</tr>
<tr>
<td>We</td>
<td>are</td>
<td>siamo</td>
<td>We\'re</td>
</tr>
<tr>
<td>You (pl.)</td>
<td>are</td>
<td>siete</td>
<td>You\'re</td>
</tr>
<tr>
<td>They</td>
<td>are</td>
<td>sono</td>
<td>They\'re</td>
</tr>
</tbody>
</table>',
                'examples' => array(
                    'I am a student.',
                    'She is from Italy.',
                    'We are happy.',
                    'They are doctors.',
                    'He is 30 years old.',
                    'It is a beautiful day.',
                    'You are my friend.',
                    'I am at the supermarket.',
                    'She is in the garden.',
                    'We are ready for the exam.'
                ),
                'italian_translations' => array(
                    'Sono uno studente.',
                    'Lei è dall\'Italia.',
                    'Siamo felici.',
                    'Loro sono medici.',
                    'Lui ha 30 anni.',
                    'È una bella giornata.',
                    'Tu sei il mio amico.',
                    'Sono al supermercato.',
                    'Lei è in giardino.',
                    'Siamo pronti per l\'esame.'
                ),
                'common_mistakes' => '<h3>Errore 1: Dimenticare il verbo "To Be"</h3>
<p><strong>Sbagliato:</strong> "I a student" (Sono uno studente)<br/>
<strong>Corretto:</strong> "I am a student"</p>
<p>In inglese il verbo è sempre necessario. In italiano a volte lo omettiamo, ma in inglese mai!</p>
<hr/>
<h3>Errore 2: Confondere "your" con "you\'re"</h3>
<p><strong>Sbagliato:</strong> "Your am happy"<br/>
<strong>Corretto:</strong> "You\'re happy"</p>
<p>"Your" è un aggettivo possessivo, "you\'re" è la contrazione di "you are"</p>
<hr/>
<h3>Errore 3: Usare la forma sbagliata</h3>
<p><strong>Sbagliato:</strong> "He are happy"<br/>
<strong>Corretto:</strong> "He is happy"</p>
<p>Con "He", "She" e "It" usiamo sempre "is", non "are"</p>
<hr/>
<h3>Errore 4: Confondere "am", "is", "are"</h3>
<p><strong>Ricorda:</strong> "I am", "He/She/It is", "You/We/They are"</p>'
            )),
            'keywords' => 'verb, be, am, is, are, essere, stare, presente',
            'related_topics' => json_encode(array(
                'Subject Pronouns',
                'Present Simple',
                'Possessive Adjectives'
            ))
        )
    );

    foreach ($lessons as $lesson) {
        // Check if lesson already exists
        $existing = SpeakEasyGrammar_Database::get_lesson_by_slug($lesson['slug']);
        
        if (!$existing) {
            SpeakEasyGrammar_Database::insert_lesson($lesson);
        }
    }
}

// Run on plugin activation
register_activation_hook(SEGRAMMAR_PLUGIN_DIR . 'speakeasy-grammar-reference.php', 'segrammar_load_initial_lessons');
