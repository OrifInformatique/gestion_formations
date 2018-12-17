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
        $groups = $this->group_model->get_filtered();
        $this->display_view('group/list', $groups);
    }

    public function view($id = -1) {
        if($id = -1)
            return;
        $groups = $this->group_model->get_filtered(new array("idf" => $id));

        //Make sure that there is only 1 item
        if (sizeof($groups) != 1) {
            //This should just redirect to the default list
            $this->display_view('group/list', $groups);
        } else {
            $this->display_view('group/form', $groups)
        }
    }

}