<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Authentication controller
 * 
 * @author      Orif, section informatique (UlSi, ViDi, BuYa)
 * @link        https://github.com/OrifInformatique/gestion_formations
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */

class Group extends MY_Controller {
    /* MY_Controller variables definition */
    protected $access_level = "*";

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('group_model');
        $this->load->helper(array('form', 'url'));
    }

    /**
     * Shows the index with all the groups
     * @param integer $error
     *      The error (does nothing)
     */
    public function index($error = 0){
        $outputs['groups'] = $this->group_model->get_ordered();
        $this->display_view('group/list', $outputs);
    }

    /**
     * Shows the form
     * @param integer $id
     *      If a group with the id exists, it will update it, otherwise it will create a new group
     * @param integer $error
     *      If there is an error
     */
    public function form($id = 0, $error = NULL){
        $outputs["error"] = ($error == NULL ? NULL : true);

        if($id > 0){
            $outputs["group"] = $this->group_model->get($id);
        }
        
        $group_names[0] = $this->lang->line('none');
        $group_names = array_merge($group_names, $this->group_model->dropdown('name_group'));
        $group_ids[0] = 0;
        $group_ids = array_merge($group_ids, $this->group_model->dropdown('id'));
        for ($i=0; $i < sizeof($group_names); $i++) { 
            $outputs["groups"][$group_ids[$i]] = $group_names[$i];
        }

        $this->display_view('group/add', $outputs);
    }

    /**
     * Opens the form and deals with updating or creating the group
     * @param integer $error
     *      If there is an error (does nothing)
     */
    public function form_validation($error = NULL){
        $this->form_validation->set_rules('name_group', $this->lang->line('group_name'), 'trim|required|alpha_numeric_spaces');
        $this->form_validation->set_rules('weight', $this->lang->line('group_weight'), 'required');
        $this->form_validation->set_rules('position', $this->lang->line('group_position'), 'required');
        $this->form_validation->set_rules('parent_group', $this->lang->line('group_parent_group'), 'required');

        $req = array(
            'name_group' => $this->input->post('name_group'),
            'weight' => $this->input->post('weight'),
            'eliminatory' => null !== $this->input->post('eliminatory'),
            'position' => $this->input->post('position'),
            'fk_parent_group' => $this->input->post('parent_group')
        );

        $req = html_escape($req);

        if($this->form_validation->run()){
            if($this->input->post('id') > 0){
                $this->group_model->update($this->input->post('id'), $req);
            } else {
                $this->group_model->insert($req);
            }
            redirect('group');
        } else {
            $outputs["groups"][0] = $this->lang->line('none');
            $outputs["groups"] = array_merge($outputs["groups"], $this->group_model->dropdown('name_group'));
            $this->display_view('group/add', $outputs);
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
        $this->load->model('module_subject_model');
        $modules = $this->module_subject_model->get_ordered();
        $outputs['deletion_allowed'] = TRUE;
        for($i = 0; $i < max(array_keys($modules)); $i++) {
            if(!isset($modules[$i]))
                continue;
            if($id == $modules[$i]->fk_group)
                $outputs['deletion_allowed'] = FALSE;
        }
        $groups = $this->group_model->get_ordered();
        for($i = 0; $i < max(array_keys($groups)); $i++) {
            if(!isset($groups[$i]))
                continue;
            if($id == $groups[$i]->fk_parent_group)
                $outputs['deletion_allowed'] = FALSE;
        }
        $outputs['group'] = $this->group_model->get($id);
        if($confirm == 1) {
            $this->group_model->delete($id);
            $this->display_view('group/success');
        } elseif ($confirm == 0)
            $this->display_view('group/delete', $outputs);
        else
            redirect('group');
    }
}