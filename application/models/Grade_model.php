<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class grade_model extends MY_Model {
    protected $protected_attributes = ['id'];
    protected $belongs_to = ["Parent_Apprentice_Formation" => ["primary_key" => "fk_apprentice_formation",
																"model" => "apprentice_formation_model"],
                            "Parent_Module_Subject" => ["primary_key" => "fk_module_subject",
                                                        "model" => "module_subject_model"]];

    /**
     * Constructor
     */
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
        return $this->module_subject_model->get_all();
    }
}