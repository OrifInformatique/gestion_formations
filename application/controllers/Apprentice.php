<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Authentication controller
 * 
 * @author      Orif, section informatique (UlSi, ViDi, BuYa)
 * @link        https://github.com/OrifInformatique/gestion_formations
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */

class Apprentice extends MY_Controller {
    /* MY_Controller variables definition */
    protected $access_level = "*";

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('apprentice_model');
        $this->load->helper(array('form', 'url'));
    }

    public function index($error = 0) {
        $outputs["apprentices"] = $this->apprentice_model->get_ordered();
        $this->display_view("apprentice/list", $outputs);
    }

    public function form($id = 0, $error = NULL) {
        $this->load->model('formation_model');
        $this->load->model('msp_model');
        $this->load->model('user_model');

        $outputs["error"] = ($error == NULL ? NULL : true);

        $formation_names = $this->formation_model->dropdown('Name_Formation');
        $formation_names[0] = $this->lang->line('none_f');
        $formation_ids = $this->formation_model->dropdown('ID');
        $formation_ids[0] = 0;
        $outputs["formations"] = $this->link_arrays($formation_ids, $formation_names);

        $msps_names = $this->msp_model->dropdown('Last_Name');
        $msps_names[0] = $this->lang->line('none');
        $msps_ids = $this->msp_model->dropdown('ID');
        $msps_ids[0] = 0;
        $outputs["msps"] = $this->link_arrays($msps_ids, $msps_names);

        $users_names = $this->user_model->dropdown('User');
        $users_names[0] = $this->lang->line('none');
        $users_ids = $this->user_model->dropdown('ID');
        $users_ids[0] = 0;
        $outputs["users"] = $this->link_arrays($users_ids, $users_names);

        if($id > 0)
            $outputs["apprentice"] = $this->apprentice_model->get($id);

        $this->display_view("apprentice/form", $outputs);
    }

    public function form_validation($error = NULL){
        $this->form_validation->set_rules('firstname', $this->lang->line('apprentice_firstname'), 'required');
        $this->form_validation->set_rules('lastname', $this->lang->line('apprentice_lastname'), 'required');
        $this->form_validation->set_rules('datebirth', $this->lang->line('apprentice_datebirth'), 'required');
        $this->form_validation->set_rules('formation', $this->lang->line('apprentice_formation'), 'required');
        $this->form_validation->set_rules('MSP', $this->lang->line('apprentice_MSP'), 'required');
        $this->form_validation->set_rules('user', $this->lang->line('apprentice_user'), 'required');

        $req = array(
            'Firstname' => $this->input->post('firstname'),
            'Last_Name' => $this->input->post('lastname'),
            'Date_Birth' => $this->input->post('datebirth'),
            'FK_Formation' => $this->input->post('formation'),
            'FK_MSP' => $this->input->post('MSP'),
            'FK_User' => $this->input->post('user')
        );

        if($this->form_validation->run()){
            if($this->input->post('id') > 0){
                $this->apprentice_model->update($this->input->post('id'), $req);
            } else {
                $this->apprentice_model->insert($req);
            }
            $this->index();
        } else {
            $outputs["groups"][0] = "Aucun";
            $outputs["groups"] = array_merge($outputs["groups"], $this->apprentice_model->dropdown('Name_Group'));
            $this->display_view('apprentice/form', $outputs);
        }
    }

    public function delete($id, $confirm = 0) {
        $outputs['apprentice'] = $this->apprentice_model->get($id);
        if($confirm == 1) {
            $this->apprentice_model->delete($id);
            $this->display_view('apprentice/success');
        } elseif ($confirm == 0)
            $this->display_view('apprentice/delete', $outputs);
        else
            redirect('group');
    }

    private function link_arrays($array_keys, $array_values) {
        if(sizeof($array_keys) == 0 || sizeof($array_values) == 0 || sizeof($array_keys) != sizeof($array_values))
            return NULL;
        for($i = 0; $i < sizeof($array_keys); $i++)
            $results[$array_keys[$i]] = $array_values[$i];

        return $results;
    }
}