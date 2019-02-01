<?php
require_once("$CFG->libdir/formslib.php");

class detail_form extends moodleform {
    //Add elements to form
    public function definition() {
        global $CFG;

        $mform = $this->_form; // Don't forget the underscore! 

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        //Add Save and Cancel Button
        $this->add_action_buttons(true, 'Save');

    }

    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }
}
