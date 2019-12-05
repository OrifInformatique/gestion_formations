<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Admin System
 *
 * @author      Orif (ViDi)
 * @link        https://github.com/OrifInformatique
 * @copyright   Copyright (c), Orif (https://www.orif.ch)
 * @version     2.0
 */
class Admin extends MY_Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        /* Define controller access level */
        $this->access_level = $this->config->item('access_lvl_admin');

        parent::__construct();

        $this->load->model(['auth/user_model', 'auth/user_type_model']);

        // Assign form_validation CI instance to this
        $this->form_validation->CI =& $this;
    }

    /**
     * Displays the primary index
     *
     * @param any $args = Arguments to pass to the primary index
     * @return void
     */
    public function index(...$args)
    {
        $this->user_index(...$args);

        $this->form_validation->CI =& $this;
    }

    /*************************
     * Users-related functions
     *************************/
    
    /**
     * Displays the list of users
     *
     * @return void
     */
    public function user_index()
    {
        $output = array(
            'title' => $this->lang->line('user_list_title'),
            'users' => $this->user_model->with_deleted()->get_all(),
            'user_types' => $this->user_type_model->dropdown('type')
        );
        $this->display_view('admin/users/index', $output);
    }

    /**
     * Adds or modify an user
     *
     * @param integer $user_id = The id of the user to modify, leave blank to create a new one
     * @return void
     */
    public function user_add($user_id = 0)
    {
        $output = array(
            'title' => $this->lang->line('user_'.((bool)$user_id ? 'update' : 'new').'_title'),
            'user' => $this->user_model->with_deleted()->get($user_id),
            'user_types' => $this->user_type_model->dropdown('type')
        );
        $this->display_view('admin/users/add', $output);
    }

    /**
     * Validates the user input and inserts it in the database
     *
     * @return void
     */
    public function user_form()
    {
        $user_id = $this->input->post('id');

        $this->form_validation->set_rules(
            'id', 'id',
            'callback_cb_not_null_user',
            ['cb_not_null_user' => $this->lang->line('msg_err_user_not_exist')]
        );
        $this->form_validation->set_rules('user_name', 'lang:user_name', [
            'required', 'trim',
            'min_length['.$this->config->item('username_min_length').']',
            'max_length['.$this->config->item('username_max_length').']'
        ]);
        $this->form_validation->set_rules('user_usertype', 'lang:user_usertype',
            ['required', 'callback_cb_not_null_user_type'],
            ['cb_not_null_user_type' => $this->lang->line('msg_err_user_type_not_exist')]
        );

        if ($user_id == 0) {
            $this->form_validation->set_rules('user_password', $this->lang->line('user_password'), [
                'required', 'trim',
                'min_length['.$this->config->item('password_min_length').']',
                'max_length['.$this->config->item('password_max_length').']'
            ]);
            $this->form_validation->set_rules('user_password_again', $this->lang->line('user_password_again'), [
                'required', 'trim', 'matches[user_password]',
                'min_length['.$this->config->item('password_min_length').']',
                'max_length['.$this->config->item('password_max_length').']'
            ]);
        }

        if ($this->form_validation->run()) {
            $user = array(
                'fk_user_type' => $this->input->post('user_usertype'),
                'user' => $this->input->post('user_name')
            );
            if ($user_id > 0) {
                if (isset($_POST['save'])) {
                    $this->user_model->update($user_id, $user);
                }
            } else {
                $password = $this->input->post('user_password');
                $user['password'] = password_hash($password, $this->config->item('password_hash_algorithm'));
                $this->user_model->insert($user);
            }
            redirect('admin/user_index');
        } else {
            $this->user_add($user_id);
        }
    }

    /**
     * Deletes or deactivate an user depending on $action
     *
     * @param integer $user_id = ID of the user to affect
     * @param integer $action = Action to apply on the user:
     *  - 0 for displaying the confirmation
     *  - 2 for deleting
     * @return void
     */
    public function user_delete($user_id, $action = 0)
    {
        $user = $this->user_model->with_deleted()->get($user_id);
        if (is_null($user)) redirect('admin/user_index');

        switch($action) {
            case 0: // Display confirmation
                $output = array(
                    'user' => $user,
                    'title' => $this->lang->line('user_delete_title')
                );
                $this->display_view('admin/users/delete', $output);
                break;
            case 2: // Delete user
                $this->user_model->delete($user_id, TRUE);
                redirect('admin/user_index');
            default: // Do nothing
                redirect('admin/user_index');
        }
    }

    /**
     * Displays a form to change an user's password
     *
     * @param integer $user_id = ID of the user to update
     * @return void
     */
    public function user_password_change($user_id)
    {
        $user = $this->user_model->with_deleted()->get($user_id);
        if (is_null($user)) redirect('admin/user_index');

        $output = array(
            'user' => $user,
            'title' => $this->lang->line('user_password_change_title')
        );

        $this->display_view('admin/users/change_password', $output);
    }

    /**
     * Validates the password change and updates the database
     *
     * @return void
     */
    public function user_password_change_form()
    {
        $user_id = $this->input->post('id');

        $this->form_validation->set_rules(
            'id', 'id',
            'callback_cb_not_null_user',
            $this->lang->line('msg_err_user_not_exist')
        );
        $this->form_validation->set_rules('user_password_new', $this->lang->line('user_password'), [
            'required', 'trim',
            'min_length['.$this->config->item('password_min_length').']',
            'max_length['.$this->config->item('password_max_length').']'
        ]);
        $this->form_validation->set_rules('user_password_again', $this->lang->line('user_password_again'), [
            'required', 'trim', 'matches[user_password_new]',
            'min_length['.$this->config->item('password_min_length').']',
            'max_length['.$this->config->item('password_max_length').']'
        ]);

        if ($this->form_validation->run()) {
            $password = $this->input->post('user_password_new');
            $password = password_hash($password, $this->config->item('password_hash_algorithm'));
            $this->user_model->update($user_id, ['password' => $password]);
            redirect('admin/user_index');
        } else {
            $this->user_password_change($user_id);
        }
    }

    /**
     * Checks that an user exists
     *
     * @param integer $user_id = Id of the user to check
     * @return boolean = TRUE if the id is 0 or if the user exists, FALSE otherwise
     */
    public function cb_not_null_user($user_id) : bool
    {
        return $user_id == 0 || !is_null($this->user_model->with_deleted()->get($user_id));
    }
    /**
     * Checks that an user type exists
     *
     * @param integer $user_type_id = Id of the user type to check
     * @return boolean = TRUE if the user type exists, FALSE otherwise
     */
    public function cb_not_null_user_type($user_type_id) : bool
    {
        return !is_null($this->user_type_model->get($user_type_id));
    }
}