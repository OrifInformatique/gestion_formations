<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class formation_model extends MY_Model {
    protected $_table = "t_formations";
    protected $primary_key = "ID";
    protected $protected_attributes = ["ID"];
    protected $has_many = ["Child_Apprentices_Formation" => ["primary_key" => "FK_Formation",
                                                            "model" => "model_formation"],
                            "Child_Formations_Modules" => ["primary_key" => "FK_Formation",
                                                            "model" => "model_formation"],
                            "Child_Apprentice" => ["primary_key" => "FK_Formation",
                                                    "model" => "model_formation"]];

    public function __construct() {
        parent::__construct();
    }

    public function get_ordered($main = 'ID', $direction = 'asc'){
        $this->db->order_by($main, $direction);
        return $this->apprentice_model->get_all();
    }
}