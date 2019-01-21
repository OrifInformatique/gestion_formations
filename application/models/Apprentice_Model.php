<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class apprentice_model extends MY_Model {
    protected $_table = "apprentices";
    protected $primary_key = 'id';
    protected $protected_attributes = ['id'];
    protected $belongs_to = ["Parent_Formation" => ["primary_key" => "fk_formation",
                                                    "model" => "formation_model"],
                            "Parent_MSP" => ["primary_key" => "fk_teacher",
                                            "model" => "taecher_model"],
                            "Parent_User" => ["primary_key" => "fk_user",
                                            "model" => "user_model"]];
    protected $has_many = ["Child_Apprentices_Formation" => ["primary_key" => "fk_apprentice",
                                                            "model" => "apprentice_model"]];

    public function __construct() {
        parent::__construct();
    }

    /**
    * Gets all the database entries ordered
    * @param string $main
    *       Column that is looked at for the sorting
    * @param string $direction
    *       Ascendent or descentent
    */
    public function get_ordered($main = 'id', $direction = 'asc'){
        $this->db->order_by($main, $direction);
        return $this->apprentice_model->get_all();
    }
}