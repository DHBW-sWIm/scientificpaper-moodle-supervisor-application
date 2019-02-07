<?php

// DO NOT TOUCH THIS FILE

$id = optional_param('id', 0, PARAM_INT); // Course_module ID, or
$n = optional_param('n', 0, PARAM_INT);  // ... spsupapp instance ID - it should be named as the first character of the module.

if ($id) {
    $cm = get_coursemodule_from_id('spsupapp', $id, 0, false, MUST_EXIST);
    $course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
    $spsupapp = $DB->get_record('spsupapp', array('id' => $cm->instance), '*', MUST_EXIST);
} else if ($n) {
    $spsupapp = $DB->get_record('spsupapp', array('id' => $n), '*', MUST_EXIST);
    $course = $DB->get_record('course', array('id' => $spsupapp->course), '*', MUST_EXIST);
    $cm = get_coursemodule_from_instance('spsupapp', $spsupapp->id, $course->id, false, MUST_EXIST);
} else {
    error('You must specify a course_module ID or an instance ID');
}

require_login($course, true, $cm);

$event = \mod_spsupapp\event\course_module_viewed::create(array(
        'objectid' => $PAGE->cm->instance,
        'context' => $PAGE->context,
));
$event->add_record_snapshot('course', $PAGE->course);
$event->add_record_snapshot($PAGE->cm->modname, $spsupapp);
$event->trigger();

// Print the page header.

$PAGE->set_url('/mod/spsupapp/view.php', array('id' => $cm->id));
$PAGE->set_title(format_string($spsupapp->name));
$PAGE->set_heading(format_string($course->fullname));

// Output starts here.
echo $OUTPUT->header();

// Conditions to show the intro can change to look for own settings or whatever.
if ($spsupapp->intro) {
    echo $OUTPUT->box(format_module_intro('spsupapp', $spsupapp, $cm->id), 'generalbox mod_introbox', 'spsupappintro');
}
