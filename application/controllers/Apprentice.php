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

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('apprentice_model');
        $this->load->helper(['form', 'url']);
    }

    /**
     * Shows the list of apprentices
     */
    public function index() {
        $outputs = $this->get_parents();
        $outputs["apprentices"] = $this->apprentice_model->get_ordered();
        $this->display_view("apprentice/list", $outputs);
    }

    /**
     * Shows the form to create / modify an apprentice
     * @param integer $id
     *      The apprentice to modify (0 for new)
     * @param integer $error
     *      Unused in form.php
     */
    public function form($id = 0) {
        $outputs = $this->get_parents();

        if($id > 0) {
            $outputs["apprentice"] = $this->apprentice_model->get($id);
        }

        $this->display_view("apprentice/form", $outputs);
    }

    /**
     * Validates the entry for a new apprentice
     * @param integer $error
     *      Unused in the function and in form.php
     */
    public function form_validation(){
        $req = array(
            'firstname' => $this->input->post('firstname'),
            'last_name' => $this->input->post('lastname'),
            'date_birth' => $this->input->post('datebirth'),
            'fk_formation' => $this->input->post('formation'),
            'fk_teacher' => $this->input->post('teacher'),
            'fk_user' => $this->input->post('user')
        );

        //Verification that the date is not in the future
        $current_date = strtotime(date("d-m-Y"));
        $input_date = strtotime($req["date_birth"]);
        $problem = ($current_date >= $input_date);

        $this->form_validation->set_rules('firstname', $this->lang->line('apprentice_firstname'), 'trim|required|regex_match[/[A-Za-zÀ-ÿ0-9 \-]+/]');
        $this->form_validation->set_rules('lastname', $this->lang->line('apprentice_lastname'), 'trim|required|regex_match[/[A-Za-zÀ-ÿ0-9 \-]+/]');
        $this->form_validation->set_rules('datebirth', $this->lang->line('apprentice_datebirth'), array('required', function() {return $problem;}));
        $this->form_validation->set_rules('formation', $this->lang->line('apprentice_formation'), 'required');
        $this->form_validation->set_rules('teacher', $this->lang->line('apprentice_MSP'), 'required');
        $this->form_validation->set_rules('user', $this->lang->line('apprentice_user'), 'required');

        $req = html_escape($req);

        if($this->form_validation->run()){
            if($this->input->post('id') > 0) {
                $this->apprentice_model->update($this->input->post('id'), $req);
            } else {
                $this->apprentice_model->insert($req);
            }
            redirect('apprentice');
        } else {
            redirect('apprentice/form/'.$this->input->post('id'));
            //$this->display_view('apprentice/form/'.$this->input->post('id'));
        }
    }

    /**
     * Deletes an apprentice
     * @param integer $id
     *      id of the apprentice to delete
     * @param integer $confirm
     *      1 to delete, 0 to ask the user, other to go back to index
     */
    public function delete($id, $confirm = 0) {
        $outputs['apprentice'] = $this->apprentice_model->get($id);
        if($confirm == 1) {
            $this->apprentice_model->delete($id);
            $this->display_view('apprentice/success');
        } elseif ($confirm == 0) {
            $this->display_view('apprentice/delete', $outputs);
        } else {
            redirect('group');
        }
    }

    /**
     * Returns all formations, teachers and users
     * @return array
     *      All formations, teachers and users in an array
     */
    private function get_parents() {
        $this->load->model(['formation_model','teacher_model','user_model']);

        //Puts the formations names and their corresponding ids together
        $formation_names = $this->formation_model->dropdown('Name_Formation');
        $formation_names[0] = $this->lang->line('none_f');
        $formation_ids = $this->formation_model->dropdown('id');
        $formation_ids[0] = 0;
        $results["formations"] = $this->link_arrays($formation_ids, $formation_names);

        //Puts the teacher first names, last names and their corresponding ids together
        $teachers_names = $this->teacher_model->dropdown('firstname');
        $teachers_last_names = $this->teacher_model->dropdown('last_name');
        for($i = 1; $i < max(array_keys($teachers_names))+1; $i ++) {
            if(!isset($teachers_names[$i]) || is_null($teachers_names[$i])) {
                continue;
            }
            $teachers_names[$i] .= " ".$teachers_last_names[$i];
        }
        $teachers_names[0] = $this->lang->line('none');
        $msps_ids = $this->teacher_model->dropdown('id');
        $msps_ids[0] = 0;
        $results["teachers"] = $this->link_arrays($msps_ids, $teachers_names);

        //Puts the user names and their corresponding ids together
        $users_names = $this->user_model->dropdown('User');
        $users_names[0] = $this->lang->line('none');
        $users_ids = $this->user_model->dropdown('id');
        $users_ids[0] = 0;
        $results["users"] = $this->link_arrays($users_ids, $users_names);

        return $results;
    }

    /**
     * Puts 2 arrays as key => value
     * Both need numbers (and the same ones) to work
     * @param array $array_keys
     *      Keys of the future array
     * @param array $array_values
     *      Values of the future array
     * @return array
     *      An array with the 2 input as $array_keys => $array_values
     */
    private function link_arrays($array_keys, $array_values) {
        $results[0] = $this->lang->line('none');
        if(sizeof($array_keys) == 0 || sizeof($array_values) == 0 || sizeof($array_keys) != sizeof($array_values)) {
            //In case either array is empty or they are not from the same place
            return NULL;
        }
        for($i = 0; $i < max($array_keys)+1; $i++) {
            if(isset($array_values[$i]) && isset($array_keys[$i])) {
                $results[$array_keys[$i]] = $array_values[$i];
            }
        }
        return $results;
    }
}