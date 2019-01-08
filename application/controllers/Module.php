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
        $this->load->model('module_subject_model');
        $this->load->model('group_model');
        $this->load->helper(array('form', 'url'));
    }

    public function index($error = 0){
        $outputs['groups'] = $this->group_model->get_ordered();
        $outputs['groups_tree'] = $this->group_model->get_tree();
        $outputs['modules'] = $this->module_subject_model->get_ordered();
        $this->display_view('module/list', $outputs);
    }

    public function form($id = 0, $error = NULL){
        $outputs["error"] = ($error == NULL ? NULL : true);

        if($id > 0){
            $outputs["module"] = $this->module_subject_model->get($id);
        }
        
        $outputs["groups"] = $this->group_model->dropdown('Name_Group');

        $this->display_view('module/add', $outputs);
    }

    public function form_validation($error = NULL){
        $this->form_validation->set_rules('title_module', $this->lang->line('title_module'), 'trim|required|alpha_numeric_spaces');
        $this->form_validation->set_rules('number_module', $this->lang->line('module_number'), 'required');
        $this->form_validation->set_rules('group_module', $this->lang->line('group_module'), 'required');

        $req = array(
            'Title' => $this->input->post('title_module'),
            'Number' => $this->input->post('number_module'),
            'FK_Group' => $this->input->post('group_module'),
            'Description' => $this->input->post('description_module')
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
            $outputs["groups"] = $this->group_model->dropdown('Name_Group');
            $this->display_view('module/add', $outputs);
        }
    }
}