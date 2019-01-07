<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class msp_model extends MY_Model {
    protected $_table = "t_msps";
    protected $primary_key = 'ID';
    protected $protected_attributes = ['ID'];
    protected $belongs_to = ["Parent_User" => ["primary_key" => "FK_User",
                                                "model" => "user_model"]];
    protected $has_many = ["Child_Apprentice" => ["primary_key" => "FK_MSP",
                                                  "model" => "msp_model"]];

    public function __construct() {
        parent::__construct();
    }

    public function get_ordered($main = 'ID', $direction = 'asc'){
        $this->db->order_by($main, $direction);
        return $this->apprentice_model->get_all();
    }
}