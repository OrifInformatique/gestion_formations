<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Authentication controller
 *
 * @author      Orif, section informatique (UlSi, ViDi, BuYa)
 * @link        https://github.com/OrifInformatique/gestion_formations
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */

class Apprentice extends MY_Controller {
    /* MY_Controller variables definition */
    protected $access_level = "*";

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('apprentice_model');
        $this->load->helper(['form', 'url']);
    }

    /**
     * Shows the list of apprentices
     */
    public function index() {
        $this->load->model(['formation_model','auth/user_model']);
        $outputs = array(
            "teachers" => $this->get_parents(),
            "apprentices" => $this->apprentice_model->with("C_App_Form")->get_ordered(),
            "formations" => array(),
            "users" => $this->user_model->dropdown('user')
        );
        $formations = $this->formation_model->get_all();
        foreach($formations as $formation) {
            $outputs['formations'][$formation->id] = $formation;
        }
        $this->display_view("apprentice/list", $outputs);
    }

    /**
     * Shows the form to create / modify an apprentice
     * @param integer $id
     *      The apprentice to modify (0 for new)
     */
    public function form($id = 0) {
        $this->load->model('user_model');
        $outputs = array(
            "teachers" => $this->get_parents(),
            "apprentice" => ($id > 0 ? $this->apprentice_model->get($id) : NULL),
            "users" => $this->user_model->dropdown('user'),
            'max_date' => date('Y-m-d')
        );

        $this->display_view("apprentice/form", $outputs);
    }

    /**
     * Validates the entry for a new apprentice
     */
    public function form_validation(){
        $req = array(
            'firstname' => $this->input->post('firstname'),
            'last_name' => $this->input->post('lastname'),
            'date_birth' => $this->input->post('datebirth'),
            'fk_teacher' => $this->input->post('teacher'),
            'fk_user' => $this->input->post('user')
        );

        $this->form_validation->set_rules('firstname', $this->lang->line('apprentice_firstname'),
            ['trim','required','regex_match[/^[A-Za-zÀ-ÿ0-9 \-]+$/]']);
        $this->form_validation->set_rules('lastname', $this->lang->line('apprentice_lastname'),
            'trim','required','regex_match[/^[A-Za-zÀ-ÿ0-9 \-]+$/]');
        $this->form_validation->set_rules('datebirth', $this->lang->line('apprentice_datebirth'),
            ['required','callback_cb_check_if_past']);
        $this->form_validation->set_rules('teacher', $this->lang->line('apprentice_MSP'),
            ['required']);
        $this->form_validation->set_rules('user', $this->lang->line('apprentice_user'),
            ['required']);

        if($this->form_validation->run()){
            if($this->input->post('id') > 0) {
                $this->apprentice_model->update($this->input->post('id'), $req);
            } else {
                $this->apprentice_model->insert($req);
            }
            redirect('apprentice');
        } else {
            $outputs = array(
                "teachers" => $this->get_parents(),
                "apprentice" => ($this->input->post('id') > 0 ? $this->apprentice_model->get($id) : NULL)
            );
            $this->display_view("apprentice/form", $outputs);
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
     * Deletes an apprentice
     * @param integer $id
     *      id of the apprentice to delete
     * @param integer $confirm
     *      1 to delete, 0 to ask the user, other to go back to index
     */
    public function delete($id, $confirm = 0) {
        $this->load->model('apprentice_formation_model');
        $deletion_allowed = ($app_for <= 0);

        $app_for = $this->apprentice_formation_model->count_by('fk_apprentice='.$id);
        $outputs = array(
            'apprentice' => $this->apprentice_model->get($id),
            'deletion_allowed' => $deletion_allowed
        );

        switch($confirm) {
            case 0:
                $this->display_view('apprentice/delete', $outputs);
                break;
            case 1:
                // In case the user attempts to force the deletion
                if(!$deletion_allowed) redirect('apprentice');
                $this->apprentice_model->delete($id);
                $this->display_view('apprentice/success');
                break;
            default:
                redirect('apprentice');
        }
    }

    /**
     * Displays the list of formations the apprentice has taken or is taking.
     *
     * @param integer $id
     *      The id of the apprentice.
     */
    public function apprentice_formations($id) {
        $this->load->model(['apprentice_formation_model','formation_model']);

        // Get other things
        $outputs = array(
            'linked_formations' => $this->apprentice_formation_model->get_many_by('fk_apprentice='.$id),
            'formation_in_progress' => $this->is_formation_in_progress($id),
            'id' => $id,
            'formations' => array(),
        );

        // Get all formations in an array
        $formations = $this->formation_model->get_all();
        foreach($formations as $formation) {
            $outputs['formations'][$formation->id] = $formation;
        }

        $this->display_view('apprentice/history', $outputs);
    }

    /**
     * Adds a new formation to the apprentice.
     *
     * @param integer $id
     *      The id of the apprentice to add a form to.
     */
    public function link_form($id) {
        $this->load->model('formation_model');

        $outputs = array(
            'formations' => $this->formation_model->dropdown('name_formation'),
            'id' => $id
        );

        $this->display_view('apprentice/link', $outputs);
    }

    /**
     * Allows changing a linked formation.
     *
     * @param integer $id
     *      The id of the link to edit.
     */
    public function edit_form($id) {
        $this->load->model(['formation_model','apprentice_formation_model']);

        // Make sure it is a valid formation
        $link = $this->apprentice_formation_model->get($id);
        if(is_null($link) || !isset($link) || $id == 0) {
            redirect('apprentice');
        }

        $outputs = array(
            'link' => $link,
            'formations' => $this->formation_model->dropdown('name_formation'),
            'id' => $link->fk_apprentice
        );

        $this->display_view('apprentice/link', $outputs);
    }

    /**
     * Inserts the link in the database.
     */
    public function link_form_validation() {
        $this->load->model('apprentice_formation_model');

        $this->form_validation->set_rules('formation', $this->lang->line('apprentice_formation'), ['required','numeric']);
        $this->form_validation->set_rules('date', $this->lang->line('apprentice_formation'), ['numeric']);

        // Check whether we are changing a link or making a new one
        if(!is_null($this->input->post('link_id'))) {
            $link_id = $this->input->post('link_id');
            $link = $this->apprentice_formation_model->get($link_id);
            $apprentice_id = $link->fk_apprentice;
            $update = TRUE;
        } else {
            $update = FALSE;
            $apprentice_id = $this->input->post('apprentice_id');
        }

        // Special case, this formation should not be touched
        if($this->input->post('formation') == 0) {
            redirect('apprentice/apprentice_formations/'.$apprentice_id);
        }

        if($this->form_validation->run()) {
            if(!$update) {
                // Insert new data
                $date = $this->input->post('date');
                if(empty($date)) {
                    $date = date('Y');
                }
                $ins = array(
                    'fk_formation' => $this->input->post('formation'),
                    'fk_apprentice' => $apprentice_id,
                    'year' => $date
                );
                $this->apprentice_formation_model->insert($ins);
            } else {
                // Update with new data
                $upd = array(
                    'fk_formation' => $this->input->post('formation'),
                    'fk_apprentice' => $apprentice_id,
                    'year' => $this->input->post('date'),
                );
                $this->apprentice_formation_model->update($link_id, $upd);
            }
            redirect('apprentice/apprentice_formations/'.$apprentice_id);
        } else {
            if($update)
                redirect('apprentice/edit_form/'.$link_id);
            else
                redirect('apprentice/link_form/'.$apprentice_id);
        }
    }

    /**
     * Deletes a link between a formation and an apprentice.
     *
     * @param integer $id
     *      The id of the link to delete
     * @param integer $command
     *      Whether to display or delete the link
     */
    public function unlink_form($id, $command = 0) {
        $this->load->model(['apprentice_formation_model','grade_model']);

        // Make sure that link is valid
        $link = $this->apprentice_formation_model->get($id);
        if(is_null($link) || !isset($link) || $id == 0) {
            // We can't get the apprentice id from an invalid link
            redirect('apprentice');
        }

        $grades = $this->grade_model->count_by('fk_apprentice_formation='.$id);
        $outputs = array(
            'deletion_allowed' => ($grades <= 0),
            'link' => $link
        );

        switch ($command) {
            case 0:
                // Display confirmation
                $this->display_view('apprentice/unlink', $outputs);
                break;
            case 1:
                // Confirmed, delete item
                $this->apprentice_formation_model->delete($id);
            default:
                // Back to the menu
                $apprentice_id = $link->fk_apprentice;
                redirect('apprentice/apprentice_formations/'.$apprentice_id);
        }
    }

    /**
     * Returns all teachers, in an array by id
     * @return array
     *      All teachers in an array
     */
    private function get_parents() {
        $this->load->model(['teacher_model']);

        //Puts the teacher first names, last names and their corresponding ids together
        $teachers_names = $this->teacher_model->dropdown('firstname');
        $teachers_last_names = $this->teacher_model->dropdown('last_name');
        for($i = 1; count($teachers_names) > 0 && $i < max(array_keys($teachers_names))+1; $i ++) {
            if(!isset($teachers_names[$i]) || is_null($teachers_names[$i])) {
                continue;
            }
            $teachers_names[$i] .= " ".$teachers_last_names[$i];
        }
        $teachers_names[0] = $this->lang->line('none');
        $msps_ids = $this->teacher_model->dropdown('id');
        $msps_ids[0] = 0;
        $results = array();
        foreach($msps_ids as $msp_id) {
            $results[$msp_id] = $teachers_names[$msp_id];
        }

        return $results;
    }

    /**
     * Calculates whether or not the apprentice has a formation in progress
     *
     * @param integer $id
     *      ID of the apprentice
     * @return boolean
     *      TRUE if the apprentice has a formation in progress
     */
    private function is_formation_in_progress($id) {
        $apprentice = $this->apprentice_model->with('C_App_Form')->get($id);
        $forms = $this->formation_model->get_all();
        $formations = array();
        foreach($forms as $form) {
            $formations[$form->id] = $form;
        }

        foreach($apprentice->C_App_Form as $app_form) {
            $form = $formations[$app_form->fk_formation];
            if ($app_form->year + $form->duration >= date('Y') && $app_form->year <= date('Y'))
                return TRUE;
        }
        return FALSE;
    }
}