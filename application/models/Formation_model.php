<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class formation_model extends MY_Model {
    protected $protected_attributes = ["id"];
    protected $has_many = ["Child_Apprentices_Formation" => ["primary_key" => "fk_formation",
                                                            "model" => "formation_model"],
                            "Child_Formations_Modules_Groups" => ["primary_key" => "fk_formation",
                                                                "model" => "formation_module_group_model"]];

    public function __construct() {
        parent::__construct();
    }

    /**
     * Gets all the database entries ordered
     * @param string $main
     *      Column that is looked at for the sorting
     * @param string $direction
     *      Ascendent or descentent
     */
    public function get_ordered($main = 'id', $direction = 'asc'){
        $this->db->order_by($main, $direction);
        return $this->formation_model->get_all();
    }
}