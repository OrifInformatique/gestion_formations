<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Module controller
 *
 * @author      Orif, section informatique (UlSi, ViDi)
 * @link        https://github.com/OrifInformatique/gestion_formations
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */

class Module extends MY_Controller {
    /* MY_Controller variables definition */
    protected $access_level = "*";

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model(["module_subject_model", "module_group_model"]);
        $this->load->helper(['form', 'url']);
    }

    /**
     * Displays the list of modules
     */
    public function index(){
        $outputs['groups'] = $this->module_group_model->get_ordered();
        $outputs['groups_tree'] = $this->module_group_model->get_tree();
        if(is_null($outputs['groups_tree']))
            $outputs['groups_tree'] = array();
        $outputs['modules'] = $this->module_subject_model->get_ordered();
        $this->display_view('module/list', $outputs);
    }

    /**
     * Displays the form to create / modify a module
     * @param integer $id
     *      The id of the module to modify (0 for a new module)
     */
    public function form($id = 0){
        $outputs = array();

        if($id > 0){
            $outputs["module"] = $this->module_subject_model->get($id);
        }

        $outputs["groups"] = $this->module_group_model->dropdown('name_group');

        $this->display_view('module/add', $outputs);
    }

    /**
     * Validates the input from the form
     */
    public function form_validation(){
        $this->form_validation->set_rules('title_module', $this->lang->line('module_title'), 'trim|required|regex_match[/[A-Za-zÀ-ÿ0-9 \-]+/]');
        $this->form_validation->set_rules('number_module', $this->lang->line('number_module'), 'required');
        $this->form_validation->set_rules('group_module', $this->lang->line('group_module'), 'required');
        $this->form_validation->set_rules('description_module', $this->lang->line('module_description'), 'trim|regex_match[/[A-Za-zÀ-ÿ0-9 \-\.,\?\!:;]+/]');

        $req = array(
            'number' => $this->input->post('number_module'),
            'title' => $this->input->post('title_module'),
            'fk_group' => $this->input->post('group_module'),
            'description' => $this->input->post('description_module')
        );

        $req = html_escape($req);

        if($this->form_validation->run()){
            if($this->input->post('id') > 0){
                $this->module_subject_model->update($this->input->post('id'), $req);
            } else {
                $this->module_subject_model->insert($req);
            }
            redirect('module');
        } else {
            $outputs["groups"] = $this->module_group_model->dropdown('name_group');
            $this->display_view('module/add', $outputs);
        }
    }

    /**
     * Deletes a module
     * @param integer $id
     *      The id of the module to delete
     * @param integer $confirm
     *      0 to display confirmation, 1 to confirm, 0 to go back to the index
     */
    public function delete($id, $confirm = 0) {
        $this->load->model('formation_module_model');
        $outputs['module'] = $this->module_subject_model->get($id);
        $outputs['deletion_allowed'] = TRUE;
        $modules = $this->formation_module_model->with('Modules')->get_many_by('fk_module='.$id);
        if(sizeof($modules) > 0) $outputs['deletion_allowed'] = FALSE;
        if($confirm == 1) {
            $this->module_subject_model->delete($id);
            $this->display_view('module/success');
        } elseif ($confirm == 0) {
            $this->display_view('module/delete', $outputs);
        } else {
            redirect('module');
        }
    }

    /**
     * Checks if the module name is unique
     * Unused
     * @param string $module_name
     *      Module name to check
     * @return boolean
     *      TRUE if the module name is unique
     */
    private function is_module_name_unique($module_name, $case_sensitive = TRUE) {
        $modules = $this->module_subject_model->get_all();
        foreach ($modules as $module) {
            if(($module->title == $module_name && $case_sensitive) || (strtolower($module->title) == strtolower($module_name) && !$case_sensitive)) {
                return FALSE;
            }
        }
        return TRUE;
    }
}