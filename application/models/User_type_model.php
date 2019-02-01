<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * User model is used to give access to the application.
 * user_type is used to give different access rights (defining an access level).
 *
 * @author      Orif, section informatique (UlSi, ViDi)
 * @link        https://github.com/OrifInformatique/gestion_formations
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */
class user_type_model extends MY_Model
{
    protected $_table = 'users_types';
    
    protected $protected_attributes = ['id'];
    public $has_many = ['users' => ['primary_key' => 'fk_user_type',
                                    'model' => 'user_model']];

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Gets all the database entries ordered
     * @param string $main
     *      Column that is looked at for the sorting
     * @param string $direction
     *      Ascendent or descendent
     */
    public function get_ordered($main = 'id', $direction = 'asc'){
        $this->db->order_by($main, $direction);
        return $this->user_type_model->get_all();
    }
}