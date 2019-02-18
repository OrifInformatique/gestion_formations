<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Admin controller
 *
 * @author      Orif, section informatique (UlSi, ViDi, BuYa)
 * @link        https://github.com/OrifInformatique/gestion_formations
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */

class Admin extends MY_Controller {
    protected $access_level = ACCESS_LVLS['ADMIN'];

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model(['user_model','user_type_model','teacher_model']);
        $this->load->helper('form');
    }

    /**
     * Shows the index of admin side
     * It's just a list of links to the other indexes.
     */
    public function index() {
        $this->display_view('admin/list');
    }

    /************************
     * User-related functions
     ************************/
    /**
     * Shows the list of users.
     */
    public function user_index() {
        $outputs['users'] = $this->user_model->get_all();
        $outputs['user_types'] = $this->user_type_model->get_all();
        $this->display_view('admin/users/list', $outputs);
    }

    /**
     * Shows the form for new/existing users
     * @param integer $id
     *      ID of the user to modify. Leave at 0 to create a new user
     */
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

    /**
     * Makes sure that the form was filled correctly.
     */
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
        $this->form_validation->set_rules('user_type', $this->lang->line('user_type'), 'required');
        if(!$update) {
            $this->form_validation->set_rules('user_password', $this->lang->line('user_password'),
                array('trim',
                    'required',
                    'min_length['.PASSWORD_MIN_LENGTH.']',
                    function($problem) {return $problem;}));
        }

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

    /**
     * Deletes a user.
     * @param integer $id
     *      ID of the user to delete
     * @param integer $confirm
     *      0 leads to the confirmation prompt, 1 deletes the user.
     */
    public function user_delete($id, $confirm = 0) {
        $this->load->model(['apprentice_model']);

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

    /*****************************
     * User type-related functions
     *****************************/
    /**
     * Shows the list of user types.
     */
    public function user_type_index() {
        $outputs['access_levels'] = array_flip(ACCESS_LVLS);
        $outputs['user_types'] = $this->user_type_model->get_all();
        $this->display_view('admin/user_types/list', $outputs);
    }

    /**
     * Shows the form for new/existing user types
     * @param integer $id
     *      ID of the user to modify. Leave at 0 to create a new user type
     */
    public function user_type_form($id = 0) {
        $outputs['access_levels'] = array_flip(ACCESS_LVLS);

        if($id > 0) {
            $outputs['user_type'] = $this->user_type_model->get($id);
        }

        $this->display_view('admin/user_types/form', $outputs);
    }

    /**
     * Makes sure that the form was filled correctly.
     */
    public function user_type_form_validation() {
        $this->form_validation->set_rules('user_type_type', $this->lang->line('user_type_type'), 'required|regex_match[/[A-Za-zÀ-ÿ ]+/]');
        $this->form_validation->set_rules('user_type_access_level', $this->lang->line('user_type_access_level'), 'required');

        $req = array(
            'type' => $this->input->post('user_type_type'),
            'access_level' => $this->input->post('user_type_access_level'));

        if($this->form_validation->run()) {
            if($this->input->post('id') > 0) {
                $this->user_type_model->update($this->input->post('id'), $req);
            } else {
                $this->user_type_model->insert($req);
            }
            redirect('admin/user_type_index');
        } else {
            if($this->input->post('id') > 0)
                $this->user_type_form($this->input->post('id'));
            $this->user_type_form();
        }
    }

    /**
     * Deletes a user type.
     * @param integer $id
     *      ID of the user type to delete
     * @param integer $confirm
     *      0 leads to the confirmation prompt, 1 deletes the user.
     */
    public function user_type_delete($id, $confirm = 0) {
        $outputs['user_type'] = $this->user_type_model->get($id);

        $outputs['deletion_allowed'] = TRUE;
        $users = $this->user_model->with('Users')->get_many_by('fk_user_type='.$id);
        if(sizeof($users) > 0)
            $outputs['deletion_allowed'] = FALSE;

        if($confirm == 1) {
            $this->user_type_model->delete($id);
            $this->display_view('admin/user_types/success');
        } elseif ($confirm == 0) {
            $this->display_view('admin/user_types/delete', $outputs);
        } else {
            redirect('admin/user_type_index');
        }
    }

    /****************************
     * Teachers-related functions
     ****************************/
    public function teacher_index() {
        $outputs['teachers'] = $this->teacher_model->get_all();
        $outputs['users'] = $this->user_model->get_all();
        $this->display_view('admin/teachers/list', $outputs);
    }

    public function teacher_form($id = 0) {
        //Puts the user names and their corresponding ids together
        $outputs['users'] = array();
        $users_names = $this->user_model->dropdown('User');
        $users_names[0] = $this->lang->line('none');
        $users_ids = $this->user_model->dropdown('id');
        $users_ids[0] = 0;
        for($i = 0; $i < max($users_ids)+1; $i++) {
            if(isset($users_names[$i]) && isset($users_ids[$i])) {
                $outputs['users'][$users_ids[$i]] = $users_names[$i];
            }
        }

        if($id > 0) {
            $outputs['teacher'] = $this->teacher_model->get($id);
        }

        $this->display_view('admin/teachers/form', $outputs);
    }

    public function teacher_form_validation() {
        $this->form_validation->set_rules('teacher_firstname', $this->lang->line('teacher_firstname'), 'trim|required|regex_match[/[A-Za-zÀ-ÿ0-9 \-]+/]');
        $this->form_validation->set_rules('teacher_name', $this->lang->line('teacher_name'), 'trim|required|regex_match[/[A-Za-zÀ-ÿ0-9 \-]+/]');
        $this->form_validation->set_rules('teacher_user', $this->lang->line('teacher_username'), 'required');

        $req = array(
            'firstname' => $this->input->post('teacher_firstname'),
            'last_name' => $this->input->post('teacher_name'),
            'fk_user' => $this->input->post('teacher_user'));

        if($this->form_validation->run()) {
            if($this->input->post('id') > 0) {
                $this->teacher_model->update($this->input->post('id'), $req);
            } else {
                $this->teacher_model->insert($req);
            }
            redirect('admin/teacher_index');
        } else {
            if($this->input->post('id') > 0)
                $this->teacher_form($this->input->post('id'));
            $this->teacher_form();
        }
    }

    public function teacher_delete($id, $confirm = 0) {
        $this->load->model(['apprentice_model']);
        $outputs['teacher'] = $this->teacher_model->get($id);

        $outputs['deletion_allowed'] = TRUE;
        $apprentices = $this->apprentice_model->with('Apprentices')->get_many_by('fk_teacher='.$id);
        if(sizeof($apprentices) > 0)
            $outputs['deletion_allowed'] = FALSE;

        if($confirm == 1) {
            $this->teacher_model->delete($id);
            $this->display_view('admin/teachers/success');
        } elseif($confirm == 0) {
            $this->display_view('admin/teachers/delete', $outputs);
        } else {
            redirect('admin/teacher_index');
        }
    }
}