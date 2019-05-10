<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class module_subject_model extends MY_Model {
    /* SET MY_Model VARIABLES */
    protected $_table = 'modules_subjects';
    protected $protected_attributes = ['id'];
    protected $has_many = ['Modules_Groups' => ['primary_key' => 'fk_module',
                                                   'model' => 'module_group_model'],
                           'Grades' => ['primary_key' => 'fk_module_subject',
                                        'model' => 'grades_model']];

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