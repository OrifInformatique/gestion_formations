<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Authentication controller
 *
 * @author      Orif, section informatique (UlSi, ViDi, BuYa)
 * @link        https://github.com/OrifInformatique/gestion_formations
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */

class Admin extends MY_Controller {
    protected $access_level = ACCESS_LVL_ADMIN;

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->model(['user_model','user_type_model']);
    }

    public function index() {
        $outputs['users'] = $this->user_model->get_all();
        $outputs['user_types'] = $this->user_type_model->get_all();
        $this->display_view('admin/users/list', $outputs);
    }
}