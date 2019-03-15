<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class formation_module_group_model extends MY_Model {
    /* SET MY_Model VARIABLES */
    protected $_table = 'formations_modules_groups';
    protected $protected_attributes = ['id'];
    protected $belongs_to = ['Parent_Group' => ['primary_key' => 'fk_parent_group',
                                            'model' => 'formation_module_group_model'],
                            "Parent_Formation" => ["primary_key" => "fk_formation",
                                                    "model" => "formation_model"]];
    protected $has_many = ['Child_Groups' => ['primary_key' => 'fk_parent_group',
                                          'model' => 'formation_module_group_model'],
                            "Child_Modules_Groups" => ["primary_key" => "fk_formation_modules_group",
                                                        "model" => "module_group_model"]];

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Returns groups ordered by position
     * @param string $main
     *      The column that will be used for the sorting
     * @param string $direction
     *      'asc' or 'desc', wether it goes from top to bottom or not
     * @return array
     *      All groups
     */
    public function get_ordered($main = 'id', $direction = 'asc'){
        $this->db->order_by($main, $direction);
        return $this->formation_module_group_model->get_all();
    }

    /**
     * Returns the tree of the group and its parents
     * @param integer $parent_group
     *      The parent group, usually at fk_parent_group
     * @return array
     *      All groups sorted
     */
    public function get_tree($parent_group = 0, $first_run = false){

        if($first_run){
            $groups = $this->formation_module_group_model->get_many_by("fk_formation = ".$parent_group);
        } else {
            $groups = $this->formation_module_group_model->get_many_by("fk_parent_group = ".$parent_group);
        }

        $groups_tree = array();
        if (count($groups) > 0){
            foreach ($groups as $group) {
                $groups_tree[$group->name_group] = array(0, $group->id, $this->formation_module_group_model->get_tree($group->id));
            }
        }

        $modules = $this->module_group_model->get_many_by("fk_formation_modules_group=".$parent_group);
        $modules_titles = array();
        foreach ($modules as $module) {
            $modules_titles[$module->id] = array(1, $module->fk_module, $this->module_subject_model->get($module->fk_module));
        }
        $groups_tree = array_merge($modules_titles, $groups_tree);
        

        if(!isset($groups_tree) || is_null($groups_tree))
            $groups_tree = NULL;

        return $groups_tree;
    }
}