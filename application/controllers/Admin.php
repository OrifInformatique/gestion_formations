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
        $outputs['admin_selected'] = 0;
        $this->display_view('admin/list', $outputs);
    }

    /**
     * Modified version of display view
     * Mainly for not having to add 'admin/common/nav' to every call
     *
     * @param string|string[] $view_parts
     *      Single view or array of view parts to display
     * @param array $data
     *      Data array to send to the view
     */
    public function display_view($view_parts, $data = NULL) {
        $forward = ['admin/common/nav'];
        if(!is_array($view_parts)) {
            $forward[] = $view_parts;
        } else {
            $forward += $view_parts;
        }

        parent::display_view($forward, $data);
    }

    /************************
     * User-related functions
     ************************/
    /**
     * Shows the list of users.
     */
    public function user_index() {
        $outputs = array(
            'admin_selected' => 1,
            'users' => $this->user_model->get_all(),
            'user_types' => $this->user_type_model->get_all()
        );
        $this->display_view('admin/users/list', $outputs);
    }

    /**
     * Shows the form for new/existing users
     * @param integer $id
     *      ID of the user to modify. Leave at 0 to create a new user
     */
    public function user_form($id = 0) {
        $user_types = $this->user_type_model->dropdown('type');
        $user_types[0] = $this->lang->line('none');
        $outputs = array(
            'admin_selected' => 1,
            'user_types' => $user_types,
            'user' => ($id > 0 ? $this->user_model->get($id) : NULL),
        );

        $this->display_view('admin/users/form', $outputs);
    }

    /**
     * Makes sure that the form was filled correctly.
     */
    public function user_form_validation() {
        $user_id = $this->input->post('id');
        $update = (!is_null($user_id));

        $req = array(
            'user' => $this->input->post('user_username'),
            'fk_user_type' => $this->input->post('user_type')
        );

        // Checks that the inputs don't mess the program
        $this->form_validation->set_rules('user_username', $this->lang->line('user_username'), [
            'trim', 'required',
            'min_length['.USERNAME_MIN_LENGTH.']',
            'is_unique[users.user]',
            'regex_match[/^[A-Za-z0-9 \-]+$/]'
        ]);
        $this->form_validation->set_rules('user_type', $this->lang->line('user_type'), 'required');
        // If it's a new user, create a password with it
        if(!$update) {
            $new_password = $this->input->post('user_password_again');
            $this->form_validation->set_rules('user_password', $this->lang->line('user_password'),
                array('trim','required','min_length['.PASSWORD_MIN_LENGTH.']','callback_cb_check_new_password['.$new_password.']'));
            $req['password'] = password_hash($this->input->post('user_password'), PASSWORD_DEFAULT);
        }

        if($this->form_validation->run()) {
            if($user_id > 0) {
                $this->user_model->update($user_id, $req);
            } else {
                $this->user_model->insert($req);
            }
            redirect('admin/user_index');
        } else {
            $this->user_form($user_id);
        }
    }

    /**
     * Opens the form to change a password
     * @param integer $id
     *      ID of the user's password to change
     */
    public function user_change_password($id) {
        $outputs = array(
            'admin_selected' => 1,
            'user' => $this->user_model->get($id)
        );

        $this->display_view('admin/users/cp', $outputs);
    }

    /**
     * Verifies that the old password corresponds to the user's password
     * and that the new password is repeated twice.
     */
    public function user_change_password_validation() {
        $user_id = $this->input->post('id');
        $base_rules = 'trim|required|min_length['.PASSWORD_MIN_LENGTH.']';

        $req = array(
            'password' => password_hash($this->input->post('user_password_new'), PASSWORD_DEFAULT)
        );

        $new_password = $this->input->post('user_password_new');
        $username = $this->user_model->get($user_id)->user;
        //Check user password
        $this->form_validation->set_rules('user_password_old', $this->lang->line('user_password_old'),
            $base_rules.'|callback_cb_check_old_password['.$username.']');
        //Check that the new password did get in
        $this->form_validation->set_rules('user_password_new', $this->lang->line('user_password_new'),
            $base_rules);
        //Check that the new password was repeated twice
        $this->form_validation->set_rules('user_password_again', $this->lang->line('user_password_again'),
            $base_rules.'|callback_cb_check_new_password['.$new_password.']');

        if($this->form_validation->run()) {
            $this->user_model->update($user_id, $req);
            redirect('admin/user_index');
        } else {
            $this->user_change_password($user_id);
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
        $teachers = $this->teacher_model->count_by('fk_user='.$id);
        $apprentices = $this->apprentice_model->count_by('fk_user='.$id);
        $deletion_allowed = ($teachers + $apprentices <= 0);

        $outputs = array(
            'admin_selected' => 1,
            'user' => $this->user_model->get($id),
            'deletion_allowed' => $deletion_allowed
        );

        switch($confirm) {
            case 0:
                $this->display_view('admin/users/delete', $outputs);
                break;
            case 1:
                // In case the user attempts to force the deletion
                if(!$deletion_allowed) redirect('admin/user_index');
                $this->user_model->delete($id);
                $this->display_view('admin/users/success', ['admin_selected' => 1]);
                break;
            default:
                redirect('admin/user_index');
                break;
        }
    }

    /**
     * Checks if the password corresponds to a username.
     *
     * Used as a callback in user_change_password_validation()
     * because adding 2 anonymous functions in there is ugly.
     *
     * @param string $old_password
     *      The user's password
     * @param string $username
     *      The username
     * @return boolean
     *      TRUE if it corresponds
     */
    public function cb_check_old_password($old_password, $username) {
        return $this->user_model->check_password($username, $old_password);
    }

    /**
     * Checks if the new password and its confirmation are the same.
     *
     * Used as a callback in user_change_password_validation()
     * because adding 2 anonymous functions in there is ugly.
     *
     * @param string $new_password
     *      The new password
     * @param string new_password_conf
     *      Should be the same as above
     * @return boolean
     *      TRUE if the passwords are the same
     */
    public function cb_check_new_password($new_password, $new_password_conf) {
        return (strcmp($new_password, $new_password_conf) == 0);
    }

    /*****************************
     * User type-related functions
     *****************************/
    /**
     * Shows the list of user types.
     */
    public function user_type_index() {
        $outputs = array(
            'admin_selected' => 2,
            'access_levels' => array_flip(ACCESS_LVLS),
            'user_types' => $this->user_type_model->get_all()
        );
        $this->display_view('admin/user_types/list', $outputs);
    }

    /**
     * Shows the form for new/existing user types
     * @param integer $id
     *      ID of the user to modify. Leave at 0 to create a new user type
     */
    public function user_type_form($id = 0) {
        $outputs = array(
            'admin_selected' => 2,
            'access_levels' => array_flip(ACCESS_LVLS),
            'user_type' => ($id > 0 ? $this->user_type_model->get($id) : NULL),
        );

        $this->display_view('admin/user_types/form', $outputs);
    }

    /**
     * Makes sure that the form was filled correctly.
     */
    public function user_type_form_validation() {
        $this->form_validation->set_rules('user_type_type', $this->lang->line('user_type_type'),
            ['required','regex_match[/^[A-Za-zÀ-ÿ ]+$/]']);
        $this->form_validation->set_rules('user_type_access_level', $this->lang->line('user_type_access_level'),
            ['required']);

        $req = array(
            'type' => $this->input->post('user_type_type'),
            'access_level' => $this->input->post('user_type_access_level')
        );

        if($this->form_validation->run()) {
            if($this->input->post('id') > 0) {
                $this->user_type_model->update($this->input->post('id'), $req);
            } else {
                $this->user_type_model->insert($req);
            }
            redirect('admin/user_type_index');
        } else {
            $this->user_type_form($this->input->post('id'));
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
        $users = $this->user_model->count_by('fk_user_type='.$id);
        $deletion_allowed = ($users <= 0);
        $outputs = array(
            'admin_selected' => 2,
            'user_type' => $this->user_type_model->get($id),
            'deletion_allowed' => $deletion_allowed
        );

        switch($confirm) {
            case 0:
                $this->display_view('admin/user_types/delete', $outputs);
                break;
            case 1:
                // In case the user attempts to force the deletion
                if(!$deletion_allowed) redirect('admin/user_type_index');
                $this->user_type_model->delete($id);
                $this->display_view('admin/user_types/success', ['admin_selected' => 2]);
                break;
            default:
                redirect('admin/user_type_index');
                break;
        }
    }

    /****************************
     * Teachers-related functions
     ****************************/
    /**
     * Shows the list of teachers
     */
    public function teacher_index() {
        $outputs = array(
            'admin_selected' => 3,
            'teachers' => $this->teacher_model->get_all(),
            'users' => $this->user_model->get_all()
        );
        $this->display_view('admin/teachers/list', $outputs);
    }

    /**
     * Shows the form for new/existing teachers
     * @param integer $id
     *      ID of the teacher to modify
     */
    public function teacher_form($id = 0) {
        $users = $this->user_model->dropdown('User');
        $users[0] = $this->lang->line('none');
        $outputs = array(
            'admin_selected' => 3,
            'users' => $users,
            'teacher' => ($id > 0 ? $this->teacher_model->get($id) : NULL),
        );

        $this->display_view('admin/teachers/form', $outputs);
    }

    /**
     * Validates the inputs in the teacher form
     */
    public function teacher_form_validation() {
        $teacher_id = $this->input->post('id');
        $this->form_validation->set_rules('teacher_firstname', $this->lang->line('teacher_firstname'),
            ['trim','required','regex_match[/^[A-Za-zÀ-ÿ0-9 \-]+$/]']);
        $this->form_validation->set_rules('teacher_name', $this->lang->line('teacher_name'),
            ['trim','required','regex_match[/^[A-Za-zÀ-ÿ0-9 \-]+$/]']);
        $this->form_validation->set_rules('teacher_user', $this->lang->line('teacher_username'),
            ['required']);

        $req = array(
            'firstname' => $this->input->post('teacher_firstname'),
            'last_name' => $this->input->post('teacher_name'),
            'fk_user' => $this->input->post('teacher_user')
        );

        if($this->form_validation->run()) {
            if($teacher_id > 0) {
                $this->teacher_model->update($teacher_id, $req);
            } else {
                $this->teacher_model->insert($req);
            }
            redirect('admin/teacher_index');
        } else {
            $this->teacher_form($teacher_id);
        }
    }

    /**
     * Deletes a teacher
     * @param integer $id
     *      ID of the teacher to delete
     * @param integer $confirm
     *      0 leads to the confirmation prompt, 1 deletes the teacher
     */
    public function teacher_delete($id, $confirm = 0) {
        $this->load->model('apprentice_model');
        $apprentices = $this->apprentice_model->count_by('fk_teacher='.$id);
        $deletion_allowed = ($apprentices <= 0);

        $outputs = array(
            'admin_selected' => 3,
            'teacher' => $this->teacher_model->get($id),
            'deletion_allowed' => $deletion_allowed
        );

        switch($confirm) {
            case 0:
                $this->display_view('admin/teachers/delete', $outputs);
                break;
            case 1:
                // In case the user attempts to force the deletion
                if(!$deletion_allowed) redirect('admin/teacher_index');
                $this->teacher_model->delete($id);
                $this->display_view('admin/teachers/success', ['admin_selected' => 3]);
                break;
            default:
                redirect('admin/teacher_index');
                break;
        }
    }
}