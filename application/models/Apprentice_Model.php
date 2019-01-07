<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class apprentice_model extends MY_Model {
    protected $_table = "t_apprentices";
    protected $primary_key = 'ID';
    protected $protected_attributes = ['ID'];
    protected $belongs_to = ["Parent_Formation" => ["primary_key" => "FK_Formation",
                                                    "model" => "formation_model"],
                            "Parent_MSP" => ["primary_key" => "FK_MSP",
                                            "model" => "msp_model"],
                            "Parent_User" => ["primary_key" => "FK_User",
                                            "model" => "user_model"]];
    protected $has_many = ["Child_Apprentices_Formation" => ["primary_key" => "FK_Apprentice",
                                                            "model" => "apprentice_model"]];

    public function __construct() {
        parent::__construct();
    }

    public function get_ordered($main = 'ID', $direction = 'asc'){
        $this->db->order_by($main, $direction);
        return $this->apprentice_model->get_all();
    }
}