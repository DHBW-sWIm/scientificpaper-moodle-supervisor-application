<?php

require_once(dirname(dirname(__DIR__)) . '/config.php');
require_once(__DIR__ . '/lib.php');
require_once(__DIR__ . '/locallib.php');

include(__DIR__ . '/view_init.php');

// @todo Replace the following lines with you own code.

global $SESSION;

echo $OUTPUT->heading('Your application successfully submitted!');

$table = 'spsupman_applicant';

$supervisors = $DB->get_records($table);
$table = new html_table();
$table->head = array('ID', 'Name', 'Vorname', 'Titel', 'Email', 'Fachbereich');
//Für jeden Datensatz
foreach ($supervisors as $supervisor) {
    $id = $supervisor->id;
    $name = $supervisor->lastname;
    $vorname = $supervisor->firstname;
    $titel = $supervisor->title;
    $email = $supervisor->email;
    $fachbereich = $supervisor->topictype;
    //Link zum löschen des Verantwortlichen in foreach-Schleife setzen
    //Daten zuweisen an HTML-Tabelle
    $table->data[] = array($id, $name, $vorname, $titel, $email, $fachbereich);
}
echo html_writer::table($table);

echo $OUTPUT->single_button(new moodle_url('/mod/spsupapp/view.php', array('id' => $cm->id)),
        'Zurück', $attributes = null);

// Finish the page.
echo $OUTPUT->footer();