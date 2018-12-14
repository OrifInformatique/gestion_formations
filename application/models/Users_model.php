<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * User is used to give access to the application.
 * User type is used to give different access rights (defining an access level).
 * 
 * @author      Orif, section informatique (UlSi, ViDi)
 * @link        https://github.com/OrifInformatique/gestion_formations
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */
class users_model extends MY_Model
{
    /* SET MY_Model VARIABLES */
    protected $_table = 't_users';
    protected $primary_key = 'ID';
    protected $protected_attributes = ['ID'];
    protected $belongs_to = ['user_type'=> ['primary_key' => 'FK_User_Type',
                                            'model' => 'user_type_model']];

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
     * @access public
     * @param $username
     * @param $password
     * @return bool true on success, false on failure
     */
    public function check_password($username, $password)
    {
        $user = $this->get_by('User', $username);

        if (!is_null($user) && password_verify($password, $user->Password)) {
            return true;
        }else{
            return false;
        }
    }
}