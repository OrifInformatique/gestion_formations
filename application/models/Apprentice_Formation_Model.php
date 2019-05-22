<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class apprentice_formation_model extends MY_Model {
    protected $protected_attributes = ['id'];
    protected $belongs_to = ["Parent_Apprentice" => ["primary_key" => "fk_apprentice",
                                                    "model" => "apprentice_model"],
                            "Parent_Formation" => ["primary_key" => "fk_formation",
                                                    "model" => "formation_model"]];
    protected $has_many = ["Child_Grade" => ["primary_key" => "fk_apprentice_formation",
                                            "model" => "apprentice_formation_model"]];

    public function __construct() {
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
        return $this->apprentice_model->get_all();
    }
}