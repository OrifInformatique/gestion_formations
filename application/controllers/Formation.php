<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Authentication controller
 *
 * @author      Orif, section informatique (UlSi, ViDi, BuYa)
 * @link        https://github.com/OrifInformatique/gestion_formations
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */

class Formation extends MY_Controller {
    /* MY_Controller variables definition */
    protected $access_level = "*";

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model(['formation_model','formation_module_group_model']);
        $this->load->helper(['form', 'url']);
    }

    /**
     * Shows the index with all the groups
     */
    public function index(){
        $outputs = array(
            'formations' => $this->formation_model->get_ordered()
        );
        $this->display_view('formation/list', $outputs);
    }

    /**
     * Shows the form
     * @param integer $id
     *      If a group with the id exists, it will update it, otherwise it will create a new group
     */
    public function form($id = 0){
        $this->load->model(['module_subject_model','apprentice_model','apprentice_formation_model']);
        $outputs = array();

        $outputs = array(
            'all_modules' => $this->module_subject_model->dropdown('title'),
        );
        if($id > 0){
            $outputs["formation"] = $this->formation_model->get($id);
            $outputs["groups"] = $this->formation_module_group_model->get_tree($id, true);
        }

        $this->display_view('formation/add', $outputs);
    }

    /**
     * Opens the form and deals with updating or creating the group
     */
    public function form_validation(){
        // Checks that the inputs don't mess the program
        $this->form_validation->set_rules('name_formation', $this->lang->line('formation_name'), 'trim|required|regex_match[/^[A-Za-zÀ-ÿ0-9 \-\']+$/]');
        $this->form_validation->set_rules('duration_formation', $this->lang->line('formation_duration'), 'required|integer');

        $req = array(
            'name_formation' => $this->input->post('name_formation'),
            'duration' => $this->input->post('duration_formation')
        );

        if($this->form_validation->run()){
            $id = $this->input->post('id');
            if($id > 0){
                $this->formation_model->update($this->input->post('id'), $req);
            } else {
                $id = $this->formation_model->insert($req);
            }
            redirect('formation');
        } else {
            $this->form($this->input->post('id'));
        }
    }

    /**
     * Deletes a group
     * @param integer $id
     *      The id to delete, the page will prevent deletion if a bad id is entered
     * @param integer $confirm
     *      If 0, it will lead to the deletion page, if 1 it will lead to the success page, else it will lead back to the index
     */
    public function delete($id, $confirm = 0) {
        $this->load->model('apprentice_formation_model');
        $modules = $this->formation_module_group_model->count_by('fk_formation='.$id);
        $apprentices = $this->apprentice_formation_model->count_by('fk_formation='.$id);
        $deletion_allowed = ($apprentices + $modules <= 0);

        $outputs = array(
            'formation' => $this->formation_model->get($id),
            'deletion_allowed' => $deletion_allowed
        );

        switch($confirm) {
            case 0:
                $this->display_view('formation/delete', $outputs);
                break;
            case 1:
                if(!$deletion_allowed) redirect('formation');
                $this->formation_model->delete($id);
                $this->display_view('formation/success');
                break;
            default:
                redirect('formation');
        }
    }
}