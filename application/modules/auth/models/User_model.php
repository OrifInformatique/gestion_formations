<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * User is used to give access to the application.
 * User_type is used to give different access rights (defining an access level).
 * 
 * @author      Orif (UlSi, ViDi)
 * @link        https://github.com/OrifInformatique
 * @copyright   Copyright (c) Orif (https://www.orif.ch)
 */
class user_model extends MY_Model
{
    /* Set MY_Model variables */
    protected $_table = 'users';
    protected $primary_key = 'id';
    protected $protected_attributes = ['id'];
    protected $belongs_to = ['user_type'=> ['primary_key' => 'fk_user_type',
                                            'model' => 'user_type_model']];
    protected $has_many = ['Child_Apprentice' => ['primary_key' => 'fk_user',
                                                    'model' => 'apprentice_model'],
                            'Child_Teacher' => ['primary_key' => 'fk_user',
                                                'model' => 'teacher_model']];

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Check username and password for login
     *
     * @param $username
     * @param $password
     * @return bool true on success, false on failure
     */
    public function check_password($username, $password)
    {
        $user = $this->get_by('user', $username);

        if (!is_null($user)) {
            // A corresponding active user has been found
            // Check password
            return password_verify($password, $user->password);
        }
        else {
            // No corresponding active user
            return false;
        }
    }
}