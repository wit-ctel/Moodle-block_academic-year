<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * course_overview block rendrer
 *
 * @package    block_academic_year
 * @copyright  2013 Cathal O'Riordan, WIT <caoriordan@wit.ie>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die;

/**
 * Academic year block rendrer
 *
 * @copyright  2013 Cathal O'Riordan, WIT <caoriordan@wit.ie>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_academic_year_renderer extends plugin_renderer_base {
    
    /**
     * Construct contents of academic_year block
     *
     * @param array $years list of available years in sorted order
     * @return string html to be displayed in academic year block
     */
    public function academic_year($years) {
        global $CFG, $SESSION;
        
        $current_academic_year_id = isset($SESSION->academic_year_id) ? $SESSION->academic_year_id : $CFG->academic_year_id;
        
        foreach ($years as $year) {
            $years[$year->id] = $year->title;
        }
        
        $html = '';
        
        $html .= html_writer::start_tag('div', array('id' => 'academic_year'));
        
        $html .= html_writer::tag('h3', get_string('selectacademicyear', 'block_academic_year'), array('class' => 'label'));
        
        $html .= $this->output->single_select(new moodle_url($CFG->wwwroot.'/blocks/academic_year/year.php'), 
                                                'academicyear', 
                                                $years,
                                                $current_academic_year_id,
                                                '');
        
        $html .= html_writer::end_tag('div'); // academic_year
        return $html;
    }
    
}