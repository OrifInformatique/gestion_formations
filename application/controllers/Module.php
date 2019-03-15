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
        $this->load->model(["module_subject_model", "formation_module_group_model"]);
        $this->load->helper(['form', 'url']);
    }

    /**
     * Displays the list of modules
     */
    public function index(){
        $outputs['groups'] = $this->formation_module_group_model->get_ordered();
        $outputs['modules'] = $this->module_subject_model->get_ordered("number");
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

        $this->display_view('module/add', $outputs);
    }

    /**
     * Validates the input from the form
     */
    public function form_validation(){
        $this->form_validation->set_rules('title_module', $this->lang->line('module_title'), 'trim|required|regex_match[/[A-Za-zÀ-ÿ0-9 \-]+/]');
        $this->form_validation->set_rules('number_module', $this->lang->line('module_number'), 'required');
        $this->form_validation->set_rules('description_module', $this->lang->line('module_description'), 'trim|regex_match[/[A-Za-zÀ-ÿ0-9 \-\.,\?\!:;]+/]');

        $req = array(
            'number' => $this->input->post('number_module'),
            'title' => $this->input->post('title_module'),
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
            $outputs["groups"] = $this->formation_module_group_model->dropdown('name_group');
            $this->form($this->input->post('id'));
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
        $this->load->model('module_group_model');
        $outputs['module'] = $this->module_subject_model->get($id);
        $outputs['deletion_allowed'] = TRUE;
        $modules = $this->module_group_model->get_many_by('fk_module='.$id);
        if(sizeof($modules) > 0) {
            $outputs['deletion_allowed'] = FALSE;
        }
        if($confirm == 1) {
            $this->module_subject_model->delete($id);
            $this->display_view('module/success');
        } elseif ($confirm == 0) {
            $this->display_view('module/delete', $outputs);
        } else {
            redirect('module');
        }
    }
}