<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class teacher_model extends MY_Model {
    protected $_table = "teachers";
    protected $primary_key = 'ID';
    protected $protected_attributes = ['ID'];
    protected $belongs_to = ["Parent_User" => ["primary_key" => "fk_user",
                                                "model" => "user_model"]];
    protected $has_many = ["Child_Apprentice" => ["primary_key" => "fk_teacher",
                                                  "model" => "msp_model"]];

    public function __construct() {
        parent::__construct();
    }

    public function get_ordered($main = 'ID', $direction = 'asc'){
        $this->db->order_by($main, $direction);
        return $this->apprentice_model->get_all();
    }
}