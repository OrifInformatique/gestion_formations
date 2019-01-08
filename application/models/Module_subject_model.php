<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class module_subject_model extends MY_Model {
    /* SET MY_Model VARIABLES */
    protected $_table = 't_modules_subjects';
    protected $primary_key = 'ID';
    protected $protected_attributes = ['ID'];
    protected $belongs_to = ['Group' => ['primary_key' => 'FK_Group',
                                         'model' => 'groups_model']];
    protected $has_many = ['Formation_modules' => ['primary_key' => 'FK_Module',
                                                   'model' => 'formation_module_model'],
                           'Grades' => ['primary_key' => 'FK_Module_Subject',
                                        'model' => 'grades_model']];

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
    }

    public function get_ordered($main = 'ID', $direction = 'asc'){
        $this->db->order_by($main, $direction);
        return $this->module_subject_model->get_all();
    }
}