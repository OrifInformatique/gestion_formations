<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class formation_model extends MY_Model {
    protected $protected_attributes = ["id"];
    protected $has_many = ["Child_Apprentices_Formation" => ["primary_key" => "fk_formation",
                                                            "model" => "model_formation"],
                            "Child_Formations_Modules" => ["primary_key" => "fk_formation",
                                                            "model" => "model_formation"],
                            "Child_Apprentice" => ["primary_key" => "fk_formation",
                                                    "model" => "model_formation"]];

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