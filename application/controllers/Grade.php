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
        $app_for = $this->apprentice_formation_model->get($id);
        if(is_null($app_for)) {
            redirect('apprentice');
        }

        $modules = $this->module_subject_model->get_all();
        $outputs['apprentice_formation'] = $app_for;
        $outputs['modules'] = array();
        $outputs['grades'] = array();
        $outputs['averages'] = array();
        $outputs['medians'] = array();
        foreach($modules as $module) {
            $grades = $this->grade_model->get_many_by('fk_module_subject='.$module->id);
            $outputs['grades'][$module->id] = $grades;
            $outputs['modules'][$module->id] = $module;
            $total = 0;
            $count = 0;
            foreach($grades as $grade) {
                $total += $grade->grade * $grade->weight;
                $count += $grade->weight;
            }
            $outputs['medians'][$module->id] = ($total == 0 ? '': $total/$count);
        }

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
        $this->form_validation->set_rules('grade_semester', $this->lang->line('grade_semester'), 'required|greater_than[0]|integer');

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
                $this->display_view('grade/success', $outputs);
                break;
            default:
                redirect('grade/remove_from_module/'.$app_for->id.'/'.$module->id);
        }
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
}