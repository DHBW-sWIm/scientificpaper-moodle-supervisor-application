<?php

/**
 * Defines backup_spsupervisorapplication_activity_task class
 */

defined('MOODLE_INTERNAL') || die;

require_once($CFG->dirroot . '/mod/spsupervisorapplication/backup/moodle2/backup_spsupervisorapplication_stepslib.php');

/**
 * Provides the steps to perform one complete backup of the spsupervisorapplication instance
 *
 * @package   mod_spsupervisorapplication
 * @category  backup
 * @copyright 2016 Your Name <your@email.address>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class backup_spsupervisorapplication_activity_task extends backup_activity_task {

    /**
     * No specific settings for this activity
     */
    protected function define_my_settings() {
    }

    /**
     * Defines a backup step to store the instance data in the spsupervisorapplication.xml file
     */
    protected function define_my_steps() {
        $this->add_step(new backup_spsupervisorapplication_activity_structure_step('spsupervisorapplication_structure', 'spsupervisorapplication.xml'));
    }

    /**
     * Encodes URLs to the index.php and view.php scripts
     *
     * @param string $content some HTML text that eventually contains URLs to the activity instance scripts
     * @return string the content with the URLs encoded
     */
    static public function encode_content_links($content) {
        global $CFG;

        $base = preg_quote($CFG->wwwroot, '/');

        // Link to the list of spsupervisorapplications.
        $search = '/(' . $base . '\/mod\/spsupervisorapplication\/index.php\?id\=)([0-9]+)/';
        $content = preg_replace($search, '$@spsupervisorapplicationINDEX*$2@$', $content);

        // Link to spsupervisorapplication view by moduleid.
        $search = '/(' . $base . '\/mod\/spsupervisorapplication\/view.php\?id\=)([0-9]+)/';
        $content = preg_replace($search, '$@spsupervisorapplicationVIEWBYID*$2@$', $content);

        return $content;
    }
}
