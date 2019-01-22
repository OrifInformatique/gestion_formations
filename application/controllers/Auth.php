<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Authentication controller
 * 
 * @author      Orif, section informatique (UlSi, ViDi)
 * @link        https://github.com/OrifInformatique/gestion_formations
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */

class Auth extends MY_Controller {
    /* MY_Controller variables definition */
    protected $access_level = "*";

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('user_model');
        $this->load->model('user_type_model');
        $this->load->helper(array('form', 'url'));
    }

    /**
     * Display the login page
     *
     * @param int $error = Type of error :  0 = no error
     *                                      1 = wrong identifiers
     *                                      2 = field(s) empty
     */
    public function index($error = 0){
        $outputs['error'] = $error;
        $outputs['title'] = $this->lang->line('page_login');
        $this->display_view("login/login", $outputs);
    }

    /**
     * Validate the login informaions and create session variables.
     * If necessary, redirect to the login page.
     */
    public function login(){
        $this->form_validation->set_rules('username', strtolower($this->lang->line('field_username')),
                                          'trim|required|min_length['.USERNAME_MIN_LENGTH.']');
        $this->form_validation->set_rules('password', strtolower($this->lang->line('field_password')),
                                          'trim|required|min_length['.PASSWORD_MIN_LENGTH.']');

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if ($this->form_validation->run() == true) {

            if($this->user_model->check_password($username, $password)) {
                $user = $this->user_model->with('users_type')->get_by('User', $username);

                $this->session->user_id = $user->ID;
                $this->session->username = $user->User;
                $this->session->user_access = $user->user_type->access_level;
                $this->session->logged_in = true;

                redirect('index.php');
            }
            else {
                // Login informations error : display login page again, with error message
                $this->index(1);
            }

        }
        else {
            // Validation error : display login page again, with error messages
            $this->index(2);
        }
    }

    /**
     * Displays the form to create a new user
     * @param object $error
     *      Unused in form.php
     */
    public function form($error = NULL) {
        $outputs["error"] = ($error == NULL ? NULL : true);
        $outputs['user_types'] = $this->user_type_model->get_ordered();
        $outputs['user_types'][0] = $this->lang->line('none');

        $this->display_view('login/form', $outputs);
    }

    /**
     * Validates the entered user
     * @param object $error
     *      Unused in the function, in form.php and in list.php
     */
    public function form_validation($error = NULL) {
        $this->form_validation->set_rules('username', strtolower($this->lang->line('field_username')), 'trim|required|min_length['.USERNAME_MIN_LENGTH.']');
        $this->form_validation->set_rules('password', strtolower($this->lang->line('field_password')), 'trim|required|min_length['.PASSWORD_MIN_LENGTH.']');
        $this->form_validation->set_rules('user_type', $this->lang->line('user_type'), 'required');

        $username = $this->input->post('username');

        $req = array(
            'user' => $this->input->post('username'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'fk_user_type' => $this->input->post('user_type')
        );

        if($this->form_validation->run() && $this->is_username_unique($username)) {
            $this->user_model->insert($req);
            $this->index();
        } else {
            $this->form();
        }
    }

    /**
     * Destroy the session and redirect to login page
     */
    public function logout(){
        session_destroy();
        redirect('Auth');
    }

    /**
     * Checks if the username is unique
     * @param string $username
     *      Username to check
     * @return boolean
     *      TRUE if the username is unique
     */
    public function is_username_unique($username) {
        $users = $this->user_model->get_all();
        $is_unique = TRUE;
        foreach ($users as $user) {
            if(!$is_unique)
                break;
            if($user->User == $username)
                $is_unique = FALSE;
        }
        return $is_unique;
    }
}