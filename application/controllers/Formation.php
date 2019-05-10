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
        $this->load->model(['formation_model','formation_module_group_model', 'module_subject_model', 'module_group_model']);
        $this->load->helper(['form', 'url']);
    }

    /**
     * Shows the index with all the groups
     */
    public function index(){
        $outputs['formations'] = $this->formation_model->get_ordered();
        $this->display_view('formation/list', $outputs);
    }

    /**
     * Shows the form
     * @param integer $id
     *      If a group with the id exists, it will update it, otherwise it will create a new group
     */
    public function form($id = 0){
        $outputs = array();

        if($id > 0){
            $outputs["formation"] = $this->formation_model->get($id);
            $outputs["groups"] = $this->formation_module_group_model->get_tree($id, true);
            $outputs["all_modules"] = $this->module_subject_model->dropdown('title');
        }

        $this->display_view('formation/add', $outputs);
    }

    /**
     * Opens the form and deals with updating or creating the group
     */
    public function form_validation(){
        $this->form_validation->set_rules('name_formation', $this->lang->line('formation_name'), 'trim|required|regex_match[/^[A-Za-zÀ-ÿ0-9 \-]+$/]');
        $this->form_validation->set_rules('duration_formation', $this->lang->line('formation_duration'), 'required|numeric');

        $req = array(
            'name_formation' => $this->input->post('name_formation'),
            'duration' => $this->input->post('duration_formation')
        );

        if($this->form_validation->run()){
            if($this->input->post('id') > 0){
                $this->formation_model->update($this->input->post('id'), $req);
                $id = $this->input->post('id');

                $add_group = $this->input->post('add_group');
                $add_module = $this->input->post('add_module');
                $added_module = $this->input->post('added_module');
                $modules = $this->input->post('modules');

                /*if(!is_null($modules)){
                    foreach ($modules as $key => $module) {
                        $req = array(
                            'fk_formation' => $id,
                            'fk_module' => $module
                        );
                        if(is_null($this->formation_module_group_model->get($key))){
                            $this->formation_module_group_model->insert($req);
                        } else {
                            $this->formation_module_group_model->update($key, $req);
                        }
                    }
                }*/

                if(isset($add_group)){
                    $req = array(
                        'fk_formation' => $id,
                        'name_group' =>  $this->input->post('add_group_name')
                    );
                    $this->formation_module_group_model->insert($req);
                } else if(isset($del_module)) {
                    $this->formation_module_group_model->delete(array_keys($del_module)[0]);
                } else if(isset($add_module)){
                    $req = array(
                        'fk_formation_modules_group' => array_keys($add_module)[0],
                        'fk_module' =>  $added_module[array_keys($add_module)[0]]
                    );
                    $this->module_group_model->insert($req);
                }

                $outputs["formation"] = $this->formation_model->get($id);
                $outputs["groups"] = $this->formation_module_group_model->get_tree($id, true);
                $outputs["all_modules"] = $this->module_subject_model->dropdown('title');

                $this->display_view('formation/add', $outputs);

            } else {
                $this->formation_model->insert($req);

                $this->index();
            }

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
        $outputs['formation'] = $this->formation_model->get($id);
        $outputs['deletion_allowed'] = TRUE;
        $modules = $this->formation_module_group_model->get_many_by('fk_formation='.$id);
        if(sizeof($modules) > 0) {
            $outputs['deletion_allowed'] = FALSE;
        }
        if($confirm == 1) {
            $this->formation_model->delete($id);
            $this->display_view('formation/success');
        } elseif ($confirm == 0) {
            $this->display_view('formation/delete', $outputs);
        }
        else
            redirect('formation');
    }

}