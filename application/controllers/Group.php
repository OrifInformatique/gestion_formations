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

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('group_model');
        $this->load->helper(array('form', 'url'));
    }

    public function index($error = 0){
        $outputs['groups'] = $this->group_model->get_ordered();
        $outputs['groups_tree'] = $this->group_model->get_tree();
        $this->display_view('group/list', $outputs);
    }

    /*public function view($id = -1) {
        if($id < 0)
            redirect('group');
        if($id == 0) {
            $outputs["groups"] = $this->group_model->get_tree();
            $this->display_view('group/add', $outputs);
            return;
        }
        $outputs['group'] = $this->group_model->get_filtered(array("idf" => $id));

        //Make sure that there is only 1 item
        if (sizeof($outputs['group']) > 1) {
            //This should just redirect to the default list but currently you can see all the things that were selected to find out why
            $this->display_view('group/list', $outputs);
        } elseif (sizeof($outputs['group']) == 1) {
            $outputs['group'] = $outputs['group'][0];
            $outputs["groups"][0] = "Aucun";
            $outputs["groups"] = array_merge($outputs["groups"], $this->group_model->dropdown('Name_Group'));
            unset($outputs["groups"][$id]);
            $this->display_view('group/add', $outputs);
        } else {
            redirect('group');
        }
    }*/

    public function add($id = 0, $error = NULL){
        $outputs["error"] = ($error == NULL ? NULL : true);

        if($id > 0){
            $outputs["group"] = $this->group_model->get($id);
        }
        
        $outputs["groups"][0] = $this->lang->line('none');
        $outputs["groups"] = array_merge($outputs["groups"], $this->group_model->dropdown('Name_Group'));

        $this->display_view('group/add', $outputs);
    }

    public function form_validation($error = NULL){
        $this->form_validation->set_rules('name_group', $this->lang->line('group_name'), 'required');
        $this->form_validation->set_rules('weight', $this->lang->line('group_weight'), 'required');
        $this->form_validation->set_rules('position', $this->lang->line('group_position'), 'required');
        $this->form_validation->set_rules('parent_group', $this->lang->line('group_parent_group'), 'required');

        $req = array(
            'Name_Group' => $this->input->post('name_group'),
            'Weight' => $this->input->post('weight'),
            'Eliminatory' => null !== $this->input->post('eliminatory'),
            'Position' => $this->input->post('position'),
            'FK_Parent_Group' => $this->input->post('parent_group')
        );

        if($this->form_validation->run()){
            if($this->input->post('id') > 0){
                $this->group_model->update($this->input->post('id'), $req);
            } else {
                $this->group_model->insert($req);
            }
            $this->index();
        } else {
            $outputs["groups"][0] = "Aucun";
            $outputs["groups"] = array_merge($outputs["groups"], $this->group_model->dropdown('Name_Group'));
            $this->display_view('group/add', $outputs);
        }
    }

    public function delete($id, $confirm = 0) {
        if(sizeof($groups = $this->group_model->get_filtered(array("idf" => $id))) > 1)
            $this->display_view('group/list', $groups); //Again, this is for debugging
        elseif(sizeof($groups) == 0)
            redirect('group');
        $outputs['group'] = $groups[0];
        if($confirm == 1) {
            $this->group_model->delete($id);
            $this->display_view('group/success');
        } elseif ($confirm == 0)
            $this->display_view('group/delete', $outputs);
        else
            redirect('group');
    }
}