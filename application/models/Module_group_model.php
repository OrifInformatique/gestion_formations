<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class module_group_model extends MY_Model {
    protected $_table = "modules_groups";
    protected $protected_attributes = ['id'];
    protected $belongs_to = ["Modules_Subjects" => ["primary_key" => "fk_module",
                                               "model" => "module_subject_model"],
                            "Formation_module_group" => ["primary_key" => "fk_formation_modules_group",
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
        return $this->module_group_model->get_all();
    }
}