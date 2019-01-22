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
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model(['formation_model','formation_module_model','module_subject_model']);
        $this->load->helper(array('form', 'url'));
    }

    /**
     * Shows the index with all the groups
     * @param integer $error
     *      Unused in the function and in list.php
     */
    public function index($error = 0){
        $outputs['formations'] = $this->formation_model->get_ordered();
        $this->display_view('formation/list', $outputs);
    }

    /**
     * Shows the form
     * @param integer $id
     *      If a group with the id exists, it will update it, otherwise it will create a new group
     * @param integer $error
     *      Unused in add.php
     */
    public function form($id = 0, $error = NULL){
        $outputs["error"] = ($error == NULL ? NULL : true);

        if($id > 0){
            $outputs["formation"] = $this->formation_model->get($id);
        }

        $this->display_view('formation/add', $outputs);
    }

    /**
     * Opens the form and deals with updating or creating the group
     * @param integer $error
     *      Unused in the function and in add.php
     */
    public function form_validation($error = NULL){
        $this->form_validation->set_rules('name_formation', $this->lang->line('formation_name'), 'trim|required');
        $this->form_validation->set_rules('duration_formation', $this->lang->line('formation_duration'), 'required');

        $req = array(
            'name_formation' => $this->input->post('name_formation'),
            'duration' => $this->input->post('duration_formation')
        );

        $req = html_escape($req);

        if($this->form_validation->run()){
            if($this->input->post('id') > 0){
                $this->formation_model->update($this->input->post('id'), $req);
            } else {
                $this->formation_model->insert($req);
            }
            redirect('formation');
        } else {
            $this->display_view('formation/add');
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
        $outputs['formation'] = $this->formation_model->get($id);
        $outputs['deletion_allowed'] = TRUE;
        $modules = $this->formation_module_model->with('Modules')->get_many_by('fk_formation='.$id);
        if(sizeof($modules) > 0) $outputs['deletion_allowed'] = FALSE;
        if($confirm == 1) {
            $this->formation_model->delete($id);
            $this->display_view('formation/success');
        } elseif ($confirm == 0)
            $this->display_view('formation/delete', $outputs);
        else
            redirect('formation');
    }

    /**
     * Edit a module
     * @param integer $id
     *      The id of the module to edit
     */
    public function edit_modules($id){
        $outputs["formation"] = $this->formation_model->get($id);
        $outputs["modules"] = $this->formation_module_model->with('Modules')->get_many_by('fk_formation='.$id);
        $outputs["all_modules"] = $this->module_subject_model->dropdown('title');
        $this->display_view('formation/edit_modules', $outputs);
    }

    /**
    * Displays the form to add / remove / change the modules in the formation
    */
    public function edit_modules_post(){
        $id = $this->input->post('id');

        $add_module = $this->input->post('add_module');
        $del_module = $this->input->post('del_module');
        $quit = $this->input->post('quit');
        $modules = $this->input->post('modules');

        if(!is_null($modules)){
            foreach ($modules as $key => $module) {
                $req = array(
                    'fk_formation' => $id,
                    'fk_module' => $module
                );
                if(is_null($this->formation_module_model->get($key))){
                    $this->formation_module_model->insert($req);
                } else {
                    $this->formation_module_model->update($key, $req);
                }
            }
        }

        if(isset($add_module)){
            $outputs["add_module"] = true;
        } else if(isset($del_module)) {
            $this->formation_module_model->delete(array_keys($del_module)[0]);
        }

        if(isset($quit)) {
            redirect('formation');
        } else {
            $outputs["formation"] = $this->formation_model->get($id);
            $outputs["modules"] = $this->formation_module_model->with('Modules')->get_many_by('fk_formation='.$id);
            $outputs["all_modules"] = $this->module_subject_model->dropdown('title');
        
            $this->display_view('formation/edit_modules', $outputs);
        }
    }
}