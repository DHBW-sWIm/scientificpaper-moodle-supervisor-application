<?php
require_once("$CFG->libdir/formslib.php");

/**
 * Created by PhpStorm.
 * User: Kevin Schroeteler
 * Date: 01.02.2019
 * Time: 18:47
 */
class application_form extends moodleform {

    public function definition() {
        global $CFG;

        $mform = $this->_form; // Don't forget the underscore!

        #Start of the Supervisor Promotion Form
        $mform->addElement('header', 'header1', 'Allgemeines');
        #NAME
        $mform->addElement('text', 'lastname', 'Name'); // Add elements to your form
        $mform->setType('lastname', PARAM_NOTAGS);                   //Set type of element
        $mform->disabledIf('lastname', 'checkbox_edit', 'notchecked');
        #VORNAME
        $mform->addElement('text', 'firstname', 'Vorname'); // Add elements to your form
        $mform->setType('firstname', PARAM_NOTAGS);                   //Set type of element
        $mform->disabledIf('firstname', 'checkbox_edit', 'notchecked');
        #TITEL
        $mform->addElement('text', 'title', 'Titel'); // Add elements to your form
        $mform->setType('title', PARAM_NOTAGS);                   //Set type of element
        $mform->disabledIf('title', 'checkbox_edit', 'notchecked');
        #GESCHLECHT
        $mform->addElement('select', 'gender', 'Geschlecht', array('männlich', 'weiblich', 'divers'));
        $mform->disabledIf('gender', 'checkbox_edit', 'notchecked');
        #GEBURTSDATUM
        $mform->addElement('date_selector', 'birthdate', 'Geburtsdatum');
        $mform->disabledIf('birthdate', 'checkbox_edit', 'notchecked');
        #space ---------------------------------------------------------------------------------
        $mform->addElement('static', 'label1', ' ', ' ');
        #SPRACHEN
        $mform->addElement('text', 'languages', 'Sprachen'); // Add elements to your form
        $mform->setType('languages', PARAM_NOTAGS);                   //Set type of element
        $mform->disabledIf('language', 'checkbox_edit', 'notchecked');
        #space ---------------------------------------------------------------------------------
        $mform->addElement('static', 'label1', ' ', ' ');
        #FIRMA
        $mform->addElement('text', 'company', 'Unternehmen'); // Add elements to your form
        $mform->setType('company', PARAM_NOTAGS);                   //Set type of element
        $mform->disabledIf('company', 'checkbox_edit', 'notchecked');
        $mform->addElement('header', 'header2', 'Kontakt');
        #STRASSE / HAUSNUMMER
        $mform->addElement('text', 'address', 'Strasse'); // Add elements to your form
        $mform->setType('address', PARAM_NOTAGS);                   //Set type of element
        $mform->disabledIf('address', 'checkbox_edit', 'notchecked');
        $mform->addElement('static', 'label1', ' ', ' ');
        #ORT
        $mform->addElement('text', 'city', 'Ort'); // Add elements to your form
        $mform->setType('city', PARAM_NOTAGS);                   //Set type of element
        $mform->disabledIf('city', 'checkbox_edit', 'notchecked');
        #PLZ
        $mform->addElement('text', 'postalcode', 'PLZ'); // Add elements to your form
        $mform->setType('postalcode', PARAM_NOTAGS);                   //Set type of element
        $mform->disabledIf('postalcode', 'checkbox_edit', 'notchecked');
        #TELEFON
        $mform->addElement('text', 'phone', 'Telefon'); // Add elements to your form
        $mform->setType('phone', PARAM_NOTAGS);                   //Set type of element
        $mform->disabledIf('phone', 'checkbox_edit', 'notchecked');
        #EMAIL
        $mform->addElement('text', 'email', 'Email'); // Add elements to your form
        $mform->setType('email', PARAM_NOTAGS);                   //Set type of element
        $mform->disabledIf('email', 'checkbox_edit', 'notchecked');
        #space ---------------------------------------------------------------------------------

        $mform->addElement('header', 'header5', 'Bankdaten');
        #IBAN
        $mform->addElement('text', 'iban', 'IBAN'); // Add elements to your form
        $mform->setType('iban', PARAM_NOTAGS);                   //Set type of element
        $mform->disabledIf('iban', 'checkbox_edit', 'notchecked');

        #space ---------------------------------------------------------------------------------
        $mform->addElement('header', 'header3', 'Qualifikation');
        #AUSBILDUNG / STUDIUM
        //fehlt noch in der Datenbank
        $mform->addElement('text', 'studium', 'Studium'); // Add elements to your form
        $mform->setType('studium', PARAM_NOTAGS);                   //Set type of element
        $mform->disabledIf('studium', 'checkbox_edit', 'notchecked');
        #FACHGEBIETE
        $mform->addElement('text', 'specialisation', 'Fachgebiete'); // Add elements to your form
        $mform->setType('specialisation', PARAM_NOTAGS);                   //Set type of element
        $mform->disabledIf('specialisation', 'checkbox_edit', 'notchecked');
        #space ---------------------------------------------------------------------------------
        $mform->addElement('static', 'label1', ' ', ' ');

        #BETREUUNG VON
        $mform->addElement('static', 'label1', 'Betreuung von*', 'Bitte wählen Sie die Themenbereiche, die Sie betreuen möchten:');

        $mform->addElement('checkbox', 'checkbox_BWL', 'BWL');
        $mform->addElement('checkbox', 'checkbox_IT', 'IT');
        $mform->addElement('checkbox', 'checkbox_WI', 'Wirtschaftsinformatik');

        #BETREUUNG BACHELORARBEIT
        $mform->addElement('static', 'label_bachelor', 'Bachelorarbeit*',
                'Sie stellen sich als Wissenschaftlicher Betreuer für Bachelorarbeiten zur Verfügung:');

        $mform->addElement('checkbox', 'checkbox_bachelor',
                'Ja     (Muss Dr. oder Proffesoren Titel führen oder zum Lehrkörper der DHBW Mannheim gehören)');

        #BETREUUNGSZEITRAUM
        $mform->addElement('select', 'supportperiod', 'Bewertungszeitraum*',
                array('Early: May - Aug', 'Late: Aug - Oct', 'Full Year: May - Oct'));

        #MAX ANZAHL JAHR
        $mform->addElement('select', 'max_year', 'Max Anzahl Arbeiten pro Jahr*',
                array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'));

        #MAX ANZAHL ZEITGLEICH
        $mform->addElement('select', 'max_attime', 'Max Anzahl Arbeiten zeitgleich*',
                array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'));

        #space ---------------------------------------------------------------------------------
        $mform->addElement('static', 'label1', ' ', ' ');

        #STUDIENGANGSLEITER
        $mform->addElement('static', 'label_who', 'Studiengangsleiter*',
                'Bitte geben sie an, unter welchem Studiengangsleiter Sie wissenschaftliche Arbeiten betreuen möchten:');

        $mform->addElement('checkbox', 'checkbox_all_supervisors', 'Gesamter Studiengang Wirtschaftsinformatik');

        $mform->addElement('checkbox', 'checkbox_martin', 'Prof. Dr. Martin');
        $mform->addElement('checkbox', 'checkbox_koslowski', 'Prof. Dr. Koslowski');
        $mform->addElement('checkbox', 'checkbox_wolff', 'Prof. Dr. Wolff');
        $mform->addElement('checkbox', 'checkbox_reichwald', 'Prof. Dr. Reichwald');
        $mform->addElement('checkbox', 'checkbox_pfisterer', 'Prof. Dr. Pfisterer');
        $mform->addElement('checkbox', 'checkbox_engel', 'Prof. Dr. Engel');
        $mform->addElement('checkbox', 'checkbox_drabant', 'Prof. Dr. Drabant');
        $mform->addElement('checkbox', 'checkbox_holey', 'Prof. Dr. Holey');

        #space ---------------------------------------------------------------------------------
        $mform->addElement('static', 'label1', ' ', ' ');

        #space ---------------------------------------------------------------------------------
        $mform->addElement('static', 'label1', ' ', ' ');

        #ERINVERSTAENDNIS
        $mform->addElement('checkbox', 'checkbox_dsgvo',
                'Hiermit erkläre ich mich damit einverstanden, dass die von mir angegebenen personenbezogenen Daten durch die DHBW MANNHEIM gespeichert, verarbeitet und genutzt werden können.');

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        #Abschicken
        $mform->addElement('submit', 'btnSubmit', 'Anmeldung abschicken');
        $mform->disabledIf('btnSubmit', 'checkbox_dsgvo', 'notchecked');

        //End of Form

    }

}
