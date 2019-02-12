<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Authentication controller
 *
 * @author      Orif, section informatique (UlSi, ViDi, BuYa)
 * @link        https://github.com/OrifInformatique/gestion_formations
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */

class Admin extends MY_Controller {
    //protected $access_level = ACCESS_LVL_ADMIN;
    protected $access_level = "*";

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model(['user_model','user_type_model']);
        $this->load->helper('form');
    }

    public function index() {
        $this->user_index();
    }

    /************************
     * User-related functions
     ************************/
    public function user_index() {
        $outputs['users'] = $this->user_model->get_all();
        $outputs['user_types'] = $this->user_type_model->get_all();
        $this->display_view('admin/users/list', $outputs);
    }

    public function user_form($id = 0) {
        if($id > 0) {
            $outputs['user'] = $this->user_model->get($id);
        }

        $user_types = $this->user_type_model->get_all();
        $outputs['user_types'] = array();
        if(is_array($user_types)) {
            foreach($user_types as $user_type) {
                $outputs['user_types'][$user_type->id] = $user_type->type;
            }
        }
        $outputs['user_types'][0] = $this->lang->line('none');

        $this->display_view('admin/users/form', $outputs);
    }

    public function user_form_validation() {
        $update = (null !== $this->input->post('id'));

        $req = array(
            'user' => $this->input->post('user_username'),
            'fk_user_type' => $this->input->post('user_type')
        );
        if(!$update) {
            $req['password'] = password_hash($this->input->post('user_password'), PASSWORD_DEFAULT);
        }

        $problem = FALSE;
        $problem = ($this->input->post('user_password') !== $this->input->post('user_password_again'));

        $this->form_validation->set_rules('user_username', $this->lang->line('user_username'),
            'trim|required|min_length['.USERNAME_MIN_LENGTH.']|is_unique[users.user]');
        if(!$update) {
            $this->form_validation->set_rules('user_password', $this->lang->line('user_password'),
                array('trim',
                    'required',
                    'min_length['.PASSWORD_MIN_LENGTH.']',
                    function($problem) {return $problem;}));
        }
        $this->form_validation->set_rules('user_type', $this->lang->line('user_type'), 'required');

        if($this->form_validation->run()) {
            if($this->input->post('id') > 0){
                $this->user_model->update($this->input->post('id'), $req);
            } else {
                $this->user_model->insert($req);
            }
            redirect('admin/user_index');
        } else {
            if($this->input->post('id') > 0)
                $this->user_form($this->input->post('id'));
            $this->user_form();
        }
    }

    public function user_delete($id, $confirm = 0) {
        $this->load->model(['teacher_model','apprentice_model']);

        $outputs['user'] = $this->user_model->get($id);

        $outputs['deletion_allowed'] = TRUE;
        $teachers = $this->teacher_model->with('Teachers')->get_many_by('fk_user='.$id);
        if(sizeof($teachers) > 0)
            $outputs['deletion_allowed'] = FALSE;
        $apprentices = $this->apprentice_model->with('Apprentices')->get_many_by('fk_user='.$id);
        if(sizeof($apprentices) > 0)
            $outputs['deletion_allowed'] = FALSE;

        if($confirm == 1) {
            $this->user_model->delete($id);
            $this->display_view('admin/users/success');
        } elseif ($confirm == 0) {
            $this->display_view('admin/users/delete', $outputs);
        } else {
            redirect('admin/user_index');
        }
    }
}