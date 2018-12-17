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
        
    }

    public function add($error = NULL){
        $outputs["error"] = ($error == NULL ? NULL : true);
        $outputs["action"] = "add";

        $outputs["groups"] = $this->group_model->get_tree();

        $this->display_view('group/add', $outputs);
    }

    public function form_validate(){
        $this->form_validation->set_rules('title', 'Title', 'required');
    }
}