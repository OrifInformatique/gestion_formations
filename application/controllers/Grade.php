<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Admin controller
 *
 * @author      Orif, section informatique (UlSi, ViDi, BuYa, MeSa)
 * @link        https://github.com/OrifInformatique/gestion_formations
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */

class Grade extends MY_Controller {
	protected $access_level = "*";

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model(['apprentice_formation_model','module_subject_model','grade_model']);
        $this->load->helper(['form', 'url']);
    }

    /**
     * Displays the list of grades in an apprentice's formation
     *
     * @param integer $id
     *      The id of the apprentice's formation
     */
    public function list($id) {
        $outputs = $this->get_parents($id);

        $this->display_view('grade/list', $outputs);
    }

    /**
     * Adds a grade to a module.
     *
     * @param integer $app_for_id
     *      The apprentice formation link id
     * @param integer $mod_id
     *      The module/subject id
     */
    public function add_to_module($app_for_id, $mod_id) {
        $app_for = $this->apprentice_formation_model->get($app_for_id);
        if(is_null($app_for)) {
            redirect('apprentice');
        }
        $module = $this->module_subject_model->get($mod_id);
        if(is_null($module)) {
            redirect('grade/list/'.$app_for_id);
        }

        $outputs['module'] = $module;
        $outputs['apprentice_formation'] = $app_for;

        $this->display_view('grade/add', $outputs);
    }

    /**
     * Allows edition of a grade.
     *
     * @param integer $id
     *      The grade to edit
     */
    public function edit_grade($id) {
        $grade = $this->grade_model->get($id);
        $app_for = $this->apprentice_formation_model->get($grade->fk_apprentice_formation);
        if(is_null($grade) || is_null($app_for)) {
            redirect('apprentice');
        }

        $module = $this->module_subject_model->get($grade->fk_module_subject);
        if(is_null($module)) {
            redirect('grade/list/'.$grade->fk_apprentice_formation);
        }

        $outputs['grade'] = $grade;
        $outputs['apprentice_formation'] = $app_for;
        $outputs['module'] = $module;

        $this->display_view('grade/add', $outputs);
    }

    /**
     * Validates the inputs and updates/adds the entry to the database
     */
    public function grade_validation() {
        $grade_id = $this->input->post('grade_id');
        $app_for_id = $this->input->post('app_for_id');
        $mod_id = $this->input->post('mod_id');
        $update = FALSE;
        $redirect = 'apprentice';

        if(is_null($app_for_id) && is_null($mod_id)) {
            redirect('apprentice');
        } else {
            $redirect = 'grade/add_to_module/'.$app_for_id.'/'.$mod_id;
        }
        if(!is_null($grade_id)) {
            if(is_null($this->grade_model->get($grade_id))) {
                redirect('apprentice');
            }

            $redirect = 'grade/edit_grade/'.$grade_id;
            $update = TRUE;
        }

        $this->form_validation->set_rules('grade_grade', $this->lang->line('grade_grade'), 'required|greater_than[-0.1]|less_than[6.1]|numeric');
        $this->form_validation->set_rules('grade_date_test', $this->lang->line('grade_date_test'), 'required|callback_cb_check_if_past');
        $this->form_validation->set_rules('grade_date_inscription', $this->lang->line('grade_date_inscription'), array(
            'required',
            'callback_cb_check_if_past',
            'callback_cb_comp_dates['.$this->input->post('grade_date_test').']'
        ));
        $this->form_validation->set_rules('grade_weight', $this->lang->line('grade_weight'), 'required|greater_than[0]|integer');
        $this->form_validation->set_rules('grade_semester', $this->lang->line('grade_semester'), 'required|greater_than[0]|integer|callback_cb_semester_before_end['.$app_for_id.']');

        $req = array(
            "grade" => $this->input->post('grade_grade'),
            "fk_apprentice_formation" => $app_for_id,
            "fk_module_subject" => $mod_id,
            "date_test" => $this->input->post('grade_date_test'),
            "date_inscription" => $this->input->post('grade_date_inscription'),
            "weight" => $this->input->post('grade_weight'),
            "semester" => $this->input->post('grade_semester')
        );

        if($this->form_validation->run()) {
            if($update) {
                $this->grade_model->update($grade_id, $req);
            } else {
                $this->grade_model->insert($req);
            }
            redirect('grade/list/'.$app_for_id);
        } else {
            redirect($redirect);
        }
    }

    /**
     * Displays a list of grades to delete.
     *
     * @param integer $app_for_id
     *      The apprentice formation link id
     * @param integer $mod_id
     *      The module/subject id
     */
    public function remove_from_module($app_for_id, $mod_id) {
        $app_for = $this->apprentice_formation_model->get($app_for_id);
        $module = $this->module_subject_model->get($mod_id);
        if(is_null($app_for) || is_null($module)) {
            redirect('apprentice');
        }
        $outputs['apprentice_formation'] = $app_for;
        $outputs['module'] = $module;
        $outputs['grades'] = $this->grade_model->get_many_by('fk_module_subject='.$mod_id.' AND fk_apprentice_formation='.$app_for_id);
        if(sizeof($outputs['grades']) == 0) {
            redirect('grade/list/'.$app_for_id);
        }

        $this->display_view('grade/deletelist', $outputs);
    }

    /**
     * Allows deleting a grade.
     *
     * @param integer $id
     *      The id of the grade to remove
     * @param integer $command
     *      Whether a confirmation prompt should be displayed or the grade should be deleted
     */
    public function delete_grade($id, $command = 0) {
        $grade = $this->grade_model->get($id);
        if(is_null($grade)) {
            redirect('apprentice');
        }
        $app_for = $this->apprentice_formation_model->get($grade->fk_apprentice_formation);
        $module = $this->module_subject_model->get($grade->fk_module_subject);
        if(is_null($app_for) || is_null($module)) {
            redirect('apprentice');
        }

        $outputs['apprentice_formation'] = $app_for;
        $outputs['module'] = $module;

        switch ($command) {
            case 0:
                $outputs['grade'] = $grade;
                $this->display_view('grade/delete', $outputs);
                break;
            case 1:
                $this->grade_model->delete($id);
                //$this->display_view('grade/success', $outputs);
                //break;
            default:
                redirect('grade/remove_from_module/'.$app_for->id.'/'.$module->id);
        }
    }

    /**
     * Displays the calculations for the median
     *
     * @param integer $app_for_id
     *      The apprentice formation link id
     * @param integer $mod_id
     *      The module/subject id
     */
    public function get_median($app_for_id, $mod_id) {
        $this->load->model('formation_model');
        // Make sure that everything is valid
        $app_for = $this->apprentice_formation_model->get($app_for_id);
        if(is_null($app_for)) {
            redirect('apprentice');
        }
        $module = $this->module_subject_model->get($mod_id);
        if(is_null($app_for)) {
            redirect('grade/list/'.$app_for_id);
        }
        $outputs['apprentice_formation'] = $app_for;
        $outputs['module'] = $module;

        // Prepare the grades
        $grades = $this->grade_model->order_by('semester')->get_many_by('fk_module_subject='.$module->id);
        $outputs['grades'] = array();

        // Calculate semesters based on the amount of years
        $semesters = ($this->formation_model->get($app_for->fk_formation))->duration*2;
        $outputs['semesters'] = $semesters;
        for($i = 1; $i <= $semesters; $i++) {
            $total = 0;
            $count = 0;
            $grades = $this->grade_model->get_many_by('fk_module_subject='.$module->id.' AND semester='.$i);
            foreach($grades as $grade) {
                $total += $grade->grade * $grade->weight;
                $count += $grade->weight;
            }
            $outputs['grades'][$i] = $grades;
            $outputs['medians'][$i] = ($total == 0 ? '' : round($total/$count,1));
        }
        // Calculate median of medians
        $total = 0;
        $count = 0;
        foreach($outputs['medians'] as $median) {
            if(!empty($median)) {
                $total += $median;
                $count++;
            }
        }
        $outputs['medians'][0] = ($total == 0 ? '' : round($total/$count,1));

        $this->display_view('grade/median', $outputs);
    }

    /**
     * Checks if the date entered is in the past.
     *
     * Used as a callback in form_validation()
     * because adding 4 lines is not really pretty.
     *
     * @param string $date_in
     *      The date to check
     * @return boolean
     *      TRUE if the date is in the past
     */
    public function cb_check_if_past($date_in) {
        return (strtotime(date("d-m-Y")) >= strtotime($date_in));
    }

    /**
     * Checks if the first date is before the 2nd one.
     *
     * @param string $date_last
     *      The 2nd date
     * @param string $date_first
     *      The first date
     * @return boolean
     *      Whether $date_first is before $date_last
     */
    public function cb_comp_dates($date_last, $date_first) {
        return (strtotime($date_first) <= strtotime($date_last));
    }

    /**
     * Checks that the semester for the grade is during the formation
     *
     * @param integer $grade_semester
     *      The semester the grade was made during
     * @param integer $app_for_id
     *      The apprentice formation id
     * @return boolean
     *      Whether the grade happened during the formation
     */
    public function cb_semester_before_end($grade_semester, $app_for_id) {
        $this->load->model('formation_model');
        $app_for = $this->apprentice_formation_model->get($app_for_id);
        $formation = $this->formation_model->get($app_for->fk_formation);
        $max_semester = $formation->duration;
        return $grade_semester <= $max_semester;
    }

    /**
     * Obtains all the data you may need.
     *
     * @param integer $app_for_id
     *      The apprentice_formation id
     * @return array
     *      An array of all the items
     */
    private function get_parents($app_for_id) {
        $this->load->model(['formation_module_group_model','module_group_model','formation_model']);
        $app_for = $this->apprentice_formation_model->get($app_for_id);
        if(is_null($app_for)) {
            redirect('apprentice');
        }

        // Prepare the different variables that may be modified / empty at return
        $results = array();
        $results['group_medians'] = array();
        $results['medians'] = array();
        $results['groups'] = array();
        $modules_groups_g = array();
        $medians_g = array();
        // Get all linked groups
        $groups = $this->formation_module_group_model->order_by('name_group')->get_many_by('fk_formation='.$app_for->fk_formation);

        // Get each group's linked modules
        foreach($groups as $group) {
            // Prepare all the groups for the result
            $results['groups'][$group->id] = $group;
            // Get all the linked modules_groups
            $modules_groups_g[$group->id] = $this->module_group_model->get_many_by('fk_formation_modules_group='.$group->id);
        }
        foreach($modules_groups_g as $modules_groups) {
            foreach($modules_groups as $module_group) {
                $module = $this->module_subject_model->get($module_group->fk_module);
                // Put it in the 'modules' result and sort by group
                $results['modules'][$module_group->fk_formation_modules_group][$module->id] = $module;

                $grades = $this->grade_model->get_many_by('fk_module_subject='.$module->id);
                // Put it in the 'grades' result and sort by module
                // It's easier for displaying, as a module can be twice in the same formation
                // It shouldn't be, but it can still be
                $results['grades'][$module->id] = $grades;

                // Calculate medians and save them with the module
                $medians = array();
                $semesters = ($this->formation_model->get($app_for->fk_formation))->duration*2;
                for($i = 1; $i <= $semesters; $i++) {
                    $total = 0;
                    $count = 0;
                    $grades = $this->grade_model->get_many_by('fk_module_subject='.$module->id.' AND semester='.$i);
                    foreach($grades as $grade) {
                        $total += $grade->grade * $grade->weight;
                        $count += $grade->weight;
                    }
                    $medians[$i] = ($count > 0 ? $total/$count : 0);
                }
                // Calculate final module median
                $total = 0;
                $count = 0;
                foreach($medians as $median) {
                    if($median == 0) continue;
                    $total += $median;
                    $count ++;
                }
                if($count > 0) {
                    $median = round($total / $count, 1);
                    $results['medians'][$module->id] = $median;
                    $medians_g[$module_group->fk_formation_modules_group][$module->id] = $median;
                } else {
                    $results['medians'][$module->id] = '';
                }
            }
            // Sort modules by number, to make the list more pleasing to the eye
            usort($results['modules'][$module_group->fk_formation_modules_group], function($a, $b) {
                return $a->number <=> $b->number;
            });
        }
        // Calculate group medians
        foreach($medians_g as $medians) {
            $index = array_search($medians, $medians_g);
            $total = 0;
            $count = 0;
            foreach($medians as $median) {
                if(empty($median)) continue;
                $total += $median;
                $count++;
            }
            $results['group_medians'][$index] = ($count > 0 ? round($total / $count, 1) : '');
        }
        // Calculate final median
        $total = 0;
        $count = 0;
        foreach($results['group_medians'] as $median) {
            if(empty($median)) continue;
            $group_id = array_search($median, $results['group_medians']);
            $group = $this->formation_module_group_model->get($group_id);
            $total += $median * $group->weight;
            $count += $group->weight;
        }
        $results['final_median'] = ($count > 0 ? round($total / $count, 1) : '');

        $results['apprentice_formation'] = $app_for;

        return $results;
    }
}