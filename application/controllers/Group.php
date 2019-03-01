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
        $this->load->helper(['form', 'url']);
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
            /* Important to prevent a group from being in itself.
            Should this happen, anything touching group will collapse.*/
        }
        $group_names[0] = $this->lang->line('none');
        $group_ids[0] = 0;
        foreach($groups as $group) {
            array_push($group_names, $group->name_group);
            array_push($group_ids, $group->id);
        }
        for ($i=0; $i < sizeof($group_names); $i++) {
            $outputs["groups"][$group_ids[$i]] = $group_names[$i];
        }

        $this->display_view('group/add', $outputs);
    }

    /**
     * Opens the form and deals with updating or creating the group
     */
    public function form_validation(){
        $this->form_validation->set_rules('name_group', $this->lang->line('group_name'), 'trim|required|regex_match[/[A-Za-zÀ-ÿ0-9 \-]+/]');
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
                $this->formation_module_group_model->update($this->input->post('id'), $req);
            } else {
                $this->formation_module_group_model->insert($req);
            }
            redirect('group');
        } else {
            $outputs["groups"][0] = $this->lang->line('none');
            $outputs["groups"] = array_merge($outputs["groups"], $this->formation_module_group_model->dropdown('name_group'));
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

        //Verifies that the group does not have any child upon deletion
        $outputs['deletion_allowed'] = TRUE;
        //Checks all modules for their parents
        $modules = $this->module_subject_model->with('Modules')->get_many_by('fk_group='.$id);
        if(sizeof($modules) > 0) {
            $outputs['deletion_allowed'] = FALSE;
        }
        //Checks all groups for their parents
        $groups = $this->formation_module_group_model->with('Modules')->get_many_by('fk_parent_group='.$id);
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
     * @param integer $max_depth
     *      Maximum depth of recursion
     * @param integer $depth
     *      Current depth of recursion, to prevent infinite recursion
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