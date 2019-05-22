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
        $this->load->model('formation_module_group_model');
        $this->load->helper(['form']);
    }

    /**
     * Shows the index with all the groups
     */
    public function index(){
        $outputs['groups'] = $this->formation_module_group_model->get_ordered();
        $this->display_view('group/list', $outputs);
    }

    /**
     * Shows the form
     * @param integer $id
     *      If a group with the id exists, it will update it, otherwise it will create a new group
     */
    public function form($id = 0){
        $outputs = array();

        if($id > 0){
            $outputs["group"] = $this->formation_module_group_model->get($id);
        }

        $groups = $this->formation_module_group_model->get_all();
        if($id != 0) {
            $groups = $this->recursive_remove($groups, $id);
            /* Important to prevent a group from being in itself.*/
        }
        $group_names[0] = $this->lang->line('none');
        $group_ids[0] = 0;
        foreach($groups as $group) {
            array_push($group_names, $group->name_group);
            array_push($group_ids, $group->id);
        }
        $outputs['groups'] = array_combine($group_ids, $group_names);

        $this->display_view('group/add', $outputs);
    }

    /**
     * Opens the form and deals with updating or creating the group
     */
    public function form_validation(){
        $this->form_validation->set_rules('name_group', $this->lang->line('group_name'), 'trim|required|regex_match[/^[A-Za-zÀ-ÿ0-9 \-]+$/]');
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

        if($this->form_validation->run()){
            if($this->input->post('id') > 0){
                $this->formation_module_group_model->update($this->input->post('id'), $req);
            } else {
                $this->formation_module_group_model->insert($req);
            }
            redirect('group');
        } else {
            $outputs["groups"][0] = $this->lang->line('none');
            $outputs["groups"] = array_merge($outputs["groups"], $this->formation_module_group_model->dropdown('name_group'));
            $this->form($this->input->post('id'));
        }
    }

    /**
     * Opens the form to add a module to a group.
     *
     * @param integer $id
     *      The id of the group to update.
     */
    public function add_module($id) {
        $this->load->model(['module_subject_model','module_group_model']);

        $outputs['group'] = $this->formation_module_group_model->get($id);
        $outputs['modules'] = $this->module_subject_model->dropdown('title');
        $outputs['m'] = [];

        // Make sure that there is a group with that id
        if(is_null($outputs['group']) || !isset($outputs['group'])) {
            redirect('group');
        }

        // Obtain linked modules
        $links = $this->module_group_model->get_many_by('fk_formation_modules_group='.$id);
        foreach($links as $link) {
            array_push($outputs['m'], $link->fk_module);
        }

        if(empty($outputs['m'])) {
            $outputs['m'] = '';
        }

        $this->display_view('group/add_module', $outputs);
    }

    /**
     * Validates and updates modules_groups according to input.
     */
    public function add_module_validation() {
        $this->load->model('module_group_model');

        $id = $this->input->post('id');
        $modules = $this->input->post('m');

        // Make sure that there is a group with that id
        $group = $this->formation_module_group_model->get($id);
        if(is_null($group) || !isset($group)) {
            redirect('group');
        }

        // Make sure it's not empty
        if(is_null($modules)) {
            $modules = array();
        }

        // Get all links to the current group
        $links = $this->module_group_model->get_many_by('fk_formation_modules_group='.$id);
        $linked_modules = array();
        foreach($links as $link) {
            $linked_modules[$link->id] = $link->fk_module;
        }

        // Check which links are to add or remove
        $to_remove = [];
        $to_add = [];
        foreach($modules as $module) {
            $i = array_search($module, $linked_modules);
            if($i === FALSE) {
                array_push($to_add, $module);
            }
        }
        foreach($linked_modules as $linked_module) {
            $i = array_search($linked_module, $modules);
            if($i === FALSE) {
                $j = array_search($linked_module, $linked_modules);
                array_push($to_remove, $j);
            }
        }

        // Add or remove links
        foreach($to_add as $add) {
            $req = array (
                'fk_formation_modules_group' => $id,
                'fk_module' => $add,
            );
            $this->module_group_model->insert($req);
        }
        foreach($to_remove as $remove) {
            $this->module_group_model->delete($remove);
        }

        // Back to list
        redirect('group');
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

        //Verifies that the group does not have any child upon deletion
        $outputs['deletion_allowed'] = TRUE;
        //Checks all groups for their parents
        $groups = $this->formation_module_group_model->get_many_by('fk_parent_group='.$id);
        if(sizeof($groups) > 0) {
            $outputs['deletion_allowed'] = FALSE;
        }
        $outputs['group'] = $this->formation_module_group_model->get($id);

        if($confirm == 1) {
            $this->formation_module_group_model->delete($id);
            $this->display_view('group/success');
        } elseif ($confirm == 0) {
            $this->display_view('group/delete', $outputs);
        } else {
            redirect('group');
        }
    }

    /**
     * Attempts to (recursively) remove the array and its children
     * @param array $group
     *      The groups affected
     * @param integer $id
     *      The id of the parent group
     * @param integer $depth
     *      Current depth of recursion, to prevent infinite recursion
     * @return array
     *      The resulting array of groups, without the parent's family
     */
    private function recursive_remove($groups, $id, $depth = 5) {
        if($depth <= 0) {
            return $groups;
        }
        foreach ($groups as $group) {
            if($group->fk_parent_group == $id || $group->id == $id) {
                unset($groups[array_search($group, $groups)]);
                $groups = $this->recursive_remove($groups, $group->id, $depth-1);
            }
        }
        return $groups;
    }
}