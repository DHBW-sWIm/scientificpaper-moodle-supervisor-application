<?php
require_once("$CFG->libdir/formslib.php");

class start_form extends moodleform {
    //Add elements to form
    public function definition() {
        global $CFG;

        $mform = $this->_form; // Don't forget the underscore!

        $mform->addElement('header', 'header', 'Implemented UI Elements:');

        $mform->addElement('text', 'email', 'Enter your Email'); // Add elements to your form
        $mform->setType('email', PARAM_NOTAGS);                   //Set type of element
        //$mform->setDefault('email', '');     //Default value

        $mform->addElement('text', 'name', 'Enter your Name');
        $mform->setType('name', PARAM_NOTAGS);
        //$mform->setDefault('name', '');

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        $mform->addElement('submit', 'btnSubmit', 'Submit');

        //THE FOLLOWING UI ELEMENTS ARE FOR COPY&PASTE

        $mform->addElement('header', 'header', 'Copy&Paste UI Elements:');

        $mform->addElement('static', 'label0', 'Label', 'Checkout: https://docs.moodle.org/dev/lib/formslib.php_Form_Definition');

        //Label
        $mform->addElement('static', 'label1', 'Label', 'Label');
        //Textfield
        $mform->addElement('text', 'text1', 'Textfield');
        //Button
        $mform->addElement('button', 'intro', 'Button');
        $mform->addElement('submit', 'button1', 'Submit-Button');
        //Checkbox
        $mform->addElement('checkbox', 'checkbox', 'Checkbox');
        //Filepicker
        $maxbytes = 10000000000;
        $mform->addElement('filepicker', 'userfile', 'File', null, array('maxbytes' => $maxbytes, 'accepted_types' => '*'));
        //Date
        $mform->addElement('date_selector', 'date', 'Datum');
        //Hidden
        $mform->addElement('hidden', 'hidden', 'hidden');
        //HTML
        $mform->addElement('html', '<div class="qheader">');
        //Password
        $mform->addElement('passwordunmask', 'password', 'Password');
        //Radio
        $radioarray = array();
        $radioarray[] = $mform->createElement('radio', 'yesno', '', 'Yes', 1);
        $radioarray[] = $mform->createElement('radio', 'yesno', '', 'no', 0);
        $mform->addGroup($radioarray, 'Radio', '', array(' '), false);
        //Selekt
        $mform->addElement('select', 'select', 'Selekt', array('red', 'blue', 'green'));
        //Multiselekt
        $select = $mform->addElement('select', 'multiselekt', 'Multiselekt', array('red', 'blue', 'green'));
        $select->setMultiple(true);

    }

    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }
}
