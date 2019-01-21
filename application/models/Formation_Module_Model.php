<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class formation_module_model extends MY_Model {
    protected $_table = "formations_modules";
    protected $primary_key = 'id';
    protected $protected_attributes = ['id'];
    protected $belongs_to = ["Formations" => ["primary_key" => "fk_formation",
                                                  "model" => "formation_model"],
                           "Modules" => ["primary_key" => "fk_module",
                                               "model" => "module_subject_model"]];

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