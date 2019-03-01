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
        $this->load->model(['user_model','user_type_model']);
        $this->load->helper(['form', 'url']);
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
     * Validate the login informations and create session variables.
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
                $user = $this->user_model->with('users_type')->get_by('user', $username);

                $this->session->user_id = $user->id;
                $this->session->username = $user->user;
                $this->session->user_access = $this->user_type_model->get($user->fk_user_type)->access_level;
                $this->session->logged_in = true;

                redirect('index.php');
            } else {
                // Login informations error : display login page again, with error message
                $this->index(1);
            }
        } else {
            // Validation error : display login page again, with error messages
            $this->index(2);
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
     * Checks if the username is unique.<br>
     * Unused because I forgot there was a is_unique filter
     * @param string $username
     *      Username to check
     * @return boolean
     *      TRUE if the username is unique
     */
    private function is_username_unique($username) {
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